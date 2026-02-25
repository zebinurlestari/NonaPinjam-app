package com.example.nonapinjam;

import android.graphics.Color;
import android.os.Bundle;
import android.util.Log;
import android.widget.Button;
import android.widget.EditText;
import android.widget.TableLayout;
import android.widget.TableRow;
import android.widget.TextView;
import android.widget.Toast;
import androidx.appcompat.app.AlertDialog;
import androidx.appcompat.app.AppCompatActivity;
import com.android.volley.DefaultRetryPolicy;
import com.android.volley.Request;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;
import org.json.JSONArray;
import org.json.JSONObject;
import java.util.HashMap;
import java.util.Map;

public class DashboardActivity extends AppCompatActivity {
    private EditText etNamaPeminjam, etBarang, etTanggal;
    private Button btnSimpan;
    private TableLayout tableDataPeminjaman;
    private String URL_BASE = "http://192.168.92.185/smartborrow/";

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_dashboard);

        etNamaPeminjam = findViewById(R.id.etNamaPeminjam);
        etBarang = findViewById(R.id.etBarang);
        etTanggal = findViewById(R.id.etTanggal);
        btnSimpan = findViewById(R.id.btnSimpan);
        tableDataPeminjaman = findViewById(R.id.tableDataPeminjaman);

        loadData(); // Memanggil data dari PHP

        btnSimpan.setOnClickListener(v -> simpanData());
    }

    private void loadData() {
        Log.d("API_STATUS", "Memanggil API: " + URL_BASE);
        StringRequest request = new StringRequest(Request.Method.GET, URL_BASE + "tampil_pinjaman.php",
                response -> {
                    try {
                        int childCount = tableDataPeminjaman.getChildCount();
                        if (childCount > 1) { tableDataPeminjaman.removeViews(1, childCount - 1); }
                        JSONArray array = new JSONArray(response);
                        for (int i = 0; i < array.length(); i++) {
                            JSONObject obj = array.getJSONObject(i);
                            tambahKeTabel(obj.getString("id"), obj.getString("nama_peminjam"), obj.getString("nama_barang"));
                        }
                    } catch (Exception e) {
                        Log.e("JSON_ERROR", "Data bukan JSON atau Error PHP");
                    }
                },
                error -> Log.e("API_ERROR", "Cek XAMPP & IP: " + error.toString()));

        request.setRetryPolicy(new DefaultRetryPolicy(5000, 1, 1.0f));
        Volley.newRequestQueue(this).add(request);
    }

    private void simpanData() {
        String nama = etNamaPeminjam.getText().toString().trim();
        String barang = etBarang.getText().toString().trim();
        if (nama.isEmpty() || barang.isEmpty()) return;

        StringRequest req = new StringRequest(Request.Method.POST, URL_BASE + "simpan_pinjaman.php",
                response -> {
                    if (response.toLowerCase().contains("success")) {
                        loadData();
                        etNamaPeminjam.setText(""); etBarang.setText("");
                        Toast.makeText(this, "Berhasil!", Toast.LENGTH_SHORT).show();
                    }
                }, error -> Log.e("API_ERROR", error.toString())) {
            @Override
            protected Map<String, String> getParams() {
                Map<String, String> p = new HashMap<>();
                p.put("nama_peminjam", nama);
                p.put("nama_barang", barang);
                p.put("tgl_pinjam", etTanggal.getText().toString());
                return p;
            }
        };
        Volley.newRequestQueue(this).add(req);
    }

    private void tambahKeTabel(String id, String nama, String barang) {
        TableRow row = new TableRow(this);
        row.setPadding(10, 10, 10, 10);
        TextView tvNama = new TextView(this); tvNama.setText(nama);
        TextView tvBarang = new TextView(this); tvBarang.setText(barang);
        row.addView(tvNama); row.addView(tvBarang);

        row.setOnClickListener(v -> {
            new AlertDialog.Builder(this).setTitle("Aksi").setItems(new String[]{"Hapus"}, (dialog, i) -> hapusDataDariSQL(id)).show();
        });
        tableDataPeminjaman.addView(row);
    }

    private void hapusDataDariSQL(String id) {
        StringRequest reqHapus = new StringRequest(Request.Method.POST, URL_BASE + "hapus_pinjaman.php",
                response -> loadData(), error -> Log.e("API_ERROR", error.toString())) {
            @Override
            protected Map<String, String> getParams() {
                Map<String, String> p = new HashMap<>();
                p.put("id", id);
                return p;
            }
        };
        Volley.newRequestQueue(this).add(reqHapus);
    }
}