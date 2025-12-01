<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>musiKool API Documentation</title>

    <link href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset("/vendor/scribe/css/theme-default.style.css") }}" media="screen">
    <link rel="stylesheet" href="{{ asset("/vendor/scribe/css/theme-default.print.css") }}" media="print">

    <script src="https://cdn.jsdelivr.net/npm/lodash@4.17.10/lodash.min.js"></script>

    <link rel="stylesheet"
          href="https://unpkg.com/@highlightjs/cdn-assets@11.6.0/styles/obsidian.min.css">
    <script src="https://unpkg.com/@highlightjs/cdn-assets@11.6.0/highlight.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jets/0.14.1/jets.min.js"></script>

    <style id="language-style">
        /* starts out as display none and is replaced with js later  */
                    body .content .bash-example code { display: none; }
                    body .content .javascript-example code { display: none; }
            </style>

    <script>
        var tryItOutBaseUrl = "http://127.0.0.1:8000";
        var useCsrf = Boolean();
        var csrfUrl = "/sanctum/csrf-cookie";
    </script>
    <script src="{{ asset("/vendor/scribe/js/tryitout-5.3.0.js") }}"></script>

    <script src="{{ asset("/vendor/scribe/js/theme-default-5.3.0.js") }}"></script>

</head>

<body data-languages="[&quot;bash&quot;,&quot;javascript&quot;]">

<a href="#" id="nav-button">
    <span>
        MENU
        <img src="{{ asset("/vendor/scribe/images/navbar.png") }}" alt="navbar-image"/>
    </span>
</a>
<div class="tocify-wrapper">
    
            <div class="lang-selector">
                                            <button type="button" class="lang-button" data-language-name="bash">bash</button>
                                            <button type="button" class="lang-button" data-language-name="javascript">javascript</button>
                    </div>
    
    <div class="search">
        <input type="text" class="search" id="input-search" placeholder="Search">
    </div>

    <div id="toc">
                    <ul id="tocify-header-introduction" class="tocify-header">
                <li class="tocify-item level-1" data-unique="introduction">
                    <a href="#introduction">Introduction</a>
                </li>
                            </ul>
                    <ul id="tocify-header-authenticating-requests" class="tocify-header">
                <li class="tocify-item level-1" data-unique="authenticating-requests">
                    <a href="#authenticating-requests">Authenticating requests</a>
                </li>
                            </ul>
                    <ul id="tocify-header-acordes" class="tocify-header">
                <li class="tocify-item level-1" data-unique="acordes">
                    <a href="#acordes">Acordes</a>
                </li>
                                    <ul id="tocify-subheader-acordes" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="acordes-GETapi-chords">
                                <a href="#acordes-GETapi-chords">Buscar un acorde.</a>
                            </li>
                                                                        </ul>
                            </ul>
                    <ul id="tocify-header-artistas" class="tocify-header">
                <li class="tocify-item level-1" data-unique="artistas">
                    <a href="#artistas">Artistas</a>
                </li>
                                    <ul id="tocify-subheader-artistas" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="artistas-POSTapi-users">
                                <a href="#artistas-POSTapi-users">Guardar un artista.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="artistas-PUTapi-users--id-">
                                <a href="#artistas-PUTapi-users--id-">Actualizar un artista.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="artistas-DELETEapi-users--id-">
                                <a href="#artistas-DELETEapi-users--id-">Eliminar un artista.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="artistas-GETapi-users">
                                <a href="#artistas-GETapi-users">Obtener artistas.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="artistas-GETapi-users--id-">
                                <a href="#artistas-GETapi-users--id-">Mostrar un artista.</a>
                            </li>
                                                                        </ul>
                            </ul>
                    <ul id="tocify-header-autenticacion" class="tocify-header">
                <li class="tocify-item level-1" data-unique="autenticacion">
                    <a href="#autenticacion">Autenticación</a>
                </li>
                                    <ul id="tocify-subheader-autenticacion" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="autenticacion-POSTapi-auth">
                                <a href="#autenticacion-POSTapi-auth">Iniciar sesión.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="autenticacion-DELETEapi-auth">
                                <a href="#autenticacion-DELETEapi-auth">Cerrar sesión.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="autenticacion-POSTapi-auth-register">
                                <a href="#autenticacion-POSTapi-auth-register">Registrar usuario.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="autenticacion-GETapi-token">
                                <a href="#autenticacion-GETapi-token">Manejar acceso sin token.</a>
                            </li>
                                                                        </ul>
                            </ul>
                    <ul id="tocify-header-canciones" class="tocify-header">
                <li class="tocify-item level-1" data-unique="canciones">
                    <a href="#canciones">Canciones</a>
                </li>
                                    <ul id="tocify-subheader-canciones" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="canciones-POSTapi-songs">
                                <a href="#canciones-POSTapi-songs">Guardar una canción.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="canciones-PUTapi-songs--id-">
                                <a href="#canciones-PUTapi-songs--id-">Actualizar una canción.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="canciones-DELETEapi-songs--id-">
                                <a href="#canciones-DELETEapi-songs--id-">Eliminar un canción.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="canciones-GETapi-my-songs">
                                <a href="#canciones-GETapi-my-songs">Obtener mis canciones.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="canciones-GETapi-songs">
                                <a href="#canciones-GETapi-songs">Obtener y filtrar canciones.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="canciones-GETapi-songs--id-">
                                <a href="#canciones-GETapi-songs--id-">Mostrar una canción.</a>
                            </li>
                                                                        </ul>
                            </ul>
                    <ul id="tocify-header-compases" class="tocify-header">
                <li class="tocify-item level-1" data-unique="compases">
                    <a href="#compases">Compases</a>
                </li>
                                    <ul id="tocify-subheader-compases" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="compases-POSTapi-songs--song_id--compasses">
                                <a href="#compases-POSTapi-songs--song_id--compasses">Guardar un compás.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="compases-PUTapi-songs--song_id--compasses--id-">
                                <a href="#compases-PUTapi-songs--song_id--compasses--id-">Actualizar un compás.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="compases-DELETEapi-songs--song_id--compasses--id-">
                                <a href="#compases-DELETEapi-songs--song_id--compasses--id-">Eliminar un compás.</a>
                            </li>
                                                                        </ul>
                            </ul>
                    <ul id="tocify-header-escalas" class="tocify-header">
                <li class="tocify-item level-1" data-unique="escalas">
                    <a href="#escalas">Escalas</a>
                </li>
                                    <ul id="tocify-subheader-escalas" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="escalas-GETapi-song-scales">
                                <a href="#escalas-GETapi-song-scales">Buscar una escala musical.</a>
                            </li>
                                                                        </ul>
                            </ul>
                    <ul id="tocify-header-favoritos" class="tocify-header">
                <li class="tocify-item level-1" data-unique="favoritos">
                    <a href="#favoritos">Favoritos</a>
                </li>
                                    <ul id="tocify-subheader-favoritos" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="favoritos-GETapi-users--user_id--favorites">
                                <a href="#favoritos-GETapi-users--user_id--favorites">Buscar favoritos de un modelo.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="favoritos-POSTapi-users--user_id--favorites">
                                <a href="#favoritos-POSTapi-users--user_id--favorites">Marcar un item como favoritos.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="favoritos-DELETEapi-users--user_id--favorites--id-">
                                <a href="#favoritos-DELETEapi-users--user_id--favorites--id-">Desmarcar un item de favoritos.</a>
                            </li>
                                                                        </ul>
                            </ul>
                    <ul id="tocify-header-figura-musical" class="tocify-header">
                <li class="tocify-item level-1" data-unique="figura-musical">
                    <a href="#figura-musical">Figura Musical</a>
                </li>
                                    <ul id="tocify-subheader-figura-musical" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="figura-musical-GETapi-rhythmic-figures">
                                <a href="#figura-musical-GETapi-rhythmic-figures">Buscar una figura musical.</a>
                            </li>
                                                                        </ul>
                            </ul>
                    <ul id="tocify-header-genero" class="tocify-header">
                <li class="tocify-item level-1" data-unique="genero">
                    <a href="#genero">Género</a>
                </li>
                                    <ul id="tocify-subheader-genero" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="genero-GETapi-musical-genres">
                                <a href="#genero-GETapi-musical-genres">Buscar un género musical.</a>
                            </li>
                                                                        </ul>
                            </ul>
                    <ul id="tocify-header-metrica" class="tocify-header">
                <li class="tocify-item level-1" data-unique="metrica">
                    <a href="#metrica">Métrica</a>
                </li>
                                    <ul id="tocify-subheader-metrica" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="metrica-GETapi-song-metrics">
                                <a href="#metrica-GETapi-song-metrics">Buscar una métrica musical.</a>
                            </li>
                                                                        </ul>
                            </ul>
                    <ul id="tocify-header-notas-musicales" class="tocify-header">
                <li class="tocify-item level-1" data-unique="notas-musicales">
                    <a href="#notas-musicales">Notas Musicales</a>
                </li>
                                    <ul id="tocify-subheader-notas-musicales" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="notas-musicales-GETapi-songs--song_id--compasses--compass_id--musicalNotes">
                                <a href="#notas-musicales-GETapi-songs--song_id--compasses--compass_id--musicalNotes">Mostrar notas musicales.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="notas-musicales-POSTapi-songs--song_id--compasses--compass_id--musicalNotes">
                                <a href="#notas-musicales-POSTapi-songs--song_id--compasses--compass_id--musicalNotes">Añadir un nueva nota musical.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="notas-musicales-GETapi-songs--song_id--compasses--compass_id--musicalNotes--id-">
                                <a href="#notas-musicales-GETapi-songs--song_id--compasses--compass_id--musicalNotes--id-">Mostrar una nota musical.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="notas-musicales-PUTapi-songs--song_id--compasses--compass_id--musicalNotes--id-">
                                <a href="#notas-musicales-PUTapi-songs--song_id--compasses--compass_id--musicalNotes--id-">Actualizar una nota.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="notas-musicales-DELETEapi-songs--song_id--compasses--compass_id--musicalNotes--id-">
                                <a href="#notas-musicales-DELETEapi-songs--song_id--compasses--compass_id--musicalNotes--id-">Eliminar una nota musical.</a>
                            </li>
                                                                        </ul>
                            </ul>
                    <ul id="tocify-header-resenas-de-canciones" class="tocify-header">
                <li class="tocify-item level-1" data-unique="resenas-de-canciones">
                    <a href="#resenas-de-canciones">Reseñas de Canciones</a>
                </li>
                                    <ul id="tocify-subheader-resenas-de-canciones" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="resenas-de-canciones-POSTapi-songs--song_id--reviews">
                                <a href="#resenas-de-canciones-POSTapi-songs--song_id--reviews">Guardar una reseña</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="resenas-de-canciones-PUTapi-songs--song_id--reviews--id-">
                                <a href="#resenas-de-canciones-PUTapi-songs--song_id--reviews--id-">Actualizar una reseña</a>
                            </li>
                                                                        </ul>
                            </ul>
            </div>

    <ul class="toc-footer" id="toc-footer">
                    <li style="padding-bottom: 5px;"><a href="{{ route("scribe.postman") }}">View Postman collection</a></li>
                            <li style="padding-bottom: 5px;"><a href="{{ route("scribe.openapi") }}">View OpenAPI spec</a></li>
                <li><a href="http://github.com/knuckleswtf/scribe">Documentation powered by Scribe ✍</a></li>
    </ul>

    <ul class="toc-footer" id="last-updated">
        <li>Last updated: October 16, 2025</li>
    </ul>
</div>

<div class="page-wrapper">
    <div class="dark-box"></div>
    <div class="content">
        <h1 id="introduction">Introduction</h1>
<p><img src="/logo.png" /><br>
Nuestro proyecto de programación &quot;musiKool&quot;, es una aplicación educativa donde puedes registrarte como artista y guardar tus canciones. <br>
Básicamente, es una biblioteca de canciones, artistas y acordes. Está orientada a fines didácticos, en especial, al aprendizaje del piano o la guitarra, mediante diagramas y muestras de sonido. <br>
Asimismo, se pueden ajustrar parámetros por cada canción, como el tiempo, compás y el tono.</p>
<aside>
    <strong>Base URL</strong>: <code>http://127.0.0.1:8000</code>
</aside>
<pre><code>This documentation aims to provide all the information you need to work with our API.

&lt;aside&gt;As you scroll, you'll see code examples for working with the API in different programming languages in the dark area to the right (or as part of the content on mobile).
You can switch the language used with the tabs at the top right (or from the nav menu at the top left on mobile).&lt;/aside&gt;</code></pre>

        <h1 id="authenticating-requests">Authenticating requests</h1>
<p>To authenticate requests, include an <strong><code>Authorization</code></strong> header with the value <strong><code>"Bearer {YOUR_AUTH_KEY}"</code></strong>.</p>
<p>All authenticated endpoints are marked with a <code>requires authentication</code> badge in the documentation below.</p>
<p>You can retrieve your token by visiting your dashboard and clicking <b>Generate API token</b>.</p>

        <h1 id="acordes">Acordes</h1>

    

                                <h2 id="acordes-GETapi-chords">Buscar un acorde.</h2>

<p>
</p>



<span id="example-requests-GETapi-chords">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://127.0.0.1:8000/api/chords" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://127.0.0.1:8000/api/chords"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-chords">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;data&quot;: [
        {
            &quot;id&quot;: 1,
            &quot;chord_name&quot;: &quot;C&quot;,
            &quot;piano_diagram&quot;: &quot;https://www.scales-chords.com/chord/piano/C&quot;,
            &quot;guitar_diagram&quot;: &quot;https://www.scales-chords.com/chord/guitar/C&quot;,
            &quot;piano_sound&quot;: &quot;https://www.scales-chords.com/api/scales-chords-api.js?chord=C&amp;instrument=piano&amp;output=sound&quot;,
            &quot;guitar_sound&quot;: &quot;https://www.scales-chords.com/api/scales-chords-api.js?chord=C&amp;instrument=guitar&amp;output=sound&quot;
        },
        {
            &quot;id&quot;: 2,
            &quot;chord_name&quot;: &quot;Cm&quot;,
            &quot;piano_diagram&quot;: &quot;https://www.scales-chords.com/chord/piano/Cm&quot;,
            &quot;guitar_diagram&quot;: &quot;https://www.scales-chords.com/chord/guitar/Cm&quot;,
            &quot;piano_sound&quot;: &quot;https://www.scales-chords.com/api/scales-chords-api.js?chord=Cm&amp;instrument=piano&amp;output=sound&quot;,
            &quot;guitar_sound&quot;: &quot;https://www.scales-chords.com/api/scales-chords-api.js?chord=Cm&amp;instrument=guitar&amp;output=sound&quot;
        },
        {
            &quot;id&quot;: 3,
            &quot;chord_name&quot;: &quot;Cdim&quot;,
            &quot;piano_diagram&quot;: &quot;https://www.scales-chords.com/chord/piano/Cdim&quot;,
            &quot;guitar_diagram&quot;: &quot;https://www.scales-chords.com/chord/guitar/Cdim&quot;,
            &quot;piano_sound&quot;: &quot;https://www.scales-chords.com/api/scales-chords-api.js?chord=Cdim&amp;instrument=piano&amp;output=sound&quot;,
            &quot;guitar_sound&quot;: &quot;https://www.scales-chords.com/api/scales-chords-api.js?chord=Cdim&amp;instrument=guitar&amp;output=sound&quot;
        },
        {
            &quot;id&quot;: 4,
            &quot;chord_name&quot;: &quot;Caug&quot;,
            &quot;piano_diagram&quot;: &quot;https://www.scales-chords.com/chord/piano/Caug&quot;,
            &quot;guitar_diagram&quot;: &quot;https://www.scales-chords.com/chord/guitar/Caug&quot;,
            &quot;piano_sound&quot;: &quot;https://www.scales-chords.com/api/scales-chords-api.js?chord=Caug&amp;instrument=piano&amp;output=sound&quot;,
            &quot;guitar_sound&quot;: &quot;https://www.scales-chords.com/api/scales-chords-api.js?chord=Caug&amp;instrument=guitar&amp;output=sound&quot;
        },
        {
            &quot;id&quot;: 5,
            &quot;chord_name&quot;: &quot;C7&quot;,
            &quot;piano_diagram&quot;: &quot;https://www.scales-chords.com/chord/piano/C7&quot;,
            &quot;guitar_diagram&quot;: &quot;https://www.scales-chords.com/chord/guitar/C7&quot;,
            &quot;piano_sound&quot;: &quot;https://www.scales-chords.com/api/scales-chords-api.js?chord=C7&amp;instrument=piano&amp;output=sound&quot;,
            &quot;guitar_sound&quot;: &quot;https://www.scales-chords.com/api/scales-chords-api.js?chord=C7&amp;instrument=guitar&amp;output=sound&quot;
        }
    ],
    &quot;links&quot;: {
        &quot;first&quot;: &quot;http://127.0.0.1:8000/api/chords?page=1&quot;,
        &quot;last&quot;: &quot;http://127.0.0.1:8000/api/chords?page=54&quot;,
        &quot;prev&quot;: null,
        &quot;next&quot;: &quot;http://127.0.0.1:8000/api/chords?page=2&quot;
    },
    &quot;meta&quot;: {
        &quot;current_page&quot;: 1,
        &quot;from&quot;: 1,
        &quot;last_page&quot;: 54,
        &quot;links&quot;: [
            {
                &quot;url&quot;: null,
                &quot;label&quot;: &quot;&amp;laquo; Previous&quot;,
                &quot;page&quot;: null,
                &quot;active&quot;: false
            },
            {
                &quot;url&quot;: &quot;http://127.0.0.1:8000/api/chords?page=1&quot;,
                &quot;label&quot;: &quot;1&quot;,
                &quot;page&quot;: 1,
                &quot;active&quot;: true
            },
            {
                &quot;url&quot;: &quot;http://127.0.0.1:8000/api/chords?page=2&quot;,
                &quot;label&quot;: &quot;2&quot;,
                &quot;page&quot;: 2,
                &quot;active&quot;: false
            },
            {
                &quot;url&quot;: &quot;http://127.0.0.1:8000/api/chords?page=3&quot;,
                &quot;label&quot;: &quot;3&quot;,
                &quot;page&quot;: 3,
                &quot;active&quot;: false
            },
            {
                &quot;url&quot;: &quot;http://127.0.0.1:8000/api/chords?page=4&quot;,
                &quot;label&quot;: &quot;4&quot;,
                &quot;page&quot;: 4,
                &quot;active&quot;: false
            },
            {
                &quot;url&quot;: &quot;http://127.0.0.1:8000/api/chords?page=5&quot;,
                &quot;label&quot;: &quot;5&quot;,
                &quot;page&quot;: 5,
                &quot;active&quot;: false
            },
            {
                &quot;url&quot;: &quot;http://127.0.0.1:8000/api/chords?page=6&quot;,
                &quot;label&quot;: &quot;6&quot;,
                &quot;page&quot;: 6,
                &quot;active&quot;: false
            },
            {
                &quot;url&quot;: &quot;http://127.0.0.1:8000/api/chords?page=7&quot;,
                &quot;label&quot;: &quot;7&quot;,
                &quot;page&quot;: 7,
                &quot;active&quot;: false
            },
            {
                &quot;url&quot;: &quot;http://127.0.0.1:8000/api/chords?page=8&quot;,
                &quot;label&quot;: &quot;8&quot;,
                &quot;page&quot;: 8,
                &quot;active&quot;: false
            },
            {
                &quot;url&quot;: &quot;http://127.0.0.1:8000/api/chords?page=9&quot;,
                &quot;label&quot;: &quot;9&quot;,
                &quot;page&quot;: 9,
                &quot;active&quot;: false
            },
            {
                &quot;url&quot;: &quot;http://127.0.0.1:8000/api/chords?page=10&quot;,
                &quot;label&quot;: &quot;10&quot;,
                &quot;page&quot;: 10,
                &quot;active&quot;: false
            },
            {
                &quot;url&quot;: null,
                &quot;label&quot;: &quot;...&quot;,
                &quot;active&quot;: false
            },
            {
                &quot;url&quot;: &quot;http://127.0.0.1:8000/api/chords?page=53&quot;,
                &quot;label&quot;: &quot;53&quot;,
                &quot;page&quot;: 53,
                &quot;active&quot;: false
            },
            {
                &quot;url&quot;: &quot;http://127.0.0.1:8000/api/chords?page=54&quot;,
                &quot;label&quot;: &quot;54&quot;,
                &quot;page&quot;: 54,
                &quot;active&quot;: false
            },
            {
                &quot;url&quot;: &quot;http://127.0.0.1:8000/api/chords?page=2&quot;,
                &quot;label&quot;: &quot;Next &amp;raquo;&quot;,
                &quot;page&quot;: 2,
                &quot;active&quot;: false
            }
        ],
        &quot;path&quot;: &quot;http://127.0.0.1:8000/api/chords&quot;,
        &quot;per_page&quot;: 5,
        &quot;to&quot;: 5,
        &quot;total&quot;: 270
    }
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-chords" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-chords"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-chords"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-chords" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-chords">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-chords" data-method="GET"
      data-path="api/chords"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-chords', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-chords"
                    onclick="tryItOut('GETapi-chords');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-chords"
                    onclick="cancelTryOut('GETapi-chords');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-chords"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/chords</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-chords"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-chords"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                <h1 id="artistas">Artistas</h1>

    <p>Endpoints para administrar los artistas.</p>

                                <h2 id="artistas-POSTapi-users">Guardar un artista.</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-POSTapi-users">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://127.0.0.1:8000/api/users" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"name\": \"vmqeopfuudtdsufvy\",
    \"email\": \"dcarter@example.org\",
    \"password\": \"OP&gt;@;4\",
    \"color\": \"#:4AB\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://127.0.0.1:8000/api/users"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "name": "vmqeopfuudtdsufvy",
    "email": "dcarter@example.org",
    "password": "OP&gt;@;4",
    "color": "#:4AB"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-users">
</span>
<span id="execution-results-POSTapi-users" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-users"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-users"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-users" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-users">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-users" data-method="POST"
      data-path="api/users"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-users', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-users"
                    onclick="tryItOut('POSTapi-users');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-users"
                    onclick="cancelTryOut('POSTapi-users');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-users"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/users</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="POSTapi-users"
               value="Bearer {YOUR_AUTH_KEY}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {YOUR_AUTH_KEY}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-users"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-users"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>name</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="name"                data-endpoint="POSTapi-users"
               value="vmqeopfuudtdsufvy"
               data-component="body">
    <br>
<p>Must be at least 5 characters. Must not be greater than 20 characters. Example: <code>vmqeopfuudtdsufvy</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>email</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="email"                data-endpoint="POSTapi-users"
               value="dcarter@example.org"
               data-component="body">
    <br>
<p>Must be a valid email address. Must not be greater than 255 characters. Example: <code>dcarter@example.org</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>password</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="password"                data-endpoint="POSTapi-users"
               value="OP>@;4"
               data-component="body">
    <br>
<p>Must match the regex /[a-z]/. Must match the regex /[A-Z]/. Must match the regex /[0-9]/. Must be at least 8 characters. Example: <code>OP&gt;@;4</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>color</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="color"                data-endpoint="POSTapi-users"
               value="#:4AB"
               data-component="body">
    <br>
<p>Must match the regex /^#(?:[0-9a-fA-F]{3}){1,2}$/. Example: <code>#:4AB</code></p>
        </div>
        </form>

                    <h2 id="artistas-PUTapi-users--id-">Actualizar un artista.</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-PUTapi-users--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PUT \
    "http://127.0.0.1:8000/api/users/1" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"name\": \"vmqeopfuudtdsufvy\",
    \"email\": \"dcarter@example.org\",
    \"password\": \"OP&gt;@;4\",
    \"color\": \"#:4AB\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://127.0.0.1:8000/api/users/1"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "name": "vmqeopfuudtdsufvy",
    "email": "dcarter@example.org",
    "password": "OP&gt;@;4",
    "color": "#:4AB"
};

fetch(url, {
    method: "PUT",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-PUTapi-users--id-">
</span>
<span id="execution-results-PUTapi-users--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PUTapi-users--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PUTapi-users--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-PUTapi-users--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PUTapi-users--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-PUTapi-users--id-" data-method="PUT"
      data-path="api/users/{id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PUTapi-users--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-PUTapi-users--id-"
                    onclick="tryItOut('PUTapi-users--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-PUTapi-users--id-"
                    onclick="cancelTryOut('PUTapi-users--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-PUTapi-users--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-darkblue">PUT</small>
            <b><code>api/users/{id}</code></b>
        </p>
            <p>
            <small class="badge badge-purple">PATCH</small>
            <b><code>api/users/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="PUTapi-users--id-"
               value="Bearer {YOUR_AUTH_KEY}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {YOUR_AUTH_KEY}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="PUTapi-users--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="PUTapi-users--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="PUTapi-users--id-"
               value="1"
               data-component="url">
    <br>
<p>The ID of the user. Example: <code>1</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>name</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="name"                data-endpoint="PUTapi-users--id-"
               value="vmqeopfuudtdsufvy"
               data-component="body">
    <br>
<p>Must be at least 5 characters. Must not be greater than 20 characters. Example: <code>vmqeopfuudtdsufvy</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>email</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="email"                data-endpoint="PUTapi-users--id-"
               value="dcarter@example.org"
               data-component="body">
    <br>
<p>Must be a valid email address. Must not be greater than 255 characters. Example: <code>dcarter@example.org</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>password</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="password"                data-endpoint="PUTapi-users--id-"
               value="OP>@;4"
               data-component="body">
    <br>
<p>Must match the regex /[a-z]/. Must match the regex /[A-Z]/. Must match the regex /[0-9]/. Must be at least 8 characters. Example: <code>OP&gt;@;4</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>color</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="color"                data-endpoint="PUTapi-users--id-"
               value="#:4AB"
               data-component="body">
    <br>
<p>Must match the regex /^#(?:[0-9a-fA-F]{3}){1,2}$/. Example: <code>#:4AB</code></p>
        </div>
        </form>

                    <h2 id="artistas-DELETEapi-users--id-">Eliminar un artista.</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-DELETEapi-users--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request DELETE \
    "http://127.0.0.1:8000/api/users/1" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://127.0.0.1:8000/api/users/1"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-DELETEapi-users--id-">
</span>
<span id="execution-results-DELETEapi-users--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-DELETEapi-users--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-DELETEapi-users--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-DELETEapi-users--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEapi-users--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-DELETEapi-users--id-" data-method="DELETE"
      data-path="api/users/{id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('DELETEapi-users--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-DELETEapi-users--id-"
                    onclick="tryItOut('DELETEapi-users--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-DELETEapi-users--id-"
                    onclick="cancelTryOut('DELETEapi-users--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-DELETEapi-users--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-red">DELETE</small>
            <b><code>api/users/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="DELETEapi-users--id-"
               value="Bearer {YOUR_AUTH_KEY}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {YOUR_AUTH_KEY}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="DELETEapi-users--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="DELETEapi-users--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="DELETEapi-users--id-"
               value="1"
               data-component="url">
    <br>
<p>The ID of the user. Example: <code>1</code></p>
            </div>
                    </form>

                    <h2 id="artistas-GETapi-users">Obtener artistas.</h2>

<p>
</p>



<span id="example-requests-GETapi-users">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://127.0.0.1:8000/api/users" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://127.0.0.1:8000/api/users"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-users">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;data&quot;: [
        {
            &quot;id&quot;: 2,
            &quot;name&quot;: &quot;Ambrose Emmerich&quot;,
            &quot;email&quot;: &quot;bailey.luisa@example.net&quot;,
            &quot;email_verified_at&quot;: &quot;2025-09-19T03:13:09.000000Z&quot;,
            &quot;color&quot;: &quot;#c0c62f&quot;,
            &quot;is_admin&quot;: false,
            &quot;created_at&quot;: null,
            &quot;updated_at&quot;: null,
            &quot;songs_count&quot;: 1
        },
        {
            &quot;id&quot;: 3,
            &quot;name&quot;: &quot;Alison Wolff&quot;,
            &quot;email&quot;: &quot;weber.corene@example.org&quot;,
            &quot;email_verified_at&quot;: &quot;2025-09-19T03:13:09.000000Z&quot;,
            &quot;color&quot;: &quot;#9e866a&quot;,
            &quot;is_admin&quot;: false,
            &quot;created_at&quot;: null,
            &quot;updated_at&quot;: null,
            &quot;songs_count&quot;: 0
        },
        {
            &quot;id&quot;: 4,
            &quot;name&quot;: &quot;Dr. Martine Berge I&quot;,
            &quot;email&quot;: &quot;devin98@example.com&quot;,
            &quot;email_verified_at&quot;: &quot;2025-09-19T03:13:09.000000Z&quot;,
            &quot;color&quot;: &quot;#544192&quot;,
            &quot;is_admin&quot;: false,
            &quot;created_at&quot;: null,
            &quot;updated_at&quot;: null,
            &quot;songs_count&quot;: 2
        },
        {
            &quot;id&quot;: 5,
            &quot;name&quot;: &quot;Bonita Turcotte&quot;,
            &quot;email&quot;: &quot;sheridan70@example.org&quot;,
            &quot;email_verified_at&quot;: &quot;2025-09-19T03:13:09.000000Z&quot;,
            &quot;color&quot;: &quot;#8ea19d&quot;,
            &quot;is_admin&quot;: false,
            &quot;created_at&quot;: null,
            &quot;updated_at&quot;: null,
            &quot;songs_count&quot;: 0
        },
        {
            &quot;id&quot;: 1,
            &quot;name&quot;: &quot;Admin Mellara&quot;,
            &quot;email&quot;: &quot;admin@admin.com&quot;,
            &quot;email_verified_at&quot;: &quot;2025-09-19T03:13:09.000000Z&quot;,
            &quot;color&quot;: &quot;#111826&quot;,
            &quot;is_admin&quot;: true,
            &quot;created_at&quot;: null,
            &quot;updated_at&quot;: null,
            &quot;songs_count&quot;: 2
        }
    ],
    &quot;links&quot;: {
        &quot;first&quot;: &quot;http://127.0.0.1:8000/api/users?page=1&quot;,
        &quot;last&quot;: &quot;http://127.0.0.1:8000/api/users?page=3&quot;,
        &quot;prev&quot;: null,
        &quot;next&quot;: &quot;http://127.0.0.1:8000/api/users?page=2&quot;
    },
    &quot;meta&quot;: {
        &quot;current_page&quot;: 1,
        &quot;from&quot;: 1,
        &quot;last_page&quot;: 3,
        &quot;links&quot;: [
            {
                &quot;url&quot;: null,
                &quot;label&quot;: &quot;&amp;laquo; Previous&quot;,
                &quot;page&quot;: null,
                &quot;active&quot;: false
            },
            {
                &quot;url&quot;: &quot;http://127.0.0.1:8000/api/users?page=1&quot;,
                &quot;label&quot;: &quot;1&quot;,
                &quot;page&quot;: 1,
                &quot;active&quot;: true
            },
            {
                &quot;url&quot;: &quot;http://127.0.0.1:8000/api/users?page=2&quot;,
                &quot;label&quot;: &quot;2&quot;,
                &quot;page&quot;: 2,
                &quot;active&quot;: false
            },
            {
                &quot;url&quot;: &quot;http://127.0.0.1:8000/api/users?page=3&quot;,
                &quot;label&quot;: &quot;3&quot;,
                &quot;page&quot;: 3,
                &quot;active&quot;: false
            },
            {
                &quot;url&quot;: &quot;http://127.0.0.1:8000/api/users?page=2&quot;,
                &quot;label&quot;: &quot;Next &amp;raquo;&quot;,
                &quot;page&quot;: 2,
                &quot;active&quot;: false
            }
        ],
        &quot;path&quot;: &quot;http://127.0.0.1:8000/api/users&quot;,
        &quot;per_page&quot;: 5,
        &quot;to&quot;: 5,
        &quot;total&quot;: 11
    }
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-users" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-users"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-users"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-users" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-users">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-users" data-method="GET"
      data-path="api/users"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-users', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-users"
                    onclick="tryItOut('GETapi-users');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-users"
                    onclick="cancelTryOut('GETapi-users');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-users"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/users</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-users"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-users"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="artistas-GETapi-users--id-">Mostrar un artista.</h2>

<p>
</p>



<span id="example-requests-GETapi-users--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://127.0.0.1:8000/api/users/1" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://127.0.0.1:8000/api/users/1"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-users--id-">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;data&quot;: {
        &quot;id&quot;: 1,
        &quot;name&quot;: &quot;Admin Mellara&quot;,
        &quot;email&quot;: &quot;admin@admin.com&quot;,
        &quot;email_verified_at&quot;: &quot;2025-09-19T03:13:09.000000Z&quot;,
        &quot;color&quot;: &quot;#111826&quot;,
        &quot;is_admin&quot;: true,
        &quot;created_at&quot;: null,
        &quot;updated_at&quot;: null
    }
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-users--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-users--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-users--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-users--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-users--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-users--id-" data-method="GET"
      data-path="api/users/{id}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-users--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-users--id-"
                    onclick="tryItOut('GETapi-users--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-users--id-"
                    onclick="cancelTryOut('GETapi-users--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-users--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/users/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-users--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-users--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="GETapi-users--id-"
               value="1"
               data-component="url">
    <br>
<p>The ID of the user. Example: <code>1</code></p>
            </div>
                    </form>

                <h1 id="autenticacion">Autenticación</h1>

    <p>Endpoints para login, registro y logout.</p>

                                <h2 id="autenticacion-POSTapi-auth">Iniciar sesión.</h2>

<p>
</p>



<span id="example-requests-POSTapi-auth">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://127.0.0.1:8000/api/auth" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"email\": \"qkunze@example.com\",
    \"password\": \"consequatur\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://127.0.0.1:8000/api/auth"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "email": "qkunze@example.com",
    "password": "consequatur"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-auth">
</span>
<span id="execution-results-POSTapi-auth" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-auth"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-auth"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-auth" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-auth">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-auth" data-method="POST"
      data-path="api/auth"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-auth', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-auth"
                    onclick="tryItOut('POSTapi-auth');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-auth"
                    onclick="cancelTryOut('POSTapi-auth');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-auth"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/auth</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-auth"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-auth"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>email</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="email"                data-endpoint="POSTapi-auth"
               value="qkunze@example.com"
               data-component="body">
    <br>
<p>Must be a valid email address. Example: <code>qkunze@example.com</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>password</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="password"                data-endpoint="POSTapi-auth"
               value="consequatur"
               data-component="body">
    <br>
<p>Example: <code>consequatur</code></p>
        </div>
        </form>

                    <h2 id="autenticacion-DELETEapi-auth">Cerrar sesión.</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-DELETEapi-auth">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request DELETE \
    "http://127.0.0.1:8000/api/auth" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://127.0.0.1:8000/api/auth"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-DELETEapi-auth">
</span>
<span id="execution-results-DELETEapi-auth" hidden>
    <blockquote>Received response<span
                id="execution-response-status-DELETEapi-auth"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-DELETEapi-auth"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-DELETEapi-auth" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEapi-auth">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-DELETEapi-auth" data-method="DELETE"
      data-path="api/auth"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('DELETEapi-auth', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-DELETEapi-auth"
                    onclick="tryItOut('DELETEapi-auth');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-DELETEapi-auth"
                    onclick="cancelTryOut('DELETEapi-auth');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-DELETEapi-auth"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-red">DELETE</small>
            <b><code>api/auth</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="DELETEapi-auth"
               value="Bearer {YOUR_AUTH_KEY}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {YOUR_AUTH_KEY}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="DELETEapi-auth"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="DELETEapi-auth"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="autenticacion-POSTapi-auth-register">Registrar usuario.</h2>

<p>
</p>



<span id="example-requests-POSTapi-auth-register">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://127.0.0.1:8000/api/auth/register" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"name\": \"vmqeopfuudtdsufvyvddq\",
    \"email\": \"kunde.eloisa@example.com\",
    \"password\": \"4[*UyPJ\\\"}6\",
    \"color\": \"#4CD4ab\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://127.0.0.1:8000/api/auth/register"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "name": "vmqeopfuudtdsufvyvddq",
    "email": "kunde.eloisa@example.com",
    "password": "4[*UyPJ\"}6",
    "color": "#4CD4ab"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-auth-register">
</span>
<span id="execution-results-POSTapi-auth-register" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-auth-register"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-auth-register"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-auth-register" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-auth-register">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-auth-register" data-method="POST"
      data-path="api/auth/register"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-auth-register', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-auth-register"
                    onclick="tryItOut('POSTapi-auth-register');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-auth-register"
                    onclick="cancelTryOut('POSTapi-auth-register');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-auth-register"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/auth/register</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-auth-register"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-auth-register"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>name</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="name"                data-endpoint="POSTapi-auth-register"
               value="vmqeopfuudtdsufvyvddq"
               data-component="body">
    <br>
<p>Must not be greater than 255 characters. Example: <code>vmqeopfuudtdsufvyvddq</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>email</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="email"                data-endpoint="POSTapi-auth-register"
               value="kunde.eloisa@example.com"
               data-component="body">
    <br>
<p>Must be a valid email address. Example: <code>kunde.eloisa@example.com</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>password</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="password"                data-endpoint="POSTapi-auth-register"
               value="4[*UyPJ"}6"
               data-component="body">
    <br>
<p>Must be at least 8 characters. Example: <code>4[*UyPJ"}6</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>color</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="color"                data-endpoint="POSTapi-auth-register"
               value="#4CD4ab"
               data-component="body">
    <br>
<p>Must match the regex /^#[0-9A-Fa-f]{6}$/. Example: <code>#4CD4ab</code></p>
        </div>
        </form>

                    <h2 id="autenticacion-GETapi-token">Manejar acceso sin token.</h2>

<p>
</p>



<span id="example-requests-GETapi-token">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://127.0.0.1:8000/api/token" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://127.0.0.1:8000/api/token"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-token">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Necesitas un token&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-token" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-token"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-token"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-token" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-token">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-token" data-method="GET"
      data-path="api/token"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-token', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-token"
                    onclick="tryItOut('GETapi-token');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-token"
                    onclick="cancelTryOut('GETapi-token');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-token"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/token</code></b>
        </p>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/token</code></b>
        </p>
            <p>
            <small class="badge badge-darkblue">PUT</small>
            <b><code>api/token</code></b>
        </p>
            <p>
            <small class="badge badge-purple">PATCH</small>
            <b><code>api/token</code></b>
        </p>
            <p>
            <small class="badge badge-red">DELETE</small>
            <b><code>api/token</code></b>
        </p>
            <p>
            <small class="badge badge-grey">OPTIONS</small>
            <b><code>api/token</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-token"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-token"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                <h1 id="canciones">Canciones</h1>

    <p>Endpoints para administrar canciones.</p>

                                <h2 id="canciones-POSTapi-songs">Guardar una canción.</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-POSTapi-songs">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://127.0.0.1:8000/api/songs" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"title\": \"vmqeopfuudtdsufvy\",
    \"bpm\": 21,
    \"user_id\": 17,
    \"song_scale_id\": 17,
    \"song_metric_id\": 17,
    \"musical_genre_id\": 17
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://127.0.0.1:8000/api/songs"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "title": "vmqeopfuudtdsufvy",
    "bpm": 21,
    "user_id": 17,
    "song_scale_id": 17,
    "song_metric_id": 17,
    "musical_genre_id": 17
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-songs">
</span>
<span id="execution-results-POSTapi-songs" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-songs"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-songs"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-songs" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-songs">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-songs" data-method="POST"
      data-path="api/songs"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-songs', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-songs"
                    onclick="tryItOut('POSTapi-songs');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-songs"
                    onclick="cancelTryOut('POSTapi-songs');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-songs"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/songs</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="POSTapi-songs"
               value="Bearer {YOUR_AUTH_KEY}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {YOUR_AUTH_KEY}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-songs"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-songs"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>title</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="title"                data-endpoint="POSTapi-songs"
               value="vmqeopfuudtdsufvy"
               data-component="body">
    <br>
<p>Must be at least 5 characters. Must not be greater than 20 characters. Example: <code>vmqeopfuudtdsufvy</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>bpm</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="bpm"                data-endpoint="POSTapi-songs"
               value="21"
               data-component="body">
    <br>
<p>Must be at least 30. Must not be greater than 280. Example: <code>21</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>user_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="user_id"                data-endpoint="POSTapi-songs"
               value="17"
               data-component="body">
    <br>
<p>The <code>id</code> of an existing record in the users table. Example: <code>17</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>song_scale_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="song_scale_id"                data-endpoint="POSTapi-songs"
               value="17"
               data-component="body">
    <br>
<p>The <code>id</code> of an existing record in the song_scales table. Example: <code>17</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>song_metric_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="song_metric_id"                data-endpoint="POSTapi-songs"
               value="17"
               data-component="body">
    <br>
<p>The <code>id</code> of an existing record in the song_metrics table. Example: <code>17</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>musical_genre_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="musical_genre_id"                data-endpoint="POSTapi-songs"
               value="17"
               data-component="body">
    <br>
<p>The <code>id</code> of an existing record in the musical_genres table. Example: <code>17</code></p>
        </div>
        </form>

                    <h2 id="canciones-PUTapi-songs--id-">Actualizar una canción.</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-PUTapi-songs--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PUT \
    "http://127.0.0.1:8000/api/songs/1" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"title\": \"vmqeopfuudtdsufvy\",
    \"bpm\": 21,
    \"user_id\": 17,
    \"song_scale_id\": 17,
    \"song_metric_id\": 17,
    \"musical_genre_id\": 17
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://127.0.0.1:8000/api/songs/1"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "title": "vmqeopfuudtdsufvy",
    "bpm": 21,
    "user_id": 17,
    "song_scale_id": 17,
    "song_metric_id": 17,
    "musical_genre_id": 17
};

fetch(url, {
    method: "PUT",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-PUTapi-songs--id-">
</span>
<span id="execution-results-PUTapi-songs--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PUTapi-songs--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PUTapi-songs--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-PUTapi-songs--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PUTapi-songs--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-PUTapi-songs--id-" data-method="PUT"
      data-path="api/songs/{id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PUTapi-songs--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-PUTapi-songs--id-"
                    onclick="tryItOut('PUTapi-songs--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-PUTapi-songs--id-"
                    onclick="cancelTryOut('PUTapi-songs--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-PUTapi-songs--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-darkblue">PUT</small>
            <b><code>api/songs/{id}</code></b>
        </p>
            <p>
            <small class="badge badge-purple">PATCH</small>
            <b><code>api/songs/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="PUTapi-songs--id-"
               value="Bearer {YOUR_AUTH_KEY}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {YOUR_AUTH_KEY}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="PUTapi-songs--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="PUTapi-songs--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="PUTapi-songs--id-"
               value="1"
               data-component="url">
    <br>
<p>The ID of the song. Example: <code>1</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>title</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="title"                data-endpoint="PUTapi-songs--id-"
               value="vmqeopfuudtdsufvy"
               data-component="body">
    <br>
<p>Must be at least 5 characters. Must not be greater than 20 characters. Example: <code>vmqeopfuudtdsufvy</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>bpm</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="bpm"                data-endpoint="PUTapi-songs--id-"
               value="21"
               data-component="body">
    <br>
<p>Must be at least 30. Must not be greater than 280. Example: <code>21</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>user_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="user_id"                data-endpoint="PUTapi-songs--id-"
               value="17"
               data-component="body">
    <br>
<p>The <code>id</code> of an existing record in the users table. Example: <code>17</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>song_scale_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="song_scale_id"                data-endpoint="PUTapi-songs--id-"
               value="17"
               data-component="body">
    <br>
<p>The <code>id</code> of an existing record in the song_scales table. Example: <code>17</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>song_metric_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="song_metric_id"                data-endpoint="PUTapi-songs--id-"
               value="17"
               data-component="body">
    <br>
<p>The <code>id</code> of an existing record in the song_metrics table. Example: <code>17</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>musical_genre_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="musical_genre_id"                data-endpoint="PUTapi-songs--id-"
               value="17"
               data-component="body">
    <br>
<p>The <code>id</code> of an existing record in the musical_genres table. Example: <code>17</code></p>
        </div>
        </form>

                    <h2 id="canciones-DELETEapi-songs--id-">Eliminar un canción.</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-DELETEapi-songs--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request DELETE \
    "http://127.0.0.1:8000/api/songs/1" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://127.0.0.1:8000/api/songs/1"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-DELETEapi-songs--id-">
</span>
<span id="execution-results-DELETEapi-songs--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-DELETEapi-songs--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-DELETEapi-songs--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-DELETEapi-songs--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEapi-songs--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-DELETEapi-songs--id-" data-method="DELETE"
      data-path="api/songs/{id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('DELETEapi-songs--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-DELETEapi-songs--id-"
                    onclick="tryItOut('DELETEapi-songs--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-DELETEapi-songs--id-"
                    onclick="cancelTryOut('DELETEapi-songs--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-DELETEapi-songs--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-red">DELETE</small>
            <b><code>api/songs/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="DELETEapi-songs--id-"
               value="Bearer {YOUR_AUTH_KEY}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {YOUR_AUTH_KEY}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="DELETEapi-songs--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="DELETEapi-songs--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="DELETEapi-songs--id-"
               value="1"
               data-component="url">
    <br>
<p>The ID of the song. Example: <code>1</code></p>
            </div>
                    </form>

                    <h2 id="canciones-GETapi-my-songs">Obtener mis canciones.</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-GETapi-my-songs">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://127.0.0.1:8000/api/my-songs" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://127.0.0.1:8000/api/my-songs"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-my-songs">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-my-songs" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-my-songs"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-my-songs"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-my-songs" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-my-songs">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-my-songs" data-method="GET"
      data-path="api/my-songs"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-my-songs', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-my-songs"
                    onclick="tryItOut('GETapi-my-songs');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-my-songs"
                    onclick="cancelTryOut('GETapi-my-songs');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-my-songs"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/my-songs</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="GETapi-my-songs"
               value="Bearer {YOUR_AUTH_KEY}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {YOUR_AUTH_KEY}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-my-songs"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-my-songs"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="canciones-GETapi-songs">Obtener y filtrar canciones.</h2>

<p>
</p>



<span id="example-requests-GETapi-songs">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://127.0.0.1:8000/api/songs" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://127.0.0.1:8000/api/songs"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-songs">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;data&quot;: [
        {
            &quot;id&quot;: 11,
            &quot;title&quot;: &quot;vmqeopfuudtdsufvy&quot;,
            &quot;bpm&quot;: 30,
            &quot;avg_rating&quot;: null,
            &quot;reviews_count&quot;: 0,
            &quot;chords&quot;: []
        },
        {
            &quot;id&quot;: 3,
            &quot;title&quot;: &quot;Saepe esse nihil sit pariatur.&quot;,
            &quot;bpm&quot;: 167,
            &quot;avg_rating&quot;: &quot;2.6666666666666667&quot;,
            &quot;reviews_count&quot;: 18,
            &quot;chords&quot;: [
                &quot;B13&quot;,
                &quot;C&quot;
            ]
        },
        {
            &quot;id&quot;: 8,
            &quot;title&quot;: &quot;Dicta tenetur et veniam.&quot;,
            &quot;bpm&quot;: 112,
            &quot;avg_rating&quot;: &quot;3.1071428571428571&quot;,
            &quot;reviews_count&quot;: 28,
            &quot;chords&quot;: [
                &quot;D#7#11&quot;,
                &quot;C#sus4&quot;,
                &quot;E7#11&quot;,
                &quot;Em9&quot;,
                &quot;Bm7&quot;,
                &quot;A#add11&quot;,
                &quot;Cm9&quot;,
                &quot;Cmaj7&quot;,
                &quot;Fdim&quot;,
                &quot;F#sus4&quot;,
                &quot;F#maj7&quot;,
                &quot;F#m7&quot;,
                &quot;D9&quot;,
                &quot;Dm9&quot;,
                &quot;Gadd9&quot;,
                &quot;Dm&quot;
            ]
        },
        {
            &quot;id&quot;: 6,
            &quot;title&quot;: &quot;Aut doloremque aut ea.&quot;,
            &quot;bpm&quot;: 225,
            &quot;avg_rating&quot;: &quot;2.6363636363636364&quot;,
            &quot;reviews_count&quot;: 22,
            &quot;chords&quot;: [
                &quot;Badd11&quot;,
                &quot;G&quot;,
                &quot;A#7&quot;,
                &quot;C#7b5&quot;,
                &quot;C#&quot;,
                &quot;C#7b9&quot;,
                &quot;Gmaj7&quot;,
                &quot;A#dim&quot;,
                &quot;B13b13&quot;,
                &quot;C7&quot;,
                &quot;D7&quot;,
                &quot;A#aug&quot;
            ]
        },
        {
            &quot;id&quot;: 2,
            &quot;title&quot;: &quot;Tempore ratione qui.&quot;,
            &quot;bpm&quot;: 152,
            &quot;avg_rating&quot;: &quot;3.0714285714285714&quot;,
            &quot;reviews_count&quot;: 14,
            &quot;chords&quot;: [
                &quot;C#9&quot;,
                &quot;C#11&quot;,
                &quot;A#7#11&quot;,
                &quot;E11&quot;,
                &quot;D#sus4&quot;,
                &quot;G7#5&quot;
            ]
        }
    ],
    &quot;links&quot;: {
        &quot;first&quot;: &quot;http://127.0.0.1:8000/api/songs?page=1&quot;,
        &quot;last&quot;: &quot;http://127.0.0.1:8000/api/songs?page=3&quot;,
        &quot;prev&quot;: null,
        &quot;next&quot;: &quot;http://127.0.0.1:8000/api/songs?page=2&quot;
    },
    &quot;meta&quot;: {
        &quot;current_page&quot;: 1,
        &quot;from&quot;: 1,
        &quot;last_page&quot;: 3,
        &quot;links&quot;: [
            {
                &quot;url&quot;: null,
                &quot;label&quot;: &quot;&amp;laquo; Previous&quot;,
                &quot;page&quot;: null,
                &quot;active&quot;: false
            },
            {
                &quot;url&quot;: &quot;http://127.0.0.1:8000/api/songs?page=1&quot;,
                &quot;label&quot;: &quot;1&quot;,
                &quot;page&quot;: 1,
                &quot;active&quot;: true
            },
            {
                &quot;url&quot;: &quot;http://127.0.0.1:8000/api/songs?page=2&quot;,
                &quot;label&quot;: &quot;2&quot;,
                &quot;page&quot;: 2,
                &quot;active&quot;: false
            },
            {
                &quot;url&quot;: &quot;http://127.0.0.1:8000/api/songs?page=3&quot;,
                &quot;label&quot;: &quot;3&quot;,
                &quot;page&quot;: 3,
                &quot;active&quot;: false
            },
            {
                &quot;url&quot;: &quot;http://127.0.0.1:8000/api/songs?page=2&quot;,
                &quot;label&quot;: &quot;Next &amp;raquo;&quot;,
                &quot;page&quot;: 2,
                &quot;active&quot;: false
            }
        ],
        &quot;path&quot;: &quot;http://127.0.0.1:8000/api/songs&quot;,
        &quot;per_page&quot;: 5,
        &quot;to&quot;: 5,
        &quot;total&quot;: 11
    }
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-songs" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-songs"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-songs"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-songs" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-songs">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-songs" data-method="GET"
      data-path="api/songs"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-songs', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-songs"
                    onclick="tryItOut('GETapi-songs');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-songs"
                    onclick="cancelTryOut('GETapi-songs');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-songs"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/songs</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-songs"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-songs"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="canciones-GETapi-songs--id-">Mostrar una canción.</h2>

<p>
</p>



<span id="example-requests-GETapi-songs--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://127.0.0.1:8000/api/songs/1" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://127.0.0.1:8000/api/songs/1"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-songs--id-">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;data&quot;: {
        &quot;id&quot;: 1,
        &quot;title&quot;: &quot;Perferendis quam consequatur.&quot;,
        &quot;bpm&quot;: 77,
        &quot;avg_rating&quot;: null,
        &quot;reviews_count&quot;: null,
        &quot;chords&quot;: [
            &quot;Dm7b5&quot;,
            &quot;Fdim&quot;,
            &quot;C&quot;,
            &quot;D#dim&quot;,
            &quot;A#dim&quot;,
            &quot;Eaug7&quot;,
            &quot;B13b13&quot;,
            &quot;F#11&quot;,
            &quot;Gm7&quot;,
            &quot;C#7#9&quot;,
            &quot;A#m&quot;,
            &quot;C#11&quot;,
            &quot;E7&quot;
        ]
    }
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-songs--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-songs--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-songs--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-songs--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-songs--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-songs--id-" data-method="GET"
      data-path="api/songs/{id}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-songs--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-songs--id-"
                    onclick="tryItOut('GETapi-songs--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-songs--id-"
                    onclick="cancelTryOut('GETapi-songs--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-songs--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/songs/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-songs--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-songs--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="GETapi-songs--id-"
               value="1"
               data-component="url">
    <br>
<p>The ID of the song. Example: <code>1</code></p>
            </div>
                    </form>

                <h1 id="compases">Compases</h1>

    <p>Endpoints para guardar y eliminar compases, así como modificar su orden.</p>

                                <h2 id="compases-POSTapi-songs--song_id--compasses">Guardar un compás.</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-POSTapi-songs--song_id--compasses">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://127.0.0.1:8000/api/songs/1/compasses" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://127.0.0.1:8000/api/songs/1/compasses"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-songs--song_id--compasses">
</span>
<span id="execution-results-POSTapi-songs--song_id--compasses" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-songs--song_id--compasses"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-songs--song_id--compasses"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-songs--song_id--compasses" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-songs--song_id--compasses">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-songs--song_id--compasses" data-method="POST"
      data-path="api/songs/{song_id}/compasses"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-songs--song_id--compasses', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-songs--song_id--compasses"
                    onclick="tryItOut('POSTapi-songs--song_id--compasses');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-songs--song_id--compasses"
                    onclick="cancelTryOut('POSTapi-songs--song_id--compasses');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-songs--song_id--compasses"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/songs/{song_id}/compasses</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="POSTapi-songs--song_id--compasses"
               value="Bearer {YOUR_AUTH_KEY}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {YOUR_AUTH_KEY}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-songs--song_id--compasses"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-songs--song_id--compasses"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>song_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="song_id"                data-endpoint="POSTapi-songs--song_id--compasses"
               value="1"
               data-component="url">
    <br>
<p>The ID of the song. Example: <code>1</code></p>
            </div>
                    </form>

                    <h2 id="compases-PUTapi-songs--song_id--compasses--id-">Actualizar un compás.</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-PUTapi-songs--song_id--compasses--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PUT \
    "http://127.0.0.1:8000/api/songs/1/compasses/1" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"order\": 73
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://127.0.0.1:8000/api/songs/1/compasses/1"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "order": 73
};

fetch(url, {
    method: "PUT",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-PUTapi-songs--song_id--compasses--id-">
</span>
<span id="execution-results-PUTapi-songs--song_id--compasses--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PUTapi-songs--song_id--compasses--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PUTapi-songs--song_id--compasses--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-PUTapi-songs--song_id--compasses--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PUTapi-songs--song_id--compasses--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-PUTapi-songs--song_id--compasses--id-" data-method="PUT"
      data-path="api/songs/{song_id}/compasses/{id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PUTapi-songs--song_id--compasses--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-PUTapi-songs--song_id--compasses--id-"
                    onclick="tryItOut('PUTapi-songs--song_id--compasses--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-PUTapi-songs--song_id--compasses--id-"
                    onclick="cancelTryOut('PUTapi-songs--song_id--compasses--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-PUTapi-songs--song_id--compasses--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-darkblue">PUT</small>
            <b><code>api/songs/{song_id}/compasses/{id}</code></b>
        </p>
            <p>
            <small class="badge badge-purple">PATCH</small>
            <b><code>api/songs/{song_id}/compasses/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="PUTapi-songs--song_id--compasses--id-"
               value="Bearer {YOUR_AUTH_KEY}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {YOUR_AUTH_KEY}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="PUTapi-songs--song_id--compasses--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="PUTapi-songs--song_id--compasses--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>song_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="song_id"                data-endpoint="PUTapi-songs--song_id--compasses--id-"
               value="1"
               data-component="url">
    <br>
<p>The ID of the song. Example: <code>1</code></p>
            </div>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="PUTapi-songs--song_id--compasses--id-"
               value="1"
               data-component="url">
    <br>
<p>The ID of the compass. Example: <code>1</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>order</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="order"                data-endpoint="PUTapi-songs--song_id--compasses--id-"
               value="73"
               data-component="body">
    <br>
<p>Must be at least 1. Example: <code>73</code></p>
        </div>
        </form>

                    <h2 id="compases-DELETEapi-songs--song_id--compasses--id-">Eliminar un compás.</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-DELETEapi-songs--song_id--compasses--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request DELETE \
    "http://127.0.0.1:8000/api/songs/1/compasses/1" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://127.0.0.1:8000/api/songs/1/compasses/1"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-DELETEapi-songs--song_id--compasses--id-">
</span>
<span id="execution-results-DELETEapi-songs--song_id--compasses--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-DELETEapi-songs--song_id--compasses--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-DELETEapi-songs--song_id--compasses--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-DELETEapi-songs--song_id--compasses--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEapi-songs--song_id--compasses--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-DELETEapi-songs--song_id--compasses--id-" data-method="DELETE"
      data-path="api/songs/{song_id}/compasses/{id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('DELETEapi-songs--song_id--compasses--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-DELETEapi-songs--song_id--compasses--id-"
                    onclick="tryItOut('DELETEapi-songs--song_id--compasses--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-DELETEapi-songs--song_id--compasses--id-"
                    onclick="cancelTryOut('DELETEapi-songs--song_id--compasses--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-DELETEapi-songs--song_id--compasses--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-red">DELETE</small>
            <b><code>api/songs/{song_id}/compasses/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="DELETEapi-songs--song_id--compasses--id-"
               value="Bearer {YOUR_AUTH_KEY}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {YOUR_AUTH_KEY}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="DELETEapi-songs--song_id--compasses--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="DELETEapi-songs--song_id--compasses--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>song_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="song_id"                data-endpoint="DELETEapi-songs--song_id--compasses--id-"
               value="1"
               data-component="url">
    <br>
<p>The ID of the song. Example: <code>1</code></p>
            </div>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="DELETEapi-songs--song_id--compasses--id-"
               value="1"
               data-component="url">
    <br>
<p>The ID of the compass. Example: <code>1</code></p>
            </div>
                    </form>

                <h1 id="escalas">Escalas</h1>

    

                                <h2 id="escalas-GETapi-song-scales">Buscar una escala musical.</h2>

<p>
</p>



<span id="example-requests-GETapi-song-scales">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://127.0.0.1:8000/api/song-scales" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://127.0.0.1:8000/api/song-scales"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-song-scales">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">[
    {
        &quot;id&quot;: 1,
        &quot;name&quot;: &quot;C Mayor&quot;
    },
    {
        &quot;id&quot;: 2,
        &quot;name&quot;: &quot;C Menor Natural&quot;
    },
    {
        &quot;id&quot;: 3,
        &quot;name&quot;: &quot;C Menor Arm&oacute;nica&quot;
    },
    {
        &quot;id&quot;: 4,
        &quot;name&quot;: &quot;C Menor Mel&oacute;dica&quot;
    },
    {
        &quot;id&quot;: 5,
        &quot;name&quot;: &quot;C D&oacute;rica&quot;
    },
    {
        &quot;id&quot;: 6,
        &quot;name&quot;: &quot;C Frigia&quot;
    },
    {
        &quot;id&quot;: 7,
        &quot;name&quot;: &quot;C Lidia&quot;
    },
    {
        &quot;id&quot;: 8,
        &quot;name&quot;: &quot;C Mixolidia&quot;
    },
    {
        &quot;id&quot;: 9,
        &quot;name&quot;: &quot;C L&oacute;cria&quot;
    },
    {
        &quot;id&quot;: 10,
        &quot;name&quot;: &quot;C Pentat&oacute;nica Mayor&quot;
    },
    {
        &quot;id&quot;: 11,
        &quot;name&quot;: &quot;C Pentat&oacute;nica Menor&quot;
    },
    {
        &quot;id&quot;: 12,
        &quot;name&quot;: &quot;C Escala de Blues&quot;
    },
    {
        &quot;id&quot;: 13,
        &quot;name&quot;: &quot;C Blues Menor&quot;
    },
    {
        &quot;id&quot;: 14,
        &quot;name&quot;: &quot;C Blues Mayor&quot;
    },
    {
        &quot;id&quot;: 15,
        &quot;name&quot;: &quot;C Crom&aacute;tica&quot;
    },
    {
        &quot;id&quot;: 16,
        &quot;name&quot;: &quot;C Entera&quot;
    },
    {
        &quot;id&quot;: 17,
        &quot;name&quot;: &quot;C Disminuida&quot;
    },
    {
        &quot;id&quot;: 18,
        &quot;name&quot;: &quot;C Aumentada&quot;
    },
    {
        &quot;id&quot;: 19,
        &quot;name&quot;: &quot;C Frigia Espa&ntilde;ola&quot;
    },
    {
        &quot;id&quot;: 20,
        &quot;name&quot;: &quot;C Menor H&uacute;ngara&quot;
    },
    {
        &quot;id&quot;: 21,
        &quot;name&quot;: &quot;C Menor Napolitana&quot;
    },
    {
        &quot;id&quot;: 22,
        &quot;name&quot;: &quot;C Mayor Napolitana&quot;
    },
    {
        &quot;id&quot;: 23,
        &quot;name&quot;: &quot;C Persa&quot;
    },
    {
        &quot;id&quot;: 24,
        &quot;name&quot;: &quot;C Japonesa (In Sen)&quot;
    },
    {
        &quot;id&quot;: 25,
        &quot;name&quot;: &quot;C Oriental&quot;
    },
    {
        &quot;id&quot;: 26,
        &quot;name&quot;: &quot;C Egipcia&quot;
    },
    {
        &quot;id&quot;: 27,
        &quot;name&quot;: &quot;C Lidia Dominante&quot;
    },
    {
        &quot;id&quot;: 28,
        &quot;name&quot;: &quot;C Escala Alterada&quot;
    },
    {
        &quot;id&quot;: 29,
        &quot;name&quot;: &quot;C Disminuida Semitono-Tono&quot;
    },
    {
        &quot;id&quot;: 30,
        &quot;name&quot;: &quot;C Disminuida Tono-Semitono&quot;
    },
    {
        &quot;id&quot;: 31,
        &quot;name&quot;: &quot;C# Mayor&quot;
    },
    {
        &quot;id&quot;: 32,
        &quot;name&quot;: &quot;C# Menor Natural&quot;
    },
    {
        &quot;id&quot;: 33,
        &quot;name&quot;: &quot;C# Menor Arm&oacute;nica&quot;
    },
    {
        &quot;id&quot;: 34,
        &quot;name&quot;: &quot;C# Menor Mel&oacute;dica&quot;
    },
    {
        &quot;id&quot;: 35,
        &quot;name&quot;: &quot;C# D&oacute;rica&quot;
    },
    {
        &quot;id&quot;: 36,
        &quot;name&quot;: &quot;C# Frigia&quot;
    },
    {
        &quot;id&quot;: 37,
        &quot;name&quot;: &quot;C# Lidia&quot;
    },
    {
        &quot;id&quot;: 38,
        &quot;name&quot;: &quot;C# Mixolidia&quot;
    },
    {
        &quot;id&quot;: 39,
        &quot;name&quot;: &quot;C# L&oacute;cria&quot;
    },
    {
        &quot;id&quot;: 40,
        &quot;name&quot;: &quot;C# Pentat&oacute;nica Mayor&quot;
    },
    {
        &quot;id&quot;: 41,
        &quot;name&quot;: &quot;C# Pentat&oacute;nica Menor&quot;
    },
    {
        &quot;id&quot;: 42,
        &quot;name&quot;: &quot;C# Escala de Blues&quot;
    },
    {
        &quot;id&quot;: 43,
        &quot;name&quot;: &quot;C# Blues Menor&quot;
    },
    {
        &quot;id&quot;: 44,
        &quot;name&quot;: &quot;C# Blues Mayor&quot;
    },
    {
        &quot;id&quot;: 45,
        &quot;name&quot;: &quot;C# Crom&aacute;tica&quot;
    },
    {
        &quot;id&quot;: 46,
        &quot;name&quot;: &quot;C# Entera&quot;
    },
    {
        &quot;id&quot;: 47,
        &quot;name&quot;: &quot;C# Disminuida&quot;
    },
    {
        &quot;id&quot;: 48,
        &quot;name&quot;: &quot;C# Aumentada&quot;
    },
    {
        &quot;id&quot;: 49,
        &quot;name&quot;: &quot;C# Frigia Espa&ntilde;ola&quot;
    },
    {
        &quot;id&quot;: 50,
        &quot;name&quot;: &quot;C# Menor H&uacute;ngara&quot;
    },
    {
        &quot;id&quot;: 51,
        &quot;name&quot;: &quot;C# Menor Napolitana&quot;
    },
    {
        &quot;id&quot;: 52,
        &quot;name&quot;: &quot;C# Mayor Napolitana&quot;
    },
    {
        &quot;id&quot;: 53,
        &quot;name&quot;: &quot;C# Persa&quot;
    },
    {
        &quot;id&quot;: 54,
        &quot;name&quot;: &quot;C# Japonesa (In Sen)&quot;
    },
    {
        &quot;id&quot;: 55,
        &quot;name&quot;: &quot;C# Oriental&quot;
    },
    {
        &quot;id&quot;: 56,
        &quot;name&quot;: &quot;C# Egipcia&quot;
    },
    {
        &quot;id&quot;: 57,
        &quot;name&quot;: &quot;C# Lidia Dominante&quot;
    },
    {
        &quot;id&quot;: 58,
        &quot;name&quot;: &quot;C# Escala Alterada&quot;
    },
    {
        &quot;id&quot;: 59,
        &quot;name&quot;: &quot;C# Disminuida Semitono-Tono&quot;
    },
    {
        &quot;id&quot;: 60,
        &quot;name&quot;: &quot;C# Disminuida Tono-Semitono&quot;
    },
    {
        &quot;id&quot;: 61,
        &quot;name&quot;: &quot;D Mayor&quot;
    },
    {
        &quot;id&quot;: 62,
        &quot;name&quot;: &quot;D Menor Natural&quot;
    },
    {
        &quot;id&quot;: 63,
        &quot;name&quot;: &quot;D Menor Arm&oacute;nica&quot;
    },
    {
        &quot;id&quot;: 64,
        &quot;name&quot;: &quot;D Menor Mel&oacute;dica&quot;
    },
    {
        &quot;id&quot;: 65,
        &quot;name&quot;: &quot;D D&oacute;rica&quot;
    },
    {
        &quot;id&quot;: 66,
        &quot;name&quot;: &quot;D Frigia&quot;
    },
    {
        &quot;id&quot;: 67,
        &quot;name&quot;: &quot;D Lidia&quot;
    },
    {
        &quot;id&quot;: 68,
        &quot;name&quot;: &quot;D Mixolidia&quot;
    },
    {
        &quot;id&quot;: 69,
        &quot;name&quot;: &quot;D L&oacute;cria&quot;
    },
    {
        &quot;id&quot;: 70,
        &quot;name&quot;: &quot;D Pentat&oacute;nica Mayor&quot;
    },
    {
        &quot;id&quot;: 71,
        &quot;name&quot;: &quot;D Pentat&oacute;nica Menor&quot;
    },
    {
        &quot;id&quot;: 72,
        &quot;name&quot;: &quot;D Escala de Blues&quot;
    },
    {
        &quot;id&quot;: 73,
        &quot;name&quot;: &quot;D Blues Menor&quot;
    },
    {
        &quot;id&quot;: 74,
        &quot;name&quot;: &quot;D Blues Mayor&quot;
    },
    {
        &quot;id&quot;: 75,
        &quot;name&quot;: &quot;D Crom&aacute;tica&quot;
    },
    {
        &quot;id&quot;: 76,
        &quot;name&quot;: &quot;D Entera&quot;
    },
    {
        &quot;id&quot;: 77,
        &quot;name&quot;: &quot;D Disminuida&quot;
    },
    {
        &quot;id&quot;: 78,
        &quot;name&quot;: &quot;D Aumentada&quot;
    },
    {
        &quot;id&quot;: 79,
        &quot;name&quot;: &quot;D Frigia Espa&ntilde;ola&quot;
    },
    {
        &quot;id&quot;: 80,
        &quot;name&quot;: &quot;D Menor H&uacute;ngara&quot;
    },
    {
        &quot;id&quot;: 81,
        &quot;name&quot;: &quot;D Menor Napolitana&quot;
    },
    {
        &quot;id&quot;: 82,
        &quot;name&quot;: &quot;D Mayor Napolitana&quot;
    },
    {
        &quot;id&quot;: 83,
        &quot;name&quot;: &quot;D Persa&quot;
    },
    {
        &quot;id&quot;: 84,
        &quot;name&quot;: &quot;D Japonesa (In Sen)&quot;
    },
    {
        &quot;id&quot;: 85,
        &quot;name&quot;: &quot;D Oriental&quot;
    },
    {
        &quot;id&quot;: 86,
        &quot;name&quot;: &quot;D Egipcia&quot;
    },
    {
        &quot;id&quot;: 87,
        &quot;name&quot;: &quot;D Lidia Dominante&quot;
    },
    {
        &quot;id&quot;: 88,
        &quot;name&quot;: &quot;D Escala Alterada&quot;
    },
    {
        &quot;id&quot;: 89,
        &quot;name&quot;: &quot;D Disminuida Semitono-Tono&quot;
    },
    {
        &quot;id&quot;: 90,
        &quot;name&quot;: &quot;D Disminuida Tono-Semitono&quot;
    },
    {
        &quot;id&quot;: 91,
        &quot;name&quot;: &quot;D# Mayor&quot;
    },
    {
        &quot;id&quot;: 92,
        &quot;name&quot;: &quot;D# Menor Natural&quot;
    },
    {
        &quot;id&quot;: 93,
        &quot;name&quot;: &quot;D# Menor Arm&oacute;nica&quot;
    },
    {
        &quot;id&quot;: 94,
        &quot;name&quot;: &quot;D# Menor Mel&oacute;dica&quot;
    },
    {
        &quot;id&quot;: 95,
        &quot;name&quot;: &quot;D# D&oacute;rica&quot;
    },
    {
        &quot;id&quot;: 96,
        &quot;name&quot;: &quot;D# Frigia&quot;
    },
    {
        &quot;id&quot;: 97,
        &quot;name&quot;: &quot;D# Lidia&quot;
    },
    {
        &quot;id&quot;: 98,
        &quot;name&quot;: &quot;D# Mixolidia&quot;
    },
    {
        &quot;id&quot;: 99,
        &quot;name&quot;: &quot;D# L&oacute;cria&quot;
    },
    {
        &quot;id&quot;: 100,
        &quot;name&quot;: &quot;D# Pentat&oacute;nica Mayor&quot;
    },
    {
        &quot;id&quot;: 101,
        &quot;name&quot;: &quot;D# Pentat&oacute;nica Menor&quot;
    },
    {
        &quot;id&quot;: 102,
        &quot;name&quot;: &quot;D# Escala de Blues&quot;
    },
    {
        &quot;id&quot;: 103,
        &quot;name&quot;: &quot;D# Blues Menor&quot;
    },
    {
        &quot;id&quot;: 104,
        &quot;name&quot;: &quot;D# Blues Mayor&quot;
    },
    {
        &quot;id&quot;: 105,
        &quot;name&quot;: &quot;D# Crom&aacute;tica&quot;
    },
    {
        &quot;id&quot;: 106,
        &quot;name&quot;: &quot;D# Entera&quot;
    },
    {
        &quot;id&quot;: 107,
        &quot;name&quot;: &quot;D# Disminuida&quot;
    },
    {
        &quot;id&quot;: 108,
        &quot;name&quot;: &quot;D# Aumentada&quot;
    },
    {
        &quot;id&quot;: 109,
        &quot;name&quot;: &quot;D# Frigia Espa&ntilde;ola&quot;
    },
    {
        &quot;id&quot;: 110,
        &quot;name&quot;: &quot;D# Menor H&uacute;ngara&quot;
    },
    {
        &quot;id&quot;: 111,
        &quot;name&quot;: &quot;D# Menor Napolitana&quot;
    },
    {
        &quot;id&quot;: 112,
        &quot;name&quot;: &quot;D# Mayor Napolitana&quot;
    },
    {
        &quot;id&quot;: 113,
        &quot;name&quot;: &quot;D# Persa&quot;
    },
    {
        &quot;id&quot;: 114,
        &quot;name&quot;: &quot;D# Japonesa (In Sen)&quot;
    },
    {
        &quot;id&quot;: 115,
        &quot;name&quot;: &quot;D# Oriental&quot;
    },
    {
        &quot;id&quot;: 116,
        &quot;name&quot;: &quot;D# Egipcia&quot;
    },
    {
        &quot;id&quot;: 117,
        &quot;name&quot;: &quot;D# Lidia Dominante&quot;
    },
    {
        &quot;id&quot;: 118,
        &quot;name&quot;: &quot;D# Escala Alterada&quot;
    },
    {
        &quot;id&quot;: 119,
        &quot;name&quot;: &quot;D# Disminuida Semitono-Tono&quot;
    },
    {
        &quot;id&quot;: 120,
        &quot;name&quot;: &quot;D# Disminuida Tono-Semitono&quot;
    },
    {
        &quot;id&quot;: 121,
        &quot;name&quot;: &quot;E Mayor&quot;
    },
    {
        &quot;id&quot;: 122,
        &quot;name&quot;: &quot;E Menor Natural&quot;
    },
    {
        &quot;id&quot;: 123,
        &quot;name&quot;: &quot;E Menor Arm&oacute;nica&quot;
    },
    {
        &quot;id&quot;: 124,
        &quot;name&quot;: &quot;E Menor Mel&oacute;dica&quot;
    },
    {
        &quot;id&quot;: 125,
        &quot;name&quot;: &quot;E D&oacute;rica&quot;
    },
    {
        &quot;id&quot;: 126,
        &quot;name&quot;: &quot;E Frigia&quot;
    },
    {
        &quot;id&quot;: 127,
        &quot;name&quot;: &quot;E Lidia&quot;
    },
    {
        &quot;id&quot;: 128,
        &quot;name&quot;: &quot;E Mixolidia&quot;
    },
    {
        &quot;id&quot;: 129,
        &quot;name&quot;: &quot;E L&oacute;cria&quot;
    },
    {
        &quot;id&quot;: 130,
        &quot;name&quot;: &quot;E Pentat&oacute;nica Mayor&quot;
    },
    {
        &quot;id&quot;: 131,
        &quot;name&quot;: &quot;E Pentat&oacute;nica Menor&quot;
    },
    {
        &quot;id&quot;: 132,
        &quot;name&quot;: &quot;E Escala de Blues&quot;
    },
    {
        &quot;id&quot;: 133,
        &quot;name&quot;: &quot;E Blues Menor&quot;
    },
    {
        &quot;id&quot;: 134,
        &quot;name&quot;: &quot;E Blues Mayor&quot;
    },
    {
        &quot;id&quot;: 135,
        &quot;name&quot;: &quot;E Crom&aacute;tica&quot;
    },
    {
        &quot;id&quot;: 136,
        &quot;name&quot;: &quot;E Entera&quot;
    },
    {
        &quot;id&quot;: 137,
        &quot;name&quot;: &quot;E Disminuida&quot;
    },
    {
        &quot;id&quot;: 138,
        &quot;name&quot;: &quot;E Aumentada&quot;
    },
    {
        &quot;id&quot;: 139,
        &quot;name&quot;: &quot;E Frigia Espa&ntilde;ola&quot;
    },
    {
        &quot;id&quot;: 140,
        &quot;name&quot;: &quot;E Menor H&uacute;ngara&quot;
    },
    {
        &quot;id&quot;: 141,
        &quot;name&quot;: &quot;E Menor Napolitana&quot;
    },
    {
        &quot;id&quot;: 142,
        &quot;name&quot;: &quot;E Mayor Napolitana&quot;
    },
    {
        &quot;id&quot;: 143,
        &quot;name&quot;: &quot;E Persa&quot;
    },
    {
        &quot;id&quot;: 144,
        &quot;name&quot;: &quot;E Japonesa (In Sen)&quot;
    },
    {
        &quot;id&quot;: 145,
        &quot;name&quot;: &quot;E Oriental&quot;
    },
    {
        &quot;id&quot;: 146,
        &quot;name&quot;: &quot;E Egipcia&quot;
    },
    {
        &quot;id&quot;: 147,
        &quot;name&quot;: &quot;E Lidia Dominante&quot;
    },
    {
        &quot;id&quot;: 148,
        &quot;name&quot;: &quot;E Escala Alterada&quot;
    },
    {
        &quot;id&quot;: 149,
        &quot;name&quot;: &quot;E Disminuida Semitono-Tono&quot;
    },
    {
        &quot;id&quot;: 150,
        &quot;name&quot;: &quot;E Disminuida Tono-Semitono&quot;
    },
    {
        &quot;id&quot;: 151,
        &quot;name&quot;: &quot;F Mayor&quot;
    },
    {
        &quot;id&quot;: 152,
        &quot;name&quot;: &quot;F Menor Natural&quot;
    },
    {
        &quot;id&quot;: 153,
        &quot;name&quot;: &quot;F Menor Arm&oacute;nica&quot;
    },
    {
        &quot;id&quot;: 154,
        &quot;name&quot;: &quot;F Menor Mel&oacute;dica&quot;
    },
    {
        &quot;id&quot;: 155,
        &quot;name&quot;: &quot;F D&oacute;rica&quot;
    },
    {
        &quot;id&quot;: 156,
        &quot;name&quot;: &quot;F Frigia&quot;
    },
    {
        &quot;id&quot;: 157,
        &quot;name&quot;: &quot;F Lidia&quot;
    },
    {
        &quot;id&quot;: 158,
        &quot;name&quot;: &quot;F Mixolidia&quot;
    },
    {
        &quot;id&quot;: 159,
        &quot;name&quot;: &quot;F L&oacute;cria&quot;
    },
    {
        &quot;id&quot;: 160,
        &quot;name&quot;: &quot;F Pentat&oacute;nica Mayor&quot;
    },
    {
        &quot;id&quot;: 161,
        &quot;name&quot;: &quot;F Pentat&oacute;nica Menor&quot;
    },
    {
        &quot;id&quot;: 162,
        &quot;name&quot;: &quot;F Escala de Blues&quot;
    },
    {
        &quot;id&quot;: 163,
        &quot;name&quot;: &quot;F Blues Menor&quot;
    },
    {
        &quot;id&quot;: 164,
        &quot;name&quot;: &quot;F Blues Mayor&quot;
    },
    {
        &quot;id&quot;: 165,
        &quot;name&quot;: &quot;F Crom&aacute;tica&quot;
    },
    {
        &quot;id&quot;: 166,
        &quot;name&quot;: &quot;F Entera&quot;
    },
    {
        &quot;id&quot;: 167,
        &quot;name&quot;: &quot;F Disminuida&quot;
    },
    {
        &quot;id&quot;: 168,
        &quot;name&quot;: &quot;F Aumentada&quot;
    },
    {
        &quot;id&quot;: 169,
        &quot;name&quot;: &quot;F Frigia Espa&ntilde;ola&quot;
    },
    {
        &quot;id&quot;: 170,
        &quot;name&quot;: &quot;F Menor H&uacute;ngara&quot;
    },
    {
        &quot;id&quot;: 171,
        &quot;name&quot;: &quot;F Menor Napolitana&quot;
    },
    {
        &quot;id&quot;: 172,
        &quot;name&quot;: &quot;F Mayor Napolitana&quot;
    },
    {
        &quot;id&quot;: 173,
        &quot;name&quot;: &quot;F Persa&quot;
    },
    {
        &quot;id&quot;: 174,
        &quot;name&quot;: &quot;F Japonesa (In Sen)&quot;
    },
    {
        &quot;id&quot;: 175,
        &quot;name&quot;: &quot;F Oriental&quot;
    },
    {
        &quot;id&quot;: 176,
        &quot;name&quot;: &quot;F Egipcia&quot;
    },
    {
        &quot;id&quot;: 177,
        &quot;name&quot;: &quot;F Lidia Dominante&quot;
    },
    {
        &quot;id&quot;: 178,
        &quot;name&quot;: &quot;F Escala Alterada&quot;
    },
    {
        &quot;id&quot;: 179,
        &quot;name&quot;: &quot;F Disminuida Semitono-Tono&quot;
    },
    {
        &quot;id&quot;: 180,
        &quot;name&quot;: &quot;F Disminuida Tono-Semitono&quot;
    },
    {
        &quot;id&quot;: 181,
        &quot;name&quot;: &quot;F# Mayor&quot;
    },
    {
        &quot;id&quot;: 182,
        &quot;name&quot;: &quot;F# Menor Natural&quot;
    },
    {
        &quot;id&quot;: 183,
        &quot;name&quot;: &quot;F# Menor Arm&oacute;nica&quot;
    },
    {
        &quot;id&quot;: 184,
        &quot;name&quot;: &quot;F# Menor Mel&oacute;dica&quot;
    },
    {
        &quot;id&quot;: 185,
        &quot;name&quot;: &quot;F# D&oacute;rica&quot;
    },
    {
        &quot;id&quot;: 186,
        &quot;name&quot;: &quot;F# Frigia&quot;
    },
    {
        &quot;id&quot;: 187,
        &quot;name&quot;: &quot;F# Lidia&quot;
    },
    {
        &quot;id&quot;: 188,
        &quot;name&quot;: &quot;F# Mixolidia&quot;
    },
    {
        &quot;id&quot;: 189,
        &quot;name&quot;: &quot;F# L&oacute;cria&quot;
    },
    {
        &quot;id&quot;: 190,
        &quot;name&quot;: &quot;F# Pentat&oacute;nica Mayor&quot;
    },
    {
        &quot;id&quot;: 191,
        &quot;name&quot;: &quot;F# Pentat&oacute;nica Menor&quot;
    },
    {
        &quot;id&quot;: 192,
        &quot;name&quot;: &quot;F# Escala de Blues&quot;
    },
    {
        &quot;id&quot;: 193,
        &quot;name&quot;: &quot;F# Blues Menor&quot;
    },
    {
        &quot;id&quot;: 194,
        &quot;name&quot;: &quot;F# Blues Mayor&quot;
    },
    {
        &quot;id&quot;: 195,
        &quot;name&quot;: &quot;F# Crom&aacute;tica&quot;
    },
    {
        &quot;id&quot;: 196,
        &quot;name&quot;: &quot;F# Entera&quot;
    },
    {
        &quot;id&quot;: 197,
        &quot;name&quot;: &quot;F# Disminuida&quot;
    },
    {
        &quot;id&quot;: 198,
        &quot;name&quot;: &quot;F# Aumentada&quot;
    },
    {
        &quot;id&quot;: 199,
        &quot;name&quot;: &quot;F# Frigia Espa&ntilde;ola&quot;
    },
    {
        &quot;id&quot;: 200,
        &quot;name&quot;: &quot;F# Menor H&uacute;ngara&quot;
    },
    {
        &quot;id&quot;: 201,
        &quot;name&quot;: &quot;F# Menor Napolitana&quot;
    },
    {
        &quot;id&quot;: 202,
        &quot;name&quot;: &quot;F# Mayor Napolitana&quot;
    },
    {
        &quot;id&quot;: 203,
        &quot;name&quot;: &quot;F# Persa&quot;
    },
    {
        &quot;id&quot;: 204,
        &quot;name&quot;: &quot;F# Japonesa (In Sen)&quot;
    },
    {
        &quot;id&quot;: 205,
        &quot;name&quot;: &quot;F# Oriental&quot;
    },
    {
        &quot;id&quot;: 206,
        &quot;name&quot;: &quot;F# Egipcia&quot;
    },
    {
        &quot;id&quot;: 207,
        &quot;name&quot;: &quot;F# Lidia Dominante&quot;
    },
    {
        &quot;id&quot;: 208,
        &quot;name&quot;: &quot;F# Escala Alterada&quot;
    },
    {
        &quot;id&quot;: 209,
        &quot;name&quot;: &quot;F# Disminuida Semitono-Tono&quot;
    },
    {
        &quot;id&quot;: 210,
        &quot;name&quot;: &quot;F# Disminuida Tono-Semitono&quot;
    },
    {
        &quot;id&quot;: 211,
        &quot;name&quot;: &quot;G Mayor&quot;
    },
    {
        &quot;id&quot;: 212,
        &quot;name&quot;: &quot;G Menor Natural&quot;
    },
    {
        &quot;id&quot;: 213,
        &quot;name&quot;: &quot;G Menor Arm&oacute;nica&quot;
    },
    {
        &quot;id&quot;: 214,
        &quot;name&quot;: &quot;G Menor Mel&oacute;dica&quot;
    },
    {
        &quot;id&quot;: 215,
        &quot;name&quot;: &quot;G D&oacute;rica&quot;
    },
    {
        &quot;id&quot;: 216,
        &quot;name&quot;: &quot;G Frigia&quot;
    },
    {
        &quot;id&quot;: 217,
        &quot;name&quot;: &quot;G Lidia&quot;
    },
    {
        &quot;id&quot;: 218,
        &quot;name&quot;: &quot;G Mixolidia&quot;
    },
    {
        &quot;id&quot;: 219,
        &quot;name&quot;: &quot;G L&oacute;cria&quot;
    },
    {
        &quot;id&quot;: 220,
        &quot;name&quot;: &quot;G Pentat&oacute;nica Mayor&quot;
    },
    {
        &quot;id&quot;: 221,
        &quot;name&quot;: &quot;G Pentat&oacute;nica Menor&quot;
    },
    {
        &quot;id&quot;: 222,
        &quot;name&quot;: &quot;G Escala de Blues&quot;
    },
    {
        &quot;id&quot;: 223,
        &quot;name&quot;: &quot;G Blues Menor&quot;
    },
    {
        &quot;id&quot;: 224,
        &quot;name&quot;: &quot;G Blues Mayor&quot;
    },
    {
        &quot;id&quot;: 225,
        &quot;name&quot;: &quot;G Crom&aacute;tica&quot;
    },
    {
        &quot;id&quot;: 226,
        &quot;name&quot;: &quot;G Entera&quot;
    },
    {
        &quot;id&quot;: 227,
        &quot;name&quot;: &quot;G Disminuida&quot;
    },
    {
        &quot;id&quot;: 228,
        &quot;name&quot;: &quot;G Aumentada&quot;
    },
    {
        &quot;id&quot;: 229,
        &quot;name&quot;: &quot;G Frigia Espa&ntilde;ola&quot;
    },
    {
        &quot;id&quot;: 230,
        &quot;name&quot;: &quot;G Menor H&uacute;ngara&quot;
    },
    {
        &quot;id&quot;: 231,
        &quot;name&quot;: &quot;G Menor Napolitana&quot;
    },
    {
        &quot;id&quot;: 232,
        &quot;name&quot;: &quot;G Mayor Napolitana&quot;
    },
    {
        &quot;id&quot;: 233,
        &quot;name&quot;: &quot;G Persa&quot;
    },
    {
        &quot;id&quot;: 234,
        &quot;name&quot;: &quot;G Japonesa (In Sen)&quot;
    },
    {
        &quot;id&quot;: 235,
        &quot;name&quot;: &quot;G Oriental&quot;
    },
    {
        &quot;id&quot;: 236,
        &quot;name&quot;: &quot;G Egipcia&quot;
    },
    {
        &quot;id&quot;: 237,
        &quot;name&quot;: &quot;G Lidia Dominante&quot;
    },
    {
        &quot;id&quot;: 238,
        &quot;name&quot;: &quot;G Escala Alterada&quot;
    },
    {
        &quot;id&quot;: 239,
        &quot;name&quot;: &quot;G Disminuida Semitono-Tono&quot;
    },
    {
        &quot;id&quot;: 240,
        &quot;name&quot;: &quot;G Disminuida Tono-Semitono&quot;
    },
    {
        &quot;id&quot;: 241,
        &quot;name&quot;: &quot;A# Mayor&quot;
    },
    {
        &quot;id&quot;: 242,
        &quot;name&quot;: &quot;A# Menor Natural&quot;
    },
    {
        &quot;id&quot;: 243,
        &quot;name&quot;: &quot;A# Menor Arm&oacute;nica&quot;
    },
    {
        &quot;id&quot;: 244,
        &quot;name&quot;: &quot;A# Menor Mel&oacute;dica&quot;
    },
    {
        &quot;id&quot;: 245,
        &quot;name&quot;: &quot;A# D&oacute;rica&quot;
    },
    {
        &quot;id&quot;: 246,
        &quot;name&quot;: &quot;A# Frigia&quot;
    },
    {
        &quot;id&quot;: 247,
        &quot;name&quot;: &quot;A# Lidia&quot;
    },
    {
        &quot;id&quot;: 248,
        &quot;name&quot;: &quot;A# Mixolidia&quot;
    },
    {
        &quot;id&quot;: 249,
        &quot;name&quot;: &quot;A# L&oacute;cria&quot;
    },
    {
        &quot;id&quot;: 250,
        &quot;name&quot;: &quot;A# Pentat&oacute;nica Mayor&quot;
    },
    {
        &quot;id&quot;: 251,
        &quot;name&quot;: &quot;A# Pentat&oacute;nica Menor&quot;
    },
    {
        &quot;id&quot;: 252,
        &quot;name&quot;: &quot;A# Escala de Blues&quot;
    },
    {
        &quot;id&quot;: 253,
        &quot;name&quot;: &quot;A# Blues Menor&quot;
    },
    {
        &quot;id&quot;: 254,
        &quot;name&quot;: &quot;A# Blues Mayor&quot;
    },
    {
        &quot;id&quot;: 255,
        &quot;name&quot;: &quot;A# Crom&aacute;tica&quot;
    },
    {
        &quot;id&quot;: 256,
        &quot;name&quot;: &quot;A# Entera&quot;
    },
    {
        &quot;id&quot;: 257,
        &quot;name&quot;: &quot;A# Disminuida&quot;
    },
    {
        &quot;id&quot;: 258,
        &quot;name&quot;: &quot;A# Aumentada&quot;
    },
    {
        &quot;id&quot;: 259,
        &quot;name&quot;: &quot;A# Frigia Espa&ntilde;ola&quot;
    },
    {
        &quot;id&quot;: 260,
        &quot;name&quot;: &quot;A# Menor H&uacute;ngara&quot;
    },
    {
        &quot;id&quot;: 261,
        &quot;name&quot;: &quot;A# Menor Napolitana&quot;
    },
    {
        &quot;id&quot;: 262,
        &quot;name&quot;: &quot;A# Mayor Napolitana&quot;
    },
    {
        &quot;id&quot;: 263,
        &quot;name&quot;: &quot;A# Persa&quot;
    },
    {
        &quot;id&quot;: 264,
        &quot;name&quot;: &quot;A# Japonesa (In Sen)&quot;
    },
    {
        &quot;id&quot;: 265,
        &quot;name&quot;: &quot;A# Oriental&quot;
    },
    {
        &quot;id&quot;: 266,
        &quot;name&quot;: &quot;A# Egipcia&quot;
    },
    {
        &quot;id&quot;: 267,
        &quot;name&quot;: &quot;A# Lidia Dominante&quot;
    },
    {
        &quot;id&quot;: 268,
        &quot;name&quot;: &quot;A# Escala Alterada&quot;
    },
    {
        &quot;id&quot;: 269,
        &quot;name&quot;: &quot;A# Disminuida Semitono-Tono&quot;
    },
    {
        &quot;id&quot;: 270,
        &quot;name&quot;: &quot;A# Disminuida Tono-Semitono&quot;
    },
    {
        &quot;id&quot;: 271,
        &quot;name&quot;: &quot;B Mayor&quot;
    },
    {
        &quot;id&quot;: 272,
        &quot;name&quot;: &quot;B Menor Natural&quot;
    },
    {
        &quot;id&quot;: 273,
        &quot;name&quot;: &quot;B Menor Arm&oacute;nica&quot;
    },
    {
        &quot;id&quot;: 274,
        &quot;name&quot;: &quot;B Menor Mel&oacute;dica&quot;
    },
    {
        &quot;id&quot;: 275,
        &quot;name&quot;: &quot;B D&oacute;rica&quot;
    },
    {
        &quot;id&quot;: 276,
        &quot;name&quot;: &quot;B Frigia&quot;
    },
    {
        &quot;id&quot;: 277,
        &quot;name&quot;: &quot;B Lidia&quot;
    },
    {
        &quot;id&quot;: 278,
        &quot;name&quot;: &quot;B Mixolidia&quot;
    },
    {
        &quot;id&quot;: 279,
        &quot;name&quot;: &quot;B L&oacute;cria&quot;
    },
    {
        &quot;id&quot;: 280,
        &quot;name&quot;: &quot;B Pentat&oacute;nica Mayor&quot;
    },
    {
        &quot;id&quot;: 281,
        &quot;name&quot;: &quot;B Pentat&oacute;nica Menor&quot;
    },
    {
        &quot;id&quot;: 282,
        &quot;name&quot;: &quot;B Escala de Blues&quot;
    },
    {
        &quot;id&quot;: 283,
        &quot;name&quot;: &quot;B Blues Menor&quot;
    },
    {
        &quot;id&quot;: 284,
        &quot;name&quot;: &quot;B Blues Mayor&quot;
    },
    {
        &quot;id&quot;: 285,
        &quot;name&quot;: &quot;B Crom&aacute;tica&quot;
    },
    {
        &quot;id&quot;: 286,
        &quot;name&quot;: &quot;B Entera&quot;
    },
    {
        &quot;id&quot;: 287,
        &quot;name&quot;: &quot;B Disminuida&quot;
    },
    {
        &quot;id&quot;: 288,
        &quot;name&quot;: &quot;B Aumentada&quot;
    },
    {
        &quot;id&quot;: 289,
        &quot;name&quot;: &quot;B Frigia Espa&ntilde;ola&quot;
    },
    {
        &quot;id&quot;: 290,
        &quot;name&quot;: &quot;B Menor H&uacute;ngara&quot;
    },
    {
        &quot;id&quot;: 291,
        &quot;name&quot;: &quot;B Menor Napolitana&quot;
    },
    {
        &quot;id&quot;: 292,
        &quot;name&quot;: &quot;B Mayor Napolitana&quot;
    },
    {
        &quot;id&quot;: 293,
        &quot;name&quot;: &quot;B Persa&quot;
    },
    {
        &quot;id&quot;: 294,
        &quot;name&quot;: &quot;B Japonesa (In Sen)&quot;
    },
    {
        &quot;id&quot;: 295,
        &quot;name&quot;: &quot;B Oriental&quot;
    },
    {
        &quot;id&quot;: 296,
        &quot;name&quot;: &quot;B Egipcia&quot;
    },
    {
        &quot;id&quot;: 297,
        &quot;name&quot;: &quot;B Lidia Dominante&quot;
    },
    {
        &quot;id&quot;: 298,
        &quot;name&quot;: &quot;B Escala Alterada&quot;
    },
    {
        &quot;id&quot;: 299,
        &quot;name&quot;: &quot;B Disminuida Semitono-Tono&quot;
    },
    {
        &quot;id&quot;: 300,
        &quot;name&quot;: &quot;B Disminuida Tono-Semitono&quot;
    }
]</code>
 </pre>
    </span>
<span id="execution-results-GETapi-song-scales" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-song-scales"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-song-scales"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-song-scales" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-song-scales">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-song-scales" data-method="GET"
      data-path="api/song-scales"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-song-scales', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-song-scales"
                    onclick="tryItOut('GETapi-song-scales');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-song-scales"
                    onclick="cancelTryOut('GETapi-song-scales');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-song-scales"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/song-scales</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-song-scales"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-song-scales"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                <h1 id="favoritos">Favoritos</h1>

    <p>Endpoints para marcar o desmarcar un item como favorito.</p>

                                <h2 id="favoritos-GETapi-users--user_id--favorites">Buscar favoritos de un modelo.</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-GETapi-users--user_id--favorites">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://127.0.0.1:8000/api/users/1/favorites" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://127.0.0.1:8000/api/users/1/favorites"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-users--user_id--favorites">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-users--user_id--favorites" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-users--user_id--favorites"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-users--user_id--favorites"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-users--user_id--favorites" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-users--user_id--favorites">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-users--user_id--favorites" data-method="GET"
      data-path="api/users/{user_id}/favorites"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-users--user_id--favorites', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-users--user_id--favorites"
                    onclick="tryItOut('GETapi-users--user_id--favorites');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-users--user_id--favorites"
                    onclick="cancelTryOut('GETapi-users--user_id--favorites');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-users--user_id--favorites"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/users/{user_id}/favorites</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="GETapi-users--user_id--favorites"
               value="Bearer {YOUR_AUTH_KEY}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {YOUR_AUTH_KEY}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-users--user_id--favorites"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-users--user_id--favorites"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>user_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="user_id"                data-endpoint="GETapi-users--user_id--favorites"
               value="1"
               data-component="url">
    <br>
<p>The ID of the user. Example: <code>1</code></p>
            </div>
                    </form>

                    <h2 id="favoritos-POSTapi-users--user_id--favorites">Marcar un item como favoritos.</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-POSTapi-users--user_id--favorites">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://127.0.0.1:8000/api/users/1/favorites" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"model\": \"Chord\",
    \"favoritable_id\": 73
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://127.0.0.1:8000/api/users/1/favorites"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "model": "Chord",
    "favoritable_id": 73
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-users--user_id--favorites">
</span>
<span id="execution-results-POSTapi-users--user_id--favorites" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-users--user_id--favorites"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-users--user_id--favorites"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-users--user_id--favorites" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-users--user_id--favorites">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-users--user_id--favorites" data-method="POST"
      data-path="api/users/{user_id}/favorites"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-users--user_id--favorites', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-users--user_id--favorites"
                    onclick="tryItOut('POSTapi-users--user_id--favorites');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-users--user_id--favorites"
                    onclick="cancelTryOut('POSTapi-users--user_id--favorites');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-users--user_id--favorites"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/users/{user_id}/favorites</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="POSTapi-users--user_id--favorites"
               value="Bearer {YOUR_AUTH_KEY}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {YOUR_AUTH_KEY}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-users--user_id--favorites"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-users--user_id--favorites"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>user_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="user_id"                data-endpoint="POSTapi-users--user_id--favorites"
               value="1"
               data-component="url">
    <br>
<p>The ID of the user. Example: <code>1</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>model</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="model"                data-endpoint="POSTapi-users--user_id--favorites"
               value="Chord"
               data-component="body">
    <br>
<p>Example: <code>Chord</code></p>
Must be one of:
<ul style="list-style-type: square;"><li><code>Song</code></li> <li><code>Chord</code></li> <li><code>User</code></li></ul>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>favoritable_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="favoritable_id"                data-endpoint="POSTapi-users--user_id--favorites"
               value="73"
               data-component="body">
    <br>
<p>Must be at least 1. Example: <code>73</code></p>
        </div>
        </form>

                    <h2 id="favoritos-DELETEapi-users--user_id--favorites--id-">Desmarcar un item de favoritos.</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-DELETEapi-users--user_id--favorites--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request DELETE \
    "http://127.0.0.1:8000/api/users/1/favorites/1" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://127.0.0.1:8000/api/users/1/favorites/1"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-DELETEapi-users--user_id--favorites--id-">
</span>
<span id="execution-results-DELETEapi-users--user_id--favorites--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-DELETEapi-users--user_id--favorites--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-DELETEapi-users--user_id--favorites--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-DELETEapi-users--user_id--favorites--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEapi-users--user_id--favorites--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-DELETEapi-users--user_id--favorites--id-" data-method="DELETE"
      data-path="api/users/{user_id}/favorites/{id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('DELETEapi-users--user_id--favorites--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-DELETEapi-users--user_id--favorites--id-"
                    onclick="tryItOut('DELETEapi-users--user_id--favorites--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-DELETEapi-users--user_id--favorites--id-"
                    onclick="cancelTryOut('DELETEapi-users--user_id--favorites--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-DELETEapi-users--user_id--favorites--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-red">DELETE</small>
            <b><code>api/users/{user_id}/favorites/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="DELETEapi-users--user_id--favorites--id-"
               value="Bearer {YOUR_AUTH_KEY}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {YOUR_AUTH_KEY}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="DELETEapi-users--user_id--favorites--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="DELETEapi-users--user_id--favorites--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>user_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="user_id"                data-endpoint="DELETEapi-users--user_id--favorites--id-"
               value="1"
               data-component="url">
    <br>
<p>The ID of the user. Example: <code>1</code></p>
            </div>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="DELETEapi-users--user_id--favorites--id-"
               value="1"
               data-component="url">
    <br>
<p>The ID of the favorite. Example: <code>1</code></p>
            </div>
                    </form>

                <h1 id="figura-musical">Figura Musical</h1>

    

                                <h2 id="figura-musical-GETapi-rhythmic-figures">Buscar una figura musical.</h2>

<p>
</p>



<span id="example-requests-GETapi-rhythmic-figures">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://127.0.0.1:8000/api/rhythmic-figures" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://127.0.0.1:8000/api/rhythmic-figures"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-rhythmic-figures">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">[
    {
        &quot;id&quot;: 1,
        &quot;name&quot;: &quot;Redonda&quot;,
        &quot;duration&quot;: &quot;4&quot;
    },
    {
        &quot;id&quot;: 2,
        &quot;name&quot;: &quot;Blanca&quot;,
        &quot;duration&quot;: &quot;2&quot;
    },
    {
        &quot;id&quot;: 3,
        &quot;name&quot;: &quot;Negra&quot;,
        &quot;duration&quot;: &quot;1&quot;
    },
    {
        &quot;id&quot;: 4,
        &quot;name&quot;: &quot;Corchea&quot;,
        &quot;duration&quot;: &quot;0.5&quot;
    }
]</code>
 </pre>
    </span>
<span id="execution-results-GETapi-rhythmic-figures" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-rhythmic-figures"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-rhythmic-figures"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-rhythmic-figures" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-rhythmic-figures">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-rhythmic-figures" data-method="GET"
      data-path="api/rhythmic-figures"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-rhythmic-figures', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-rhythmic-figures"
                    onclick="tryItOut('GETapi-rhythmic-figures');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-rhythmic-figures"
                    onclick="cancelTryOut('GETapi-rhythmic-figures');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-rhythmic-figures"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/rhythmic-figures</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-rhythmic-figures"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-rhythmic-figures"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                <h1 id="genero">Género</h1>

    

                                <h2 id="genero-GETapi-musical-genres">Buscar un género musical.</h2>

<p>
</p>



<span id="example-requests-GETapi-musical-genres">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://127.0.0.1:8000/api/musical-genres" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://127.0.0.1:8000/api/musical-genres"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-musical-genres">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">[
    {
        &quot;id&quot;: 10,
        &quot;name&quot;: &quot;Afrobeat&quot;,
        &quot;description&quot;: &quot;Doloremque ratione.&quot;,
        &quot;color&quot;: &quot;#ff1671&quot;
    },
    {
        &quot;id&quot;: 18,
        &quot;name&quot;: &quot;Ambiental&quot;,
        &quot;description&quot;: &quot;Minus corrupti.&quot;,
        &quot;color&quot;: &quot;#6ba087&quot;
    },
    {
        &quot;id&quot;: 15,
        &quot;name&quot;: &quot;Americana&quot;,
        &quot;description&quot;: &quot;Quibusdam placeat.&quot;,
        &quot;color&quot;: &quot;#bb3926&quot;
    },
    {
        &quot;id&quot;: 40,
        &quot;name&quot;: &quot;Arabesco&quot;,
        &quot;description&quot;: &quot;Aut officia modi.&quot;,
        &quot;color&quot;: &quot;#faccd6&quot;
    },
    {
        &quot;id&quot;: 34,
        &quot;name&quot;: &quot;Bachata&quot;,
        &quot;description&quot;: &quot;Facere distinctio.&quot;,
        &quot;color&quot;: &quot;#5e558a&quot;
    },
    {
        &quot;id&quot;: 51,
        &quot;name&quot;: &quot;Banda Sonora&quot;,
        &quot;description&quot;: &quot;Illum reiciendis.&quot;,
        &quot;color&quot;: &quot;#e9a5e9&quot;
    },
    {
        &quot;id&quot;: 53,
        &quot;name&quot;: &quot;Barroca&quot;,
        &quot;description&quot;: &quot;Ea sunt et deserunt.&quot;,
        &quot;color&quot;: &quot;#0154ec&quot;
    },
    {
        &quot;id&quot;: 35,
        &quot;name&quot;: &quot;Bebop&quot;,
        &quot;description&quot;: &quot;Alias nihil earum.&quot;,
        &quot;color&quot;: &quot;#4eea53&quot;
    },
    {
        &quot;id&quot;: 37,
        &quot;name&quot;: &quot;Bluegrass&quot;,
        &quot;description&quot;: &quot;Ducimus sit dolor.&quot;,
        &quot;color&quot;: &quot;#2f3397&quot;
    },
    {
        &quot;id&quot;: 6,
        &quot;name&quot;: &quot;Blues&quot;,
        &quot;description&quot;: &quot;Eaque officia.&quot;,
        &quot;color&quot;: &quot;#933157&quot;
    },
    {
        &quot;id&quot;: 56,
        &quot;name&quot;: &quot;Bolero&quot;,
        &quot;description&quot;: &quot;Porro est nam.&quot;,
        &quot;color&quot;: &quot;#4921b5&quot;
    },
    {
        &quot;id&quot;: 22,
        &quot;name&quot;: &quot;Bossa Nova&quot;,
        &quot;description&quot;: &quot;Sunt velit quia.&quot;,
        &quot;color&quot;: &quot;#2e32cf&quot;
    },
    {
        &quot;id&quot;: 69,
        &quot;name&quot;: &quot;Celta&quot;,
        &quot;description&quot;: &quot;Est odit aut.&quot;,
        &quot;color&quot;: &quot;#1f3ad8&quot;
    },
    {
        &quot;id&quot;: 54,
        &quot;name&quot;: &quot;Chicago Blues&quot;,
        &quot;description&quot;: &quot;Nesciunt vel.&quot;,
        &quot;color&quot;: &quot;#b4f953&quot;
    },
    {
        &quot;id&quot;: 39,
        &quot;name&quot;: &quot;Chillout&quot;,
        &quot;description&quot;: &quot;Optio veniam et.&quot;,
        &quot;color&quot;: &quot;#e1b17a&quot;
    },
    {
        &quot;id&quot;: 8,
        &quot;name&quot;: &quot;Chiptune&quot;,
        &quot;description&quot;: &quot;Doloremque fugit.&quot;,
        &quot;color&quot;: &quot;#743448&quot;
    },
    {
        &quot;id&quot;: 44,
        &quot;name&quot;: &quot;Cl&aacute;sica&quot;,
        &quot;description&quot;: &quot;Natus debitis aut.&quot;,
        &quot;color&quot;: &quot;#904530&quot;
    },
    {
        &quot;id&quot;: 48,
        &quot;name&quot;: &quot;Cl&aacute;sica India&quot;,
        &quot;description&quot;: &quot;Amet et eos.&quot;,
        &quot;color&quot;: &quot;#48ec38&quot;
    },
    {
        &quot;id&quot;: 43,
        &quot;name&quot;: &quot;Cool Jazz&quot;,
        &quot;description&quot;: &quot;Quis asperiores.&quot;,
        &quot;color&quot;: &quot;#dd155b&quot;
    },
    {
        &quot;id&quot;: 2,
        &quot;name&quot;: &quot;Country&quot;,
        &quot;description&quot;: &quot;Aliquid neque amet.&quot;,
        &quot;color&quot;: &quot;#b777d1&quot;
    },
    {
        &quot;id&quot;: 63,
        &quot;name&quot;: &quot;Cumbia&quot;,
        &quot;description&quot;: &quot;Laudantium amet.&quot;,
        &quot;color&quot;: &quot;#3dcd2d&quot;
    },
    {
        &quot;id&quot;: 4,
        &quot;name&quot;: &quot;Delta Blues&quot;,
        &quot;description&quot;: &quot;Occaecati suscipit.&quot;,
        &quot;color&quot;: &quot;#fbdb41&quot;
    },
    {
        &quot;id&quot;: 33,
        &quot;name&quot;: &quot;Disco&quot;,
        &quot;description&quot;: &quot;Vel aspernatur.&quot;,
        &quot;color&quot;: &quot;#ccc94b&quot;
    },
    {
        &quot;id&quot;: 72,
        &quot;name&quot;: &quot;Drum and Bass&quot;,
        &quot;description&quot;: &quot;Eius sit similique.&quot;,
        &quot;color&quot;: &quot;#5fe308&quot;
    },
    {
        &quot;id&quot;: 26,
        &quot;name&quot;: &quot;Dubstep&quot;,
        &quot;description&quot;: &quot;Sapiente excepturi.&quot;,
        &quot;color&quot;: &quot;#b5a21b&quot;
    },
    {
        &quot;id&quot;: 66,
        &quot;name&quot;: &quot;Educativa&quot;,
        &quot;description&quot;: &quot;Reiciendis sunt.&quot;,
        &quot;color&quot;: &quot;#c2b4ba&quot;
    },
    {
        &quot;id&quot;: 38,
        &quot;name&quot;: &quot;Electro&quot;,
        &quot;description&quot;: &quot;Quaerat eaque.&quot;,
        &quot;color&quot;: &quot;#c7e0bb&quot;
    },
    {
        &quot;id&quot;: 49,
        &quot;name&quot;: &quot;Electr&oacute;nica&quot;,
        &quot;description&quot;: &quot;Quae vel debitis.&quot;,
        &quot;color&quot;: &quot;#fa2805&quot;
    },
    {
        &quot;id&quot;: 62,
        &quot;name&quot;: &quot;Espiritual&quot;,
        &quot;description&quot;: &quot;Quam cum error ab.&quot;,
        &quot;color&quot;: &quot;#3c25aa&quot;
    },
    {
        &quot;id&quot;: 30,
        &quot;name&quot;: &quot;Experimental&quot;,
        &quot;description&quot;: &quot;Ipsam autem qui et.&quot;,
        &quot;color&quot;: &quot;#3d3cd5&quot;
    },
    {
        &quot;id&quot;: 36,
        &quot;name&quot;: &quot;Fado&quot;,
        &quot;description&quot;: &quot;Natus eum corrupti.&quot;,
        &quot;color&quot;: &quot;#cc16d9&quot;
    },
    {
        &quot;id&quot;: 1,
        &quot;name&quot;: &quot;Flamenco&quot;,
        &quot;description&quot;: &quot;Commodi sunt rerum.&quot;,
        &quot;color&quot;: &quot;#48ab95&quot;
    },
    {
        &quot;id&quot;: 47,
        &quot;name&quot;: &quot;Folk&quot;,
        &quot;description&quot;: &quot;Perferendis dolores.&quot;,
        &quot;color&quot;: &quot;#787c63&quot;
    },
    {
        &quot;id&quot;: 77,
        &quot;name&quot;: &quot;Folk Rock&quot;,
        &quot;description&quot;: &quot;Ipsam dicta totam.&quot;,
        &quot;color&quot;: &quot;#5b4a21&quot;
    },
    {
        &quot;id&quot;: 32,
        &quot;name&quot;: &quot;Funk&quot;,
        &quot;description&quot;: &quot;Nihil sapiente et.&quot;,
        &quot;color&quot;: &quot;#9e6800&quot;
    },
    {
        &quot;id&quot;: 75,
        &quot;name&quot;: &quot;Fusi&oacute;n&quot;,
        &quot;description&quot;: &quot;Voluptas ut.&quot;,
        &quot;color&quot;: &quot;#708240&quot;
    },
    {
        &quot;id&quot;: 7,
        &quot;name&quot;: &quot;Garage Rock&quot;,
        &quot;description&quot;: &quot;Aut enim optio sunt.&quot;,
        &quot;color&quot;: &quot;#79f517&quot;
    },
    {
        &quot;id&quot;: 11,
        &quot;name&quot;: &quot;Gnawa&quot;,
        &quot;description&quot;: &quot;Omnis eligendi qui.&quot;,
        &quot;color&quot;: &quot;#12b8cb&quot;
    },
    {
        &quot;id&quot;: 57,
        &quot;name&quot;: &quot;Gospel&quot;,
        &quot;description&quot;: &quot;Error.&quot;,
        &quot;color&quot;: &quot;#17ef7e&quot;
    },
    {
        &quot;id&quot;: 50,
        &quot;name&quot;: &quot;Grunge&quot;,
        &quot;description&quot;: &quot;Nemo voluptatem.&quot;,
        &quot;color&quot;: &quot;#f20318&quot;
    },
    {
        &quot;id&quot;: 64,
        &quot;name&quot;: &quot;Hard Rock&quot;,
        &quot;description&quot;: &quot;Aut ut aut illo.&quot;,
        &quot;color&quot;: &quot;#27e092&quot;
    },
    {
        &quot;id&quot;: 9,
        &quot;name&quot;: &quot;Highlife&quot;,
        &quot;description&quot;: &quot;Dolorem eum et et.&quot;,
        &quot;color&quot;: &quot;#ff2847&quot;
    },
    {
        &quot;id&quot;: 67,
        &quot;name&quot;: &quot;Hip Hop&quot;,
        &quot;description&quot;: &quot;Soluta hic.&quot;,
        &quot;color&quot;: &quot;#46377b&quot;
    },
    {
        &quot;id&quot;: 41,
        &quot;name&quot;: &quot;House&quot;,
        &quot;description&quot;: &quot;Doloremque et ullam.&quot;,
        &quot;color&quot;: &quot;#f6cc03&quot;
    },
    {
        &quot;id&quot;: 74,
        &quot;name&quot;: &quot;Indie Rock&quot;,
        &quot;description&quot;: &quot;Qui rerum nesciunt.&quot;,
        &quot;color&quot;: &quot;#0da3ca&quot;
    },
    {
        &quot;id&quot;: 68,
        &quot;name&quot;: &quot;Industrial&quot;,
        &quot;description&quot;: &quot;Autem reprehenderit.&quot;,
        &quot;color&quot;: &quot;#e21aa4&quot;
    },
    {
        &quot;id&quot;: 55,
        &quot;name&quot;: &quot;Infantil&quot;,
        &quot;description&quot;: &quot;Atque ullam.&quot;,
        &quot;color&quot;: &quot;#386b43&quot;
    },
    {
        &quot;id&quot;: 46,
        &quot;name&quot;: &quot;J-Pop&quot;,
        &quot;description&quot;: &quot;Nulla dolore eos.&quot;,
        &quot;color&quot;: &quot;#2fe7f5&quot;
    },
    {
        &quot;id&quot;: 14,
        &quot;name&quot;: &quot;Jazz&quot;,
        &quot;description&quot;: &quot;Et possimus labore.&quot;,
        &quot;color&quot;: &quot;#2227c2&quot;
    },
    {
        &quot;id&quot;: 13,
        &quot;name&quot;: &quot;K-Pop&quot;,
        &quot;description&quot;: &quot;Quo maxime.&quot;,
        &quot;color&quot;: &quot;#2f769e&quot;
    },
    {
        &quot;id&quot;: 24,
        &quot;name&quot;: &quot;Lo-fi&quot;,
        &quot;description&quot;: &quot;Velit perspiciatis.&quot;,
        &quot;color&quot;: &quot;#e16596&quot;
    },
    {
        &quot;id&quot;: 59,
        &quot;name&quot;: &quot;Mariachi&quot;,
        &quot;description&quot;: &quot;Laborum in ex eum.&quot;,
        &quot;color&quot;: &quot;#524ad9&quot;
    },
    {
        &quot;id&quot;: 3,
        &quot;name&quot;: &quot;Merengue&quot;,
        &quot;description&quot;: &quot;Praesentium qui ut.&quot;,
        &quot;color&quot;: &quot;#873b06&quot;
    },
    {
        &quot;id&quot;: 27,
        &quot;name&quot;: &quot;Metal&quot;,
        &quot;description&quot;: &quot;Molestias et culpa.&quot;,
        &quot;color&quot;: &quot;#e64de1&quot;
    },
    {
        &quot;id&quot;: 45,
        &quot;name&quot;: &quot;M&uacute;sica de C&aacute;mara&quot;,
        &quot;description&quot;: &quot;Aperiam aut sunt.&quot;,
        &quot;color&quot;: &quot;#f2713d&quot;
    },
    {
        &quot;id&quot;: 73,
        &quot;name&quot;: &quot;Noise&quot;,
        &quot;description&quot;: &quot;Incidunt quo eos.&quot;,
        &quot;color&quot;: &quot;#a2ef65&quot;
    },
    {
        &quot;id&quot;: 58,
        &quot;name&quot;: &quot;&Oacute;pera&quot;,
        &quot;description&quot;: &quot;Laboriosam dicta.&quot;,
        &quot;color&quot;: &quot;#620708&quot;
    },
    {
        &quot;id&quot;: 25,
        &quot;name&quot;: &quot;Orquestal&quot;,
        &quot;description&quot;: &quot;Nihil quis quo in.&quot;,
        &quot;color&quot;: &quot;#09f91c&quot;
    },
    {
        &quot;id&quot;: 23,
        &quot;name&quot;: &quot;Pop&quot;,
        &quot;description&quot;: &quot;Ea aut sunt.&quot;,
        &quot;color&quot;: &quot;#8de889&quot;
    },
    {
        &quot;id&quot;: 42,
        &quot;name&quot;: &quot;Pop Ambiental&quot;,
        &quot;description&quot;: &quot;Voluptatem itaque.&quot;,
        &quot;color&quot;: &quot;#ce1ae7&quot;
    },
    {
        &quot;id&quot;: 31,
        &quot;name&quot;: &quot;Punk&quot;,
        &quot;description&quot;: &quot;Tempora veniam.&quot;,
        &quot;color&quot;: &quot;#ec9ad8&quot;
    },
    {
        &quot;id&quot;: 65,
        &quot;name&quot;: &quot;R&amp;B&quot;,
        &quot;description&quot;: &quot;Omnis et aliquam.&quot;,
        &quot;color&quot;: &quot;#afa177&quot;
    },
    {
        &quot;id&quot;: 20,
        &quot;name&quot;: &quot;Rap&quot;,
        &quot;description&quot;: &quot;Earum aut et sint.&quot;,
        &quot;color&quot;: &quot;#cbfc9d&quot;
    },
    {
        &quot;id&quot;: 60,
        &quot;name&quot;: &quot;Reggae&quot;,
        &quot;description&quot;: &quot;Nostrum et enim.&quot;,
        &quot;color&quot;: &quot;#73305c&quot;
    },
    {
        &quot;id&quot;: 61,
        &quot;name&quot;: &quot;Reggaet&oacute;n&quot;,
        &quot;description&quot;: &quot;Eos qui.&quot;,
        &quot;color&quot;: &quot;#2c7faf&quot;
    },
    {
        &quot;id&quot;: 76,
        &quot;name&quot;: &quot;Rock&quot;,
        &quot;description&quot;: &quot;Omnis minus iure.&quot;,
        &quot;color&quot;: &quot;#2b6b99&quot;
    },
    {
        &quot;id&quot;: 71,
        &quot;name&quot;: &quot;Rock Alternativo&quot;,
        &quot;description&quot;: &quot;Commodi accusamus.&quot;,
        &quot;color&quot;: &quot;#5512f3&quot;
    },
    {
        &quot;id&quot;: 16,
        &quot;name&quot;: &quot;Rock Progresivo&quot;,
        &quot;description&quot;: &quot;Similique.&quot;,
        &quot;color&quot;: &quot;#0054ca&quot;
    },
    {
        &quot;id&quot;: 5,
        &quot;name&quot;: &quot;Rom&aacute;ntica&quot;,
        &quot;description&quot;: &quot;Aut dolorem rerum.&quot;,
        &quot;color&quot;: &quot;#cd0b0a&quot;
    },
    {
        &quot;id&quot;: 12,
        &quot;name&quot;: &quot;Salsa&quot;,
        &quot;description&quot;: &quot;Doloribus maiores.&quot;,
        &quot;color&quot;: &quot;#99d338&quot;
    },
    {
        &quot;id&quot;: 52,
        &quot;name&quot;: &quot;Samba&quot;,
        &quot;description&quot;: &quot;Modi perferendis.&quot;,
        &quot;color&quot;: &quot;#69c12d&quot;
    },
    {
        &quot;id&quot;: 70,
        &quot;name&quot;: &quot;Soul&quot;,
        &quot;description&quot;: &quot;Harum et dolorum.&quot;,
        &quot;color&quot;: &quot;#a6bf36&quot;
    },
    {
        &quot;id&quot;: 21,
        &quot;name&quot;: &quot;Swing&quot;,
        &quot;description&quot;: &quot;Recusandae sequi.&quot;,
        &quot;color&quot;: &quot;#8f3079&quot;
    },
    {
        &quot;id&quot;: 19,
        &quot;name&quot;: &quot;Synthwave&quot;,
        &quot;description&quot;: &quot;Accusamus dolores.&quot;,
        &quot;color&quot;: &quot;#ff2cd1&quot;
    },
    {
        &quot;id&quot;: 28,
        &quot;name&quot;: &quot;Tango&quot;,
        &quot;description&quot;: &quot;Blanditiis est.&quot;,
        &quot;color&quot;: &quot;#3690c1&quot;
    },
    {
        &quot;id&quot;: 29,
        &quot;name&quot;: &quot;Techno&quot;,
        &quot;description&quot;: &quot;Omnis distinctio.&quot;,
        &quot;color&quot;: &quot;#182983&quot;
    },
    {
        &quot;id&quot;: 17,
        &quot;name&quot;: &quot;Trance&quot;,
        &quot;description&quot;: &quot;Nam vel.&quot;,
        &quot;color&quot;: &quot;#55b1de&quot;
    }
]</code>
 </pre>
    </span>
<span id="execution-results-GETapi-musical-genres" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-musical-genres"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-musical-genres"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-musical-genres" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-musical-genres">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-musical-genres" data-method="GET"
      data-path="api/musical-genres"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-musical-genres', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-musical-genres"
                    onclick="tryItOut('GETapi-musical-genres');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-musical-genres"
                    onclick="cancelTryOut('GETapi-musical-genres');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-musical-genres"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/musical-genres</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-musical-genres"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-musical-genres"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                <h1 id="metrica">Métrica</h1>

    

                                <h2 id="metrica-GETapi-song-metrics">Buscar una métrica musical.</h2>

<p>
</p>



<span id="example-requests-GETapi-song-metrics">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://127.0.0.1:8000/api/song-metrics" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://127.0.0.1:8000/api/song-metrics"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-song-metrics">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">[
    {
        &quot;id&quot;: 1,
        &quot;name&quot;: &quot;2/4&quot;
    },
    {
        &quot;id&quot;: 2,
        &quot;name&quot;: &quot;3/4&quot;
    },
    {
        &quot;id&quot;: 3,
        &quot;name&quot;: &quot;4/4&quot;
    },
    {
        &quot;id&quot;: 4,
        &quot;name&quot;: &quot;5/4&quot;
    },
    {
        &quot;id&quot;: 5,
        &quot;name&quot;: &quot;6/4&quot;
    },
    {
        &quot;id&quot;: 6,
        &quot;name&quot;: &quot;7/4&quot;
    },
    {
        &quot;id&quot;: 7,
        &quot;name&quot;: &quot;8/4&quot;
    },
    {
        &quot;id&quot;: 8,
        &quot;name&quot;: &quot;2/8&quot;
    },
    {
        &quot;id&quot;: 9,
        &quot;name&quot;: &quot;3/8&quot;
    },
    {
        &quot;id&quot;: 10,
        &quot;name&quot;: &quot;4/8&quot;
    },
    {
        &quot;id&quot;: 11,
        &quot;name&quot;: &quot;5/8&quot;
    },
    {
        &quot;id&quot;: 12,
        &quot;name&quot;: &quot;6/8&quot;
    },
    {
        &quot;id&quot;: 13,
        &quot;name&quot;: &quot;7/8&quot;
    },
    {
        &quot;id&quot;: 14,
        &quot;name&quot;: &quot;9/8&quot;
    },
    {
        &quot;id&quot;: 15,
        &quot;name&quot;: &quot;12/8&quot;
    },
    {
        &quot;id&quot;: 16,
        &quot;name&quot;: &quot;6/8&quot;
    },
    {
        &quot;id&quot;: 17,
        &quot;name&quot;: &quot;9/8&quot;
    },
    {
        &quot;id&quot;: 18,
        &quot;name&quot;: &quot;12/8&quot;
    },
    {
        &quot;id&quot;: 19,
        &quot;name&quot;: &quot;5/8&quot;
    },
    {
        &quot;id&quot;: 20,
        &quot;name&quot;: &quot;7/8&quot;
    },
    {
        &quot;id&quot;: 21,
        &quot;name&quot;: &quot;11/8&quot;
    },
    {
        &quot;id&quot;: 22,
        &quot;name&quot;: &quot;13/8&quot;
    },
    {
        &quot;id&quot;: 23,
        &quot;name&quot;: &quot;15/8&quot;
    },
    {
        &quot;id&quot;: 24,
        &quot;name&quot;: &quot;3/2&quot;
    },
    {
        &quot;id&quot;: 25,
        &quot;name&quot;: &quot;4/2&quot;
    },
    {
        &quot;id&quot;: 26,
        &quot;name&quot;: &quot;5/2&quot;
    },
    {
        &quot;id&quot;: 27,
        &quot;name&quot;: &quot;7/2&quot;
    },
    {
        &quot;id&quot;: 28,
        &quot;name&quot;: &quot;9/4&quot;
    },
    {
        &quot;id&quot;: 29,
        &quot;name&quot;: &quot;12/4&quot;
    }
]</code>
 </pre>
    </span>
<span id="execution-results-GETapi-song-metrics" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-song-metrics"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-song-metrics"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-song-metrics" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-song-metrics">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-song-metrics" data-method="GET"
      data-path="api/song-metrics"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-song-metrics', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-song-metrics"
                    onclick="tryItOut('GETapi-song-metrics');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-song-metrics"
                    onclick="cancelTryOut('GETapi-song-metrics');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-song-metrics"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/song-metrics</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-song-metrics"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-song-metrics"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                <h1 id="notas-musicales">Notas Musicales</h1>

    <p>Endpoints para administrar las notas musicales dentro de una compás.</p>

                                <h2 id="notas-musicales-GETapi-songs--song_id--compasses--compass_id--musicalNotes">Mostrar notas musicales.</h2>

<p>
</p>



<span id="example-requests-GETapi-songs--song_id--compasses--compass_id--musicalNotes">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://127.0.0.1:8000/api/songs/1/compasses/1/musicalNotes" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://127.0.0.1:8000/api/songs/1/compasses/1/musicalNotes"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-songs--song_id--compasses--compass_id--musicalNotes">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-songs--song_id--compasses--compass_id--musicalNotes" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-songs--song_id--compasses--compass_id--musicalNotes"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-songs--song_id--compasses--compass_id--musicalNotes"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-songs--song_id--compasses--compass_id--musicalNotes" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-songs--song_id--compasses--compass_id--musicalNotes">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-songs--song_id--compasses--compass_id--musicalNotes" data-method="GET"
      data-path="api/songs/{song_id}/compasses/{compass_id}/musicalNotes"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-songs--song_id--compasses--compass_id--musicalNotes', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-songs--song_id--compasses--compass_id--musicalNotes"
                    onclick="tryItOut('GETapi-songs--song_id--compasses--compass_id--musicalNotes');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-songs--song_id--compasses--compass_id--musicalNotes"
                    onclick="cancelTryOut('GETapi-songs--song_id--compasses--compass_id--musicalNotes');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-songs--song_id--compasses--compass_id--musicalNotes"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/songs/{song_id}/compasses/{compass_id}/musicalNotes</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-songs--song_id--compasses--compass_id--musicalNotes"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-songs--song_id--compasses--compass_id--musicalNotes"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>song_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="song_id"                data-endpoint="GETapi-songs--song_id--compasses--compass_id--musicalNotes"
               value="1"
               data-component="url">
    <br>
<p>The ID of the song. Example: <code>1</code></p>
            </div>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>compass_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="compass_id"                data-endpoint="GETapi-songs--song_id--compasses--compass_id--musicalNotes"
               value="1"
               data-component="url">
    <br>
<p>The ID of the compass. Example: <code>1</code></p>
            </div>
                    </form>

                    <h2 id="notas-musicales-POSTapi-songs--song_id--compasses--compass_id--musicalNotes">Añadir un nueva nota musical.</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-POSTapi-songs--song_id--compasses--compass_id--musicalNotes">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://127.0.0.1:8000/api/songs/1/compasses/1/musicalNotes" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"chord_id\": 17,
    \"lyrics\": \"mqeopfuudtdsufvyvddqa\",
    \"is_dotted\": true,
    \"is_silence\": false,
    \"rhythmic_figure_id\": 17
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://127.0.0.1:8000/api/songs/1/compasses/1/musicalNotes"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "chord_id": 17,
    "lyrics": "mqeopfuudtdsufvyvddqa",
    "is_dotted": true,
    "is_silence": false,
    "rhythmic_figure_id": 17
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-songs--song_id--compasses--compass_id--musicalNotes">
</span>
<span id="execution-results-POSTapi-songs--song_id--compasses--compass_id--musicalNotes" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-songs--song_id--compasses--compass_id--musicalNotes"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-songs--song_id--compasses--compass_id--musicalNotes"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-songs--song_id--compasses--compass_id--musicalNotes" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-songs--song_id--compasses--compass_id--musicalNotes">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-songs--song_id--compasses--compass_id--musicalNotes" data-method="POST"
      data-path="api/songs/{song_id}/compasses/{compass_id}/musicalNotes"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-songs--song_id--compasses--compass_id--musicalNotes', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-songs--song_id--compasses--compass_id--musicalNotes"
                    onclick="tryItOut('POSTapi-songs--song_id--compasses--compass_id--musicalNotes');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-songs--song_id--compasses--compass_id--musicalNotes"
                    onclick="cancelTryOut('POSTapi-songs--song_id--compasses--compass_id--musicalNotes');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-songs--song_id--compasses--compass_id--musicalNotes"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/songs/{song_id}/compasses/{compass_id}/musicalNotes</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="POSTapi-songs--song_id--compasses--compass_id--musicalNotes"
               value="Bearer {YOUR_AUTH_KEY}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {YOUR_AUTH_KEY}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-songs--song_id--compasses--compass_id--musicalNotes"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-songs--song_id--compasses--compass_id--musicalNotes"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>song_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="song_id"                data-endpoint="POSTapi-songs--song_id--compasses--compass_id--musicalNotes"
               value="1"
               data-component="url">
    <br>
<p>The ID of the song. Example: <code>1</code></p>
            </div>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>compass_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="compass_id"                data-endpoint="POSTapi-songs--song_id--compasses--compass_id--musicalNotes"
               value="1"
               data-component="url">
    <br>
<p>The ID of the compass. Example: <code>1</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>chord_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="chord_id"                data-endpoint="POSTapi-songs--song_id--compasses--compass_id--musicalNotes"
               value="17"
               data-component="body">
    <br>
<p>The <code>id</code> of an existing record in the chords table. Example: <code>17</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>lyrics</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="lyrics"                data-endpoint="POSTapi-songs--song_id--compasses--compass_id--musicalNotes"
               value="mqeopfuudtdsufvyvddqa"
               data-component="body">
    <br>
<p>Must not be greater than 255 characters. Example: <code>mqeopfuudtdsufvyvddqa</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>is_dotted</code></b>&nbsp;&nbsp;
<small>boolean</small>&nbsp;
<i>optional</i> &nbsp;
                <label data-endpoint="POSTapi-songs--song_id--compasses--compass_id--musicalNotes" style="display: none">
            <input type="radio" name="is_dotted"
                   value="true"
                   data-endpoint="POSTapi-songs--song_id--compasses--compass_id--musicalNotes"
                   data-component="body"             >
            <code>true</code>
        </label>
        <label data-endpoint="POSTapi-songs--song_id--compasses--compass_id--musicalNotes" style="display: none">
            <input type="radio" name="is_dotted"
                   value="false"
                   data-endpoint="POSTapi-songs--song_id--compasses--compass_id--musicalNotes"
                   data-component="body"             >
            <code>false</code>
        </label>
    <br>
<p>Example: <code>true</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>is_silence</code></b>&nbsp;&nbsp;
<small>boolean</small>&nbsp;
<i>optional</i> &nbsp;
                <label data-endpoint="POSTapi-songs--song_id--compasses--compass_id--musicalNotes" style="display: none">
            <input type="radio" name="is_silence"
                   value="true"
                   data-endpoint="POSTapi-songs--song_id--compasses--compass_id--musicalNotes"
                   data-component="body"             >
            <code>true</code>
        </label>
        <label data-endpoint="POSTapi-songs--song_id--compasses--compass_id--musicalNotes" style="display: none">
            <input type="radio" name="is_silence"
                   value="false"
                   data-endpoint="POSTapi-songs--song_id--compasses--compass_id--musicalNotes"
                   data-component="body"             >
            <code>false</code>
        </label>
    <br>
<p>Example: <code>false</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>rhythmic_figure_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="rhythmic_figure_id"                data-endpoint="POSTapi-songs--song_id--compasses--compass_id--musicalNotes"
               value="17"
               data-component="body">
    <br>
<p>The <code>id</code> of an existing record in the rhythmic_figures table. Example: <code>17</code></p>
        </div>
        </form>

                    <h2 id="notas-musicales-GETapi-songs--song_id--compasses--compass_id--musicalNotes--id-">Mostrar una nota musical.</h2>

<p>
</p>



<span id="example-requests-GETapi-songs--song_id--compasses--compass_id--musicalNotes--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://127.0.0.1:8000/api/songs/1/compasses/1/musicalNotes/1" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://127.0.0.1:8000/api/songs/1/compasses/1/musicalNotes/1"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-songs--song_id--compasses--compass_id--musicalNotes--id-">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-songs--song_id--compasses--compass_id--musicalNotes--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-songs--song_id--compasses--compass_id--musicalNotes--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-songs--song_id--compasses--compass_id--musicalNotes--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-songs--song_id--compasses--compass_id--musicalNotes--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-songs--song_id--compasses--compass_id--musicalNotes--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-songs--song_id--compasses--compass_id--musicalNotes--id-" data-method="GET"
      data-path="api/songs/{song_id}/compasses/{compass_id}/musicalNotes/{id}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-songs--song_id--compasses--compass_id--musicalNotes--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-songs--song_id--compasses--compass_id--musicalNotes--id-"
                    onclick="tryItOut('GETapi-songs--song_id--compasses--compass_id--musicalNotes--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-songs--song_id--compasses--compass_id--musicalNotes--id-"
                    onclick="cancelTryOut('GETapi-songs--song_id--compasses--compass_id--musicalNotes--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-songs--song_id--compasses--compass_id--musicalNotes--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/songs/{song_id}/compasses/{compass_id}/musicalNotes/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-songs--song_id--compasses--compass_id--musicalNotes--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-songs--song_id--compasses--compass_id--musicalNotes--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>song_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="song_id"                data-endpoint="GETapi-songs--song_id--compasses--compass_id--musicalNotes--id-"
               value="1"
               data-component="url">
    <br>
<p>The ID of the song. Example: <code>1</code></p>
            </div>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>compass_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="compass_id"                data-endpoint="GETapi-songs--song_id--compasses--compass_id--musicalNotes--id-"
               value="1"
               data-component="url">
    <br>
<p>The ID of the compass. Example: <code>1</code></p>
            </div>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="GETapi-songs--song_id--compasses--compass_id--musicalNotes--id-"
               value="1"
               data-component="url">
    <br>
<p>The ID of the musicalNote. Example: <code>1</code></p>
            </div>
                    </form>

                    <h2 id="notas-musicales-PUTapi-songs--song_id--compasses--compass_id--musicalNotes--id-">Actualizar una nota.</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-PUTapi-songs--song_id--compasses--compass_id--musicalNotes--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PUT \
    "http://127.0.0.1:8000/api/songs/1/compasses/1/musicalNotes/1" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"chord_id\": 17,
    \"lyrics\": \"mqeopfuudtdsufvyvddqa\",
    \"is_dotted\": true,
    \"is_silence\": true,
    \"rhythmic_figure_id\": 17
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://127.0.0.1:8000/api/songs/1/compasses/1/musicalNotes/1"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "chord_id": 17,
    "lyrics": "mqeopfuudtdsufvyvddqa",
    "is_dotted": true,
    "is_silence": true,
    "rhythmic_figure_id": 17
};

fetch(url, {
    method: "PUT",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-PUTapi-songs--song_id--compasses--compass_id--musicalNotes--id-">
</span>
<span id="execution-results-PUTapi-songs--song_id--compasses--compass_id--musicalNotes--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PUTapi-songs--song_id--compasses--compass_id--musicalNotes--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PUTapi-songs--song_id--compasses--compass_id--musicalNotes--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-PUTapi-songs--song_id--compasses--compass_id--musicalNotes--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PUTapi-songs--song_id--compasses--compass_id--musicalNotes--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-PUTapi-songs--song_id--compasses--compass_id--musicalNotes--id-" data-method="PUT"
      data-path="api/songs/{song_id}/compasses/{compass_id}/musicalNotes/{id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PUTapi-songs--song_id--compasses--compass_id--musicalNotes--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-PUTapi-songs--song_id--compasses--compass_id--musicalNotes--id-"
                    onclick="tryItOut('PUTapi-songs--song_id--compasses--compass_id--musicalNotes--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-PUTapi-songs--song_id--compasses--compass_id--musicalNotes--id-"
                    onclick="cancelTryOut('PUTapi-songs--song_id--compasses--compass_id--musicalNotes--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-PUTapi-songs--song_id--compasses--compass_id--musicalNotes--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-darkblue">PUT</small>
            <b><code>api/songs/{song_id}/compasses/{compass_id}/musicalNotes/{id}</code></b>
        </p>
            <p>
            <small class="badge badge-purple">PATCH</small>
            <b><code>api/songs/{song_id}/compasses/{compass_id}/musicalNotes/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="PUTapi-songs--song_id--compasses--compass_id--musicalNotes--id-"
               value="Bearer {YOUR_AUTH_KEY}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {YOUR_AUTH_KEY}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="PUTapi-songs--song_id--compasses--compass_id--musicalNotes--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="PUTapi-songs--song_id--compasses--compass_id--musicalNotes--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>song_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="song_id"                data-endpoint="PUTapi-songs--song_id--compasses--compass_id--musicalNotes--id-"
               value="1"
               data-component="url">
    <br>
<p>The ID of the song. Example: <code>1</code></p>
            </div>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>compass_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="compass_id"                data-endpoint="PUTapi-songs--song_id--compasses--compass_id--musicalNotes--id-"
               value="1"
               data-component="url">
    <br>
<p>The ID of the compass. Example: <code>1</code></p>
            </div>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="PUTapi-songs--song_id--compasses--compass_id--musicalNotes--id-"
               value="1"
               data-component="url">
    <br>
<p>The ID of the musicalNote. Example: <code>1</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>chord_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="chord_id"                data-endpoint="PUTapi-songs--song_id--compasses--compass_id--musicalNotes--id-"
               value="17"
               data-component="body">
    <br>
<p>The <code>id</code> of an existing record in the chords table. Example: <code>17</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>lyrics</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="lyrics"                data-endpoint="PUTapi-songs--song_id--compasses--compass_id--musicalNotes--id-"
               value="mqeopfuudtdsufvyvddqa"
               data-component="body">
    <br>
<p>Must not be greater than 255 characters. Example: <code>mqeopfuudtdsufvyvddqa</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>is_dotted</code></b>&nbsp;&nbsp;
<small>boolean</small>&nbsp;
<i>optional</i> &nbsp;
                <label data-endpoint="PUTapi-songs--song_id--compasses--compass_id--musicalNotes--id-" style="display: none">
            <input type="radio" name="is_dotted"
                   value="true"
                   data-endpoint="PUTapi-songs--song_id--compasses--compass_id--musicalNotes--id-"
                   data-component="body"             >
            <code>true</code>
        </label>
        <label data-endpoint="PUTapi-songs--song_id--compasses--compass_id--musicalNotes--id-" style="display: none">
            <input type="radio" name="is_dotted"
                   value="false"
                   data-endpoint="PUTapi-songs--song_id--compasses--compass_id--musicalNotes--id-"
                   data-component="body"             >
            <code>false</code>
        </label>
    <br>
<p>Example: <code>true</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>is_silence</code></b>&nbsp;&nbsp;
<small>boolean</small>&nbsp;
<i>optional</i> &nbsp;
                <label data-endpoint="PUTapi-songs--song_id--compasses--compass_id--musicalNotes--id-" style="display: none">
            <input type="radio" name="is_silence"
                   value="true"
                   data-endpoint="PUTapi-songs--song_id--compasses--compass_id--musicalNotes--id-"
                   data-component="body"             >
            <code>true</code>
        </label>
        <label data-endpoint="PUTapi-songs--song_id--compasses--compass_id--musicalNotes--id-" style="display: none">
            <input type="radio" name="is_silence"
                   value="false"
                   data-endpoint="PUTapi-songs--song_id--compasses--compass_id--musicalNotes--id-"
                   data-component="body"             >
            <code>false</code>
        </label>
    <br>
<p>Example: <code>true</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>rhythmic_figure_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="rhythmic_figure_id"                data-endpoint="PUTapi-songs--song_id--compasses--compass_id--musicalNotes--id-"
               value="17"
               data-component="body">
    <br>
<p>The <code>id</code> of an existing record in the rhythmic_figures table. Example: <code>17</code></p>
        </div>
        </form>

                    <h2 id="notas-musicales-DELETEapi-songs--song_id--compasses--compass_id--musicalNotes--id-">Eliminar una nota musical.</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-DELETEapi-songs--song_id--compasses--compass_id--musicalNotes--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request DELETE \
    "http://127.0.0.1:8000/api/songs/1/compasses/1/musicalNotes/1" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://127.0.0.1:8000/api/songs/1/compasses/1/musicalNotes/1"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-DELETEapi-songs--song_id--compasses--compass_id--musicalNotes--id-">
</span>
<span id="execution-results-DELETEapi-songs--song_id--compasses--compass_id--musicalNotes--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-DELETEapi-songs--song_id--compasses--compass_id--musicalNotes--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-DELETEapi-songs--song_id--compasses--compass_id--musicalNotes--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-DELETEapi-songs--song_id--compasses--compass_id--musicalNotes--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEapi-songs--song_id--compasses--compass_id--musicalNotes--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-DELETEapi-songs--song_id--compasses--compass_id--musicalNotes--id-" data-method="DELETE"
      data-path="api/songs/{song_id}/compasses/{compass_id}/musicalNotes/{id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('DELETEapi-songs--song_id--compasses--compass_id--musicalNotes--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-DELETEapi-songs--song_id--compasses--compass_id--musicalNotes--id-"
                    onclick="tryItOut('DELETEapi-songs--song_id--compasses--compass_id--musicalNotes--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-DELETEapi-songs--song_id--compasses--compass_id--musicalNotes--id-"
                    onclick="cancelTryOut('DELETEapi-songs--song_id--compasses--compass_id--musicalNotes--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-DELETEapi-songs--song_id--compasses--compass_id--musicalNotes--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-red">DELETE</small>
            <b><code>api/songs/{song_id}/compasses/{compass_id}/musicalNotes/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="DELETEapi-songs--song_id--compasses--compass_id--musicalNotes--id-"
               value="Bearer {YOUR_AUTH_KEY}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {YOUR_AUTH_KEY}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="DELETEapi-songs--song_id--compasses--compass_id--musicalNotes--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="DELETEapi-songs--song_id--compasses--compass_id--musicalNotes--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>song_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="song_id"                data-endpoint="DELETEapi-songs--song_id--compasses--compass_id--musicalNotes--id-"
               value="1"
               data-component="url">
    <br>
<p>The ID of the song. Example: <code>1</code></p>
            </div>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>compass_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="compass_id"                data-endpoint="DELETEapi-songs--song_id--compasses--compass_id--musicalNotes--id-"
               value="1"
               data-component="url">
    <br>
<p>The ID of the compass. Example: <code>1</code></p>
            </div>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="DELETEapi-songs--song_id--compasses--compass_id--musicalNotes--id-"
               value="1"
               data-component="url">
    <br>
<p>The ID of the musicalNote. Example: <code>1</code></p>
            </div>
                    </form>

                <h1 id="resenas-de-canciones">Reseñas de Canciones</h1>

    <p>Endpoints para dejar reseñas.</p>

                                <h2 id="resenas-de-canciones-POSTapi-songs--song_id--reviews">Guardar una reseña</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-POSTapi-songs--song_id--reviews">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://127.0.0.1:8000/api/songs/1/reviews" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"rating\": 5,
    \"user_id\": 17
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://127.0.0.1:8000/api/songs/1/reviews"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "rating": 5,
    "user_id": 17
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-songs--song_id--reviews">
</span>
<span id="execution-results-POSTapi-songs--song_id--reviews" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-songs--song_id--reviews"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-songs--song_id--reviews"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-songs--song_id--reviews" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-songs--song_id--reviews">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-songs--song_id--reviews" data-method="POST"
      data-path="api/songs/{song_id}/reviews"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-songs--song_id--reviews', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-songs--song_id--reviews"
                    onclick="tryItOut('POSTapi-songs--song_id--reviews');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-songs--song_id--reviews"
                    onclick="cancelTryOut('POSTapi-songs--song_id--reviews');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-songs--song_id--reviews"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/songs/{song_id}/reviews</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="POSTapi-songs--song_id--reviews"
               value="Bearer {YOUR_AUTH_KEY}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {YOUR_AUTH_KEY}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-songs--song_id--reviews"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-songs--song_id--reviews"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>song_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="song_id"                data-endpoint="POSTapi-songs--song_id--reviews"
               value="1"
               data-component="url">
    <br>
<p>The ID of the song. Example: <code>1</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>rating</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="rating"                data-endpoint="POSTapi-songs--song_id--reviews"
               value="5"
               data-component="body">
    <br>
<p>Must be at least 1. Must not be greater than 5. Example: <code>5</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>user_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="user_id"                data-endpoint="POSTapi-songs--song_id--reviews"
               value="17"
               data-component="body">
    <br>
<p>The <code>id</code> of an existing record in the users table. Example: <code>17</code></p>
        </div>
        </form>

                    <h2 id="resenas-de-canciones-PUTapi-songs--song_id--reviews--id-">Actualizar una reseña</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-PUTapi-songs--song_id--reviews--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PUT \
    "http://127.0.0.1:8000/api/songs/1/reviews/1" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"rating\": 5,
    \"user_id\": 17
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://127.0.0.1:8000/api/songs/1/reviews/1"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "rating": 5,
    "user_id": 17
};

fetch(url, {
    method: "PUT",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-PUTapi-songs--song_id--reviews--id-">
</span>
<span id="execution-results-PUTapi-songs--song_id--reviews--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PUTapi-songs--song_id--reviews--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PUTapi-songs--song_id--reviews--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-PUTapi-songs--song_id--reviews--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PUTapi-songs--song_id--reviews--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-PUTapi-songs--song_id--reviews--id-" data-method="PUT"
      data-path="api/songs/{song_id}/reviews/{id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PUTapi-songs--song_id--reviews--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-PUTapi-songs--song_id--reviews--id-"
                    onclick="tryItOut('PUTapi-songs--song_id--reviews--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-PUTapi-songs--song_id--reviews--id-"
                    onclick="cancelTryOut('PUTapi-songs--song_id--reviews--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-PUTapi-songs--song_id--reviews--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-darkblue">PUT</small>
            <b><code>api/songs/{song_id}/reviews/{id}</code></b>
        </p>
            <p>
            <small class="badge badge-purple">PATCH</small>
            <b><code>api/songs/{song_id}/reviews/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="PUTapi-songs--song_id--reviews--id-"
               value="Bearer {YOUR_AUTH_KEY}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {YOUR_AUTH_KEY}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="PUTapi-songs--song_id--reviews--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="PUTapi-songs--song_id--reviews--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>song_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="song_id"                data-endpoint="PUTapi-songs--song_id--reviews--id-"
               value="1"
               data-component="url">
    <br>
<p>The ID of the song. Example: <code>1</code></p>
            </div>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="PUTapi-songs--song_id--reviews--id-"
               value="1"
               data-component="url">
    <br>
<p>The ID of the review. Example: <code>1</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>rating</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="rating"                data-endpoint="PUTapi-songs--song_id--reviews--id-"
               value="5"
               data-component="body">
    <br>
<p>Must be at least 1. Must not be greater than 5. Example: <code>5</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>user_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="user_id"                data-endpoint="PUTapi-songs--song_id--reviews--id-"
               value="17"
               data-component="body">
    <br>
<p>The <code>id</code> of an existing record in the users table. Example: <code>17</code></p>
        </div>
        </form>

            

        
    </div>
    <div class="dark-box">
                    <div class="lang-selector">
                                                        <button type="button" class="lang-button" data-language-name="bash">bash</button>
                                                        <button type="button" class="lang-button" data-language-name="javascript">javascript</button>
                            </div>
            </div>
</div>
</body>
</html>
