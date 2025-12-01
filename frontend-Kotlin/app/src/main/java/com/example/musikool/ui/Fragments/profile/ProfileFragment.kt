package com.example.musikool.ui.Fragments.profile

import android.content.Intent
import android.os.Bundle
import androidx.fragment.app.Fragment
import android.view.LayoutInflater
import android.view.View
import android.view.ViewGroup
import android.widget.ImageButton
import android.widget.Toast
import androidx.appcompat.app.AppCompatActivity
import androidx.lifecycle.lifecycleScope
import androidx.navigation.Navigation
import androidx.navigation.fragment.findNavController
import com.example.musikool.API.SecureStorage
import com.example.musikool.DTOs.Request.Models.MusicalNoteRequest
import com.example.musikool.DTOs.Request.Models.UserRequest
import com.example.musikool.DTOs.Response.Auth.LoginResponse
import com.example.musikool.R
import com.example.musikool.Repositories.AuthRepository
import com.example.musikool.Repositories.UserRepository
import com.example.musikool.Utils.showAPIError
import com.example.musikool.databinding.FragmentProfileBinding
import com.example.musikool.ui.Activities.MainActivity
import kotlinx.coroutines.launch

class ProfileFragment : Fragment() {
    private var _binding: FragmentProfileBinding? = null
    // This property is only valid between onCreateView and onDestroyView.

    private val binding get() = _binding!!
    private lateinit var userRepository: UserRepository


    override fun onViewCreated(view: View, savedInstanceState: Bundle?) {
        super.onViewCreated(view, savedInstanceState)

        (requireActivity() as MainActivity).setProfileButtonVisibility(false)
    }

    override fun onCreateView(
        inflater: LayoutInflater,
        container: ViewGroup?,
        savedInstanceState: Bundle?
    ): View {
        _binding = FragmentProfileBinding.inflate(inflater, container, false)
        val view = binding.root

        val loginResponse =
            SecureStorage.getObject(requireContext(), "Token", LoginResponse::class.java)

        if (loginResponse != null && loginResponse.token.isNotEmpty()) {
            userRepository = UserRepository(requireContext())

            val userName = loginResponse.user.name
            (requireActivity() as AppCompatActivity).supportActionBar?.title = userName
            showUser(loginResponse.user.name)

            binding.cardMySongs.setOnClickListener {
                val bundle = Bundle().apply {
                    putInt("user_id", loginResponse.user.id)
                }

                val navController = Navigation.findNavController(it)
                navController.navigate(R.id.nav_my_songs, bundle)
            }

            binding.cardFavoriteArtists.setOnClickListener {
                val bundle = Bundle().apply {
                    putInt("user_id", loginResponse.user.id)
                    putString("model", "User")
                }

                val navController = Navigation.findNavController(it)
                navController.navigate(R.id.nav_favorites, bundle)


            }

            binding.cardFavoriteSongs.setOnClickListener {
                val bundle = Bundle().apply {
                    putInt("user_id", loginResponse.user.id)
                    putString("model", "Song")
                }

                val navController = Navigation.findNavController(it)
                navController.navigate(R.id.nav_favorites, bundle)


            }

            binding.cardFavoriteChords.setOnClickListener {
                val bundle = Bundle().apply {
                    putInt("user_id", loginResponse.user.id)
                    putString("model", "Chord")
                }

                val navController = Navigation.findNavController(it)
                navController.navigate(R.id.nav_favorites, bundle)


            }

            binding.btnUpdateUser.setOnClickListener {
                binding.btnUpdateUser.text= "Cargando"
                binding.btnUpdateUser.isEnabled = false

                if (binding.edtPassword.text.toString() != binding.edtConfirmPassword.text.toString()) {
                    Toast.makeText(
                        requireContext(),
                        "Las contraseñas no coinciden",
                        Toast.LENGTH_SHORT
                    ).show()
                    return@setOnClickListener
                } else {
                    val username = binding.edtUsername.text.toString().trim()
                    val password = binding.edtPassword.text.toString().trim()
                    val confirmPassword = binding.edtConfirmPassword.text.toString().trim()

                    if (password.isNotEmpty() && password != confirmPassword) {
                        Toast.makeText(requireContext(), "Las contraseñas no coinciden", Toast.LENGTH_SHORT).show()
                        return@setOnClickListener
                    }

                    val userRequest = UserRequest(
                        name = if (username.isNotEmpty()) username else null,
                        email = loginResponse.user.email,
                        password = if (password.isNotEmpty()) password else null,
                        color = loginResponse.user.color
                    )

                    updateUserAPI(loginResponse.user.id, userRequest)
                }

            }

            binding.btnLogout.visibility = View.VISIBLE
            binding.btnLogout.setOnClickListener {
                binding.btnLogout.isEnabled = false
                binding.btnLogout.text = "Cargando..."

                var authRepo = AuthRepository(requireContext())
                authRepo.logout({ result ->
                    requireActivity().runOnUiThread {
                        result.onSuccess { response ->
                            Toast.makeText(requireContext(), "Sesión cerrada", Toast.LENGTH_SHORT)
                                .show()
                            SecureStorage.clear(requireContext())
                            binding.btnLogout.isEnabled = true
                            binding.btnLogout.text = "Cerrar sesión"

                            val intent = Intent(requireContext(), MainActivity::class.java)
                            intent.flags =
                                Intent.FLAG_ACTIVITY_NEW_TASK or Intent.FLAG_ACTIVITY_CLEAR_TASK
                            startActivity(intent)
                            requireActivity().finish()
                        }
                        result.onFailure { error ->
                            Toast.makeText(requireContext(), "Error: $error", Toast.LENGTH_SHORT)
                                .show()
                        }
                    }
                })
            }
        } else {
            val navController =
                Navigation.findNavController(requireActivity(), R.id.nav_host_fragment_content_main)
            navController.navigate(R.id.nav_songs)
        }

        return view
    }

    private fun updateUserAPI(userId: Int, userRequest: UserRequest) {
        binding.btnUpdateUser.isEnabled = false
        binding.btnUpdateUser.text = "Cargando..."

        userRepository.updateUser(userId, userRequest) { result ->
            if (!isAdded || _binding == null || view == null) return@updateUser
            viewLifecycleOwner.lifecycleScope.launch  {

                result.onSuccess { response ->
                    Toast.makeText(requireContext(), "Usuario actualizado. Los cambios aparecerán cuando reinicie su sesión", Toast.LENGTH_SHORT)
                        .show()
                    binding.btnUpdateUser.text= "Guardar"
                    binding.btnUpdateUser.isEnabled = true
                }
                result.onFailure { error ->
                    showAPIError(requireContext(), error, binding.btnUpdateUser, "Guardar")
                }
            }
        }
    }

    private fun showUser(username: String) {
        binding.edtUsername.setText(username)
    }


    override fun onDestroyView() {
        super.onDestroyView()
        userRepository.cancelAllRequests()
        _binding = null
    }
}