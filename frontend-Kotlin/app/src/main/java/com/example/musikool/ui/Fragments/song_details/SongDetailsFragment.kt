package com.example.musikool.ui.Fragments.song_details

import android.graphics.Color
import android.os.Bundle
import androidx.fragment.app.Fragment
import android.view.LayoutInflater
import android.view.View
import android.view.ViewGroup
import android.webkit.WebChromeClient
import android.webkit.WebViewClient
import android.widget.ImageView
import android.widget.Toast
import androidx.appcompat.app.AppCompatActivity
import androidx.lifecycle.lifecycleScope
import androidx.recyclerview.widget.LinearLayoutManager
import com.example.musikool.API.SecureStorage
import com.example.musikool.Adapters.CompassAdapter
import com.example.musikool.DTOs.Request.Models.SongReviewRequest
import com.example.musikool.DTOs.Response.Auth.LoginResponse
import com.example.musikool.Entities.Compass
import com.example.musikool.Entities.Song
import com.example.musikool.Entities.SongReview
import com.example.musikool.R
import com.example.musikool.Repositories.SongRepository
import com.example.musikool.Repositories.SongReviewRepository
import com.example.musikool.databinding.FragmentSongDetailsBinding
import kotlinx.coroutines.launch

class SongDetailsFragment : Fragment() {

    private var _binding: FragmentSongDetailsBinding? = null
    private val binding get() = _binding!!

    private lateinit var songRepository: SongRepository
    private lateinit var songReviewRepository: SongReviewRepository
    private lateinit var compassAdapter: CompassAdapter

    private var selectedRating = 0
    private lateinit var starViews: List<ImageView>

    private var currenUserReview : SongReview? = null

    private var bpm : Int = 0
    private var metric : String = ""
    private var  chordNames = mutableListOf<String>()

    private var isPlaying = false

    private val baseBpm = 120.0

    override fun onCreateView(
        inflater: LayoutInflater,
        container: ViewGroup?,
        savedInstanceState: Bundle? ): View {

        _binding = FragmentSongDetailsBinding.inflate(inflater, container, false)
        val songName = arguments?.getString("song_title") ?: "Canción"
        (requireActivity() as AppCompatActivity).supportActionBar?.title = songName

        songRepository = SongRepository(requireContext())
        songReviewRepository = SongReviewRepository(requireContext())

        val loginResponse = SecureStorage.getObject(requireContext(), "Token", LoginResponse::class.java)
        val songId = arguments?.getInt("song_id") ?: -1
        binding.compassesList.layoutManager = LinearLayoutManager(requireContext())

        starViews= listOf(
            binding.star1, binding.star2,binding.star3, binding.star4, binding.star5
        )

        starViews.forEachIndexed { index, view ->
            view.setOnClickListener {
                selectedRating = index + 1
                updateStarImages(selectedRating)
            }
        }

        getSongReviewAPI(songId)

        if(loginResponse != null){
            binding.reviews.visibility = View.VISIBLE
            binding.btnReview.setOnClickListener {
                if (selectedRating == 0){
                    Toast.makeText(requireContext(), "Selecciona una calificación", Toast.LENGTH_SHORT).show()
                    return@setOnClickListener
                }
                val reviewRequest = SongReviewRequest(selectedRating, loginResponse?.user?.id ?: -1)
                if( currenUserReview == null) saveSongReviewAPI(songId, reviewRequest)
                else updateSongReviewAPI(songId,  reviewRequest)
            }
        }else{
            binding.reviews.visibility = View.GONE
        }



        // configurar botones de play/stop (no cargamos WebView aun)
        setupPlayer()

        getSongAPI(songId)

        return binding.root
    }

    private fun getSongAPI(songId : Int) {
        binding.progressBar.root.visibility = View.VISIBLE
        binding.layoutFragmentDetails.visibility = View.GONE
        binding.emptyStateContainer.root.visibility = View.GONE

        songRepository.getSong( songId, include = "artist,genre,compasses.musicalNotes.rhythmicFigure,metric,scale") { result ->
            if (!isAdded || _binding == null || view == null) return@getSong
            viewLifecycleOwner.lifecycleScope.launch  {
                binding.progressBar.root.visibility = View.GONE

                result.onSuccess { response ->
                    if(response == null){
                        binding.emptyStateContainer.root.visibility = View.VISIBLE
                        binding.layoutFragmentDetails.visibility = View.GONE
                    }else{
                        showSong(response)
                        showCompasses(response.compasses ?: emptyList())

                        bpm = response.bpm.toInt()
                        metric = response.song_metric?.name ?: "4/4"

                        chordNames.clear()


                        response.compasses?.forEach { comp ->
                            comp.musical_notes?.forEach { note ->
                                // usa is_silence si existe, si no, considera "-" como silencio
                                val isSilent = try { note.is_silence ?: false } catch (e: Exception) { false }
                                val chordName = if (isSilent) "-" else (note.chord?.chord_name ?: "-")
                                val durationBeats = try { note.duration_in_compass?.toInt() ?: 1 } catch (e: Exception) { 1 }
                                val safeName = chordName.replace("\"", "\\\"")
                                val silentFlag = if (isSilent || chordName.trim() == "-") "true" else "false"
                                chordNames.add("{\"name\":\"$safeName\",\"dur\":$durationBeats,\"silent\":$silentFlag}")
                            }
                        }

                        val notesJson = chordNames.joinToString(prefix = "[", postfix = "]", separator = ",")
                        if (chordNames.isNotEmpty()) {
                            loadPlayerHTML(notesJson)
                        } else {
                            Toast.makeText(requireContext(), "No hay acordes disponibles.", Toast.LENGTH_SHORT).show()
                        }



                        binding.emptyStateContainer.root.visibility = View.GONE
                        binding.layoutFragmentDetails.visibility = View.VISIBLE

                    }
                }
                result.onFailure { error ->
                    Toast.makeText(requireContext(), "Error: ${error.message}", Toast.LENGTH_SHORT).show()
                    binding.emptyStateContainer.root.visibility = View.VISIBLE
                }
            }
        }
    }

    private fun getSongReviewAPI(songId: Int){
        songReviewRepository.getSongReview( songId) { result ->
            if (!isAdded || _binding == null || view == null) return@getSongReview
            viewLifecycleOwner.lifecycleScope.launch  {
                result.onSuccess { response ->
                    currenUserReview = response.data
                    showSongReview(response.data)
                }
            }
        }
    }

    private fun saveSongReviewAPI(songId: Int, reviewRequest: SongReviewRequest){
        songReviewRepository.saveSongReview( songId, reviewRequest) { result ->
            if (!isAdded || _binding == null || view == null) return@saveSongReview
            viewLifecycleOwner.lifecycleScope.launch  {
                result.onSuccess { response ->
                    Toast.makeText(requireContext(), "Reseña guardada.", Toast.LENGTH_SHORT).show()
                    currenUserReview = response.data
                    getSongReviewAPI(songId)
                }
                result.onFailure { error ->
                    Toast.makeText(requireContext(), "Error: ${error.message}", Toast.LENGTH_SHORT).show()
                }
            }
        }
    }

    private fun updateSongReviewAPI(songId: Int, reviewRequest: SongReviewRequest){
        songReviewRepository.updateSongReview( songId, reviewRequest) { result ->
            if (!isAdded || _binding == null || view == null) return@updateSongReview
            viewLifecycleOwner.lifecycleScope.launch  {
                result.onSuccess { response ->
                    Toast.makeText(requireContext(), "Reseña actualizada.", Toast.LENGTH_SHORT).show()
                    currenUserReview = response.data
                }
                result.onFailure { error ->
                    Toast.makeText(requireContext(), "Error: ${error.message}", Toast.LENGTH_SHORT).show()
                }
            }
        }
    }

    private fun showSong(song: Song){
        binding.viewUserColorLayout.setBackgroundColor(Color.parseColor(song.user?.color))
        binding.viewGenreColorLayout.setBackgroundColor(Color.parseColor(song.musical_genre?.color))
        binding.txtSongName.text = song.title ?: "Sin título"
        binding.txtUserName.text = song.user?.name ?: "Desconocido"
        binding.txtSongGenre.text = "Género: ${song.musical_genre?.name}" ?: "Sin género"
        binding.txtSongScale.text = "Escala: ${song.song_scale?.name}" ?: "Sin escala"
        binding.txtSongMetric.text = "Métrica: ${song.song_metric?.name}" ?: "Sin métrica"
        binding.txtSongBPM.text = "Velocidad: ${song.bpm} BPM" ?: "—"
    }

    private fun showCompasses(compassList: List<Compass>) {
        binding.compassProgressBar.root.visibility = View.VISIBLE

        compassAdapter = CompassAdapter(compassList)
        binding.compassesList.adapter = compassAdapter
        binding.compassesList.visibility = View.VISIBLE

        if (compassList.isEmpty()) {
            binding.compassEmptyStateContainer.root.visibility = View.VISIBLE
            binding.compassesList.visibility = View.GONE
        } else {
            binding.compassEmptyStateContainer.root.visibility = View.GONE
            binding.compassesList.visibility = View.VISIBLE
        }

        binding.compassProgressBar.root.visibility = View.GONE
    }

    private fun showSongReview(songReview: SongReview){
        updateStarImages(songReview.rating)
    }

    private fun updateStarImages(rating: Int){
        starViews.forEachIndexed { index, view ->
            if (index < rating){
                view.setImageResource(R.drawable.ic_star_filled)
            }else{
                view.setImageResource(R.drawable.ic_star_border)
            }
        }
    }

    private fun setupPlayer(){
        binding.btnPlay.setOnClickListener {
            if (isPlaying){
                // pause
                binding.webView.evaluateJavascript("pauseFromAndroid();", null)
                binding.btnPlay.text = "▶️"
                isPlaying = false
            } else {
                // start: evaluamos JS que resume AudioContext y arranca metrónomo
                val safeMetric = metric.replace("'", "\\'")
                val js = "playFromAndroid(${bpm}, '$safeMetric');"
                binding.webView.evaluateJavascript(js, null)
                binding.btnPlay.text = "⏸"
                isPlaying = true
            }
        }

        binding.btnStop.setOnClickListener {
            binding.webView.evaluateJavascript("resetFromAndroid();", null)
            binding.btnPlay.text = "▶️"
            isPlaying = false
        }
    }



    /**
     * Crea un HTML que:
     *  - recibe NOTE_URLS desde Kotlin (array JSON)
     *  - decodifica los buffers con fetch()->decodeAudioData()
     *  - reproduce el siguiente buffer en cada pulso del metrónomo
     *  - usa la fórmula intervalMs = (60000 / bpm) * (4 / denominator)
     *  - setPlaybackRate(rate) para ajustar la velocidad de reproducción
     */
    private fun loadPlayerHTML(notesJson: String) {
        val html = """
    <html>
    <head>
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
      <style>body{margin:0;background:transparent;color:#000;font-family:Arial;}#status{padding:8px;font-size:12px}</style>
    </head>
    <body>
      <div id="status">Player ready</div>
      <script>
        // NOTES: array of { name: "...", dur: N, silent: true|false }
        const NOTES = $notesJson || [];
        let audioCtx = null;
        let metronomeTimer = null;
        let metronomeState = { bpm: 120, beats: 4, denom: 4, running:false };
        let sequenceIndex = 0;
        let remainingBeats = 0;

        function ensureAudioCtx() {
          if (!audioCtx) audioCtx = new (window.AudioContext || window.webkitAudioContext)();
          return audioCtx;
        }

        // parse chord root -> simple triad frequencies
        function parseChordToFreqs(chordName) {
          if (!chordName || chordName.trim() === "-") return [];
          const rootMatch = chordName.trim().match(/^([A-Ga-g])([#b]?)/);
          if (!rootMatch) return [];
          const root = rootMatch[0].toUpperCase();
          const map = {'C':0,'C#':1,'DB':1,'D':2,'D#':3,'EB':3,'E':4,'F':5,'F#':6,'GB':6,'G':7,'G#':8,'AB':8,'A':9,'A#':10,'BB':10,'B':11};
          const rootKey = root.replace('b','B');
          const rootSemi = map[rootKey] || 0;
          const rootMidi = 60 + rootSemi; // approx C4 base
          const intervals = [0,4,7]; // major triad default
          return intervals.map(i => 440 * Math.pow(2, ((rootMidi + i) - 69) / 12));
        }

        function playFreqs(freqs, durationMs = 200, gainVal = 0.12) {
          try {
            ensureAudioCtx();
            const now = audioCtx.currentTime;
            const g = audioCtx.createGain();
            g.gain.value = gainVal;
            g.connect(audioCtx.destination);
            freqs.forEach(f => {
              const o = audioCtx.createOscillator();
              o.type = 'sine';
              o.frequency.value = f;
              o.connect(g);
              o.start(now);
              o.stop(now + durationMs / 1000);
            });
            setTimeout(()=>{ try{ g.disconnect(); }catch(e){} }, durationMs + 60);
          } catch(e) {
            console.warn('playFreqs error', e);
          }
        }

        function playFallbackClick() {
          ensureAudioCtx();
          const o = audioCtx.createOscillator();
          const g = audioCtx.createGain();
          o.frequency.value = 900;
          g.gain.value = 0.06;
          o.connect(g); g.connect(audioCtx.destination);
          o.start();
          setTimeout(()=>{ try{ o.stop(); g.disconnect(); }catch(e){} }, 50);
        }

        function computeIntervalMs(bpm, denom) {
          // duration of a quarter note = 60000 / bpm ; adjust by denominator
          return (60000.0 / bpm) * (4.0 / denom);
        }

        // Called every metronome pulse
        function onPulse() {
          // If we're sustaining current note/silence across multiple beats, just decrement
          if (remainingBeats > 0) {
            remainingBeats -= 1;
            // update UI if you want
            return;
          }

          if (!NOTES || NOTES.length === 0) {
            // no notes: optional click
            playFallbackClick();
            return;
          }

          const item = NOTES[sequenceIndex % NOTES.length];
          const name = (item.name !== undefined && item.name !== null) ? item.name : "-";
          const durBeats = (item.dur && Number(item.dur) > 0) ? Number(item.dur) : 1;
          const isSilent = !!item.silent || name.trim() === "-";

          // update status
          var statusText = '';
  if (isSilent) {
    statusText = 'Silencio (' + durBeats + ' beats)';
  } else {
    statusText = 'Acorde: ' + name + ' (' + durBeats + ' beats)';
  }
  var statusEl = document.getElementById('status');
  if (statusEl) statusEl.innerText = statusText;

          // only play when not silent
          if (!isSilent) {
            const freqs = parseChordToFreqs(name);
            if (freqs && freqs.length > 0) {
              const intervalMs = computeIntervalMs(metronomeState.bpm, metronomeState.denom);
              const noteDurationMs = Math.max(30, Math.round(intervalMs * durBeats * 0.9));
              playFreqs(freqs, noteDurationMs, 0.12);
            } else {
              // if parsing failed, optionally play a click instead or nothing
              // playFallbackClick();
            }
          } else {
            // silent: do nothing audible (no click)
          }

          // consume beats: we already used 1 beat now
          remainingBeats = durBeats - 1;
          sequenceIndex = (sequenceIndex + 1) % NOTES.length;
        }

        function startMetronome(bpmVal, metricStr) {
          stopMetronome();
          let parts = (metricStr || '4/4').split('/');
          const beats = parseInt(parts[0]) || 4;
          const denom = parseInt(parts[1]) || 4;
          metronomeState = { bpm: bpmVal || 120, beats: beats, denom: denom, running: true };

          const intervalMs = computeIntervalMs(metronomeState.bpm, metronomeState.denom);
          // immediate first pulse
          onPulse();
          metronomeTimer = setInterval(() => {
            if (!metronomeState.running) return;
            onPulse();
          }, intervalMs);
        }

        function stopMetronome() {
          metronomeState.running = false;
          if (metronomeTimer) { clearInterval(metronomeTimer); metronomeTimer = null; }
          document.getElementById('status').innerText = 'Stopped';
        }

        function resetPlayer() {
          stopMetronome();
          sequenceIndex = 0;
          remainingBeats = 0;
          document.getElementById('status').innerText = 'Reset';
        }

        // API from Android
        window.playFromAndroid = function(bpmArg, metricArg) {
          try {
            ensureAudioCtx();
            if (audioCtx.state === 'suspended') audioCtx.resume();
            document.getElementById('status').innerText = 'Playing';
            startMetronome(bpmArg || 120, metricArg || '4/4');
            return true;
          } catch(e) {
            console.warn('playFromAndroid error', e);
            return false;
          }
        }

        window.pauseFromAndroid = function() {
          stopMetronome();
          document.getElementById('status').innerText = 'Paused';
        }

        window.resetFromAndroid = function() {
          resetPlayer();
        }

        console.log('Player loaded. NOTES count:', NOTES.length);
      </script>
    </body>
    </html>
    """.trimIndent()

        binding.webView.settings.javaScriptEnabled = true
        binding.webView.settings.mediaPlaybackRequiresUserGesture = false
        binding.webView.webChromeClient = WebChromeClient()
        binding.webView.webViewClient = object : WebViewClient() {
            override fun onPageFinished(view: android.webkit.WebView?, url: String?) {
                super.onPageFinished(view, url)
                binding.webView.evaluateJavascript("console.log('Player HTML loaded');", null)
            }
        }
        binding.webView.loadDataWithBaseURL(null, html, "text/html", "UTF-8", null)
    }

    override fun onDestroyView() {
        super.onDestroyView()
        songRepository.cancelAllRequests()
        songReviewRepository.cancelAllRequests()
        // limpiar JS
        try {
            binding.webView.evaluateJavascript("resetFromAndroid();", null)
        } catch (_: Exception) {}
        _binding = null
    }
}
