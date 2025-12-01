package com.example.musikool.Adapters

import android.os.Bundle
import android.view.LayoutInflater
import android.view.View
import android.view.ViewGroup
import android.widget.TextView
import androidx.navigation.Navigation
import androidx.recyclerview.widget.LinearLayoutManager
import androidx.recyclerview.widget.RecyclerView
import com.example.musikool.Entities.Compass
import com.example.musikool.R

class CompassAdapter(var compassList : List<Compass>): RecyclerView.Adapter<CompassViewHolder>() {

    override fun onCreateViewHolder(
        parent: ViewGroup,
        viewType: Int
    ): CompassViewHolder {
        var view = LayoutInflater.from(parent.context).inflate(R.layout.item_compass, parent, false)

        return CompassViewHolder(view)
    }

    override fun onBindViewHolder(holder: CompassViewHolder, position: Int) {
        var compass = compassList[position]

        holder.order.text = compass.order.toString()

        holder.musicalNotes.layoutManager = LinearLayoutManager(holder.itemView.context, LinearLayoutManager.HORIZONTAL, false)
        holder.musicalNotes.adapter = MusicalNoteAdapter(compass.musical_notes)

        if (compass.musical_notes.isEmpty()) {
            holder.musicalNotes.visibility = View.GONE
            holder.emptyState.visibility = View.VISIBLE
        } else {
            holder.musicalNotes.visibility = View.VISIBLE
            holder.emptyState.visibility = View.GONE
        }
    }

    override fun getItemCount(): Int {
        return compassList.size;
    }
}