package com.example.nonapinjam;

import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.TextView;
import android.widget.Toast;
import androidx.appcompat.app.AppCompatActivity;

import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;

import java.util.HashMap;
import java.util.Map;

public class MainActivity extends AppCompatActivity {
    // Deklarasi komponen
    EditText etEmail, etPassword;
    Button btnLogin;
    TextView tvRegister;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);

        // Hubungkan variabel dengan ID di XML
        etEmail = findViewById(R.id.etEmail);
        etPassword = findViewById(R.id.etPassword);
        btnLogin = findViewById(R.id.btnLogin);
        tvRegister = findViewById(R.id.tvRegister); // ID ini harus ada di XML

        // LOGIKA PINDAH KE HALAMAN DAFTAR
        tvRegister.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent intent = new Intent(MainActivity.this, RegisterActivity.class);
                startActivity(intent);
            }
        });

        // LOGIKA TOMBOL LOGIN
        btnLogin.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                final String email = etEmail.getText().toString().trim();
                final String pass = etPassword.getText().toString().trim();

                if (email.isEmpty() || pass.isEmpty()) {
                    Toast.makeText(MainActivity.this, "Email dan Password tidak boleh kosong!", Toast.LENGTH_SHORT).show();
                    return;
                }

                // Alamat IP laptopmu (hasil ipconfig terbaru)
                String url = "http://192.168.92.185/smartborrow/api_login.php";

// Pastikan StringRequest memanggil variabel 'url' di atas
                StringRequest stringRequest = new StringRequest(Request.Method.POST, url,
                        new Response.Listener<String>() {
                            @Override
                            public void onResponse(String response) {
                                // PHP membalas "success" jika email & password cocok
                                if (response.trim().equals("success")) {
                                    Toast.makeText(MainActivity.this, "Login Berhasil!", Toast.LENGTH_SHORT).show();

                                    // Pindah ke Dashboard setelah login berhasil
                                    Intent intent = new Intent(MainActivity.this, DashboardActivity.class);
                                    startActivity(intent);
                                    finish(); // Tutup halaman login agar tidak bisa di-back
                                } else {
                                    Toast.makeText(MainActivity.this, "Email atau Password Salah!", Toast.LENGTH_SHORT).show();
                                }
                            }
                        },
                        new Response.ErrorListener() {
                            @Override
                            public void onErrorResponse(VolleyError error) {
                                Toast.makeText(MainActivity.this, "Error: " + error.getMessage(), Toast.LENGTH_SHORT).show();
                            }
                        }) {
                    @Override
                    protected Map<String, String> getParams() {
                        Map<String, String> params = new HashMap<>();
                        // 'username' di sini adalah key yang dibaca $_POST['username'] di PHP
                        params.put("username", email);
                        params.put("password", pass);
                        return params;
                    }
                };

                RequestQueue requestQueue = Volley.newRequestQueue(MainActivity.this);
                requestQueue.add(stringRequest);
            }
        });
    }
}