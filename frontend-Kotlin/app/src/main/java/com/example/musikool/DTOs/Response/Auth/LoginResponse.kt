package com.example.musikool.DTOs.Response.Auth

import com.example.musikool.Entities.User

class LoginResponse (val token: String, val user: User) {
}