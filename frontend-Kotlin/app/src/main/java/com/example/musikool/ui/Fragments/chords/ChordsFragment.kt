package com.example.musikool.ui.Fragments.chords

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
import androidx.recyclerview.widget.LinearLayoutManager
import com.example.musikool.Adapters.ChordAdapter
import com.example.musikool.Entities.Chord
import com.example.musikool.Entities.Song
import com.example.musikool.R
import com.example.musikool.Repositories.ChordRepository
import com.example.musikool.Repositories.SongRepository
import com.example.musikool.Utils.PaginationUtils
import com.example.musikool.databinding.FragmentChordsBinding
import com.example.musikool.databinding.FragmentSongsBinding
import kotlinx.coroutines.launch

class ChordsFragment : Fragment() {

    private var _binding: FragmentChordsBinding? = null

    // This property is only valid between onCreateView and
    // onDestroyView.
    private val binding get() = _binding!!
    private lateinit var chordRepository : ChordRepository
    private lateinit var chordAdapter: ChordAdapter

    override fun onCreateView(
        inflater: LayoutInflater,
        container: ViewGroup?,
        savedInstanceState: Bundle?
    ): View {
        _binding = FragmentChordsBinding.inflate(inflater, container, false)
        val view = binding.root

        binding.chordElementsList.layoutManager = LinearLayoutManager(requireContext())

        chordRepository = ChordRepository(requireContext())

        setupSearchAndFilter()

        getChordsAPI()

        return view
    }

    private fun getChordsAPI(chord_name:String? = null, filter: String? = null, page: Int? = 1) {
        binding.progressBar.root.visibility = View.VISIBLE
        binding.chordElementsList.visibility = View.GONE
        binding.emptyStateContainer.root.visibility = View.GONE
        binding.paginationLayout.paginationContainer.visibility = View.GONE

        chordRepository.getChords ( chord_name, filter,  page = page ?: 1) { result ->
            if (!isAdded || _binding == null || view == null) return@getChords
            viewLifecycleOwner.lifecycleScope.launch  {
                binding.progressBar.root.visibility = View.GONE

                result.onSuccess {
                        response ->
                    if(response.data.isEmpty()){
                        binding.emptyStateContainer.root.visibility = View.VISIBLE
                        binding.chordElementsList.visibility = View.GONE
                    }else{
                        showChords(response.data)
                        binding.emptyStateContainer.root.visibility = View.GONE
                        binding.chordElementsList.visibility = View.VISIBLE

                        if (response.meta.total >= 10) {
                            binding.paginationLayout.paginationContainer.visibility = View.VISIBLE
                            PaginationUtils.render(binding.paginationLayout.paginationContainer, response.meta) { newPage ->
                                getChordsAPI(chord_name, filter, newPage)
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

    private fun showChords(chordList: List<Chord>) {
        chordAdapter = ChordAdapter(chordList, requireContext())
        binding.chordElementsList.adapter = chordAdapter
    }

    private fun setupSearchAndFilter(){
        val filterButtons = listOf(binding.btnAll, binding.btnBasic, binding.btnAdvanced)
        var filter: String = ""

        filterButtons.forEach { button ->
            button.setOnClickListener {
                val query = binding.edtSearch.text.toString()

                filter = when (button){
                    binding.btnAll -> ""
                    binding.btnBasic -> "basic"
                    binding.btnAdvanced -> "advanced"
                    else -> ""
                }

                getChordsAPI(query, filter)

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

        binding.btnAll.performClick()
        binding.btnSearch.setOnClickListener { getChordsAPI(binding.edtSearch.text.toString()) }
        binding.btnClear.setOnClickListener {
            binding.edtSearch.setText("")
            getChordsAPI(null, filter)
        }
    }


    override fun onDestroyView() {
        super.onDestroyView()
        chordRepository.cancelAllRequests()
        _binding = null
    }
}