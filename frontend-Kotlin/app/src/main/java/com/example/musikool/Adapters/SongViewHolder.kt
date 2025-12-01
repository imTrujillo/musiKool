package com.example.musikool.Adapters

import android.graphics.Color
import android.os.Bundle
import android.view.View
import android.widget.ImageButton
import android.widget.ImageView
import android.widget.TextView
import androidx.navigation.Navigation
import androidx.recyclerview.widget.RecyclerView
import com.example.musikool.Entities.Compass
import com.example.musikool.Entities.MusicalGenre
import com.example.musikool.Entities.Song
import com.example.musikool.Entities.SongMetric
import com.example.musikool.Entities.SongReview
import com.example.musikool.Entities.SongScale
import com.example.musikool.Entities.User
import com.example.musikool.R

class SongViewHolder (view: View) : RecyclerView.ViewHolder(view) {
    var title: TextView = view.findViewById(R.id.txtSongName)
    var user: TextView = view.findViewById(R.id.txtSongArtist)
    var genre:  TextView = view.findViewById(R.id.txtSongGenre)
    var reviews_count: TextView = view.findViewById(R.id.txtSongReviewCount)
    var isFavorite: ImageButton = view.findViewById(R.id.btnFavorite)

    var stars: List<ImageView> = listOf(
        view.findViewById(R.id.star1),
        view.findViewById(R.id.star2),
        view.findViewById(R.id.star3),
        view.findViewById(R.id.star4),
        view.findViewById(R.id.star5),
    )

    fun bind(song: Song) {
        title.text = song.title ?: "Canción desconocida"
        user.text = song.user?.name ?: "Artista desconocido"
        genre.text = song.musical_genre?.name ?: "Género desconocido"
        reviews_count.text = "${song.reviews_count ?: 0} Reseñas"

        val rating = (song.avg_rating ?: 0.0f).toInt().coerceIn(0, 5)
        for (i in stars.indices) {
            val icon = if (i < rating) R.drawable.ic_star_filled else R.drawable.ic_star_border
            stars[i].setImageResource(icon)
        }

        itemView.setOnClickListener {
            val bundle = Bundle().apply {
                putInt("song_id", song.id)
                putString("song_title", song.title)
            }
            val navController = Navigation.findNavController(it)
            navController.navigate(R.id.nav_songs_details, bundle)
        }

        isFavorite.visibility = View.GONE
    }
}