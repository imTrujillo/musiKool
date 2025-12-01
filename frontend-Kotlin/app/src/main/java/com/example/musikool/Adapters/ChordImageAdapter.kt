package com.example.musikool.Adapters

import android.view.ViewGroup
import android.webkit.WebView
import android.widget.ImageView
import androidx.recyclerview.widget.RecyclerView
import com.bumptech.glide.Glide

class ChordImageAdapter(val chordList: List<String>)
    : RecyclerView.Adapter<ChordImageAdapter.ChordImageViewHolder>() {
    override fun onCreateViewHolder(
        parent: ViewGroup,
        viewType: Int
    ): ChordImageViewHolder {
        var webView = WebView(parent.context)
        webView.layoutParams =  ViewGroup.LayoutParams(
                ViewGroup.LayoutParams.MATCH_PARENT,
                ViewGroup.LayoutParams.MATCH_PARENT
            )
        webView.settings.javaScriptEnabled=true

        return ChordImageViewHolder(webView)
    }

    override fun onBindViewHolder(
        holder: ChordImageViewHolder,
        position: Int
    ) {
        val chordName = chordList[position].substringAfterLast("/")
        val instrument = if (position % 2 == 0) "piano" else "guitar"

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
                     transform: scale(0.33);
                     transform-origin: center center;
                     display: block;
                   }
                 </style>
                <script async type="text/javascript" src="https://www.scales-chords.com/api/scales-chords-api.js"></script>
              </head>
              <body>
                <ins class="scales_chords_api" chord="$chordName" instrument="$instrument"></ins>
              </body>
            </html>
        """.trimIndent()
        holder.webView.loadDataWithBaseURL(null, htmlContent, "text/html", "UTF-8", null)

    }

    override fun getItemCount(): Int {
        return chordList.size
    }

    class ChordImageViewHolder(val webView: WebView) : RecyclerView.ViewHolder(webView)
}