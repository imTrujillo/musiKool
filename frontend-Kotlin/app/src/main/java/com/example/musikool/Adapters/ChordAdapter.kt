package com.example.musikool.Adapters

import android.content.Context
import android.media.MediaPlayer
import android.net.Uri
import android.view.LayoutInflater
import android.view.View
import android.view.ViewGroup
import android.widget.Toast
import androidx.recyclerview.widget.RecyclerView
import com.example.musikool.API.SecureStorage
import com.example.musikool.DTOs.Request.Models.FavoriteRequest
import com.example.musikool.DTOs.Response.Auth.LoginResponse
import com.example.musikool.Entities.Chord
import com.example.musikool.R
import com.example.musikool.Repositories.FavoriteRepository
import com.example.musikool.Utils.showAPIError

class ChordAdapter(var chordList: List<Chord>,
                   val context: Context,
                   private val onFavoritesLoaded: ((Boolean) -> Unit)? = null)
    : RecyclerView.Adapter<ChordViewHolder>() {
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
            favoriteRepository.getIds(loginResponse.user.id, "Chord") { result ->
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
                    showAPIError(context, error)
                    areFavoritesLoaded = true
                    notifyDataSetChanged()
                    onFavoritesLoaded?.invoke(false)
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
    ): ChordViewHolder {
        var view = LayoutInflater.from(parent.context).inflate(R.layout.item_chord, parent, false)

        return ChordViewHolder(view)
    }

    override fun onBindViewHolder(
        holder: ChordViewHolder,
        position: Int
    ) {
        val chord = chordList[position]
        holder.chord_name.text = chord.chord_name ?: "Acorde desconocido"

        val chordDiagrams = listOfNotNull(chord.piano_diagram, chord.guitar_diagram )
        holder.carousel.adapter = ChordImageAdapter(chordDiagrams)

        if (loginResponse == null || loginResponse.token.isEmpty()) {
            holder.isFavorite.visibility = View.GONE
        } else {
            if (areFavoritesLoaded) {
                holder.isFavorite.visibility = View.VISIBLE
                val isFavorite = favoriteItemIds.contains(chord.id)
                holder.isFavorite.isSelected = isFavorite
                holder.isFavorite.isEnabled = true
            } else {
                holder.isFavorite.visibility = View.INVISIBLE
                holder.isFavorite.isEnabled = false
            }
        }

        val htmlContent = """ 
            <html>
            <head>
                <style>
                   body {
                     margin: 0;
                     padding: 0;
                     display: flex;
                     justify-content: center;
                     align-items: center;
                   }
                   .scales_chords_api {
                     transform: scale(2.2);
                     transform-origin: center center;
                     display: block;
                   }
                 </style>
                <script async type="text/javascript" src="https://www.scales-chords.com/api/scales-chords-api.js"></script>
            </head>
            <body>
                <ins class="scales_chords_api" chord="${chord.chord_name}" instrument="piano" output="sound"></ins>
            </body>
        </html>
        """.trimIndent()
        holder.webPlay.settings.javaScriptEnabled=true
        holder.webPlay.addJavascriptInterface(WebAppInterface(context), "AndroidBridge")
        holder.webPlay.loadDataWithBaseURL(null, htmlContent, "text/html", "UTF-8", null)

        holder.isFavorite.setOnClickListener {
            toggleFavorite(chord, holder)
        }
    }

    override fun getItemCount(): Int {
        return chordList.size
    }

    private fun toggleFavorite(chord: Chord, holder: ChordViewHolder) {
        if (loginResponse == null || loginResponse.token.isEmpty()) return
        if (pendingFavorites.contains(chord.id)) return

        val isCurrentlyFavorite = favoriteItemIds.contains(chord.id)
        holder.isFavorite.isEnabled = false
        pendingFavorites.add(chord.id)

        if (isCurrentlyFavorite) {
            val favoriteId = favoriteIdMap[chord.id]
            if (favoriteId != null) {
                holder.isFavorite.isSelected = false
                favoriteRepository.deleteFavorite(loginResponse.user.id, favoriteId) { result ->
                    pendingFavorites.remove(chord.id)
                    holder.isFavorite.isEnabled = true
                    result.onSuccess {
                        favoriteItemIds = favoriteItemIds.filter { it != chord.id }
                        favoriteIdMap.remove(chord.id)
                    }
                    result.onFailure { error ->
                        holder.isFavorite.isSelected = true
                        showAPIError(context, error)
                    }
                }
            }
        } else {
            val favoriteRequest = FavoriteRequest("Chord", chord.id)
            holder.isFavorite.isSelected = true // optimistic
            favoriteRepository.saveFavorite(loginResponse.user.id, favoriteRequest) { result ->
                pendingFavorites.remove(chord.id)
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