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
import com.example.musikool.R
import com.example.musikool.Repositories.AuthRepository
import com.example.musikool.Utils.showAPIError
import org.json.JSONObject

class LoginActivity : AppCompatActivity() {
    lateinit var edtEmail : EditText
    lateinit var edtPassword : EditText
    lateinit var btnLogin : Button

    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        enableEdgeToEdge()
        setContentView(R.layout.activity_login)
        ViewCompat.setOnApplyWindowInsetsListener(findViewById(R.id.main)) { v, insets ->
            val systemBars = insets.getInsets(WindowInsetsCompat.Type.systemBars())
            v.setPadding(systemBars.left, systemBars.top, systemBars.right, systemBars.bottom)
            insets
        }

        val token = SecureStorage.getString(this, "Token")

        if(!token.isNullOrEmpty()){
            GoToSongs()
        }else{
            edtEmail  = findViewById(R.id.edtEmail)
            edtPassword  = findViewById(R.id.edtPassword)
            btnLogin = findViewById(R.id.btnLogin)

            btnLogin.setOnClickListener {
                btnLogin.isEnabled = false
                btnLogin.text = "Cargando..."
                
                var request = LoginRequest(edtEmail.text.toString(), edtPassword.text.toString())

                var loginRepo = AuthRepository(this)
                loginRepo.login(request, {

                        result -> runOnUiThread {
                    result.onSuccess {
                            response ->
                        if(response.token != ""){
                            SecureStorage.putObject(this, "Token", response)
                            GoToSongs()
                        }else{
                            Toast.makeText(this, "Credenciales inválidas", Toast.LENGTH_SHORT).show()
                            btnLogin.isEnabled = false
                            btnLogin.text = "Cargando..."
                        }
                    }

                    result.onFailure { error->
                        showAPIError(this, error, btnLogin, "Iniciar sesión")
                    }
                }
                })
            }
        }


    }

    fun GoToSongs(){
        var intent = Intent(this, MainActivity::class.java)
        startActivity(intent)
    }


}
