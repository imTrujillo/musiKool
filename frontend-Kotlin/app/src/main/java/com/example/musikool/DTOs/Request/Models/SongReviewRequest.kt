package com.example.musikool.DTOs.Request.Models

import java.io.Serializable

class SongReviewRequest(
    var rating : Int,
    var user_id: Int
) : Serializable {
}