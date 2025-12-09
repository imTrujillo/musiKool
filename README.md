# 🎵 musiKool – App de Aprendizaje Musical (Kotlin + Laravel API)

<img src="https://musikool-api.onrender.com/logo.png" width="300" alt="Logo del proyecto">

musiKool es una aplicación móvil desarrollada en Kotlin que permite a músicos autodidactas aprender piano y guitarra a través de teoría musical aplicada, canciones estructuradas y herramientas de apoyo.

El backend está construido en Laravel, ofreciendo un API REST completo para gestión de usuarios, canciones, reseñas, compases, notas musicales y más.

---

## 🎯 Objetivo del Proyecto

<img src="https://musikool-api.onrender.com/screenshots/3.jpg" width="350" alt="App">

- Desarrollar una aplicación educativa que facilite el aprendizaje autónomo del piano y la guitarra, reduciendo las barreras que enfrentan músicos principiantes sin un instructor.

## Objetivos Específicos

1. Diseñar funcionalidades con contenidos esenciales de formación musical.

2. Proveer un entorno digital interactivo.

3. Ofrecer teoría musical aplicada para progresar de manera clara y ordenada.

---

## 🚀 Características Principales

<img src="https://musikool-api.onrender.com/screenshots/1.jpg" width="350" alt="App">

### 🎶 Para los usuarios:
- Repositorio amplio de canciones.
- Información de digitación, acordes y escalas.
- Notas musicales organizadas por compases.
- Favoritos personalizados.
- Sistema de reseñas por canción.

<img src="https://musikool-api.onrender.com/screenshots/2.jpg" width="350" alt="Teoria">

### 🎼 Teoría musical integrada:
- Figuras rítmicas.
- Géneros musicales.
- Métrica.
- Escalas.
- Acordes.

---

## 🛠️ Tecnologías Utilizadas

<img src="https://musikool-api.onrender.com/screenshots/4.jpg" width="350" alt="frontend">

### Frontend (App móvil)
- Kotlin (Android Studio)
- Retrofit + OkHttp
- Gson

![backend](https://musikool-api.onrender.com/screenshots/5.png)

### Backend (API REST)
- Laravel 11
- MySQL
- Laravel Sanctum (autenticación)
- Scribe (documentación API)

---

## 📊 Diagrama de la base de datos

![db](https://musikool-api.onrender.com/screenshots/6.png)

- Usuarios
- Canciones
- Reseñas
- Figuras rítmicas
- Compases
- Géneros
- Favoritos
- Escalas
- Métrica
- Acordes
- Notas musicales

---

## 🧪 Requisitos

### Backend
- PHP 8.2+
- Laravel 11
- MySQL/MariaDB
- Composer

### Android
- Android Studio
- Kotlin 1.9+
- Min SDK 24+

---

## ▶️ Cómo Ejecutar

### Backend
```
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
php artisan serve
```

### Android
- Abrir el proyecto en Android Studio.
- Configurar la base_url del API en APIClient.kt.
- Ejecutar la app.

---

## 🌐 Despliegue

- Backend → Render → https://musikool-api.onrender.com/docs
- Frontend → APK → https://drive.google.com/file/d/1oc020zaQmXvJQEwbNpfBkc6v1BI0am3h/view?usp=sharing
- Base de datos → Railway

---

## 👥 Creadores

1. Abel Díaz → https://github.com/Abel270
2. José González → https://github.com/jose76s
3. Luis Martínez → https://github.com/BlckXI
4. Josué Melara → https://github.com/JosuMelara21
5. Steven Trujillo → https://github.com/imTrujillo
6. Ernesto Zavaleta → https://github.com/lIlIIIIIIllllI
