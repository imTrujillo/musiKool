package com.example.musikool.ui.Fragments.my_songs

import android.os.Bundle
import androidx.fragment.app.Fragment
import android.view.LayoutInflater
import android.view.View
import android.view.ViewGroup
import android.widget.ImageButton
import android.widget.Toast
import androidx.appcompat.app.AppCompatActivity
import androidx.core.content.ContextCompat
import androidx.lifecycle.lifecycleScope
import androidx.navigation.Navigation
import androidx.recyclerview.widget.LinearLayoutManager
import com.example.musikool.Adapters.EditableSongAdapter
import com.example.musikool.Adapters.SongAdapter
import com.example.musikool.Entities.Song
import com.example.musikool.R
import com.example.musikool.Repositories.SongRepository
import com.example.musikool.Utils.PaginationUtils
import com.example.musikool.databinding.FragmentMySongsBinding
import com.example.musikool.databinding.FragmentSongsBinding
import kotlinx.coroutines.launch

class MySongsFragment : Fragment() {
    private var _binding: FragmentMySongsBinding? = null
    // This property is only valid between onCreateView and onDestroyView.

    private val binding get() = _binding!!

    private lateinit var songRepository: SongRepository
    private lateinit var editableSongAdapter: EditableSongAdapter


    override fun onCreateView(
        inflater: LayoutInflater,
        container: ViewGroup?,
        savedInstanceState: Bundle? ): View {

        _binding = FragmentMySongsBinding.inflate(inflater, container, false)
        val view = binding.root

        binding.songElementsList.layoutManager = LinearLayoutManager(requireContext())

        songRepository = SongRepository(requireContext())

        binding.btnAddSong.setOnClickListener {
            val navController = Navigation.findNavController(it)
            navController.navigate(R.id.nav_modify_song)
        }

        getMySongsAPI()

        return view
    }

    private fun getMySongsAPI(page: Int? = 1) {
        viewLifecycleOwner.lifecycleScope.launch{
            binding.progressBar.root.visibility = View.VISIBLE
            binding.songElementsList.visibility = View.GONE
            binding.emptyStateContainer.root.visibility = View.GONE
            binding.paginationLayout.paginationContainer.visibility = View.GONE

            songRepository.getMySongs(page, "artist,genre") { result ->
                if (!isAdded || _binding == null || view == null) return@getMySongs
                viewLifecycleOwner.lifecycleScope.launch  {
                    binding.progressBar.root.visibility = View.GONE

                    result.onSuccess {
                            response ->
                        if(response.data.isEmpty()){

                            binding.btnAddSong.visibility = View.VISIBLE
                            binding.songElementsList.visibility = View.GONE
                        }else{
                            showSongs(response.data)
                            binding.emptyStateContainer.root.visibility = View.GONE
                            binding.songElementsList.visibility = View.VISIBLE

                            if (response.meta.total >= 10) {
                                binding.paginationLayout.paginationContainer.visibility = View.VISIBLE
                                PaginationUtils.render(binding.paginationLayout.paginationContainer, response.meta) { newPage ->
                                    getMySongsAPI( newPage)
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
    }

    private fun showSongs(songList: List<Song>) {
        editableSongAdapter = EditableSongAdapter(songList, requireContext())
        binding.songElementsList.adapter = editableSongAdapter
    }


    override fun onDestroyView() {
        super.onDestroyView()
        songRepository.cancelAllRequests()
        _binding = null
    }
}