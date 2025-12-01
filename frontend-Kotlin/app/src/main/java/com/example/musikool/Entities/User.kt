package com.example.musikool.Entities

class User (
    val id: Int,
    val name: String,
    val email : String,
    val email_verified_at : String,
    val color: String,
    val is_admin : Boolean,
    val created_at: String,
    val updated_at: String,
    val songs_count : Int? = null,
    val songs : List<Song>? = null,
    val favorites: List<Favorite>? = null,
    val reviews: List<SongReview>? = null
    ) {
}