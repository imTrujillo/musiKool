package com.example.musikool.Adapters

import android.view.View
import android.widget.Button
import android.widget.TextView
import androidx.recyclerview.widget.RecyclerView
import com.example.musikool.R

class EditableCompassViewHolder (view: View) : RecyclerView.ViewHolder(view) {
    var order: TextView = view.findViewById(R.id.txtCompassOrder)
    var musicalNotes: RecyclerView = view.findViewById(R.id.musicalNotesList)
    var emptyState  : TextView = view.findViewById(R.id.txtEmptyStateTitle)
    val add: Button = view.findViewById(R.id.btnAdd)

    val edit : Button = view.findViewById(R.id.btnEdit)
    val delete : Button = view.findViewById(R.id.btnDelete)
}