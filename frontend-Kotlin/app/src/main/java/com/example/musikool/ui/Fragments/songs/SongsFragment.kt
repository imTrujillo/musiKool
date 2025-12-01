package com.example.musikool.ui.Fragments.songs
import android.graphics.Color
import android.os.Bundle
import android.view.LayoutInflater
import android.view.View
import android.view.ViewGroup
import android.widget.Toast
import androidx.core.content.ContextCompat
import androidx.fragment.app.Fragment
import androidx.lifecycle.lifecycleScope
import androidx.recyclerview.widget.LinearLayoutManager
import com.example.musikool.Adapters.SongAdapter
import com.example.musikool.Entities.Song
import com.example.musikool.R
import com.example.musikool.Repositories.SongRepository
import com.example.musikool.Utils.PaginationUtils
import com.example.musikool.databinding.FragmentSongsBinding
import kotlinx.coroutines.launch


class SongsFragment : Fragment() {
    private var _binding: FragmentSongsBinding? = null
    // This property is only valid between onCreateView and onDestroyView.

    private val binding get() = _binding!!

    private lateinit var songRepository: SongRepository
    private lateinit var songAdapter: SongAdapter


    override fun onCreateView(
        inflater: LayoutInflater,
        container: ViewGroup?,
        savedInstanceState: Bundle? ): View {

        _binding = FragmentSongsBinding.inflate(inflater, container, false)
        val view = binding.root

        binding.songElementsList.layoutManager = LinearLayoutManager(requireContext())

        songRepository = SongRepository(requireContext())

        setupSearchAndFilter()
        getSongsAPI()

        return view
    }

    private fun getSongsAPI(title:String? = null, filter: String? = null, page: Int? = 1, genre_id: Int? = null, artist_id : Int? = null) {

            binding.progressBar.root.visibility = View.VISIBLE
            binding.songElementsList.visibility = View.GONE
            binding.emptyStateContainer.root.visibility = View.GONE
            binding.paginationLayout.paginationContainer.visibility = View.GONE

            songRepository.getSongs( include = "artist,genre", page = page ?: 1, title, filter, genre_id, artist_id) { result ->
                if (!isAdded || _binding == null || view == null) return@getSongs
                viewLifecycleOwner.lifecycleScope.launch  {
                    binding.progressBar.root.visibility = View.GONE

                    result.onSuccess {
                            response ->
                        if(response.data.isEmpty()){
                            if (!isAdded || _binding == null) return@onSuccess
                            binding.emptyStateContainer.root.visibility = View.VISIBLE
                            binding.songElementsList.visibility = View.GONE
                        }else{
                            showSongs(response.data)
                            binding.emptyStateContainer.root.visibility = View.GONE
                            binding.songElementsList.visibility = View.VISIBLE

                            if (response.meta.total >= 10) {
                                binding.paginationLayout.paginationContainer.visibility = View.VISIBLE
                                PaginationUtils.render(binding.paginationLayout.paginationContainer, response.meta) { newPage ->
                                    getSongsAPI(title, filter, newPage)
                                }
                            } else {
                                binding.paginationLayout.paginationContainer.visibility = View.GONE
                            }
                        }

                    }
                    result.onFailure { error ->
                        if (!isAdded || _binding == null) return@onFailure
                        Toast.makeText(requireContext(), "Error: ${error.message}", Toast.LENGTH_SHORT).show()
                        binding.emptyStateContainer.root.visibility = View.VISIBLE
                    }
                }
            }
    }

    private fun showSongs(songList: List<Song>) {
        songAdapter = SongAdapter(songList, requireContext())
        binding.songElementsList.adapter = songAdapter
    }

    private fun setupSearchAndFilter(){
        binding.layoutFilter.visibility = View.VISIBLE
        binding.layoutSearch.visibility = View.VISIBLE

        val filterButtons = listOf(binding.btnLatest, binding.btnPopular, binding.btnRating)
        var filter: String = ""

        filterButtons.forEach { button ->
            button.setOnClickListener {
                val query = binding.edtSearch.text.toString()

                filter = when (button){
                    binding.btnLatest -> ""
                    binding.btnPopular -> "popular"
                    binding.btnRating -> "rating"
                    else -> ""
                }

                getSongsAPI(query, filter)

                filterButtons.forEach { btn ->
                    var isSelected = (btn == button)
                    btn.isActivated = isSelected

                    val color = if (isSelected) {
                        ContextCompat.getColor(requireContext(), R.color.purple_200)
                    } else {
                        ContextCompat.getColor(requireContext(), R.color.purple_500)
                    }
                    btn.setTextColor(color)
                }
            }


        }

        binding.btnLatest.performClick()
        binding.btnSearch.setOnClickListener { getSongsAPI(binding.edtSearch.text.toString()) }
        binding.btnClear.setOnClickListener {
            binding.edtSearch.setText("")
            getSongsAPI(null, filter)
        }
    }

    override fun onDestroyView() {
        super.onDestroyView()
        songRepository.cancelAllRequests()
        _binding = null
    }
}