package com.example.musikool.API

import com.example.musikool.DTOs.Response.App.Lists.FavoriteItem
import com.example.musikool.Entities.Chord
import com.example.musikool.Entities.Song
import com.example.musikool.Entities.User
import com.google.gson.JsonDeserializationContext
import com.google.gson.JsonDeserializer
import com.google.gson.JsonElement
import com.google.gson.JsonParseException
import java.lang.reflect.Type

class FavoriteItemTypeAdapter : JsonDeserializer<FavoriteItem> {
    override fun deserialize(
        json: JsonElement,
        typeOfT: Type,
        context: JsonDeserializationContext
    ): FavoriteItem? {
        val jsonObject = json.asJsonObject

        // Determina el tipo basado en los campos presentes en el JSON
        return when {
            jsonObject.has("bpm") -> {

                val song = context.deserialize<Song>(json, Song::class.java)
                FavoriteItem.SongItem(song)
            }
            jsonObject.has("email") -> {
                // Es un usuario (User)
                val user = context.deserialize<User>(json, User::class.java)
                FavoriteItem.UserItem(user)
            }
            jsonObject.has("chord_name") -> {
                // Es un acorde (Chord)
                val chord = context.deserialize<Chord>(json, Chord::class.java)
                FavoriteItem.ChordItem(chord)
            }
            else -> throw JsonParseException("Cannot determine FavoriteItem type from JSON: $json")
        }
    }
}