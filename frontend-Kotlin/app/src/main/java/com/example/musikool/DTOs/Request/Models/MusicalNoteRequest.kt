package com.example.musikool.DTOs.Request.Models

import com.example.musikool.Entities.Song
import java.io.Serializable

class MusicalNoteRequest(
    val lyrics: String,
    val is_dotted: Boolean,
    val is_silence: Boolean,
    val chord_id: Int,
    val rhythmic_figure_id: Int
) : Serializable {
}