package com.example.musikool.Entities

class Song (
    val id: Int,
    val title: String,
    val bpm : Int,
    val user_id: Int,
    val song_scale_id: Int,
    val song_metric_id : Int,
    val musical_genre_id: Int,
    val avg_rating : Float? = null,
    val reviews_count: Int? = null,
    val chords: List<String>? = null,
    val compasses : List<Compass>? = null,
    val reviews: List<SongReview>? = null,
    val user: User? = null,
    val musical_genre: MusicalGenre? = null,
    val song_metric: SongMetric? = null,
    val song_scale: SongScale? = null
) {
}
