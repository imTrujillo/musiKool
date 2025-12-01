package com.example.musikool.Adapters

import android.content.Context
import android.graphics.Color
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
import com.example.musikool.Entities.User
import com.example.musikool.R
import com.example.musikool.Repositories.FavoriteRepository
import com.example.musikool.Utils.showAPIError

class UserAdapter (var usersList: List<User>,
                   val context: Context,
                   private val onFavoritesLoaded: ((Boolean) -> Unit)? = null) 
    : RecyclerView.Adapter<UserViewHolder>(){
        
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
            favoriteRepository.getIds(loginResponse.user.id, "User") { result ->
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



    override fun onCreateViewHolder(
        parent: ViewGroup,
        viewType: Int
    ): UserViewHolder {
        var view = LayoutInflater.from(context).inflate(R.layout.item_artist, parent, false)

        return UserViewHolder(view)
    }

    override fun onBindViewHolder(
        holder: UserViewHolder,
        position: Int
    ) {
        var user  = usersList[position]
        var colorHex = user.color ?: "#333045"
        var colorInt = Color.parseColor(colorHex)

        holder.name.text = user.name ?: "Artista desconocido"
        holder.color.setBackgroundColor(colorInt)
        holder.songs_count.text = if(user.songs_count == 1)"1 canción" else "${user.songs_count ?: 0} canciones"

        if (loginResponse == null || loginResponse.token.isEmpty()) {
            holder.isFavorite.visibility = View.GONE
        } else {
            if (areFavoritesLoaded) {
                holder.isFavorite.visibility = View.VISIBLE
                val isFavorite = favoriteItemIds.contains(user.id)
                holder.isFavorite.isSelected = isFavorite
                holder.isFavorite.isEnabled = true
            } else {
                holder.isFavorite.visibility = View.INVISIBLE
                holder.isFavorite.isEnabled = false
            }
        }

        holder.itemView.setOnClickListener {
            val bundle = Bundle().apply {
                putInt("artist_id", user.id)
                putString("artist_name", user.name)
                putString("artist_color", user.color)
                putInt("artist_songs_count", user.songs_count ?: 0)
            }

            val navController = Navigation.findNavController(it)
            navController.navigate(R.id.nav_songs_per_entity, bundle)
        }

        holder.isFavorite.setOnClickListener {
            toggleFavorite(user, holder)
        }
    }

    override fun getItemCount(): Int {
        return usersList.size
    }

    private fun toggleFavorite(user: User, holder: UserViewHolder) {
        if (loginResponse == null || loginResponse.token.isEmpty()) return
        if (pendingFavorites.contains(user.id)) return

        val isCurrentlyFavorite = favoriteItemIds.contains(user.id)
        holder.isFavorite.isEnabled = false
        pendingFavorites.add(user.id)

        if (isCurrentlyFavorite) {
            val favoriteId = favoriteIdMap[user.id]
            if (favoriteId != null) {
                holder.isFavorite.isSelected = false
                favoriteRepository.deleteFavorite(loginResponse.user.id, favoriteId) { result ->
                    pendingFavorites.remove(user.id)
                    holder.isFavorite.isEnabled = true
                    result.onSuccess {
                        favoriteItemIds = favoriteItemIds.filter { it != user.id }
                        favoriteIdMap.remove(user.id)
                    }
                    result.onFailure { error ->
                        holder.isFavorite.isSelected = true
                        showAPIError(context, error)
                    }
                }
            }
        } else {
            val favoriteRequest = FavoriteRequest("User", user.id)
            holder.isFavorite.isSelected = true // optimistic
            favoriteRepository.saveFavorite(loginResponse.user.id, favoriteRequest) { result ->
                pendingFavorites.remove(user.id)
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

}