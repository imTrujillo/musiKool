package com.example.musikool.Adapters

import android.os.Bundle
import android.view.LayoutInflater
import android.view.ViewGroup
import android.widget.Toast
import androidx.appcompat.app.AlertDialog
import androidx.navigation.Navigation
import androidx.recyclerview.widget.RecyclerView
import com.example.musikool.Entities.MusicalNote
import com.example.musikool.R
import com.example.musikool.Repositories.CompassRepository
import com.example.musikool.Repositories.MusicalNoteRepository

class EditableMusicalNoteAdapter (var songId : Int,var musicalNoteList: List<MusicalNote>) : RecyclerView.Adapter<EditableMusicalNoteViewHolder>() {
    private lateinit var musicalNoteRepository: MusicalNoteRepository

    override fun onCreateViewHolder(
        parent: ViewGroup,
        viewType: Int
    ): EditableMusicalNoteViewHolder {
        if (!::musicalNoteRepository.isInitialized) {
            musicalNoteRepository = MusicalNoteRepository(parent.context)
        }

        val view = LayoutInflater.from(parent.context).inflate(R.layout.item_editable_musical_note, parent, false)
        return EditableMusicalNoteViewHolder(view)
    }

    override fun onBindViewHolder(
        holder: EditableMusicalNoteViewHolder,
        position: Int
    ) {
        var musicalNote = musicalNoteList[position]
        val context = holder.itemView.context

        holder.chord.text = if(musicalNote.is_silence) "-" else musicalNote.chord?.chord_name ?: "-"
        holder.lyrics.text = musicalNote.lyrics

        holder.edit.setOnClickListener {
            val bundle = Bundle().apply {
                putInt("song_id", songId)
                putInt("compass_id", musicalNote.compass_id)
                putInt("musical_note_id", musicalNote.id)
                putString("musical_note_lyrics", musicalNote.lyrics)
                putInt("musical_note_chord_id", musicalNote.chord_id)
                putInt("musical_note_rhythmic_figure_id", musicalNote.rhythmic_figure_id)
                putBoolean("musical_note_is_dotted", musicalNote.is_dotted)
                putBoolean("musical_note_is_silence", musicalNote.is_silence)
            }

            val navController = Navigation.findNavController(it)
            navController.navigate(R.id.nav_modify_musical_note, bundle)
        }

        holder.delete.setOnClickListener {
            AlertDialog.Builder(context)
                .setTitle("Eliminar nota musical")
                .setMessage("¿Está seguro de eliminar esta nota musical?")
                .setPositiveButton("Sí"){ _,_ ->
                    musicalNoteRepository.deleteMusicalNote(songId, musicalNote.compass_id, musicalNote.id){ result ->
                        result.onSuccess { response ->
                            val newList = musicalNoteList.toMutableList()
                            newList.removeAt(holder.adapterPosition)
                            musicalNoteList = newList

                            notifyItemRemoved(holder.adapterPosition)

                            Toast.makeText(context, "Nota musical eliminada", Toast.LENGTH_SHORT).show()
                        }
                        result.onFailure { error -> Toast.makeText(context, "Error: ${error.message}", Toast.LENGTH_SHORT).show()
                        }
                    }
                }
                .setNegativeButton("Cancelar", null)
                .show()

        }
    }

    override fun getItemCount(): Int {
        return musicalNoteList.size
    }
}