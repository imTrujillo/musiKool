package com.example.musikool.Adapters

import android.view.View
import android.widget.LinearLayout
import android.widget.ProgressBar
import android.widget.TextView
import androidx.recyclerview.widget.RecyclerView
import com.example.musikool.R

class CompassViewHolder (view: View) : RecyclerView.ViewHolder(view) {
    var order: TextView = view.findViewById(R.id.txtCompassOrder)
    var musicalNotes: RecyclerView = view.findViewById(R.id.musicalNotesList)
    var emptyState  : TextView = view.findViewById(R.id.txtEmptyStateTitle)
}