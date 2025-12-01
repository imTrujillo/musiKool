package com.example.musikool.ui.Fragments.modify_song

import android.os.Bundle
import androidx.fragment.app.Fragment
import android.view.LayoutInflater
import android.view.View
import android.view.ViewGroup
import android.widget.ArrayAdapter
import android.widget.AutoCompleteTextView
import android.widget.Toast
import androidx.lifecycle.lifecycleScope
import androidx.navigation.fragment.findNavController
import androidx.recyclerview.widget.LinearLayoutManager
import com.example.musikool.API.SecureStorage
import com.example.musikool.Adapters.EditableCompassAdapter
import com.example.musikool.DTOs.Request.Models.SongRequest
import com.example.musikool.DTOs.Response.Auth.LoginResponse
import com.example.musikool.Entities.Compass
import com.example.musikool.Entities.Song
import com.example.musikool.Repositories.CompassRepository
import com.example.musikool.Repositories.SearchRepository
import com.example.musikool.Repositories.SongRepository
import com.example.musikool.Utils.showAPIError
import com.example.musikool.databinding.FragmentModifySongBinding
import kotlinx.coroutines.launch


class ModifySongFragment : Fragment() {
    private var _binding: FragmentModifySongBinding? = null
    // This property is only valid between onCreateView and onDestroyView.

    private val binding get() = _binding!!

    private lateinit var songRepository: SongRepository
    private lateinit var compassRepository : CompassRepository
    private lateinit var searchRepository : SearchRepository

    private lateinit var editableCompassAdapter: EditableCompassAdapter


    override fun onCreateView(
        inflater: LayoutInflater,
        container: ViewGroup?,
        savedInstanceState: Bundle?
    ): View {

        _binding = FragmentModifySongBinding.inflate(inflater, container, false)
        val view = binding.root

        val loginResponse = SecureStorage.getObject(requireContext(), "Token", LoginResponse::class.java)


        val songId = arguments?.getInt("song_id") ?: 0


        songRepository = SongRepository(requireContext())
        compassRepository = CompassRepository(requireContext())
        searchRepository = SearchRepository(requireContext())

        getGenresAPI()
        getSongScalesAPI()
        getSongMetricsAPI()

        if(songId > 0){
            getSongAPI(songId)
            binding.showCompasses.visibility = View.VISIBLE
        }else{
            binding.showCompasses.visibility = View.GONE
        }

        binding.btnModifySong.setOnClickListener {
            val metricId = (binding.autoCompleteMetric.tag as? Int) ?: 0
            val scaleId = (binding.autoCompleteScale.tag as? Int) ?: 0
            val genreId = (binding.autoCompleteGenre.tag as? Int) ?: 0

            if(
                binding.edtTitle.text.toString().isEmpty() ||
                binding.edtBPM.text.toString().isEmpty() ||
                metricId <= 0 || scaleId <= 0 || genreId <= 0){
                Toast.makeText(requireContext(), "Llena todos los campos", Toast.LENGTH_SHORT).show()
                return@setOnClickListener
            }

            val songRequest = SongRequest(
                binding.edtTitle.text.toString(),
                binding.edtBPM.text.toString().toIntOrNull() ?: 0,
                metricId,
                loginResponse?.user?.id  ?: 0,
                scaleId,
                genreId
            )

            if(songId > 0){
                updateSongAPI(songId, songRequest)
            } else {
                saveSongAPI(songRequest)
            }
        }

        binding.btnAddCompass.setOnClickListener {
            saveCompassAPI(songId)
        }


        return view
    }

    private fun getSongAPI(songId: Int) {

            binding.progressBar.root.visibility = View.VISIBLE
            binding.editableCompassesElementsList.visibility = View.GONE
            binding.emptyStateContainer.root.visibility = View.GONE

            songRepository.getSong( songId, include = "artist,genre,compasses.musicalNotes.rhythmicFigure,metric,scale") { result ->
                if (!isAdded || _binding == null || view == null) return@getSong
                viewLifecycleOwner.lifecycleScope.launch  {
                    binding.progressBar.root.visibility = View.GONE

                    result.onSuccess {
                            response ->
                        if(response == null){
                            binding.emptyStateContainer.root.visibility = View.VISIBLE
                        }else{
                            showSong(response )
                            showCompasses(response.compasses ?: emptyList())
                            binding.emptyStateContainer.root.visibility = View.GONE
                        }

                    }
                    result.onFailure { error ->
                        Toast.makeText(requireContext(), "Error: ${error.message}", Toast.LENGTH_SHORT).show()
                        binding.emptyStateContainer.root.visibility = View.VISIBLE
                    }
                }
            }


    }


    private fun saveSongAPI(songRequest: SongRequest) {
        binding.btnModifySong.isEnabled = false
        binding.btnModifySong.text = "Cargando..."

        songRepository.saveSong( songRequest) { result ->
            if (!isAdded || _binding == null || view == null) return@saveSong
            viewLifecycleOwner.lifecycleScope.launch {
                result.onSuccess { response ->
                    Toast.makeText(requireContext(), "¡Canción agregada!", Toast.LENGTH_SHORT)
                        .show()
                    binding.btnModifySong.isEnabled = true
                    binding.btnModifySong.text = "Guardar"
                    binding.btnAddCompass.visibility = View.VISIBLE
                    findNavController().popBackStack()
                }


                result.onFailure { error ->
                    showAPIError(requireContext(), error, binding.btnModifySong, "Guardar")
                    binding.btnModifySong.isEnabled = true
                    binding.btnModifySong.text = "Guardar"
                }
            }
        }

    }

    private fun saveCompassAPI(songId : Int) {
        binding.btnAddCompass.isEnabled = false
        binding.btnAddCompass.text = "Cargando..."

        compassRepository.saveCompass( songId) { result ->
            if (!isAdded || _binding == null || view == null) return@saveCompass
            viewLifecycleOwner.lifecycleScope.launch  {
                result.onSuccess { response ->
                    Toast.makeText(requireContext(), "¡Compás agregado!", Toast.LENGTH_SHORT).show()
                    binding.btnAddCompass.isEnabled = true
                    binding.btnAddCompass.text = "+ Compás"
                    getSongAPI(songId)
                }

                result.onFailure { error ->
                    showAPIError(requireContext(), error, binding.btnAddCompass, "Guardar")
                }
            }
        }
    }

    private fun updateSongAPI(songId: Int, songRequest: SongRequest) {
        binding.btnModifySong.isEnabled = false
        binding.btnModifySong.text = "Cargando..."

        songRepository.updateSong( songId, songRequest) { result ->
            if (!isAdded || _binding == null || view == null) return@updateSong
            viewLifecycleOwner.lifecycleScope.launch {
                result.onSuccess { response ->
                    Toast.makeText(requireContext(), "¡Canción actualizada!", Toast.LENGTH_SHORT)
                        .show()
                    binding.btnModifySong.isEnabled = true
                    binding.btnModifySong.text = "Guardar"
                }

                result.onFailure { error ->
                    showAPIError(requireContext(), error, binding.btnModifySong, "Guardar")
                    binding.btnModifySong.isEnabled = true
                    binding.btnModifySong.text = "Guardar"
                }
            }
        }
    }

    private fun getGenresAPI() {
        searchRepository.getMusicalGenres { result ->
            if (!isAdded || _binding == null || view == null) return@getMusicalGenres
            viewLifecycleOwner.lifecycleScope.launch {
                result.onSuccess { response ->
                    val options = response.map { genre ->
                        SelectOption(genre.id, genre.name)
                    }
                    showResultsList(binding.autoCompleteGenre, options)
                }

                result.onFailure { error ->
                    Toast.makeText(requireContext(), "Error: ${error.message}", Toast.LENGTH_SHORT)
                        .show()
                }
            }
        }
    }

    private fun getSongScalesAPI() {
        searchRepository.getSongScales { result ->
            if (!isAdded || _binding == null || view == null) return@getSongScales
            viewLifecycleOwner.lifecycleScope.launch {
                result.onSuccess { response ->
                    val options = response.map { scale ->
                        SelectOption(scale.id, scale.name)
                    }
                    showResultsList(binding.autoCompleteScale, options)
                }

                result.onFailure { error ->
                    Toast.makeText(requireContext(), "Error: ${error.message}", Toast.LENGTH_SHORT)
                        .show()
                }
            }
        }
    }

    private fun getSongMetricsAPI() {
        searchRepository.getSongMetrics { result ->
            if (!isAdded || _binding == null || view == null) return@getSongMetrics
            viewLifecycleOwner.lifecycleScope.launch {
                result.onSuccess { response ->
                    val options = response.map { metric ->
                        SelectOption(metric.id, metric.name)
                    }
                    showResultsList(binding.autoCompleteMetric, options)
                }

                result.onFailure { error ->
                    Toast.makeText(requireContext(), "Error: ${error.message}", Toast.LENGTH_SHORT)
                        .show()
                }
            }
        }
    }

    private fun showResultsList(autoCompleter: AutoCompleteTextView, list: List<SelectOption>){
        val adapter = ArrayAdapter(requireContext(), android.R.layout.simple_dropdown_item_1line, list)

        autoCompleter.setAdapter(adapter)

        autoCompleter.setOnItemClickListener { parent, _, position, _ ->
            val selectedOption = parent.adapter.getItem(position) as SelectOption
            autoCompleter.tag = selectedOption.id
        }
    }


    private fun showSong(song: Song) {
        binding.edtTitle.setText(song.title ?: "")
        binding.edtBPM.setText(song.bpm?.toString() ?: "")

        selectAutoCompleteItem(binding.autoCompleteScale, song.song_scale_id ?: 0)
        selectAutoCompleteItem(binding.autoCompleteMetric, song.song_metric_id ?: 0)
        selectAutoCompleteItem(binding.autoCompleteGenre, song.musical_genre_id ?: 0)



        editableCompassAdapter = EditableCompassAdapter(song.compasses ?: emptyList())
        binding.editableCompassesElementsList.adapter = editableCompassAdapter
        binding.editableCompassesElementsList.layoutManager = LinearLayoutManager(requireContext())
    }

    private fun showCompasses(compassList: List<Compass>) {
        editableCompassAdapter = EditableCompassAdapter(compassList)
        binding.editableCompassesElementsList.adapter = editableCompassAdapter
        binding.editableCompassesElementsList.visibility = View.VISIBLE
    }

    private fun selectAutoCompleteItem(autoComplete: AutoCompleteTextView, idToSelect: Int) {
        val adapter = autoComplete.adapter as? ArrayAdapter<SelectOption> ?: return
        for (i in 0 until adapter.count) {
            val option = adapter.getItem(i)
            if (option != null && option.id == idToSelect) {
                autoComplete.setText(option.name, false)
                autoComplete.tag = option.id
                break
            }
        }
    }

    override fun onDestroyView() {
        super.onDestroyView()
        songRepository.cancelAllRequests()
        compassRepository.cancelAllRequests()
        searchRepository.cancelAllRequests()
        _binding = null
    }
}



data class SelectOption(
    val id: Int,
    val name: String
) {
    override fun toString(): String {
        return name
    }
}

data class SelectBooleanOption(
    val value: Boolean,
    val name: String
) {
    override fun toString(): String {
        return name
    }
}