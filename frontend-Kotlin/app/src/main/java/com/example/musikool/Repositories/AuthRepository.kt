package com.example.musikool.Repositories

import android.content.Context
import com.example.musikool.API.APIClient
import com.example.musikool.DTOs.Request.Auth.LoginRequest
import com.example.musikool.DTOs.Request.Auth.RegisterRequest
import com.example.musikool.DTOs.Response.Auth.LoginResponse
import com.example.musikool.DTOs.Response.Auth.LogoutResponse
import com.example.musikool.DTOs.Response.Auth.RegisterResponse
import retrofit2.Call
import retrofit2.Callback
import retrofit2.HttpException
import retrofit2.Response

class AuthRepository(val context: Context) {
    private val currentCalls = mutableListOf<Call<*>>()

    fun login(request: LoginRequest, callback: (Result<LoginResponse>) -> Unit) {
        val call = APIClient.instance(context).login(request)

        currentCalls.add(call)

        call.enqueue(object : Callback<LoginResponse> {
            override fun onResponse(
                call: Call<LoginResponse?>,
                response: Response<LoginResponse?>
            ) {
                currentCalls.remove(call)
                if (response.isSuccessful && response.body() != null) {
                    callback(Result.success(response.body()!!))
                } else {
                    callback(Result.failure(HttpException(response)))
                }
            }

            override fun onFailure(
                call: Call<LoginResponse?>,
                t: Throwable
            ) {
                currentCalls.remove(call)
                callback(Result.failure(t))
            }
        })
    }

    fun register(request: RegisterRequest, callback: (Result<RegisterResponse>) -> Unit) {
        val call = APIClient.instance(context).register(request)

        currentCalls.add(call)

        call.enqueue(object : Callback<RegisterResponse> {
            override fun onResponse(
                call: Call<RegisterResponse?>,
                response: Response<RegisterResponse?>
            ) {
                currentCalls.remove(call)
                if (response.isSuccessful && response.body() != null) {
                    callback(Result.success(response.body()!!))
                } else {
                    callback(Result.failure(HttpException(response)))
                }
            }

            override fun onFailure(
                call: Call<RegisterResponse?>,
                t: Throwable
            ) {
                currentCalls.remove(call)
                callback(Result.failure(t))
            }
        })
    }

    fun logout(callback: (Result<LogoutResponse>) -> Unit) {
        val call = APIClient.instance(context).logout()

        currentCalls.add(call)

        call.enqueue(object : Callback<LogoutResponse> {
            override fun onResponse(
                call: Call<LogoutResponse?>,
                response: Response<LogoutResponse?>
            ) {
                currentCalls.remove(call)
                if (response.isSuccessful && response.body() != null) {
                    callback(Result.success(response.body()!!))
                } else {
                    callback(Result.failure(HttpException(response)))
                }
            }

            override fun onFailure(
                call: Call<LogoutResponse?>,
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