package com.example.musikool.Adapters

import android.view.View
import android.webkit.WebView
import android.widget.ImageButton
import android.widget.TextView
import androidx.recyclerview.widget.RecyclerView
import androidx.viewpager2.widget.ViewPager2
import com.example.musikool.Entities.Chord
import com.example.musikool.R

class ChordViewHolder(view: View) : RecyclerView.ViewHolder(view) {
    var chord_name: TextView = view.findViewById(R.id.txtChordName)

    var carousel: ViewPager2 = view.findViewById(R.id.carouselChords)

    var webPlay : WebView = view.findViewById(R.id.webPlayChord)
    var isFavorite: ImageButton = view.findViewById(R.id.btnFavorite)

    fun bind(chord: Chord) {
        chord_name.text = chord.chord_name ?: "Acorde desconocido"

        val chordDiagrams = listOfNotNull(chord.piano_diagram, chord.guitar_diagram)
        carousel.adapter = ChordImageAdapter(chordDiagrams)

        val htmlContent = """
            <html>
            <head>
                <style>
                   body {
                     margin: 0;
                     padding: 0;
                     display: flex;
                     justify-content: center;
                     align-items: center;
                   }
                   .scales_chords_api {
                     transform: scale(1.6);
                     transform-origin: center center;
                     display: block;
                   }
                 </style>
                <script async type="text/javascript" src="https://www.scales-chords.com/api/scales-chords-api.js"></script>
            </head>
            <body>
                <ins class="scales_chords_api" chord="${chord.chord_name}" instrument="piano" output="sound"></ins>
            </body>
            </html>
        """.trimIndent()

        webPlay.settings.javaScriptEnabled = true
        webPlay.loadDataWithBaseURL(null, htmlContent, "text/html", "UTF-8", null)

        isFavorite.visibility = View.GONE
    }
}