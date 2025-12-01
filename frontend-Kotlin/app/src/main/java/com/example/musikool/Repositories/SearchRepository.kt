package com.example.musikool.Repositories

import android.content.Context
import com.example.musikool.API.APIClient
import com.example.musikool.Entities.MusicalGenre
import com.example.musikool.Entities.RhythmicFigure
import com.example.musikool.Entities.SongMetric
import com.example.musikool.Entities.SongScale
import retrofit2.Call
import retrofit2.Callback
import retrofit2.HttpException
import retrofit2.Response

class SearchRepository(val context: Context) {
    private val currentCalls = mutableListOf<Call<*>>()

    fun getMusicalGenres(
        search: String? = null,
        callback: (Result<List<MusicalGenre>>) -> Unit
    ) {
        val call = APIClient.instance(context)
            .getMusicalGenres(search)

        currentCalls.add(call)

        call.enqueue(object : Callback<List<MusicalGenre>> {
            override fun onResponse(
                call: Call<List<MusicalGenre>?>,
                response: Response<List<MusicalGenre>?>
            ) {
                currentCalls.remove(call)
                if (response.isSuccessful && response.body() != null) {
                    callback(Result.success(response.body()!!))
                } else {
                    callback(Result.failure(HttpException(response)))
                }
            }

            override fun onFailure(
                call: Call<List<MusicalGenre>?>,
                t: Throwable
            ) {
                currentCalls.remove(call)
                callback(Result.failure(t))
            }
        })
    }

    fun getSongScales(
        search: String? = null,
        callback: (Result<List<SongScale>>) -> Unit
    ) {
        val call = APIClient.instance(context)
            .getSongScales(search)

        currentCalls.add(call)

        call.enqueue(object : Callback<List<SongScale>> {
            override fun onResponse(
                call: Call<List<SongScale>?>,
                response: Response<List<SongScale>?>
            ) {
                currentCalls.remove(call)
                if (response.isSuccessful && response.body() != null) {
                    callback(Result.success(response.body()!!))
                } else {
                    callback(Result.failure(HttpException(response)))
                }
            }

            override fun onFailure(
                call: Call<List<SongScale>?>,
                t: Throwable
            ) {
                currentCalls.remove(call)
                callback(Result.failure(t))
            }
        })
    }

    fun getSongMetrics(
        search: String? = null,
        callback: (Result<List<SongMetric>>) -> Unit
    ) {
        val call = APIClient.instance(context)
            .getSongMetrics(search)

        currentCalls.add(call)

        call.enqueue(object : Callback<List<SongMetric>> {
            override fun onResponse(
                call: Call<List<SongMetric>?>,
                response: Response<List<SongMetric>?>
            ) {
                currentCalls.remove(call)
                if (response.isSuccessful && response.body() != null) {
                    callback(Result.success(response.body()!!))
                } else {
                    callback(Result.failure(HttpException(response)))
                }
            }

            override fun onFailure(
                call: Call<List<SongMetric>?>,
                t: Throwable
            ) {
                currentCalls.remove(call)
                callback(Result.failure(t))
            }
        })
    }

    fun getRhythmicFigures(
        search: String? = null,
        callback: (Result<List<RhythmicFigure>>) -> Unit
    ) {
        val call = APIClient.instance(context)
            .getRhythmicFigures(search)

        currentCalls.add(call)

        call.enqueue(object : Callback<List<RhythmicFigure>> {
            override fun onResponse(
                call: Call<List<RhythmicFigure>?>,
                response: Response<List<RhythmicFigure>?>
            ) {
                currentCalls.remove(call)
                if (response.isSuccessful && response.body() != null) {
                    callback(Result.success(response.body()!!))
                } else {
                    callback(Result.failure(HttpException(response)))
                }
            }

            override fun onFailure(
                call: Call<List<RhythmicFigure>?>,
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