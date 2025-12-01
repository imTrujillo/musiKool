package com.example.musikool.Entities

class MusicalNote(
    val id: Int,
    val lyrics: String,
    val is_dotted: Boolean,
    val is_silence: Boolean,
    val chord_id: Int,
    val compass_id: Int,
    val song_id: Int,
    val rhythmic_figure_id: Int,
    val order_in_compass: Int,
    val duration_in_compass: Float,
    val chord: Chord ? = null
) {
}