package com.example.musikool.Adapters

import android.content.Context
import android.os.Bundle
import android.view.LayoutInflater
import android.view.View
import android.view.ViewGroup
import android.widget.Toast
import androidx.navigation.Navigation
import androidx.recyclerview.widget.RecyclerView
import com.example.musikool.API.SecureStorage
import com.example.musikool.DTOs.Request.Models.FavoriteRequest
import com.example.musikool.DTOs.Response.Auth.LoginResponse
import com.example.musikool.Entities.Chord
import com.example.musikool.Entities.Song
import com.example.musikool.R
import com.example.musikool.Repositories.FavoriteRepository
import com.example.musikool.Utils.PaginationUtils
import com.example.musikool.Utils.showAPIError

class SongAdapter(
    var songList: List<Song>,
    val context: Context,
    private val onFavoritesLoaded: ((Boolean) -> Unit)? = null
) : RecyclerView.Adapter<SongViewHolder>() {

    private val favoriteRepository = FavoriteRepository(context)


    private var favoriteItemIds = emptyList<Int>()
    private var favoriteIdMap = mutableMapOf<Int, Int>()
    private val pendingFavorites = mutableSetOf<Int>()

    private val loginResponse = SecureStorage.getObject(context, "Token", LoginResponse::class.java)
    private var areFavoritesLoaded = false

    init {
        loadFavoriteIds()
    }

    private fun loadFavoriteIds() {
        if (loginResponse != null && loginResponse.token.isNotEmpty()) {
            favoriteRepository.getIds(loginResponse.user.id, "Song") { result ->
                result.onSuccess { response ->
                    favoriteItemIds = response.favorites.map { it.favoritable_id }

                    favoriteIdMap.clear()
                    response.favorites.forEach { fav ->
                        favoriteIdMap[fav.favoritable_id] = fav.id
                    }

                    areFavoritesLoaded = true
                    notifyDataSetChanged()
                    onFavoritesLoaded?.invoke(true)
                }
                result.onFailure { error ->
                    areFavoritesLoaded = true
                    notifyDataSetChanged()
                    onFavoritesLoaded?.invoke(false)
                    Toast.makeText(context, "Error cargando favoritos", Toast.LENGTH_SHORT).show()
                }
            }
        } else {
            areFavoritesLoaded = true
            onFavoritesLoaded?.invoke(true)
        }
    }

    override fun onCreateViewHolder(parent: ViewGroup, viewType: Int): SongViewHolder {
        val view = LayoutInflater.from(parent.context).inflate(R.layout.item_song, parent, false)
        return SongViewHolder(view)
    }

    override fun onBindViewHolder(holder: SongViewHolder, position: Int) {
        val song = songList[position]

        holder.title.text = song.title ?: "Sin título"
        holder.genre.text = song.musical_genre?.name ?: "Género desconocido"
        holder.user.text = song.user?.name ?: "Artista desconocido"
        holder.reviews_count.text = if(song.reviews_count == 1) "1 reseña" else "${song.reviews_count ?: 0} reseñas"

        val rating = (song.avg_rating ?: 0.0f).toInt().coerceIn(0,5)
        for(i in holder.stars.indices){
            val icon = if (i < rating) R.drawable.ic_star_filled else R.drawable.ic_star_border
            holder.stars[i].setImageResource(icon)
        }

        if (loginResponse == null || loginResponse.token.isEmpty()) {
            holder.isFavorite.visibility = View.GONE
        } else {
            if (areFavoritesLoaded) {
                holder.isFavorite.visibility = View.VISIBLE
                val isFavorite = favoriteItemIds.contains(song.id)
                holder.isFavorite.isSelected = isFavorite
                holder.isFavorite.isEnabled = true
            } else {
                holder.isFavorite.visibility = View.INVISIBLE
                holder.isFavorite.isEnabled = false
            }
        }

        holder.itemView.setOnClickListener {
            val bundle = Bundle().apply {
                putInt("song_id", song.id)
                putString("song_title", song.title)
            }
            val navController = Navigation.findNavController(it)
            navController.navigate(R.id.nav_songs_details, bundle)
        }

        holder.isFavorite.setOnClickListener {
            toggleFavorite(song, holder)
        }
    }

    private fun toggleFavorite(song: Song, holder: SongViewHolder) {
        if (loginResponse == null || loginResponse.token.isEmpty()) return
        if (pendingFavorites.contains(song.id)) return

        val isCurrentlyFavorite = favoriteItemIds.contains(song.id)
        holder.isFavorite.isEnabled = false
        pendingFavorites.add(song.id)

        if (isCurrentlyFavorite) {
            val favoriteId = favoriteIdMap[song.id]
            if (favoriteId != null) {
                holder.isFavorite.isSelected = false
                favoriteRepository.deleteFavorite(loginResponse.user.id, favoriteId) { result ->
                    pendingFavorites.remove(song.id)
                    holder.isFavorite.isEnabled = true
                    result.onSuccess {
                        favoriteItemIds = favoriteItemIds.filter { it != song.id }
                        favoriteIdMap.remove(song.id)
                    }
                    result.onFailure { error ->
                        holder.isFavorite.isSelected = true
                        showAPIError(context, error)
                    }
                }
            }
        } else {
            val favoriteRequest = FavoriteRequest("Song", song.id)
            holder.isFavorite.isSelected = true // optimistic
            favoriteRepository.saveFavorite(loginResponse.user.id, favoriteRequest) { result ->
                pendingFavorites.remove(song.id)
                holder.isFavorite.isEnabled = true
                result.onSuccess { fav ->
                    favoriteItemIds = favoriteItemIds + fav.favoritable_id
                    favoriteIdMap[fav.favoritable_id] = fav.id
                }
                result.onFailure { error ->
                    holder.isFavorite.isSelected = false
                    showAPIError(context, error)
                }
            }
        }
    }


    override fun getItemCount(): Int = songList.size


}