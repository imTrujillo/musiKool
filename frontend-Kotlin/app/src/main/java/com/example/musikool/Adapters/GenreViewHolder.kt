package com.example.musikool.Adapters

import android.view.View
import android.widget.ImageButton
import android.widget.TextView
import androidx.recyclerview.widget.RecyclerView
import com.example.musikool.R

class GenreViewHolder (view: View) : RecyclerView.ViewHolder(view) {
    var color: View = view.findViewById(R.id.viewGenreColor)
    var name: TextView = view.findViewById(R.id.txtGenreName)
    var songs_count: TextView = view.findViewById(R.id.txtSongsCount)
}