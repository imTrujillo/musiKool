package com.example.musikool.Adapters

import android.view.LayoutInflater
import android.view.ViewGroup
import androidx.recyclerview.widget.RecyclerView
import com.example.musikool.DTOs.Response.App.Lists.FavoriteItem
import com.example.musikool.R



class FavoriteAdapter (val favoriteItemList : List<FavoriteItem>) : RecyclerView.Adapter<RecyclerView.ViewHolder>() {

    companion object{
        private const val ARTIST = 0
        private const val CHORD = 1
        private const val SONG = 2
    }

    override fun getItemViewType(position: Int): Int {
        return when (favoriteItemList[position]){
            is FavoriteItem.UserItem -> ARTIST
            is FavoriteItem.ChordItem -> CHORD
            is FavoriteItem.SongItem -> SONG
            else-> CHORD
        }
    }

    override fun onCreateViewHolder(
        parent: ViewGroup,
        viewType: Int
    ): RecyclerView.ViewHolder {
        return when (viewType){
            ARTIST -> {
                val view = LayoutInflater.from(parent.context).inflate(R.layout.item_artist, parent, false)
                UserViewHolder(view)
            }
            CHORD -> {
                val view = LayoutInflater.from(parent.context).inflate(R.layout.item_chord, parent, false)
                ChordViewHolder(view)
            }
            else -> {
                val view = LayoutInflater.from(parent.context).inflate(R.layout.item_song, parent, false)
                SongViewHolder(view)
            }
        }
    }

    override fun onBindViewHolder(
        holder: RecyclerView.ViewHolder,
        position: Int
    ) {
        when (val item = favoriteItemList[position]) {
            is FavoriteItem.UserItem -> (holder as UserViewHolder).bind(item.user)
            is FavoriteItem.SongItem -> (holder as SongViewHolder).bind(item.song)
            is FavoriteItem.ChordItem -> (holder as ChordViewHolder).bind(item.chord)
        }
    }

    override fun getItemCount(): Int {
        return favoriteItemList.size
    }
}