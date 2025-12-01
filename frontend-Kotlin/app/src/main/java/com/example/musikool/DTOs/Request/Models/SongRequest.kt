package com.example.musikool.DTOs.Request.Models

import java.io.Serializable

class SongRequest(
    val title: String,
    val bpm: Int,
    val song_metric_id: Int,
    val user_id: Int,
    val song_scale_id: Int,
    val musical_genre_id: Int
) : Serializable {
}