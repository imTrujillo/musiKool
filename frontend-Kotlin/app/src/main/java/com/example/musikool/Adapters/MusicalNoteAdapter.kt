package com.example.musikool.Adapters

import android.view.LayoutInflater
import android.view.ViewGroup
import androidx.recyclerview.widget.RecyclerView
import com.example.musikool.Entities.MusicalNote
import com.example.musikool.R

class MusicalNoteAdapter (val musicalNoteList: List<MusicalNote>) : RecyclerView.Adapter<MusicalNoteViewHolder>() {
    override fun onCreateViewHolder(
        parent: ViewGroup,
        viewType: Int
    ): MusicalNoteViewHolder {
        val view = LayoutInflater.from(parent.context).inflate(R.layout.item_musical_note, parent, false)
        return MusicalNoteViewHolder(view)
    }

    override fun onBindViewHolder(
        holder: MusicalNoteViewHolder,
        position: Int
    ) {
        var musicalNote = musicalNoteList[position]

        holder.chord.text = if(musicalNote.is_silence) "-" else musicalNote.chord?.chord_name ?: "-"
        holder.lyrics.text = musicalNote.lyrics
        holder.duration.text = musicalNote.duration_in_compass.toString()
    }

    override fun getItemCount(): Int {
       return musicalNoteList.size
    }
}