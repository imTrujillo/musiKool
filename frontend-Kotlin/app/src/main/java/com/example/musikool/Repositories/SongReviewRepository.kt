package com.example.musikool.Repositories

import android.content.Context
import com.example.musikool.API.APIClient
import com.example.musikool.DTOs.Request.Models.SongRequest
import com.example.musikool.DTOs.Request.Models.SongReviewRequest
import com.example.musikool.DTOs.Response.App.Models.SongResponse
import com.example.musikool.DTOs.Response.App.Models.SongReviewResponse
import com.example.musikool.Entities.Song
import com.example.musikool.Entities.SongReview
import retrofit2.Call
import retrofit2.Callback
import retrofit2.HttpException
import retrofit2.Response

class SongReviewRepository(val context: Context) {
    private val currentCalls = mutableListOf<Call<*>>()

    fun getSongReview(songId: Int, callback: (Result<SongReviewResponse>) -> Unit) {
        val call = APIClient.instance(context).getSongReview(songId)

        currentCalls.add(call)

        call.enqueue(object : Callback<SongReviewResponse> {
            override fun onResponse(
                call: Call<SongReviewResponse>,
                response: Response<SongReviewResponse>
            ) {
                currentCalls.remove(call)
                if (response.isSuccessful && response.body() != null){
                    callback(Result.success(response.body()!!))
                }else{
                    callback(Result.failure(HttpException(response)))
                }
            }

            override fun onFailure(
                call: Call<SongReviewResponse>,
                t: Throwable
            ) {
                currentCalls.remove(call)
                callback(Result.failure(t))
            }
        })
    }

    fun saveSongReview(songId: Int, songReview: SongReviewRequest, callback: (Result<SongReviewResponse>) -> Unit) {
        val call = APIClient.instance(context).saveSongReview(songId, songReview)

        currentCalls.add(call)

        call.enqueue(object : Callback<SongReviewResponse> {
            override fun onResponse(
                call: Call<SongReviewResponse>,
                response: Response<SongReviewResponse>
            ) {
                currentCalls.remove(call)
                if (response.isSuccessful && response.body() != null){
                    callback(Result.success(response.body()!!))
                }else{
                    callback(Result.failure(HttpException(response)))
                }
            }

            override fun onFailure(
                call: Call<SongReviewResponse>,
                t: Throwable
            ) {
                currentCalls.remove(call)
                callback(Result.failure(t))
            }
        })
    }

    fun updateSongReview(songId: Int, songReview: SongReviewRequest, callback: (Result<SongReviewResponse>) -> Unit) {
        val call = APIClient.instance(context).updateSongReview(songId, songReview)

        currentCalls.add(call)

        call.enqueue(object : Callback<SongReviewResponse> {
            override fun onResponse(
                call: Call<SongReviewResponse>,
                response: Response<SongReviewResponse>
            ) {
                currentCalls.remove(call)
                if (response.isSuccessful && response.body() != null){
                    callback(Result.success(response.body()!!))
                }else{
                    callback(Result.failure(HttpException(response)))
                }
            }

            override fun onFailure(
                call: Call<SongReviewResponse>,
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