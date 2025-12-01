package com.example.musikool.Adapters

import android.content.Context
import android.graphics.Color
import android.os.Bundle
import android.view.LayoutInflater
import android.view.ViewGroup
import androidx.navigation.Navigation
import androidx.recyclerview.widget.RecyclerView
import com.example.musikool.Entities.MusicalGenre
import com.example.musikool.R


class GenreAdapter(var genreList: List<MusicalGenre>) : RecyclerView.Adapter<GenreViewHolder>() {
    var _context: Context? = null
    override fun onCreateViewHolder(
        parent: ViewGroup,
        viewType: Int
    ): GenreViewHolder {
        if (_context == null){
            _context = parent.context
        }
        var view = LayoutInflater.from(parent.context).inflate(R.layout.item_genre, parent, false)

        return GenreViewHolder(view)
    }

    override fun onBindViewHolder(
        holder: GenreViewHolder,
        position: Int
    ) {
        var genre = genreList[position]
        var colorHex = genre.color ?: "#333045"
        var colorInt = Color.parseColor(colorHex)

        holder.name.text = genre.name ?: "Género desconocido"
        holder.color.setBackgroundColor(colorInt)
        holder.songs_count.text = if(genre.songs_count == 1)"1 canción" else "${genre.songs_count ?: 0} canciones"

        holder.itemView.setOnClickListener {
            val bundle = Bundle().apply {
                putInt("genre_id", genre.id)
                putString("genre_name", genre.name)
                putString("genre_color", genre.color)
                putInt("genre_songs_count", genre.songs_count ?: 0)
            }

            val navController = Navigation.findNavController(it)
            navController.navigate(R.id.nav_songs_per_entity, bundle)
        }

    }

    override fun getItemCount(): Int {
        return genreList.size
    }
}