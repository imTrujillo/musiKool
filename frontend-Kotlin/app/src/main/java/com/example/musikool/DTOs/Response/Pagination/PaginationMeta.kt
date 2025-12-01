package com.example.musikool.DTOs.Response.Pagination

class PaginationMeta (
    val current_page : Int,
    val from: Int?,
    val last_page: Int,
    val links: List<PaginationLinkItem>,
    val path: String,
    val per_page: Int,
    val to: Int?,
    val total: Int
) {
}