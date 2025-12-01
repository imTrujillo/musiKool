package com.example.musikool.API

import android.content.Context
import androidx.security.crypto.EncryptedSharedPreferences
import androidx.security.crypto.MasterKey
import com.google.gson.Gson

object SecureStorage {
    val pref_name = "secure_storage"
    val gson = Gson()

    fun getPrefs (context: Context) = EncryptedSharedPreferences
        .create(context, pref_name, MasterKey.Builder(context)
            .setKeyScheme(
                MasterKey.KeyScheme.AES256_GCM).build(),
            EncryptedSharedPreferences.PrefKeyEncryptionScheme.AES256_SIV,
            EncryptedSharedPreferences.PrefValueEncryptionScheme.AES256_GCM)

    fun putString(context: Context, key: String, value: String){
        val pref = getPrefs(context).edit()

        pref.putString(key, value)
        pref.apply()
    }

    fun getString(context: Context, key: String): String {
        val pref = getPrefs(context)

        val keyValue = pref.getString(key, "")
        return keyValue.toString()
    }

    fun <T> putObject(context:Context, key: String, obj: T){
        val json = gson.toJson(obj)
        putString(context, key, json)
    }

    fun <T> getObject(context:Context, key: String,clazz: Class<T>): T?{
        val json = getString(context, key)
        return if (json.isNotEmpty()) gson.fromJson(json, clazz) else null
    }

    fun clear(context: Context ){
        getPrefs(context).edit().clear().apply()
    }
}