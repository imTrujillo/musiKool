package com.example.musikool.Adapters

import android.view.View
import android.widget.ImageButton
import android.widget.TextView
import androidx.recyclerview.widget.RecyclerView
import com.example.musikool.R

class EditableMusicalNoteViewHolder (view: View) : RecyclerView.ViewHolder(view) {
    var chord : TextView = view.findViewById(R.id.txtChord)
    var lyrics : TextView = view.findViewById(R.id.txtSongLyrics)

    val edit : ImageButton = view.findViewById(R.id.btnNoteEdit)
    val delete : ImageButton = view.findViewById(R.id.btnNoteDelete)
}