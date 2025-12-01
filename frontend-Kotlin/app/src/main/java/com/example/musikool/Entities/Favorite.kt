package com.example.musikool.Entities

class Favorite (
    var id: Int,
    var model: String,
    var favoritable_id: Int,
    var user_id: Int,
    var updated_at: String? = null,
    var created_at: String? = null,
) {
}