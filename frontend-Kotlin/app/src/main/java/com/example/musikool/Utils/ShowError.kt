package com.example.musikool.Utils

import android.content.Context
import android.widget.Button
import android.widget.Toast
import org.json.JSONObject
import retrofit2.HttpException
import java.io.IOException

fun showAPIError(
    context: Context,
    error: Throwable,
    button: Button? = null,
    textButton: String? = null
) {
    when (error) {
        is HttpException -> {
            val code = error.code()
            val errorBody = try {
                error.response()?.errorBody()?.string()
            } catch (e: Exception) {
                null
            }

            if (code == 422 && !errorBody.isNullOrEmpty()) {
                try {
                    val json = JSONObject(errorBody)
                    val errors = json.optJSONObject("errors")
                    if (errors != null) {
                        val messages = StringBuilder()
                        val keys = errors.keys()
                        while (keys.hasNext()) {
                            val key = keys.next()
                            val arr = errors.optJSONArray(key)
                            if (arr != null) {
                                for (i in 0 until arr.length()) {
                                    messages.append(arr.getString(i)).append("\n")
                                }
                            }
                        }
                        val msg = messages.toString().trim()
                        Toast.makeText(context, msg, Toast.LENGTH_LONG).show()
                    } else {
                        val msg = json.optString("message", "Error de validación")
                        Toast.makeText(context, msg, Toast.LENGTH_SHORT).show()
                    }
                } catch (e: Exception) {
                    Toast.makeText(context, "Error de validación", Toast.LENGTH_SHORT).show()
                    e.printStackTrace()
                }
            } else {
                Toast.makeText(context, "Error HTTP $code", Toast.LENGTH_SHORT).show()
            }
        }

        is IOException -> {
            Toast.makeText(context, "Error de conexión. Verifica tu red.", Toast.LENGTH_SHORT).show()
        }

        else -> {
            Toast.makeText(context, "Error inesperado: ${error.message}", Toast.LENGTH_SHORT).show()
        }
    }

    button?.let {
        it.isEnabled = true
        if (textButton != null) it.text = textButton
    }
}
