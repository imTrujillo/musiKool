package com.example.musikool.ui.Fragments.artists

import android.content.Intent
import android.os.Bundle
import android.view.LayoutInflater
import android.view.View
import android.view.ViewGroup
import android.widget.TextView
import android.widget.Toast
import androidx.core.content.ContextCompat
import androidx.fragment.app.Fragment
import androidx.lifecycle.ViewModelProvider
import androidx.lifecycle.lifecycleScope
import androidx.recyclerview.widget.GridLayoutManager
import androidx.recyclerview.widget.LinearLayoutManager
import com.example.musikool.Adapters.UserAdapter
import com.example.musikool.Entities.User
import com.example.musikool.R
import com.example.musikool.Repositories.UserRepository
import com.example.musikool.Utils.PaginationUtils
import com.example.musikool.databinding.FragmentArtistsBinding
import com.example.musikool.databinding.FragmentSongsBinding
import kotlinx.coroutines.launch

class ArtistsFragment : Fragment() {

    private var _binding: FragmentArtistsBinding? = null

    // This property is only valid between onCreateView and
    // onDestroyView.
    private val binding get() = _binding!!

    private lateinit var userRepository : UserRepository
    private lateinit var userAdapter: UserAdapter

    override fun onCreateView(
        inflater: LayoutInflater,
        container: ViewGroup?,
        savedInstanceState: Bundle?
    ): View {
        _binding = FragmentArtistsBinding.inflate(inflater, container, false)
        val view = binding.root

        binding.artistElementsList.layoutManager = GridLayoutManager(requireContext(), 2)

        userRepository = UserRepository(requireContext())

        setupSearchAndFilter()

        getArtistsAPI()

        return view
    }

    private fun getArtistsAPI(name:String? = null, filter: String? = null, page: Int? = 1) {
        binding.progressBar.root.visibility = View.VISIBLE
        binding.artistElementsList.visibility = View.GONE
        binding.emptyStateContainer.root.visibility = View.GONE
        binding.paginationLayout.paginationContainer.visibility = View.GONE

        userRepository.getUsers(  name = name, filter = filter, page = page ?: 1) { result ->
            if (!isAdded || _binding == null || view == null) return@getUsers
            viewLifecycleOwner.lifecycleScope.launch  {
                binding.progressBar.root.visibility = View.GONE

                result.onSuccess {
                        response ->
                    if (!isAdded || _binding == null) return@onSuccess
                    if(response.data.isEmpty()){
                        binding.emptyStateContainer.root.visibility = View.VISIBLE
                        binding.artistElementsList.visibility = View.GONE
                    }else{
                        showArtists(response.data)
                        binding.emptyStateContainer.root.visibility = View.GONE
                        binding.artistElementsList.visibility = View.VISIBLE

                        if (response.meta.total >= 25) {
                            binding.paginationLayout.paginationContainer.visibility = View.VISIBLE
                            PaginationUtils.render(binding.paginationLayout.paginationContainer, response.meta) { newPage ->
                                getArtistsAPI(name, filter, newPage)
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

    private fun showArtists(artistList: List<User>) {
        userAdapter = UserAdapter(artistList, requireContext())
        binding.artistElementsList.adapter = userAdapter
    }

    private fun setupSearchAndFilter(){
        val filterButtons = listOf(binding.btnLatest, binding.btnMostSongs)
        var filter: String = ""

        filterButtons.forEach { button ->
            button.setOnClickListener {
                val query = binding.edtSearch.text.toString()

                filter = when (button){
                    binding.btnLatest -> ""
                    binding.btnMostSongs -> "most_songs"
                    else -> ""
                }

                getArtistsAPI(query, filter)

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
        binding.btnSearch.setOnClickListener { getArtistsAPI(binding.edtSearch.text.toString()) }
        binding.btnClear.setOnClickListener {
            binding.edtSearch.setText("")
            getArtistsAPI(null, filter)
        }
    }


    override fun onDestroyView() {
        super.onDestroyView()
        userRepository.cancelAllRequests()
        _binding = null
    }
}