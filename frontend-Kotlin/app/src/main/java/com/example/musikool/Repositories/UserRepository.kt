package com.example.musikool.Repositories

import android.content.Context
import com.example.musikool.API.APIClient
import com.example.musikool.DTOs.Request.Models.UserRequest
import com.example.musikool.DTOs.Response.App.Lists.UserListResponse
import com.example.musikool.DTOs.Response.App.Models.UserResponse
import com.example.musikool.Entities.User
import retrofit2.Call
import retrofit2.Callback
import retrofit2.HttpException
import retrofit2.Response

class UserRepository(val context: Context) {
    private val currentCalls = mutableListOf<Call<*>>()

    fun getUsers(
        include: String? = null,
        page: Int = 1,
        name: String? = null,
        filter: String? = null,
        callback: (Result<UserListResponse>) -> Unit
    ) {
        val call = APIClient.instance(context).getUsers(include,  page, name,filter)

        currentCalls.add(call)

        call.enqueue(object : Callback<UserListResponse> {
            override fun onResponse(
                call: Call<UserListResponse?>,
                response: Response<UserListResponse?>
            ) {
                currentCalls.remove(call)
                if (response.isSuccessful && response.body() != null) {
                    callback(Result.success(response.body()!!))
                } else {
                    callback(Result.failure(HttpException(response)))
                }
            }

            override fun onFailure(
                call: Call<UserListResponse?>,
                t: Throwable
            ) {
                currentCalls.remove(call)
                callback(Result.failure(t))
            }
        })
    }

    fun getUser(id: Int, include: String? = null, callback: (Result<User>) -> Unit) {
        val call = APIClient.instance(context).getUser(id, include)

        currentCalls.add(call)

        call.enqueue(object : Callback<UserResponse> {
            override fun onResponse(
                call: Call<UserResponse?>,
                response: Response<UserResponse?>
            ) {
                currentCalls.remove(call)
                if (response.isSuccessful && response.body() != null) {
                    callback(Result.success(response.body()!!.data))
                } else {
                    callback(Result.failure(HttpException(response)))
                }
            }

            override fun onFailure(
                call: Call<UserResponse?>,
                t: Throwable
            ) {
                currentCalls.remove(call)
                callback(Result.failure(t))
            }
        })
    }

    fun updateUser(id: Int, request: UserRequest, callback: (Result<User>) -> Unit) {
        val call = APIClient.instance(context).updateUser(id, request)

        currentCalls.add(call)

        call.enqueue(object : Callback<UserResponse> {
            override fun onResponse(
                call: Call<UserResponse?>,
                response: Response<UserResponse?>
            ) {
                currentCalls.remove(call)
                if (response.isSuccessful && response.body() != null) {
                    callback(Result.success(response.body()!!.data))
                } else {
                    callback(Result.failure(HttpException(response)))
                }
            }

            override fun onFailure(
                call: Call<UserResponse?>,
                t: Throwable
            ) {
                currentCalls.remove(call)
                callback(Result.failure(t))
            }
        })
    }

    fun deleteUser(id: Int, callback: (Result<Unit>) -> Unit) {
        val call = APIClient.instance(context).deleteUser(id)

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

            override fun onFailure(
                call: Call<Void?>,
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