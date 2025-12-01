package com.example.musikool.ui.Fragments.modify_musical_note

import android.os.Bundle
import androidx.fragment.app.Fragment
import android.view.LayoutInflater
import android.view.View
import android.view.ViewGroup
import android.widget.ArrayAdapter
import android.widget.AutoCompleteTextView
import android.widget.Toast
import androidx.lifecycle.lifecycleScope
import androidx.navigation.fragment.findNavController
import com.example.musikool.DTOs.Request.Models.MusicalNoteRequest
import com.example.musikool.Repositories.ChordRepository
import com.example.musikool.Repositories.MusicalNoteRepository
import com.example.musikool.Repositories.SearchRepository
import com.example.musikool.Utils.showAPIError
import com.example.musikool.databinding.FragmentModifyMusicalNoteBinding
import com.example.musikool.ui.Fragments.modify_song.SelectBooleanOption
import com.example.musikool.ui.Fragments.modify_song.SelectOption
import kotlinx.coroutines.launch

class ModifyMusicalNoteFragment : Fragment() {
    private var _binding: FragmentModifyMusicalNoteBinding? = null
    private val binding get() = _binding!!

    private lateinit var musicalNoteRepository: MusicalNoteRepository
    private lateinit var chordRepository: ChordRepository
    private lateinit var searchRepository: SearchRepository

    override fun onCreateView(
        inflater: LayoutInflater,
        container: ViewGroup?,
        savedInstanceState: Bundle? ): View {

        _binding = FragmentModifyMusicalNoteBinding.inflate(inflater, container, false)
        val view = binding.root

        val songId = arguments?.getInt("song_id") ?: -1
        val compassId = arguments?.getInt("compass_id") ?: -1
        val musicalNoteId = arguments?.getInt("musical_note_id") ?: -1
        val musicalNoteLyrics = arguments?.getString("musical_note_lyrics") ?: ""
        val musicalNoteChordId = arguments?.getInt("musical_note_chord_id") ?: 0
        val musicalNoteRhythmicFigureId = arguments?.getInt("musical_note_rhythmic_figure_id") ?: 0
        val musicalNoteIsDotted = arguments?.getBoolean("musical_note_is_dotted") ?: false
        val musicalNoteIsSilence = arguments?.getBoolean("musical_note_is_silence") ?: false

        musicalNoteRepository = MusicalNoteRepository(requireContext())
        chordRepository = ChordRepository(requireContext())
        searchRepository = SearchRepository(requireContext())

        // Configurar booleanos primero (son locales)
        setupBooleanAutoCompletes()

        // Luego cargar datos de API
        getChordsAPI()
        getRhythmicFiguresAPI()

        binding.btnModifyMusicalNote.setOnClickListener {
            val isDotted = (binding.autoCompleteDotted.tag as? Boolean) ?: false
            val isSilence = (binding.autoCompleteSilence.tag as? Boolean) ?: false
            val chordId = (binding.autoCompleteChord.tag as? Int) ?: 0
            val figureId = (binding.autoCompleteFigure.tag as? Int) ?: 0
            val lyrics = binding.edtLyrics.text.toString()

            if(chordId == 0 || figureId == 0 || lyrics.isEmpty()){
                Toast.makeText(requireContext(), "Llena todos los campos", Toast.LENGTH_SHORT).show()
                return@setOnClickListener
            }

            val musicalNoteRequest = MusicalNoteRequest(
                lyrics,
                isDotted,
                isSilence,
                chordId,
                figureId
            )

            if(musicalNoteId > 0){
                updateMusicalNoteAPI(songId, compassId, musicalNoteId, musicalNoteRequest)
            }else{
                saveMusicalNoteAPI(songId, compassId, musicalNoteRequest)
            }
        }

        if(musicalNoteId > 0){
            showMusicalNote(
                musicalNoteLyrics,
                musicalNoteChordId,
                musicalNoteRhythmicFigureId,
                musicalNoteIsDotted,
                musicalNoteIsSilence
            )
        }

        return view
    }

    private fun setupBooleanAutoCompletes() {
        // Configurar autocomplete para Dotted (booleano)
        val dottedOptions = listOf(
            SelectBooleanOption(true, "Sí"),
            SelectBooleanOption(false, "No")
        )
        setupBooleanAutoComplete(binding.autoCompleteDotted, dottedOptions)

        // Configurar autocomplete para Silence (booleano)
        val silenceOptions = listOf(
            SelectBooleanOption(true, "Sí"),
            SelectBooleanOption(false, "No")
        )
        setupBooleanAutoComplete(binding.autoCompleteSilence, silenceOptions)
    }

    private fun setupBooleanAutoComplete(autoComplete: AutoCompleteTextView, options: List<SelectBooleanOption>) {
        val adapter = ArrayAdapter(requireContext(), android.R.layout.simple_dropdown_item_1line, options)
        autoComplete.setAdapter(adapter)

        // Hacer que muestre todas las opciones al hacer clic
        autoComplete.setOnClickListener {
            autoComplete.showDropDown()
        }

        autoComplete.setOnItemClickListener { parent, _, position, _ ->
            val selectedOption = parent.adapter.getItem(position) as SelectBooleanOption
            autoComplete.tag = selectedOption.value
            autoComplete.setText(selectedOption.name, false)
        }
    }

    private fun saveMusicalNoteAPI(songId: Int, compassId: Int, musicalNoteRequest: MusicalNoteRequest) {
        binding.btnModifyMusicalNote.isEnabled = false
        binding.btnModifyMusicalNote.text = "Cargando..."
        musicalNoteRepository.saveMusicalNote(songId, compassId, musicalNoteRequest) { result ->
            if (!isAdded || _binding == null || view == null) return@saveMusicalNote
            viewLifecycleOwner.lifecycleScope.launch {
                result.onSuccess { response ->
                    Toast.makeText(requireContext(), "Nota musical agregada.", Toast.LENGTH_SHORT).show()
                    findNavController().popBackStack()
                }
                result.onFailure { error ->
                    showAPIError(requireContext(),error, binding.btnModifyMusicalNote, "Guardar")
                    }
            }
        }
    }

    private fun updateMusicalNoteAPI(songId: Int, compassId: Int, musicalNoteId: Int, musicalNoteRequest: MusicalNoteRequest) {
        binding.btnModifyMusicalNote.isEnabled = false
        binding.btnModifyMusicalNote.text = "Cargando..."
        musicalNoteRepository.updateMusicalNote(songId, compassId, musicalNoteId, musicalNoteRequest) { result ->
            if (!isAdded || _binding == null || view == null) return@updateMusicalNote
            viewLifecycleOwner.lifecycleScope.launch {
                result.onSuccess { response ->
                    Toast.makeText(requireContext(), "Nota musical actualizada.", Toast.LENGTH_SHORT).show()
                    findNavController().popBackStack()
                }
                result.onFailure { error ->
                    showAPIError(requireContext(),error,binding.btnModifyMusicalNote, "Guardar")
                }
            }
        }
    }

    private fun getChordsAPI() {
        chordRepository.getNonPaginatedChords { result ->
            if (!isAdded || _binding == null || view == null) return@getNonPaginatedChords
            viewLifecycleOwner.lifecycleScope.launch {
                result.onSuccess { response ->
                    val options = response.map { chord ->
                        SelectOption(chord.id, chord.chord_name)
                    }
                    showResultsList(binding.autoCompleteChord, options)
                }
                result.onFailure { error ->
                    Toast.makeText(requireContext(), "Error cargando acordes: ${error.message}", Toast.LENGTH_SHORT).show()
                }
            }
        }
    }

    private fun getRhythmicFiguresAPI() {
        searchRepository.getRhythmicFigures { result ->
            if (!isAdded || _binding == null || view == null) return@getRhythmicFigures
            viewLifecycleOwner.lifecycleScope.launch {
                result.onSuccess { response ->
                    val options = response.map { figure ->
                        SelectOption(figure.id, figure.name)
                    }
                    showResultsList(binding.autoCompleteFigure, options)
                }
                result.onFailure { error ->
                    Toast.makeText(requireContext(), "Error cargando figuras rítmicas: ${error.message}", Toast.LENGTH_SHORT).show()
                }
            }
        }
    }

    private fun showMusicalNote(
        musicalNoteLyrics: String,
        musicalNoteChordId: Int,
        musicalNoteRhythmicFigureId: Int,
        musicalNoteIsDotted: Boolean,
        musicalNoteIsSilence: Boolean
    ) {
        binding.edtLyrics.setText(musicalNoteLyrics)

        // Estos se llenarán cuando las APIs respondan
        selectAutoCompleteItem(binding.autoCompleteChord, musicalNoteChordId)
        selectAutoCompleteItem(binding.autoCompleteFigure, musicalNoteRhythmicFigureId)
        selectBooleanAutoCompleteItem(binding.autoCompleteDotted, musicalNoteIsDotted)
        selectBooleanAutoCompleteItem(binding.autoCompleteSilence, musicalNoteIsSilence)
    }

    private fun showResultsList(autoCompleter: AutoCompleteTextView, list: List<SelectOption>) {
        val adapter = ArrayAdapter(requireContext(), android.R.layout.simple_dropdown_item_1line, list)
        autoCompleter.setAdapter(adapter)

        autoCompleter.setOnItemClickListener { parent, _, position, _ ->
            val selectedOption = parent.adapter.getItem(position) as SelectOption
            autoCompleter.tag = selectedOption.id
            autoCompleter.setText(selectedOption.name, false)
        }
    }

    private fun selectAutoCompleteItem(autoComplete: AutoCompleteTextView, idToSelect: Int) {
        val adapter = autoComplete.adapter as? ArrayAdapter<SelectOption> ?: return
        for (i in 0 until adapter.count) {
            val option = adapter.getItem(i)
            if (option != null && option.id == idToSelect) {
                autoComplete.setText(option.name, false)
                autoComplete.tag = option.id
                break
            }
        }
    }

    private fun selectBooleanAutoCompleteItem(autoComplete: AutoCompleteTextView, valueToSelect: Boolean) {
        val adapter = autoComplete.adapter as? ArrayAdapter<SelectBooleanOption> ?: return
        for (i in 0 until adapter.count) {
            val option = adapter.getItem(i)
            if (option != null && option.value == valueToSelect) {
                autoComplete.setText(option.name, false)
                autoComplete.tag = option.value
                break
            }
        }
    }

    override fun onDestroyView() {
        super.onDestroyView()
        chordRepository.cancelAllRequests()
        musicalNoteRepository.cancelAllRequests()
        _binding = null
    }
}