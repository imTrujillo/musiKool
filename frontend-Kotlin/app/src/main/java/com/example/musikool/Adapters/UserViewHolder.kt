package com.example.musikool.Adapters

import android.graphics.Color
import android.os.Bundle
import android.view.View
import android.widget.ImageButton
import android.widget.TextView
import androidx.navigation.Navigation
import androidx.recyclerview.widget.RecyclerView
import com.example.musikool.Entities.Favorite
import com.example.musikool.Entities.User
import com.example.musikool.R


class UserViewHolder (view: View) : RecyclerView.ViewHolder(view) {
    var color: View = view.findViewById(R.id.viewUserColorLayout)
    var name: TextView = view.findViewById(R.id.txtUserName)
    var songs_count: TextView = view.findViewById(R.id.txtUserSongsCount)
    var isFavorite: ImageButton = view.findViewById(R.id.btnFavorite)

    fun bind(user: User) {
        color.setBackgroundColor(Color.parseColor(user.color))
        name.text = user.name ?: "Artista desconocido"
        songs_count.text = "Canciones: ${user.songs_count ?: 0}"

        itemView.setOnClickListener {
            val bundle = Bundle().apply {
                putInt("artist_id", user.id)
                putString("artist_name", user.name)
                putString("artist_color", user.color)
                putInt("artist_songs_count", user.songs_count ?: 0)
            }

            val navController = Navigation.findNavController(it)
            navController.navigate(R.id.nav_songs_per_entity, bundle)
        }

        isFavorite.visibility = View.GONE
    }
}