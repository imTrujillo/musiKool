package com.example.musikool.ui.Fragments.about

import android.os.Bundle
import android.view.LayoutInflater
import android.view.View
import android.view.ViewGroup
import android.widget.TextView
import androidx.fragment.app.Fragment
import com.example.musikool.databinding.FragmentAboutBinding
import androidx.core.text.HtmlCompat
import com.example.musikool.R

class AboutFragment : Fragment() {

    private var _binding: FragmentAboutBinding? = null

    // This property is only valid between onCreateView and
    // onDestroyView.
    private val binding get() = _binding!!

    override fun onCreateView(
        inflater: LayoutInflater,
        container: ViewGroup?,
        savedInstanceState: Bundle?
    ): View {

        _binding = FragmentAboutBinding.inflate(inflater, container, false)
        val root: View = binding.root

        // Obtener la referencia al TextView de Cómo Usar
        val tvHowToUse = binding.tvHowToUse

        // Usamos HtmlCompat para aplicar negritas (<b>) y saltos de línea (\n)
        val howToUseText = getString(R.string.about_how_to_use)
        tvHowToUse.text = HtmlCompat.fromHtml(howToUseText, HtmlCompat.FROM_HTML_MODE_LEGACY)


        // Obtener la referencia al TextView de Creadores
        val tvCreators = binding.tvCreators

        // Reemplazar \n por <br/> y usar HtmlCompat para formatear la lista de creadores
        val creatorsText = getString(R.string.about_creators_list).replace("\n", "<br/>")
        tvCreators.text = HtmlCompat.fromHtml(creatorsText, HtmlCompat.FROM_HTML_MODE_LEGACY)

        return root
    }

    override fun onDestroyView() {
        super.onDestroyView()
        _binding = null
    }
}