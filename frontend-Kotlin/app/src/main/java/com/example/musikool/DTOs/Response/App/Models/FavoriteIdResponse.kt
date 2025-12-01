package com.example.musikool.DTOs.Response.App.Models

data class FavoriteItem(
    val id: Int,
    val favoritable_id: Int
)

data class FavoriteIdResponse(
    val favorites: List<FavoriteItem>
)