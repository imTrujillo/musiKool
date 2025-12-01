package com.example.musikool.Repositories

import android.content.Context
import com.example.musikool.API.APIClient
import com.example.musikool.DTOs.Response.App.Lists.ChordListResponse
import com.example.musikool.Entities.Chord
import retrofit2.Call
import retrofit2.Callback
import retrofit2.HttpException
import retrofit2.Response

class ChordRepository(val context: Context) {
    private val currentCalls = mutableListOf<Call<*>>()

    fun getChords(
        chord_name: String? = null,
        filter: String? = null,
        page: Int = 1,
        callback: (Result<ChordListResponse>) -> Unit
    ) {
        val call = APIClient.instance(context)
            .getChords(chord_name, filter, page)

        currentCalls.add(call)

        call.enqueue(object : Callback<ChordListResponse> {
            override fun onResponse(
                call: Call<ChordListResponse?>,
                response: Response<ChordListResponse?>
            ) {
                currentCalls.remove(call)
                if (response.isSuccessful && response.body() != null) {
                    callback(Result.success(response.body()!!))
                } else {
                    callback(Result.failure(HttpException(response)))
                }
            }

            override fun onFailure(
                call: Call<ChordListResponse?>,
                t: Throwable
            ) {
                currentCalls.remove(call)
                callback(Result.failure(t))
            }
        })
    }

    fun getNonPaginatedChords(
        callback: (Result<List<Chord>>) -> Unit
    ) {
        val call = APIClient.instance(context)
            .getNonPaginatedChords()

        currentCalls.add(call)

        call.enqueue(object : Callback<List<Chord>> {
            override fun onResponse(
                call: Call<List<Chord>>,
                response: Response<List<Chord>>
            ) {
                currentCalls.remove(call)
                if (response.isSuccessful && response.body() != null) {
                    callback(Result.success(response.body()!!))
                } else {
                    callback(Result.failure(HttpException(response)))
                }
            }

            override fun onFailure(
                call: Call<List<Chord>>,
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