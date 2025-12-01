package com.example.musikool.DTOs.Response.App.Lists

import com.example.musikool.DTOs.Response.Pagination.PaginationLinks
import com.example.musikool.DTOs.Response.Pagination.PaginationMeta
import com.example.musikool.Entities.Chord
import com.example.musikool.Entities.Favorite
import com.example.musikool.Entities.Song
import com.example.musikool.Entities.User

sealed class FavoriteItem {
    data class ChordItem(val chord: Chord) : FavoriteItem()
    data class UserItem(val user: User) : FavoriteItem()
    data class SongItem (val song: Song) : FavoriteItem()
}
class FavoriteListResponse(
    val data: List<FavoriteItem>,
    val links: PaginationLinks,
    val meta: PaginationMeta
) {
}