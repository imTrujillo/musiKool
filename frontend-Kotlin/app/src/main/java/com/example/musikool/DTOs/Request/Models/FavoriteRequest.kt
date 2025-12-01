package com.example.musikool.DTOs.Request.Models

import java.io.Serializable

class FavoriteRequest(
    val model: String,
    val favoritable_id: Int
) : Serializable {
}