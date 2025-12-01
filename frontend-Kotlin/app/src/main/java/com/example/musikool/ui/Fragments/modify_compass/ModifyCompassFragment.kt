package com.example.musikool.ui.Fragments.modify_compass

import android.graphics.Color
import android.os.Bundle
import androidx.fragment.app.Fragment
import android.view.LayoutInflater
import android.view.View
import android.view.ViewGroup
import android.widget.Toast
import androidx.appcompat.app.AppCompatActivity
import androidx.lifecycle.lifecycleScope
import androidx.navigation.Navigation
import androidx.navigation.fragment.findNavController
import androidx.recyclerview.widget.LinearLayoutManager
import com.example.musikool.Adapters.CompassAdapter
import com.example.musikool.DTOs.Request.Models.CompassRequest
import com.example.musikool.DTOs.Request.Models.SongRequest
import com.example.musikool.Entities.Compass
import com.example.musikool.Entities.Song
import com.example.musikool.R
import com.example.musikool.Repositories.CompassRepository
import com.example.musikool.Repositories.SongRepository
import com.example.musikool.databinding.FragmentModifyCompassBinding
import com.example.musikool.databinding.FragmentSongDetailsBinding
import kotlinx.coroutines.launch

class ModifyCompassFragment : Fragment() {
    private var _binding: FragmentModifyCompassBinding? = null
    // This property is only valid between onCreateView and onDestroyView.

    private val binding get() = _binding!!

    private lateinit var compassRepository : CompassRepository


    override fun onCreateView(
        inflater: LayoutInflater,
        container: ViewGroup?,
        savedInstanceState: Bundle? ): View {

        _binding = FragmentModifyCompassBinding.inflate(inflater, container, false)

        val view = binding.root

        val songId = arguments?.getInt("song_id") ?: -1
        val compassId =arguments?.getInt("compass_id") ?: -1
        val compassOrder  =arguments?.getInt("compass_order", -1) ?: -1

        compassRepository = CompassRepository(requireContext())



        if(compassId > 0){
            showCompass(compassOrder)

            binding.btnModifyCompass.setOnClickListener {
                val orderText = binding.edtCompassOrder.text.toString().trim()

                if (orderText.isEmpty()) {
                    Toast.makeText(requireContext(), "Llena todos los campos", Toast.LENGTH_SHORT).show()
                    return@setOnClickListener
                }

                val order = orderText.toIntOrNull()
                if (order == null || order <= 0) {
                    Toast.makeText(requireContext(), "El número debe ser mayor que 0", Toast.LENGTH_SHORT).show()
                    return@setOnClickListener
                }

                val compassRequest = CompassRequest(
                    orderText.toInt()
                )

                updateCompassAPI(songId, compassId,compassRequest)
            }
        }else{
            binding.btnModifyCompass.setOnClickListener {
                saveCompassAPI(compassId)
            }
        }

        return view
    }

    private fun showCompass(order: Int){
        binding.edtCompassOrder.setText(order.toString())
    }
    private fun saveCompassAPI(songId : Int) {
        binding.btnModifyCompass.isEnabled = false
        binding.btnModifyCompass.text = "Cargando..."

            compassRepository.saveCompass( songId) { result ->
                if (!isAdded || _binding == null || view == null) return@saveCompass
                viewLifecycleOwner.lifecycleScope.launch {
                    {

                        result.onSuccess { response ->
                            Toast.makeText(requireContext(), "Compás agregado.", Toast.LENGTH_SHORT)
                                .show()
                            findNavController().popBackStack()
                        }
                        result.onFailure { error ->
                            Toast.makeText(
                                requireContext(),
                                "Error: ${error.message}",
                                Toast.LENGTH_SHORT
                            ).show()
                        }
                    }
                }
            }
    }

    private fun updateCompassAPI(songId : Int, compassId : Int, compassRequest: CompassRequest) {
        binding.btnModifyCompass.isEnabled = false
        binding.btnModifyCompass.text = "Cargando..."

        compassRepository.updateCompass( songId, compassId, compassRequest) { result ->
            if (!isAdded || _binding == null || view == null) return@updateCompass
            viewLifecycleOwner.lifecycleScope.launch  {

                result.onSuccess {
                        response ->
                    Toast.makeText(requireContext(), "Compás actualizado.", Toast.LENGTH_SHORT).show()
                    findNavController().popBackStack()
                }
                result.onFailure { error ->
                    Toast.makeText(requireContext(), "Error: ${error.message}", Toast.LENGTH_SHORT).show()
                }
            }
        }
    }

    override fun onDestroyView() {
        super.onDestroyView()
        compassRepository.cancelAllRequests()
        _binding = null
    }
}