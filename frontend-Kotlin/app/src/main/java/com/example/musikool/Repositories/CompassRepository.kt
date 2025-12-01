package com.example.musikool.Repositories

import android.content.Context
import com.example.musikool.API.APIClient
import com.example.musikool.DTOs.Request.Models.CompassRequest
import com.example.musikool.DTOs.Response.App.Models.CompassResponse
import retrofit2.Call
import retrofit2.Callback
import retrofit2.HttpException
import retrofit2.Response

class CompassRepository(val context: Context) {
    private val currentCalls = mutableListOf<Call<*>>()

    fun saveCompass(songId: Int, callback: (Result<CompassResponse>) -> Unit) {
        val call = APIClient.instance(context).saveCompass(songId)

        currentCalls.add(call)

        call.enqueue(object : Callback<CompassResponse> {
            override fun onResponse(
                call: Call<CompassResponse?>,
                response: Response<CompassResponse?>
            ) {
                currentCalls.remove(call)
                if (response.isSuccessful && response.body() != null) {
                    callback(Result.success(response.body()!!))
                } else {
                    callback(Result.failure(HttpException(response)))
                }
            }

            override fun onFailure(
                call: Call<CompassResponse?>,
                t: Throwable
            ) {
                currentCalls.remove(call)
                callback(Result.failure(t))
            }
        })
    }

    fun updateCompass(songId: Int, compassId: Int, compassRequest: CompassRequest, callback: (Result<CompassResponse>) -> Unit) {
        val call = APIClient.instance(context).updateCompass(songId, compassId, compassRequest)

        currentCalls.add(call)

        call.enqueue(object : Callback<CompassResponse> {
            override fun onResponse(
                call: Call<CompassResponse?>,
                response: Response<CompassResponse?>
            ) {
                currentCalls.remove(call)
                if (response.isSuccessful && response.body() != null) {
                    callback(Result.success(response.body()!!))
                } else {
                    callback(Result.failure(HttpException(response)))
                }
            }

            override fun onFailure(
                call: Call<CompassResponse?>,
                t: Throwable
            ) {
                currentCalls.remove(call)
                callback(Result.failure(t))
            }
        })
    }

    fun deleteCompass(songId: Int, compassId: Int, callback: (Result<Unit>) -> Unit) {
        val call = APIClient.instance(context).deleteCompass(songId, compassId)

        currentCalls.add(call)

        call.enqueue(object : Callback<Void> {
            override fun onResponse(
                call: Call<Void?>,
                response: Response<Void?>
            ) {
                currentCalls.remove(call)
                if (response.isSuccessful) {
                    callback(Result.success(Unit))
                } else {
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