package com.example.musikool.Adapters

import android.os.Bundle
import android.view.LayoutInflater
import android.view.View
import android.view.ViewGroup
import android.widget.Toast
import androidx.appcompat.app.AlertDialog
import androidx.navigation.Navigation
import androidx.recyclerview.widget.LinearLayoutManager
import androidx.recyclerview.widget.RecyclerView
import com.example.musikool.Entities.Compass
import com.example.musikool.R
import com.example.musikool.Repositories.CompassRepository
import com.example.musikool.Repositories.SongRepository

class EditableCompassAdapter (var compassList : List<Compass>): RecyclerView.Adapter<EditableCompassViewHolder>() {

    private lateinit var compassRepository : CompassRepository

    override fun onCreateViewHolder(
        parent: ViewGroup,
        viewType: Int
    ): EditableCompassViewHolder {
        if (!::compassRepository.isInitialized) {
            compassRepository = CompassRepository(parent.context)
        }

        var view = LayoutInflater.from(parent.context).inflate(R.layout.item_editable_compass, parent, false)

        return EditableCompassViewHolder(view)
    }

    override fun onBindViewHolder(holder: EditableCompassViewHolder, position: Int) {
        var compass = compassList[position]
        val context = holder.itemView.context

        holder.order.text = compass.order.toString()

        holder.musicalNotes.layoutManager = LinearLayoutManager(holder.itemView.context, LinearLayoutManager.HORIZONTAL, false)
        holder.musicalNotes.adapter = EditableMusicalNoteAdapter(compass.song_id, compass.musical_notes)

        if (compass.musical_notes.isEmpty()) {
            holder.musicalNotes.visibility = View.GONE
            holder.emptyState.visibility = View.VISIBLE
        } else {
            holder.musicalNotes.visibility = View.VISIBLE
            holder.emptyState.visibility = View.GONE
        }

        holder.add.setOnClickListener {
            val bundle = Bundle().apply {
                putInt("song_id", compass.song_id)
                putInt("compass_id", compass.id)
            }

            val navController = Navigation.findNavController(it)
            navController.navigate(R.id.nav_modify_musical_note, bundle)
        }

        holder.edit.setOnClickListener {
            val bundle = Bundle().apply {
                putInt("song_id", compass.song_id)
                putInt("compass_id", compass.id)
                putInt("compass_order", compass.order)
            }

            val navController = Navigation.findNavController(it)
            navController.navigate(R.id.nav_modify_compass, bundle)
        }

        holder.delete.setOnClickListener {
            AlertDialog.Builder(context)
                .setTitle("Eliminar compás")
                .setMessage("¿Está seguro de eliminar el compás '${compass.order}'?")
                .setPositiveButton("Sí"){ _,_ ->
                    compassRepository.deleteCompass(compass.song_id, compass.id){ result ->
                        result.onSuccess { response ->
                            val newList = compassList.toMutableList()
                            newList.removeAt(holder.adapterPosition)
                            compassList = newList

                            notifyItemRemoved(holder.adapterPosition)

                            Toast.makeText(context, "Compás eliminado", Toast.LENGTH_SHORT).show()
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
        return compassList.size;
    }
}