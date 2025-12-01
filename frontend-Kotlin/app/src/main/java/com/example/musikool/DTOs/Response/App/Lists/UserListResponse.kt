package com.example.musikool.DTOs.Response.App.Lists

import com.example.musikool.DTOs.Response.Pagination.PaginationLinks
import com.example.musikool.DTOs.Response.Pagination.PaginationMeta
import com.example.musikool.Entities.User

class UserListResponse(
    val data: List<User>,
    val links: PaginationLinks,
    val meta: PaginationMeta
) {
}