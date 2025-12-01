package com.example.musikool.Repositories

import android.content.Context
import com.example.musikool.API.APIClient
import com.example.musikool.DTOs.Request.Models.FavoriteRequest
import com.example.musikool.DTOs.Response.App.Lists.FavoriteListResponse
import com.example.musikool.DTOs.Response.App.Models.FavoriteIdResponse
import com.example.musikool.Entities.Favorite
import retrofit2.Call
import retrofit2.Callback
import retrofit2.HttpException
import retrofit2.Response

class FavoriteRepository(val context: Context) {
    private val currentCalls = mutableListOf<Call<*>>()

    fun getFavorites(
        userId: Int,
        page: Int? = 1,
        model: String,
        callback: (Result<FavoriteListResponse>) -> Unit
    ) {
        val call = APIClient.instance(context)
            .getFavorites(userId, page, model)

        currentCalls.add(call)

        call.enqueue(object : Callback<FavoriteListResponse> {
            override fun onResponse(
                call: Call<FavoriteListResponse>,
                response: Response<FavoriteListResponse>
            ) {
                currentCalls.remove(call)
                if (response.isSuccessful && response.body() != null) {
                    callback(Result.success(response.body()!!))
                } else {
                    callback(Result.failure(HttpException(response)))
                }
            }

            override fun onFailure(
                call: Call<FavoriteListResponse>,
                t: Throwable
            ) {
                currentCalls.remove(call)
                callback(Result.failure(t))
            }
        })
    }

    fun getIds(
        userId: Int,
        model: String,
        callback: (Result<FavoriteIdResponse>) -> Unit
    ) {
        val call = APIClient.instance(context)
            .getFavoriteIds(userId, model)

        currentCalls.add(call)

        call.enqueue(object : Callback<FavoriteIdResponse> {
            override fun onResponse(
                call: Call<FavoriteIdResponse>,
                response: Response<FavoriteIdResponse>
            ) {
                currentCalls.remove(call)
                if (response.isSuccessful && response.body() != null) {
                    callback(Result.success(response.body()!!))
                } else {
                    callback(Result.failure(HttpException(response)))
                }
            }

            override fun onFailure(
                call: Call<FavoriteIdResponse>,
                t: Throwable
            ) {
                currentCalls.remove(call)
                callback(Result.failure(t))
            }
        })
    }

    fun saveFavorite(
        userId: Int,
        request: FavoriteRequest,
        callback: (Result<Favorite>) -> Unit
    ) {
        val call = APIClient.instance(context)
            .saveFavorite(userId, request)

        currentCalls.add(call)

        call.enqueue(object : Callback<Favorite> {
            override fun onResponse(
                call: Call<Favorite>,
                response: Response<Favorite>
            ) {
                currentCalls.remove(call)
                if (response.isSuccessful && response.body() != null) {
                    callback(Result.success(response.body()!!))
                } else {
                    callback(Result.failure(HttpException(response)))
                }
            }

            override fun onFailure(
                call: Call<Favorite>,
                t: Throwable
            ) {
                currentCalls.remove(call)
                callback(Result.failure(t))
            }
        })
    }

    fun deleteFavorite(
        userId: Int,
        favoriteId: Int,
        callback: (Result<Unit>) -> Unit
    ) {
        val call = APIClient.instance(context)
            .deleteFavorite(userId, favoriteId)

        currentCalls.add(call)

        call.enqueue(object : Callback<Void> {
            override fun onResponse(
                call: Call<Void>,
                response: Response<Void>
            ) {
                currentCalls.remove(call)
                if (response.isSuccessful) {
                    callback(Result.success(Unit))
                } else {
                    callback(Result.failure(HttpException(response)))
                }
            }

            override fun onFailure(
                call: Call<Void>,
                t: Throwable
            ) {
                currentCalls.remove(call)
                callback(Result.failure(t))
            }
        })
    }

    fun cancelAllRequests() {
        currentCalls.forEach { call ->
            call.cancel()
        }
        currentCalls.clear()
    }

    fun cancelRequest(call: Call<*>) {
        call.cancel()
        currentCalls.remove(call)
    }
}