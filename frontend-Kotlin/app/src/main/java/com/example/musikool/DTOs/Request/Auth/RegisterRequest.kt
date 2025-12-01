package com.example.musikool.DTOs.Request.Auth

import java.io.Serializable

class RegisterRequest (
    val name: String,
    val email: String,
    val password: String,
    val password_confirmation: String,
    val color: String
) : Serializable {
}