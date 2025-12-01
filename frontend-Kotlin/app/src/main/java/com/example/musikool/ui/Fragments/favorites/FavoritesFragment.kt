package com.example.musikool.ui.Fragments.favorites

import android.os.Bundle
import androidx.fragment.app.Fragment
import android.view.LayoutInflater
import android.view.View
import android.view.ViewGroup
import android.widget.ImageButton
import android.widget.Toast
import androidx.appcompat.app.AppCompatActivity
import androidx.lifecycle.lifecycleScope
import androidx.recyclerview.widget.LinearLayoutManager
import androidx.recyclerview.widget.RecyclerView
import com.example.musikool.Adapters.ChordAdapter
import com.example.musikool.Adapters.FavoriteAdapter
import com.example.musikool.Adapters.UserAdapter
import com.example.musikool.DTOs.Response.App.Lists.FavoriteItem
import com.example.musikool.Entities.Song
import com.example.musikool.R
import com.example.musikool.Repositories.ChordRepository
import com.example.musikool.Repositories.FavoriteRepository
import com.example.musikool.Repositories.SongRepository
import com.example.musikool.Repositories.UserRepository
import com.example.musikool.Utils.PaginationUtils
import com.example.musikool.databinding.FragmentFavoritesBinding
import com.example.musikool.databinding.FragmentMySongsBinding
import kotlinx.coroutines.launch


class FavoritesFragment : Fragment() {
    private var _binding: FragmentFavoritesBinding? = null
    // This property is only valid between onCreateView and onDestroyView.

    private val binding get() = _binding!!

    private lateinit var favoriteRepository : FavoriteRepository
    private lateinit var favoriteAdapter : FavoriteAdapter


    override fun onCreateView(
        inflater: LayoutInflater,
        container: ViewGroup?,
        savedInstanceState: Bundle? ): View {

        _binding = FragmentFavoritesBinding.inflate(inflater, container, false)
        val view = binding.root

        val userId =arguments?.getInt("user_id") ?: -1
        val model = arguments?.getString("model") ?: "Canciones"

        var toolbarTitle = ""
        var recycleList : RecyclerView
        when(model){
            "User" -> {
                toolbarTitle = "Artistas Guardados"
                binding.artistElementsList.layoutManager = LinearLayoutManager(requireContext())
                recycleList = binding.artistElementsList
            }
            "Chord"-> {
                toolbarTitle = "Acordes Guardados"
                binding.chordElementsList.layoutManager = LinearLayoutManager(requireContext())
                recycleList = binding.chordElementsList
            }
            else ->{
                toolbarTitle = "Canciones Guardadas"
                binding.songElementsList.layoutManager = LinearLayoutManager(requireContext())
                recycleList = binding.songElementsList
            }
        }

        (requireActivity() as AppCompatActivity).supportActionBar?.title = toolbarTitle

        favoriteRepository = FavoriteRepository(requireContext())
        getFavoritesAPI(userId, model = model, recycleList =  recycleList )

        return view
    }

    private fun getFavoritesAPI(userId: Int, page: Int? = 1, model: String, recycleList : RecyclerView) {

            binding.progressBar.root.visibility = View.VISIBLE
            binding.songElementsList.visibility = View.GONE
            binding.artistElementsList.visibility = View.GONE
            binding.chordElementsList.visibility = View.GONE
            binding.emptyStateContainer.root.visibility = View.GONE
            binding.paginationLayout.paginationContainer.visibility = View.GONE

            favoriteRepository.getFavorites(userId, page, model) { result ->
                if (!isAdded || _binding == null || view == null) return@getFavorites
                viewLifecycleOwner.lifecycleScope.launch {

                        binding.progressBar.root.visibility = View.GONE

                        result.onSuccess { response ->
                            if (response.data.isEmpty()) {
                                binding.emptyStateContainer.root.visibility = View.VISIBLE
                                recycleList.visibility = View.GONE
                            } else {
                                showFavoriteItems(response.data, recycleList)
                                binding.emptyStateContainer.root.visibility = View.GONE
                                recycleList.visibility = View.VISIBLE

                                if (response.meta.total >= 10) {
                                    binding.paginationLayout.paginationContainer.visibility =
                                        View.VISIBLE
                                    PaginationUtils.render(
                                        binding.paginationLayout.paginationContainer,
                                        response.meta
                                    ) { newPage ->
                                        getFavoritesAPI(userId, newPage, model, recycleList)
                                    }
                                } else {
                                    binding.paginationLayout.paginationContainer.visibility =
                                        View.GONE
                                }
                            }

                        }
                        result.onFailure { error ->
                            Toast.makeText(
                                requireContext(),
                                "Error: ${error.message}",
                                Toast.LENGTH_SHORT
                            ).show()
                            binding.emptyStateContainer.root.visibility = View.VISIBLE
                        }

                }
        }

    }

    private fun showFavoriteItems(favoriteList: List<FavoriteItem>, recycleList: RecyclerView) {
        favoriteAdapter = FavoriteAdapter(favoriteList)
        recycleList.adapter = favoriteAdapter
    }


    override fun onDestroyView() {
        super.onDestroyView()
        favoriteRepository.cancelAllRequests()
        _binding = null
    }
}