package com.example.musikool.Adapters

import android.view.View
import android.widget.Button
import android.widget.TextView
import androidx.recyclerview.widget.RecyclerView
import com.example.musikool.R

class EditableSongViewHolder (view: View) : RecyclerView.ViewHolder(view) {
    var title: TextView = view.findViewById(R.id.txtSongName)
    var genre: TextView = view.findViewById(R.id.txtSongGenre)
    var reviews_count: TextView = view.findViewById(R.id.txtSongReviewCount)

    val edit: Button = view.findViewById(R.id.btnEdit)
    val delete: Button = view.findViewById(R.id.btnDelete)
}