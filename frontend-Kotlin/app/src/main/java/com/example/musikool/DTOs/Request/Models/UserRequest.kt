package com.example.musikool.DTOs.Request.Models

import java.io.Serializable

class UserRequest (
    var name: String? = null,
    var email: String? = null,
    var password: String? = null,
    var color: String? = null
) : Serializable{
}