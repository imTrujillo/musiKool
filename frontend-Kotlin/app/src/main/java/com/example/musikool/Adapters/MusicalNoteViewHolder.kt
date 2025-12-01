package com.example.musikool.Adapters

import android.view.View
import android.widget.TextView
import androidx.recyclerview.widget.RecyclerView
import com.example.musikool.R

class MusicalNoteViewHolder(view: View) : RecyclerView.ViewHolder(view) {
    var chord : TextView = view.findViewById(R.id.txtChord)
    var lyrics : TextView = view.findViewById(R.id.txtSongLyrics)
    var duration : TextView = view.findViewById(R.id.txtDuration)
}