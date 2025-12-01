package com.example.musikool.Repositories

import android.content.Context
import com.example.musikool.API.APIClient
import com.example.musikool.DTOs.Request.Models.MusicalNoteRequest
import com.example.musikool.DTOs.Response.App.Models.MusicalNoteResponse
import retrofit2.Call
import retrofit2.Callback
import retrofit2.HttpException
import retrofit2.Response

class MusicalNoteRepository(val context: Context) {
    private val currentCalls = mutableListOf<Call<*>>()

    fun saveMusicalNote(
        songId: Int,
        compassId: Int,
        musicalNoteRequest: MusicalNoteRequest,
        callback: (Result<MusicalNoteResponse>) -> Unit
    ) {
        val call = APIClient.instance(context).saveMusicalNote(songId, compassId, musicalNoteRequest)

        currentCalls.add(call)

        call.enqueue(object : Callback<MusicalNoteResponse> {
            override fun onResponse(
                call: Call<MusicalNoteResponse?>,
                response: Response<MusicalNoteResponse?>
            ) {
                currentCalls.remove(call)
                if (response.isSuccessful && response.body() != null) {
                    callback(Result.success(response.body()!!))
                } else {
                    callback(Result.failure(HttpException(response)))
                }
            }

            override fun onFailure(
                call: Call<MusicalNoteResponse?>,
                t: Throwable
            ) {
                currentCalls.remove(call)
                callback(Result.failure(t))
            }
        })
    }

    fun updateMusicalNote(
        songId: Int,
        compassId: Int,
        musicalNoteId: Int,
        musicalNoteRequest: MusicalNoteRequest,
        callback: (Result<MusicalNoteResponse>) -> Unit
    ) {
        val call = APIClient.instance(context).updateMusicalNote(songId, compassId, musicalNoteId, musicalNoteRequest)

        currentCalls.add(call)

        call.enqueue(object : Callback<MusicalNoteResponse> {
            override fun onResponse(
                call: Call<MusicalNoteResponse?>,
                response: Response<MusicalNoteResponse?>
            ) {
                currentCalls.remove(call)
                if (response.isSuccessful && response.body() != null) {
                    callback(Result.success(response.body()!!))
                } else {
                    callback(Result.failure(Exception("${response.message()}")))
                }
            }

            override fun onFailure(
                call: Call<MusicalNoteResponse?>,
                t: Throwable
            ) {
                currentCalls.remove(call)
                callback(Result.failure(t))
            }
        })
    }

    fun deleteMusicalNote(
        songId: Int,
        compassId: Int,
        musicalNoteId: Int,
        callback: (Result<Unit>) -> Unit
    ) {
        val call = APIClient.instance(context).deleteMusicalNote(songId, compassId, musicalNoteId)

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
                    callback(Result.failure(Exception("Error al eliminar la nota musical")))
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