package com.example.musikool.ui.Fragments.songs_per_entity

import android.graphics.Color
import android.os.Bundle
import androidx.fragment.app.Fragment
import android.view.LayoutInflater
import android.view.View
import android.view.ViewGroup
import android.widget.Toast
import androidx.appcompat.app.AppCompatActivity
import androidx.lifecycle.lifecycleScope
import androidx.recyclerview.widget.LinearLayoutManager
import com.example.musikool.Adapters.SongAdapter
import com.example.musikool.Entities.Song
import com.example.musikool.Repositories.SongRepository
import com.example.musikool.Utils.PaginationUtils
import com.example.musikool.databinding.FragmentSongsPerEntityBinding
import kotlinx.coroutines.launch

class SongsPerEntityFragment : Fragment() {

    private var _binding: FragmentSongsPerEntityBinding? = null
    // This property is only valid between onCreateView and onDestroyView.

    private val binding get() = _binding!!

    private lateinit var songRepository: SongRepository
    private lateinit var songAdapter: SongAdapter

    override fun onCreateView(
        inflater: LayoutInflater,
        container: ViewGroup?,
        savedInstanceState: Bundle?): View {

        _binding = FragmentSongsPerEntityBinding.inflate(inflater, container, false)

        val name = savedInstanceState?.getString("title")
            ?: arguments?.getString("genre_name")
            ?: arguments?.getString("artist_name")
            ?: "Canciones"

        (requireActivity() as AppCompatActivity).supportActionBar?.title = name

        val view = binding.root

        binding.songElementsList.layoutManager = LinearLayoutManager(requireContext())

        val artistId =arguments?.getInt("artist_id", -1) ?: -1
        val artistName =arguments?.getString("artist_name")
        val artistColor =arguments?.getString("artist_color")
        val artistSongsCount =arguments?.getInt("artist_songs_count") ?: 0
        val genreId =arguments?.getInt("genre_id", -1) ?: -1
        val genreName =arguments?.getString("genre_name")
        val genreSongsCount =arguments?.getInt("genre_songs_count") ?: 0
        val genreColor =arguments?.getString("genre_color")

        songRepository = SongRepository(requireContext())

        if(artistId > 0){
            binding.cardArtist.visibility = View.VISIBLE
            binding.txtUserName.text = artistName ?: "Artista Desconocido"
            artistColor?.let {
                binding.viewUserColorLayout.setBackgroundColor(Color.parseColor(it))
            }
            binding.txtUserSongsCount.text =
                if (artistSongsCount == 1) "1 canción" else "$artistSongsCount canciones"
            getSongsAPI(artist_id = artistId)
        }else if(genreId > 0){
            binding.cardGenre.visibility = View.VISIBLE
            binding.txtGenreName.text = genreName.toString() ?: "Género Desconocido"
            genreColor?.let {
                binding.viewGenreColorLayout.setBackgroundColor(Color.parseColor(it))
            }
            binding.txtGenreSongsCount.text =
                if (genreSongsCount == 1) "1 canción" else "$genreSongsCount canciones"

            getSongsAPI(genre_id = genreId)
        }
        setupSearch(genreId, artistId)


        return view
    }

    override fun onSaveInstanceState(outState: Bundle) {
        super.onSaveInstanceState(outState)
        val name = arguments?.getString("genre_name") ?: arguments?.getString("artist_name") ?: "Canciones"
        outState.putString("title", name)
    }


    private fun getSongsAPI(title:String? = null, page: Int? = 1, genre_id: Int? = null, artist_id : Int? = null) {
            binding.progressBar.root.visibility = View.VISIBLE
            binding.songElementsList.visibility = View.GONE
            binding.emptyStateContainer.root.visibility = View.GONE
            binding.paginationLayout.paginationContainer.visibility = View.GONE

            songRepository.getSongs( include = "artist,genre", page = page ?: 1, title,genre_id = genre_id, artist_id = artist_id) { result ->
                if (!isAdded || _binding == null || view == null) return@getSongs
                viewLifecycleOwner.lifecycleScope.launch  {
                    binding.progressBar.root.visibility = View.GONE

                    result.onSuccess {
                            response ->
                        if(response.data.isEmpty()){
                            binding.cardArtist.visibility = View.GONE
                            binding.cardGenre.visibility = View.GONE
                            binding.layoutSearch.visibility = View.GONE
                            binding.emptyStateContainer.root.visibility = View.VISIBLE
                            binding.songElementsList.visibility = View.GONE
                        }else{
                            showSongs(response.data)
                            binding.emptyStateContainer.root.visibility = View.GONE
                            binding.songElementsList.visibility = View.VISIBLE

                            if (response.meta.total >= 10) {
                                binding.paginationLayout.paginationContainer.visibility = View.VISIBLE
                                PaginationUtils.render(binding.paginationLayout.paginationContainer, response.meta) { newPage ->
                                    getSongsAPI(title, newPage, genre_id, artist_id)
                                }
                            } else {
                                binding.paginationLayout.paginationContainer.visibility = View.GONE
                            }
                        }

                    }
                    result.onFailure { error ->
                        Toast.makeText(requireContext(), "Error: ${error.message}", Toast.LENGTH_SHORT).show()
                        binding.emptyStateContainer.root.visibility = View.VISIBLE
                    }
                }
            }
    }

    private fun setupSearch(genre_id: Int? = null, artist_id: Int? = null){
        binding.layoutSearch.visibility = View.VISIBLE

        binding.btnSearch.setOnClickListener { getSongsAPI(binding.edtSearch.text.toString(), genre_id = genre_id,artist_id = artist_id) }
        binding.btnClear.setOnClickListener {
            binding.edtSearch.setText("")
            getSongsAPI(null, genre_id = genre_id, artist_id =  artist_id)
        }
    }


    private fun showSongs(songList: List<Song>) {
        songAdapter = SongAdapter(songList, requireContext())
        binding.songElementsList.adapter = songAdapter
    }

    override fun onDestroyView() {
        super.onDestroyView()
        songRepository.cancelAllRequests()
        _binding = null
    }

}