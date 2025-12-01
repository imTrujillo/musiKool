package com.example.musikool.Utils

import android.widget.Button
import android.widget.LinearLayout
import androidx.core.content.ContextCompat
import com.example.musikool.DTOs.Response.Pagination.PaginationMeta
import com.example.musikool.R

object PaginationUtils {
    fun render(
        container: LinearLayout,
        meta: PaginationMeta,
        onPageClick: (Int)->Unit){

        container.removeAllViews()

        for(link in meta.links){
            var button = Button(container.context).apply {
                text = link.label
                    .replace("&laquo; Previous","←")
                    .replace("Next &raquo;", "→")
                isEnabled = link.url != null

                if(link.active){
                    setBackgroundResource(R.drawable.bg_pagination_button)
                    setTextColor(ContextCompat.getColor(container.context, android.R.color.white))
                }else{
                    setBackgroundResource(android.R.color.transparent)
                    setTextColor(ContextCompat.getColor(container.context, R.color.purple_500))
                }

                setOnClickListener {
                    link.page?.let {onPageClick(it)}
                }
            }

            container.addView(button)
            var params = button.layoutParams
            params.width = 75
            params.height = 75
            button.layoutParams = params
        }
    }
}