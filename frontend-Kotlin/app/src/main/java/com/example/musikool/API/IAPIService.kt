package com.example.musikool.API

import RequiresFavoriteAdapter
import com.example.musikool.DTOs.Request.Models.CompassRequest
import com.example.musikool.DTOs.Request.Models.FavoriteRequest
import com.example.musikool.DTOs.Request.Models.MusicalNoteRequest
import com.example.musikool.DTOs.Request.Models.SongRequest
import com.example.musikool.DTOs.Request.Models.SongReviewRequest
import com.example.musikool.DTOs.Request.Models.UserRequest
import com.example.musikool.DTOs.Request.Auth.LoginRequest
import com.example.musikool.DTOs.Request.Auth.RegisterRequest
import com.example.musikool.DTOs.Response.App.Lists.ChordListResponse
import com.example.musikool.DTOs.Response.App.Lists.FavoriteListResponse
import com.example.musikool.DTOs.Response.App.Lists.MusicalNoteListResponse
import com.example.musikool.DTOs.Response.App.Lists.SongListResponse
import com.example.musikool.DTOs.Response.App.Lists.UserListResponse
import com.example.musikool.DTOs.Response.App.Models.CompassResponse
import com.example.musikool.DTOs.Response.App.Models.FavoriteIdResponse
import com.example.musikool.DTOs.Response.App.Models.FavoriteResponse
import com.example.musikool.DTOs.Response.App.Models.MusicalNoteResponse
import com.example.musikool.DTOs.Response.App.Models.SongResponse
import com.example.musikool.DTOs.Response.App.Models.SongReviewResponse
import com.example.musikool.DTOs.Response.App.Models.UserResponse
import com.example.musikool.DTOs.Response.Auth.LoginResponse
import com.example.musikool.DTOs.Response.Auth.LogoutResponse
import com.example.musikool.DTOs.Response.Auth.RegisterResponse
import com.example.musikool.Entities.Chord
import com.example.musikool.Entities.Favorite
import com.example.musikool.Entities.MusicalGenre
import com.example.musikool.Entities.RhythmicFigure
import com.example.musikool.Entities.SongMetric
import com.example.musikool.Entities.SongScale
import retrofit2.Call
import retrofit2.http.Body
import retrofit2.http.DELETE
import retrofit2.http.GET
import retrofit2.http.HTTP
import retrofit2.http.POST
import retrofit2.http.PUT
import retrofit2.http.Path
import retrofit2.http.Query

interface IAPIService {

//    Autenticación
    @POST("auth")
    fun login(@Body request : LoginRequest): Call<LoginResponse>

    @DELETE("auth")
    fun logout() : Call<LogoutResponse>

    @POST("auth/register")
    fun register(@Body request: RegisterRequest): Call<RegisterResponse>

//    Canciones
    @GET("songs")
    fun getSongs(
        @Query("include") include : String?,
        @Query("page") page: Int? = 1,
        @Query("title") title : String? = null,
        @Query("filter") filter : String? = null,
        @Query("genre_id") genre_id : Int? = null,
        @Query("artist_id") artist_id : Int? = null,
        ) : Call<SongListResponse>

    @GET("my-songs")
    fun getMySongs(@Query("page") page: Int? = 1,
                   @Query("include") include : String?) : Call<SongListResponse>

    @GET("songs/{id}")
    fun getSong(
        @Path("id") id: Int,
        @Query("include") include : String?) : Call<SongResponse>

    @POST("songs")
    fun saveSong(@Body request: SongRequest) : Call<SongResponse>

    @PUT("songs/{id}")
    fun updateSong(@Path("id") id: Int, @Body request: SongRequest) : Call<SongResponse>

    @DELETE("songs/{id}")
    fun deleteSong(@Path("id") id: Int) : Call<Void>

//    Reseñas de Canciones

    @GET("songs/{songId}/reviews")
    fun getSongReview(@Path("songId") songId: Int) : Call<SongReviewResponse>

    @POST("songs/{songId}/reviews")
    fun saveSongReview(@Path("songId") songId: Int, @Body request: SongReviewRequest) : Call<SongReviewResponse>

    @PUT("songs/{songId}/reviews")
    fun updateSongReview(
        @Path("songId") songId: Int,
        @Body request: SongReviewRequest) : Call<SongReviewResponse>

//    Usuarios
    @GET("users")
    fun getUsers(
        @Query("include") include : String?,
        @Query("page") page: Int? = 1,
        @Query("name") name : String? = null,
        @Query("filter") filter : String? = null) : Call<UserListResponse>

    @GET("users/{id}")
    fun getUser(
        @Path("id") id: Int,
        @Query("include") include : String?) : Call<UserResponse>

    @POST("users")
    fun saveUser(@Body request: UserRequest) : Call<UserResponse>

    @PUT("users/{id}")
    fun updateUser(@Path("id") id: Int, @Body request: UserRequest) : Call<UserResponse>

    @DELETE("users/{id}")
    fun deleteUser(@Path("id") id: Int) : Call<Void>

//    Compases
    @POST("songs/{songId}/compasses")
    fun saveCompass(@Path("songId") songId: Int) : Call<CompassResponse>

    @PUT("songs/{songId}/compasses/{compassId}")
    fun updateCompass(
        @Path("songId") songId: Int,
        @Path("compassId") compassId: Int,
        @Body request: CompassRequest) : Call<CompassResponse>

    @DELETE("songs/{songId}/compasses/{compassId}")
    fun deleteCompass(
        @Path("songId") songId: Int,
        @Path("compassId") compassId: Int) : Call<Void>


//      Notas Musicales
    @GET("songs/{songId}/compasses/{compassId}/musicalNotes/{musicalNoteId}")
    fun getMusicalNotes(
        @Path("songId") songId: Int,
        @Path("compassId") compassId: Int,
        @Query("page") page: Int? = 1) : Call<MusicalNoteListResponse>

    @GET("songs/{songId}/compasses/{compassId}/musicalNotes/{musicalNoteId}")
    fun getMusicalNote(
        @Path("songId") songId: Int,
        @Path("compassId") compassId: Int,
        @Path("musicalNoteId") musicalNoteId: Int) : Call<MusicalNoteResponse>

    @POST("songs/{songId}/compasses/{compassId}/musicalNotes")
    fun saveMusicalNote(
        @Path("songId") songId: Int,
        @Path("compassId") compassId: Int,
        @Body request: MusicalNoteRequest) : Call<MusicalNoteResponse>

    @PUT("songs/{songId}/compasses/{compassId}/musicalNotes/{musicalNoteId}")
    fun updateMusicalNote(
        @Path("songId") songId: Int,
        @Path("compassId") compassId: Int,
        @Path("musicalNoteId") musicalNoteId: Int,
        @Body request: MusicalNoteRequest) : Call<MusicalNoteResponse>

    @DELETE("songs/{songId}/compasses/{compassId}/musicalNotes/{musicalNoteId}")
    fun deleteMusicalNote(
        @Path("songId") songId: Int,
        @Path("compassId") compassId: Int,
        @Path("musicalNoteId") musicalNoteId: Int) : Call<Void>


//    Favoritos
    @GET("users/{userId}/favorites")
    @RequiresFavoriteAdapter
    fun getFavorites(
        @Path("userId") userId: Int,
        @Query("page") page: Int? = 1,
        @Query("model") model : String = "Song",
        ) : Call<FavoriteListResponse>

    @GET("users/{userId}/favorites/ids")
    fun getFavoriteIds(
        @Path("userId") userId: Int,
        @Query("model") model : String,
    ) : Call<FavoriteIdResponse>

    @POST("users/{userId}/favorites")
    fun saveFavorite(
        @Path("userId") userId: Int,
        @Body request: FavoriteRequest) : Call<Favorite>

    @DELETE("users/{userId}/favorites/{favoriteId}")
    fun deleteFavorite(
        @Path("userId") userId: Int,
        @Path("favoriteId") favoriteId: Int) : Call<Void>

//    Acordes
    @GET("chords")
    fun getChords(
        @Query("chord_name") chord_name : String? = null,
        @Query("filter") filter : String? = null,
        @Query("page") page: Int? = 1) : Call<ChordListResponse>

    @GET("chords/no-paginate")
    fun getNonPaginatedChords() : Call<List<Chord>>

//    Géneros musicales
    @GET("musical-genres")
    fun getMusicalGenres(
        @Query("search") search : String? = "null") : Call<List<MusicalGenre>>

//    Escalas
    @GET("song-scales")
    fun getSongScales(
        @Query("search") search : String? = null) : Call<List<SongScale>>

//    Métrica
    @GET("song-metrics")
    fun getSongMetrics(
        @Query("search") search : String? = null) : Call<List<SongMetric>>

//    Figuras musicales
    @GET("rhythmic-figures")
    fun getRhythmicFigures(
        @Query("search") search : String? = null) : Call<List<RhythmicFigure>>
}