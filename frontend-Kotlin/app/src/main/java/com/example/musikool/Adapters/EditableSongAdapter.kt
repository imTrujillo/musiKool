package com.example.musikool.Adapters

import android.content.Context
import android.os.Bundle
import android.view.LayoutInflater
import android.view.ViewGroup
import android.widget.Toast
import androidx.appcompat.app.AlertDialog
import androidx.navigation.Navigation
import androidx.recyclerview.widget.LinearLayoutManager
import androidx.recyclerview.widget.RecyclerView
import com.example.musikool.Entities.Song
import com.example.musikool.R
import com.example.musikool.Repositories.SongRepository

class EditableSongAdapter (
    var songList: List<Song>,
    val context: Context
) : RecyclerView.Adapter<EditableSongViewHolder>() {
    private lateinit var songRepository: SongRepository

    override fun onCreateViewHolder(parent: ViewGroup, viewType: Int): EditableSongViewHolder {
        if (!::songRepository.isInitialized) {
            songRepository = SongRepository(parent.context)
        }

        val view = LayoutInflater.from(parent.context).inflate(R.layout.item_editable_song, parent, false)
        return EditableSongViewHolder(view)
    }

    override fun onBindViewHolder(holder: EditableSongViewHolder, position: Int) {
        val song = songList[position]

        holder.title.text = song.title ?: "Sin título"
        holder.genre.text = song.musical_genre?.name ?: "Género desconocido"
        holder.reviews_count.text = if(song.reviews_count == 1) "1 reseña" else "${song.reviews_count ?: 0} reseñas"

        holder.edit.setOnClickListener {
            val bundle = Bundle().apply {
                putInt("song_id", song.id)
            }

            val navController = Navigation.findNavController(it)
            navController.navigate(R.id.nav_modify_song, bundle)
        }

        holder.delete.setOnClickListener {
            AlertDialog.Builder(context)
                .setTitle("Eliminar canción")
                .setMessage("¿Está seguro de eliminar '${song.title}' ")
                .setPositiveButton("Sí"){ _,_ ->
                    songRepository.deleteSong(song.id){ result ->
                        result.onSuccess { response ->
                            val newList = songList.toMutableList()
                            newList.removeAt(holder.adapterPosition)
                            songList = newList

                            notifyItemRemoved(holder.adapterPosition)

                            Toast.makeText(context, "Canción eliminada", Toast.LENGTH_SHORT).show()
                        }
                        result.onFailure { error -> Toast.makeText(context, "Error: ${error.message}", Toast.LENGTH_SHORT).show()
                        }
                    }
                }
                .setNegativeButton("Cancelar", null)
                .show()

        }
    }




    override fun getItemCount(): Int = songList.size


}