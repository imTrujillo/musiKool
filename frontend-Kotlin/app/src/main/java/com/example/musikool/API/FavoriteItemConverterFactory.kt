import com.example.musikool.API.FavoriteItemTypeAdapter
import com.example.musikool.DTOs.Response.App.Lists.FavoriteItem
import com.google.gson.Gson
import com.google.gson.GsonBuilder
import okhttp3.ResponseBody
import retrofit2.Converter
import retrofit2.Retrofit
import java.lang.reflect.Type

@Retention(AnnotationRetention.RUNTIME)
@Target(AnnotationTarget.FUNCTION)
annotation class RequiresFavoriteAdapter

class FavoriteItemConverterFactory : Converter.Factory() {
    private val gsonWithAdapter = GsonBuilder()
        .registerTypeAdapter(FavoriteItem::class.java, FavoriteItemTypeAdapter())
        .create()

    private val defaultGson = Gson()

    override fun responseBodyConverter(
        type: Type,
        annotations: Array<Annotation>,
        retrofit: Retrofit
    ): GsonResponseBodyConverter<*>? {
        return if (annotations.any { it is RequiresFavoriteAdapter }) {
            GsonResponseBodyConverter<Any>(gsonWithAdapter, type)
        } else {
            GsonResponseBodyConverter<Any>(defaultGson, type)
        }
    }

    class GsonResponseBodyConverter<T>(
        private val gson: Gson,
        private val type: Type
    ) : Converter<ResponseBody, T> {
        override fun convert(value: ResponseBody): T {
            return gson.fromJson(value.charStream(), type)
        }
    }
}