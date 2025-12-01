package com.example.musikool.ui.Activities

import android.content.Intent
import android.os.Bundle
import android.view.Gravity
import android.view.View
import android.widget.Button
import android.widget.ImageButton
import android.widget.ImageView
import androidx.appcompat.widget.Toolbar
import com.google.android.material.snackbar.Snackbar
import com.google.android.material.navigation.NavigationView
import androidx.navigation.findNavController
import androidx.navigation.ui.AppBarConfiguration
import androidx.navigation.ui.navigateUp
import androidx.navigation.ui.setupActionBarWithNavController
import androidx.navigation.ui.setupWithNavController
import androidx.drawerlayout.widget.DrawerLayout
import androidx.appcompat.app.AppCompatActivity
import com.example.musikool.API.SecureStorage
import com.example.musikool.DTOs.Response.Auth.LoginResponse
import com.example.musikool.R
import com.example.musikool.databinding.ActivityMainBinding

class MainActivity : AppCompatActivity() {

    private lateinit var appBarConfiguration: AppBarConfiguration
    private lateinit var binding: ActivityMainBinding
    private var isProfileButtonVisible = true

    lateinit var btnNavLogin : Button
    lateinit var btnNavRegister : Button

    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)

        binding = ActivityMainBinding.inflate(layoutInflater)
        setContentView(binding.root)

        setSupportActionBar(binding.appBarMain.toolbar)

        binding.appBarMain.fab.setOnClickListener { view ->
            Snackbar.make(view, "Abriendose :)", Snackbar.LENGTH_LONG)
                .setAction("Action", null)
                .setAnchorView(R.id.fab).show()
        }
        binding.appBarMain.fab.hide()

        val drawerLayout: DrawerLayout = binding.drawerLayout
        val navView: NavigationView = binding.navView
        val navController = findNavController(R.id.nav_host_fragment_content_main)

        navController.addOnDestinationChangedListener { _, destination, _ ->
            when (destination.id) {
                R.id.nav_profile,
                R.id.nav_my_songs,
                R.id.nav_songs_details,
                R.id.nav_modify_compass,
                R.id.nav_modify_song,
                R.id.nav_modify_musical_note,
                R.id.nav_favorites ->{
                    hideProfileButton()
                    isProfileButtonVisible = false
                }
                R.id.nav_songs_details -> {
                    binding.appBarMain.fab.show()
                }
                else -> {
                    binding.appBarMain.fab.hide()
                    showProfileButton()
                }
            }
        }

        val loginResponse = SecureStorage.getObject(this, "Token", LoginResponse::class.java)

        if (loginResponse != null && loginResponse.token.isNotEmpty()){
            val profileButton = ImageButton(this).apply {
                id = R.id.btnProfileIcon
                setImageResource(R.drawable.ic_profile_user)
                setBackgroundColor(android.graphics.Color.TRANSPARENT)
                scaleType = ImageView.ScaleType.CENTER_INSIDE
                adjustViewBounds = true
                setOnClickListener {
                    val navController = findNavController(R.id.nav_host_fragment_content_main)
                    navController.navigate(R.id.nav_profile)
                }
            }

            binding.appBarMain.toolbar.addView(profileButton)
            val params = Toolbar.LayoutParams(
                110,110
            ).apply {
                gravity = Gravity.END
                marginEnd = 12
            }
            profileButton.layoutParams = params
        }else{
            val footerLayout = layoutInflater.inflate(R.layout.nav_footer, null)
            navView.addHeaderView(footerLayout)

            btnNavLogin = footerLayout.findViewById(R.id.btnNavLogin)
            btnNavRegister = footerLayout.findViewById(R.id.btnNavRegister)

            btnNavLogin.setOnClickListener {
                val intent = Intent(this, LoginActivity::class.java)
                startActivity(intent)
                drawerLayout.closeDrawers()
            }
            btnNavRegister.setOnClickListener {
                val intent = Intent(this, RegisterActivity::class.java)
                startActivity(intent)
                drawerLayout.closeDrawers()
            }
        }

        // Passing each menu ID as a set of Ids because each
        // menu should be considered as top level destinations.
        appBarConfiguration = AppBarConfiguration(
            setOf(
                R.id.nav_songs, R.id.nav_artists, R.id.nav_genres, R.id.nav_chords, R.id.nav_about
            ), drawerLayout
        )
        setupActionBarWithNavController(navController, appBarConfiguration)
        navView.setupWithNavController(navController)

        Thread.setDefaultUncaughtExceptionHandler { thread, throwable ->

            var algo = thread
        }
    }


//    override fun onCreateOptionsMenu(menu: Menu): Boolean {
//        // Inflate the menu; this adds items to the action bar if it is present.
//        menuInflater.inflate(R.menu.main, menu)
//        return true
//    }

    override fun onSupportNavigateUp(): Boolean {
        val navController = findNavController(R.id.nav_host_fragment_content_main)
        return navController.navigateUp(appBarConfiguration) || super.onSupportNavigateUp()
    }

    fun setProfileButtonVisibility(visible: Boolean) {
        isProfileButtonVisible = visible
        if (visible) {
            showProfileButton()
        } else {
            hideProfileButton()
        }
    }

    private fun showProfileButton() {
        val profileButton = binding.appBarMain.toolbar.findViewById<ImageButton>(R.id.btnProfileIcon)
        profileButton?.visibility = View.VISIBLE
    }

    private fun hideProfileButton() {
        val profileButton = binding.appBarMain.toolbar.findViewById<ImageButton>(R.id.btnProfileIcon)
        profileButton?.visibility = View.GONE
    }

}