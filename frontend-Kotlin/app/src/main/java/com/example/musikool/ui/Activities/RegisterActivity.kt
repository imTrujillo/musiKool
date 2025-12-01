package com.example.musikool.ui.Activities

import android.content.Intent
import android.os.Bundle
import android.widget.Button
import android.widget.EditText
import android.widget.Toast
import androidx.activity.enableEdgeToEdge
import androidx.appcompat.app.AppCompatActivity
import androidx.core.view.ViewCompat
import androidx.core.view.WindowInsetsCompat
import com.example.musikool.API.SecureStorage
import com.example.musikool.DTOs.Request.Auth.LoginRequest
import com.example.musikool.DTOs.Request.Auth.RegisterRequest
import com.example.musikool.R
import com.example.musikool.Repositories.AuthRepository
import com.example.musikool.Utils.showAPIError
import com.skydoves.colorpickerview.ColorPickerView
import com.skydoves.colorpickerview.listeners.ColorListener
import org.json.JSONObject

class RegisterActivity : AppCompatActivity() {
    private lateinit var edtUserName : EditText
    private lateinit var edtEmail : EditText
    private lateinit var edtPassword: EditText
    private lateinit var edtConfirmPassword: EditText
    private lateinit var btnRegister: Button

    private lateinit var colorPickerView : ColorPickerView
    private lateinit var edtColor: EditText

    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        enableEdgeToEdge()
        setContentView(R.layout.activity_register)
        ViewCompat.setOnApplyWindowInsetsListener(findViewById(R.id.main)) { v, insets ->
            val systemBars = insets.getInsets(WindowInsetsCompat.Type.systemBars())
            v.setPadding(systemBars.left, systemBars.top, systemBars.right, systemBars.bottom)
            insets
        }

        colorPickerView = findViewById(R.id.colorPickerView)
        edtColor = findViewById(R.id.edtLayoutProfile)

        colorPickerView.setColorListener(object : ColorListener {
            override fun onColorSelected(color: Int, fromUser: Boolean) {
                val hex = String.format("#%06X", 0xFFFFFF and color)
                if (edtColor.text.toString() != hex) {
                    edtColor.setText(hex)
                }
            }
        })

        val token = SecureStorage.getString(this, "Token")

        if(token.isNotEmpty()){
            GoToSongs()
        }else{
            edtUserName = findViewById(R.id.edtUsername)
            edtEmail  = findViewById(R.id.edtEmail)
            edtPassword  = findViewById(R.id.edtPassword)
            edtConfirmPassword= findViewById(R.id.edtConfirmPassword)
            btnRegister = findViewById(R.id.btnRegister)


            btnRegister.setOnClickListener {
                btnRegister.isEnabled = false
                btnRegister.text = "Cargando..."

                var request = RegisterRequest(
                    edtUserName.text.toString(),
                    edtEmail.text.toString(),
                    edtPassword.text.toString(),
                    edtConfirmPassword.text.toString(),
                    edtColor.text.toString())

                if (request.password != request.password_confirmation){
                    Toast.makeText(this, "Las contraseñas no coinciden", Toast.LENGTH_SHORT).show()
                    return@setOnClickListener
                }else if (
                    request.name.isEmpty() ||
                    request.email.isEmpty() ||
                    request.password.isEmpty() ||
                    request.password_confirmation.isEmpty() ||
                    request.color.isEmpty()){
                    Toast.makeText(this, "Llena todos los campos", Toast.LENGTH_SHORT).show()
                    return@setOnClickListener
                }

                var authRepo = AuthRepository(this)
                authRepo.register(request, {
                    result -> runOnUiThread {
                    result.onSuccess {
                            response ->
                        login(authRepo, edtEmail.text.toString(), edtPassword.text.toString())
                    }
                    result.onFailure { error ->
                        showAPIError(this, error, btnRegister, "Registrarse")
                    }
                }
                })
            }
        }

        Thread.setDefaultUncaughtExceptionHandler { thread, throwable ->
            var algo = thread
        }
    }

    fun login(authRepository: AuthRepository, email : String, password: String){
        var request = LoginRequest(email, password)
        authRepository.login(request, { result ->
            runOnUiThread {
                result.onSuccess { response ->
                    if (response.token != "") {
                        SecureStorage.putObject(this, "Token", response)
                        GoToSongs()
                    } else {
                        Toast.makeText(this, "Credenciales inválidas", Toast.LENGTH_SHORT)
                            .show()
                    }
                }
                result.onFailure { error ->
                    Toast.makeText(this, "Error: $error", Toast.LENGTH_SHORT).show()
                }
            }

        })
    }

    fun GoToSongs(){
        var intent = Intent(this, MainActivity::class.java)
        startActivity(intent)
        finish()
    }


}
