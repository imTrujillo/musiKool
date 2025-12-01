package com.example.musikool.DTOs.Response.App.Lists

import com.example.musikool.DTOs.Response.App.Models.SongResponse
import com.example.musikool.DTOs.Response.Pagination.PaginationLinks
import com.example.musikool.DTOs.Response.Pagination.PaginationMeta
import com.example.musikool.Entities.Song

class SongListResponse(
    val data: List<Song>,
    val links: PaginationLinks,
    val meta: PaginationMeta
) {
}