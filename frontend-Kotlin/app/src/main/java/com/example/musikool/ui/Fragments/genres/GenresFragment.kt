package com.example.musikool.ui.Fragments.genres

import android.os.Bundle
import android.view.LayoutInflater
import android.view.View
import android.view.ViewGroup
import android.widget.Toast
import androidx.fragment.app.Fragment
import androidx.lifecycle.lifecycleScope
import androidx.recyclerview.widget.GridLayoutManager
import com.example.musikool.Adapters.GenreAdapter
import com.example.musikool.Entities.MusicalGenre
import com.example.musikool.Repositories.SearchRepository
import com.example.musikool.databinding.FragmentGenresBinding
import kotlinx.coroutines.launch

class GenresFragment : Fragment() {

    private var _binding: FragmentGenresBinding? = null

    // This property is only valid between onCreateView and
    // onDestroyView.
    private val binding get() = _binding!!

    private lateinit var searchRepository: SearchRepository
    private lateinit var genreAdapter: GenreAdapter


    override fun onCreateView(
        inflater: LayoutInflater,
        container: ViewGroup?,
        savedInstanceState: Bundle?
    ): View {
        _binding = FragmentGenresBinding.inflate(inflater, container, false)
        val view = binding.root

        binding.genreElementsList.layoutManager = GridLayoutManager(requireContext(),2)

        searchRepository = SearchRepository(requireContext())

        setupSearch()

        getGenresAPI()

        return view
    }

    private fun getGenresAPI(search:String? = null) {
        binding.progressBar.root.visibility = View.VISIBLE
        binding.genreElementsList.visibility = View.GONE
        binding.emptyStateContainer.root.visibility = View.GONE

        searchRepository.getMusicalGenres( search) { result ->
            if (!isAdded || _binding == null || view == null) return@getMusicalGenres
            viewLifecycleOwner.lifecycleScope.launch  {
                binding.progressBar.root.visibility = View.GONE

                result.onSuccess {
                        response ->
                    if(response.isEmpty()){
                        binding.emptyStateContainer.root.visibility = View.VISIBLE
                        binding.genreElementsList.visibility = View.GONE
                    }else{
                        showGenres(response)
                        binding.emptyStateContainer.root.visibility = View.GONE
                        binding.genreElementsList.visibility = View.VISIBLE

                    }

                }
                result.onFailure { error ->
                    Toast.makeText(requireContext(), "Error: ${error.message}", Toast.LENGTH_SHORT).show()
                    binding.emptyStateContainer.root.visibility = View.VISIBLE
                }
            }
        }
    }

    private fun showGenres(genreList: List<MusicalGenre>) {
        genreAdapter = GenreAdapter(genreList)
        binding.genreElementsList.adapter = genreAdapter
    }

    private fun setupSearch(){
        binding.btnSearch.setOnClickListener { getGenresAPI(binding.edtSearch.text.toString()) }
        binding.btnClear.setOnClickListener {
            binding.edtSearch.setText("")
            getGenresAPI(null)
        }
    }


    override fun onDestroyView() {
        super.onDestroyView()
        searchRepository.cancelAllRequests()
        _binding = null
    }
}