package com.example.musikool.Repositories

import android.content.Context
import com.example.musikool.API.APIClient
import com.example.musikool.DTOs.Request.Models.SongRequest
import com.example.musikool.DTOs.Response.App.Lists.SongListResponse
import com.example.musikool.DTOs.Response.App.Models.SongResponse
import com.example.musikool.Entities.Song
import retrofit2.Call
import retrofit2.Callback
import retrofit2.HttpException
import retrofit2.Response

class SongRepository(val context: Context) {
    private val currentCalls = mutableListOf<Call<*>>()

    fun getSongs(
        include: String?,
        page: Int = 1,
        title: String? = null,
        filter: String? = null,
        genre_id: Int? = null,
        artist_id: Int? = null,
        callback: (Result<SongListResponse>) -> Unit
    ) {
        val call = APIClient.instance(context)
            .getSongs(include = include, page, title, filter, genre_id, artist_id)

        currentCalls.add(call)

        call.enqueue(object : Callback<SongListResponse> {
            override fun onResponse(
                call: Call<SongListResponse?>,
                response: Response<SongListResponse?>
            ) {
                currentCalls.remove(call)
                if(response.isSuccessful && response.body() != null){
                    callback(Result.success(response.body()!!))
                }else{
                    callback(Result.failure(HttpException(response)))
                }
            }

            override fun onFailure(
                call: Call<SongListResponse?>,
                t: Throwable
            ) {
                currentCalls.remove(call)
                callback(Result.failure(t))
            }
        })
    }

    fun getMySongs(
        page: Int? = null,
        include: String? = null,
        callback: (Result<SongListResponse>) -> Unit
    ) {
        val call = APIClient.instance(context)
            .getMySongs(page, include)

        currentCalls.add(call)

        call.enqueue(object : Callback<SongListResponse> {
            override fun onResponse(
                call: Call<SongListResponse?>,
                response: Response<SongListResponse?>
            ) {
                currentCalls.remove(call)
                if(response.isSuccessful && response.body() != null){
                    callback(Result.success(response.body()!!))
                }else{
                    callback(Result.failure(HttpException(response)))
                }
            }

            override fun onFailure(
                call: Call<SongListResponse?>,
                t: Throwable
            ) {
                currentCalls.remove(call)
                callback(Result.failure(t))
            }
        })
    }

    fun getSong(id: Int, include: String?, callback: (Result<Song>) -> Unit) {
        val call = APIClient.instance(context).getSong(id, include)

        currentCalls.add(call)

        call.enqueue(object : Callback<SongResponse> {
            override fun onResponse(
                call: Call<SongResponse?>,
                response: Response<SongResponse?>
            ) {
                currentCalls.remove(call)
                if (response.isSuccessful && response.body() != null){
                    callback(Result.success(response.body()!!.data))
                }else{
                    callback(Result.failure(HttpException(response)))
                }
            }

            override fun onFailure(
                call: Call<SongResponse?>,
                t: Throwable
            ) {
                currentCalls.remove(call)
                callback(Result.failure(t))
            }
        })
    }

    fun saveSong(song: SongRequest, callback: (Result<Song>) -> Unit) {
        val call = APIClient.instance(context).saveSong(song)

        currentCalls.add(call)

        call.enqueue(object : Callback<SongResponse> {
            override fun onResponse(
                call: Call<SongResponse?>,
                response: Response<SongResponse?>
            ) {
                currentCalls.remove(call)
                if (response.isSuccessful && response.body() != null){
                    callback(Result.success(response.body()!!.data))
                }else{
                    callback(Result.failure(HttpException(response)))
                }
            }

            override fun onFailure(
                call: Call<SongResponse?>,
                t: Throwable
            ) {
                currentCalls.remove(call)
                callback(Result.failure(t))
            }
        })
    }

    fun updateSong(id: Int, request: SongRequest, callback: (Result<Song>) -> Unit) {
        val call = APIClient.instance(context).updateSong(id, request)

        currentCalls.add(call)

        call.enqueue(object : Callback<SongResponse> {
            override fun onResponse(
                call: Call<SongResponse?>,
                response: Response<SongResponse?>
            ) {
                currentCalls.remove(call)
                if (response.isSuccessful && response.body() != null){
                    callback(Result.success(response.body()!!.data))
                }else{
                    callback(Result.failure(HttpException(response)))
                }
            }

            override fun onFailure(
                call: Call<SongResponse?>,
                t: Throwable
            ) {
                currentCalls.remove(call)
                callback(Result.failure(t))
            }
        })
    }

    fun deleteSong(id: Int, callback: (Result<Unit>) -> Unit) {
        val call = APIClient.instance(context).deleteSong(id)

        currentCalls.add(call)

        call.enqueue(object : Callback<Void> {
            override fun onResponse(
                call: Call<Void?>,
                response: Response<Void?>
            ) {
                currentCalls.remove(call)
                if(response.isSuccessful){
                    callback(Result.success(Unit))
                }else{
                    callback(Result.failure(HttpException(response)))
                }
            }

            override fun onFailure(call: Call<Void?>, t: Throwable) {
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