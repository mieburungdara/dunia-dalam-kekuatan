# Changelog

Semua perubahan signifikan pada proyek ini akan dicatat di file ini.

---

## v0.11.0 - Pembaruan Aturan Kerja Kualitas
*Tanggal: 2025-09-05*

- **Diperbarui**: Menambahkan aturan baru ke `GEMINI.md` untuk selalu melakukan pemeriksaan konsistensi cerita setiap kali ada perubahan pada alur cerita.

---

## v0.10.0 - Restrukturisasi Folder Cerita
*Tanggal: 2025-09-05*

- **Diubah**: Merestrukturisasi direktori `cerita/`. Setiap bab sekarang berada di dalam foldernya sendiri untuk manajemen aset yang lebih baik.
- **Diubah**: Memindahkan semua file bab ke dalam folder masing-masing dan menamainya `index.md`.
- **Diperbarui**: Memperbarui semua tautan di halaman utama (`index.md`) untuk mencerminkan struktur folder yang baru.

---

## v0.9.0 - Pembaruan Aturan Kerja Lanjutan
*Tanggal: 2025-09-05*

- **Diperbarui**: Menambahkan aturan baru ke `GEMINI.md` untuk menyinkronkan prompt gambar setiap kali ada penulisan ulang cerita.

---

## v0.8.0 - Pembaruan Aturan Kerja
*Tanggal: 2025-09-05*

- **Diperbarui**: Menambahkan aturan baru ke `GEMINI.md` untuk selalu membuat prompt gambar tersembunyi di setiap konten cerita baru.

---

## v0.7.0 - Integrasi Prompt Gambar per Bab
*Tanggal: 2025-09-05*

- **Ditambahkan**: Menyisipkan catatan prompt gambar yang relevan di setiap file bab (dari intro hingga bab 9). Catatan ini disembunyikan dari pembaca dan hanya berfungsi sebagai panduan untuk penulis.

---

## v0.6.0 - Perubahan Gaya Visual Gambar
*Tanggal: 2025-09-05*

- **Diperbarui**: Mengubah `IMAGE_PROMPT_PATTERN.md` untuk menghasilkan gambar dengan gaya visual anime, menggantikan gaya *digital painting* sebelumnya.

---

## v0.5.0 - Panduan Gambar
*Tanggal: 2025-09-05*

- **Ditambahkan**: File `IMAGE_PROMPT_PATTERN.md` untuk memberikan panduan dan prompt siap pakai dalam membuat gambar yang konsisten secara visual.

---

## v0.4.0 - Perbaikan Alur Pengguna
*Tanggal: 2025-09-05*

- **Ditambahkan**: File perkenalan cerita baru di `cerita/00_intro.md`.
- **Diubah**: Halaman utama (`index.md`) sekarang mengarah ke file perkenalan baru.
- **Diubah**: File `GUIDE.md` sekarang disembunyikan dari situs publik untuk menghindari kebingungan.

---

## v0.3.0 - Konfigurasi dan Otomatisasi
*Tanggal: 2025-09-05*

- **Ditambahkan**: File `changelogs.md` untuk melacak riwayat perubahan.
- **Diubah**: Aturan kerja bot untuk melakukan commit dan push secara otomatis setelah setiap perubahan.

---

## v0.2.0 - Perubahan Tema dan Panduan
*Tanggal: 2025-09-05*

- **Diubah**: Mengganti tema situs dari Docsify ke Jekyll theme 'Quick'.
- **Dihapus**: File-file konfigurasi Docsify (`index.html`, `_sidebar.md`, `.nojekyll`).
- **Ditambahkan**: File konfigurasi Jekyll (`_config.yml`) dan halaman utama baru (`index.md`).
- **Diperbarui**: `GUIDE.md` disesuaikan dengan cerita "Lima Jiwa di Bumi Lain" dan menghapus konten lama.

---

## v0.1.0 - Inisialisasi Proyek
*Tanggal: 2025-09-05*

- **Ditambahkan**: Membuat 9 bab pertama dari cerita "Lima Jiwa di Bumi Lain" dalam format Markdown.
- **Ditambahkan**: Mengkonfigurasi situs GitHub Pages awal menggunakan Docsify.
