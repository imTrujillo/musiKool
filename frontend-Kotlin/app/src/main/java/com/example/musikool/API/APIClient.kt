package com.example.musikool.API

import FavoriteItemConverterFactory
import android.content.Context
import okhttp3.OkHttpClient
import retrofit2.Retrofit
import retrofit2.converter.gson.GsonConverterFactory
import java.util.concurrent.TimeUnit

object APIClient {
    private const val base_url = "https://lexicological-semestrial-johnathan.ngrok-free.dev/api/"

    fun instance (context: Context): IAPIService {
        val client = OkHttpClient().newBuilder()
            .addInterceptor(AuthInterceptor(context))
            .connectTimeout(45, TimeUnit.SECONDS)
            .readTimeout(45, TimeUnit.SECONDS)
            .writeTimeout(45, TimeUnit.SECONDS)
            .build()

        val retrofit = Retrofit.Builder().baseUrl(base_url).client(client)
            .addConverterFactory(FavoriteItemConverterFactory())
            .addConverterFactory(GsonConverterFactory.create())
            .build().create(IAPIService::class.java)

        return retrofit
    }
}