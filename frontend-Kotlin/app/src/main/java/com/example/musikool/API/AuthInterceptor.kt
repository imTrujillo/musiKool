package com.example.musikool.API

import android.content.Context
import com.example.musikool.DTOs.Response.Auth.LoginResponse
import okhttp3.Interceptor
import okhttp3.Response

class AuthInterceptor (private val context: Context) : Interceptor {
    override fun intercept(chain: Interceptor.Chain): Response {
        val original = chain.request()
        val loginResponse = SecureStorage.getObject(context, "Token", LoginResponse::class.java)

        if(loginResponse?.token.isNullOrEmpty()){
            return chain.proceed(original)
        }else{
            var newRequest = original.newBuilder().addHeader("Authorization", "Bearer ${loginResponse?.token}").build()
            return chain.proceed(newRequest)
        }
    }
}