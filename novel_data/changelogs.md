# Changelog

Semua perubahan signifikan pada proyek ini akan dicatat di file ini.

---

## v0.59.0 - Refactor Data Lokasi & Perbaikan Konsistensi
*Tanggal: 2025-09-10*

- **Refactor**: Merestrukturisasi data lokasi dengan memindahkannya ke file individual di bawah `novel_data/locations/` untuk menjaga konsistensi dengan tipe data lain.
- **Perbaikan**: Memperbarui skrip `ConsistencyChecker.php` untuk membaca struktur data lokasi yang baru, memperbaiki laporan inkonsistensi yang keliru.

---

## v0.58.0 - Perbaikan Routing & 404 Error
*Tanggal: 2025-09-09*

- **Perbaikan**: Memperbaiki masalah routing yang menyebabkan 404 error.
  - Mengosongkan `$config['index_page']` untuk mengaktifkan URL bersih (`clean URL`) sesuai aturan `.htaccess`.
  - Menyesuaikan rute `novel` menjadi `Novel` untuk mengatasi masalah *case-sensitivity* pada server Linux.

---

## v0.57.0 - Penambahan Inventory dan Skills pada Karakter
*Tanggal: 2025-09-07*

- **Ditambahkan**: Menambahkan bidang `Inventory` dan `Skills` ke setiap objek karakter di `CHARACTERS.json` untuk memperkaya detail kemampuan dan sumber daya karakter.

---

## v0.56.0 - Migrasi Data Karakter ke JSON
*Tanggal: 2025-09-07*

- **Diubah**: Memindahkan semua data karakter dari `KARAKTER_ALTERNATIF.md`, `KARAKTER_DESKRIPSI.md`, dan `KARAKTER_PENDUKUNG.md` ke `CHARACTERS.json`.
- **Dihapus**: Mengosongkan konten `KARAKTER_ALTERNATIF.md`, `KARAKTER_DESKRIPSI.md`, dan `KARAKTER_PENDUKUNG.md`.

---

## v0.55.0 - Penambahan Profesi Demon dan Tingkatannya
*Tanggal: 2025-09-06*

- **Ditambahkan**: Membuat file `_role/DEMON.md` dengan penjelasan detail profesi Demon dan 10 tingkatannya.

---

## v0.54.0 - Penambahan Profesi Succubus dan Tingkatannya
*Tanggal: 2025-09-06*

- **Ditambahkan**: Membuat file `_role/SUCCUBUS.md` dengan penjelasan detail profesi Succubus dan 10 tingkatannya.

---

## v0.53.0 - Penambahan Profesi Knight dan Tingkatannya
*Tanggal: 2025-09-06*

- **Ditambahkan**: Membuat file `_role/KNIGHT.md` dengan penjelasan detail profesi Knight dan 10 tingkatannya.

---

## v0.52.0 - Penambahan Profesi Assassin dan Tingkatannya
*Tanggal: 2025-09-06*

- **Ditambahkan**: Membuat file `_role/ASSASSIN.md` dengan penjelasan detail profesi Assassin dan 10 tingkatannya.

---

## v0.51.0 - Penambahan Profesi Shadowmancer dan Tingkatannya
*Tanggal: 2025-09-06*

- **Ditambahkan**: Membuat file `_role/SHADOWMANCER.md` dengan penjelasan detail profesi Shadowmancer dan 10 tingkatannya.

---

## v0.50.0 - Penambahan Profesi Lightweaver dan Tingkatannya
*Tanggal: 2025-09-06*

- **Ditambahkan**: Membuat file `_role/LIGHTWEAVER.md` dengan penjelasan detail profesi Lightweaver dan 10 tingkatannya.

---

## v0.49.0 - Penambahan Profesi Aeromancer dan Tingkatannya
*Tanggal: 2025-09-06*

- **Ditambahkan**: Membuat file `_role/AEROMANCER.md` dengan penjelasan detail profesi Aeromancer dan 10 tingkatannya.

---

## v0.48.0 - Penambahan Profesi Geomancer dan Tingkatannya
*Tanggal: 2025-09-06*

- **Ditambahkan**: Membuat file `_role/GEOMANCER.md` dengan penjelasan detail profesi Geomancer dan 10 tingkatannya.

---

## v0.47.0 - Penambahan Profesi Hydromancer dan Tingkatannya
*Tanggal: 2025-09-06*

- **Ditambahkan**: Membuat file `_role/HYDROMANCER.md` dengan penjelasan detail profesi Hydromancer dan 10 tingkatannya.

---

## v0.46.0 - Penambahan Profesi Pyromancer dan Tingkatannya
*Tanggal: 2025-09-06*

- **Ditambahkan**: Membuat file `_role/PYROMANCER.md` dengan penjelasan detail profesi Pyromancer dan 10 tingkatannya.

---

## v0.45.0 - Penambahan Profesi Necromancer dan Tingkatannya
*Tanggal: 2025-09-06*

- **Ditambahkan**: Membuat file `_role/NECROMANCER.md` dengan penjelasan detail profesi Necromancer dan 10 tingkatannya.

---

## v0.44.0 - Penambahan Profesi Wizard dan Tingkatannya
*Tanggal: 2025-09-06*

- **Ditambahkan**: Membuat file `_role/WIZARD.md` dengan penjelasan detail profesi Wizard dan 10 tingkatannya.

---

## v0.43.0 - Penambahan Tingkatan Mage
*Tanggal: 2025-09-06*

- **Diperbarui**: Menambahkan 10 tingkatan detail untuk profesi Penyihir (Mage) di `_role/MAGE.md`.

---

## v0.42.0 - Penambahan Folder Profesi
*Tanggal: 2025-09-06*

- **Ditambahkan**: Membuat folder `_role` untuk menyimpan penjelasan detail profesi.
- **Ditambahkan**: Menambahkan `_role/README.md` sebagai panduan struktur profesi.
- **Ditambahkan**: Menambahkan `_role/MAGE.md` sebagai contoh profesi Penyihir.

---

## v0.41.0 - Penambahan Dokumen Agama dan Kepercayaan
*Tanggal: 2025-09-06*

- **Ditambahkan**: Membuat file `AGAMA_KEPERCAYAAN.md` sebagai panduan dan daftar agama/kepercayaan di dunia cerita.

---

## v0.40.0 - Penambahan Dokumen Monster
*Tanggal: 2025-09-06*

- **Ditambahkan**: Membuat file `MONSTERS.md` sebagai panduan dan daftar monster di dunia cerita.

---

## v0.39.0 - Perbaikan Daftar Isi Dinamis
*Tanggal: 2025-09-05*

- **Diperbaiki**: Memperbarui logika daftar isi di `index.md` untuk secara akurat menampilkan bab-bab dari koleksi `cerita` dengan memfilter hanya file `index.md` di setiap direktori bab.

---

## v0.38.0 - Perubahan Alur Kerja & Atribut Karakter
*Tanggal: 2025-09-05*

- **Diperbarui**: Alur kerja Git diubah menjadi manual, menunggu perintah `commit` dari pengguna. Aturan terkait diperbarui di `GEMINI.md`.
- **Diperbarui**: Menambahkan panduan gaya penulisan baru (pronomina, paragraf, dialog) ke `GEMINI.md`.
- **Diperbarui**: Menambahkan sifat "pemalas" pada Bimo dan "keras kepala" pada Mira di semua file karakter.
- **Diperbaiki**: Mengoreksi penggunaan pronomina di Bab 1.

---

## v0.37.0 - Refactoring Tema ke Bootstrap 5
*Tanggal: 2025-09-05*

- **Diubah**: Menghapus `remote_theme` dari `_config.yml`.
- **Ditambahkan**: Membuat layout `default.html` baru menggunakan Bootstrap 5 dari CDN untuk kontrol penuh atas tampilan situs.

---

## v0.36.0 - Penambahan Atribut Karakter (Zodiak & MBTI)
*Tanggal: 2025-09-05*

- **Diperbarui**: Menambahkan informasi Zodiak dan MBTI untuk setiap karakter di `GUIDE.md`, `KARAKTER_DESKRIPSI.md`, dan `KARAKTER_ALTERNATIF.md` untuk memperdalam kepribadian mereka.

---

## v0.35.0 - Restrukturisasi Bab dengan Sub-Bab
*Tanggal: 2025-09-05*

- **Diubah**: Merestrukturisasi Bab 1 dengan memecah narasinya menjadi empat file sub-bab yang terpisah (`1.1` hingga `1.4`).
- **Diperbarui**: Mengubah `index.md` di dalam folder bab menjadi halaman daftar isi dinamis untuk sub-bab di dalamnya.

---

## v0.34.0 - Pembersihan Prompt Gambar
*Tanggal: 2025-09-05*

- **Dihapus**: Menghapus semua sisa prompt gambar yang tersembunyi dari file cerita untuk membersihkan file dan fokus pada narasi.

---

## v0.33.0 - Penonaktifan Fitur Prompt Gambar
*Tanggal: 2025-09-05*

- **Diperbarui**: Menonaktifkan sementara fitur pembuatan prompt gambar dengan memberi komentar pada aturan terkait di `GEMINI.md` untuk fokus pada pengembangan cerita.

---

## v0.32.0 - Revisi Alur Cerita Bab 1 (Bimo, Pendalaman)
*Tanggal: 2025-09-05*

- **Ditulis Ulang**: Memperpanjang dan memperkaya adegan Bimo di Bab 1 dengan lebih banyak dialog internal dan aksi yang mencerminkan kepribadiannya sebagai gamer.
- **Diperbarui**: Menyesuaikan prompt gambar untuk adegan Bimo agar lebih detail dan komikal.

---

## v0.31.0 - Penulisan Ulang Bab 1 (Pendalaman)
*Tanggal: 2025-09-05*

- **Ditulis Ulang**: Melakukan penulisan ulang Bab 1 secara ekstensif untuk memperdalam dan memperpanjang adegan setiap karakter sesuai standar detail yang baru.
- **Diperbarui**: Menyesuaikan semua prompt gambar di Bab 1 agar selaras dengan narasi yang lebih kaya.

---

## v0.30.0 - Penulisan Ulang Bab 1 (Detail Karakter)
*Tanggal: 2025-09-05*

- **Ditulis Ulang**: Memperpanjang dan memperkaya setiap adegan perkenalan karakter di Bab 1 untuk memberikan lebih banyak kedalaman dan detail, termasuk menambahkan kembali adegan untuk Raka.
- **Diperbarui**: Menyesuaikan semua prompt gambar di Bab 1 agar selaras dengan narasi yang lebih kaya.

---

## v0.29.0 - Revisi Alur Cerita Bab 1 (Bimo)
*Tanggal: 2025-09-05*

- **Ditulis Ulang**: Merevisi adegan Bimo di Bab 1 untuk lebih menonjolkan kepribadiannya yang ceria dan optimis seperti seorang gamer.
- **Diperbarui**: Menyesuaikan prompt gambar untuk adegan Bimo agar cocok dengan revisi.

---

## v0.28.0 - Revisi Alur Cerita Bab 1 (Arga)
*Tanggal: 2025-09-05*

- **Ditulis Ulang**: Merevisi adegan Arga di Bab 1 untuk menunjukkan proses berpikirnya yang lebih logis dan realistis sebelum memutuskan untuk kabur.
- **Diperbarui**: Menyesuaikan prompt gambar untuk adegan Arga agar cocok dengan revisi.

---

## v0.27.0 - Integrasi Konsep Cerita Baru & Aturan Revisi
*Tanggal: 2025-09-05*

- **Diperbarui**: Mengintegrasikan konsep "Pilar Cahaya" dari `REVISI.md` ke dalam `GUIDE.md` dan narasi Bab 1.
- **Diperbarui**: Menyesuaikan prompt gambar di Bab 1 untuk mencerminkan konsep baru.
- **Diperbarui**: Menambahkan aturan kerja baru di `GEMINI.md` yang menyatakan bahwa revisi cerita adalah proses penggabungan, bukan penggantian.

---

## v0.26.0 - Revisi Alur Cerita Bab 1 (Lina)
*Tanggal: 2025-09-05*

- **Ditulis Ulang**: Merevisi bagian cerita Lina di Bab 1 agar lebih emosional dan dramatis, di mana ia lumpuh karena takut sebelum akhirnya melarikan diri.
- **Diperbarui**: Menyesuaikan prompt gambar untuk adegan Lina agar cocok dengan revisi.

---

## v0.25.0 - Implementasi Anti-Cache
*Tanggal: 2025-09-05*

- **Ditambahkan**: Membuat komponen `_includes/cache_buster.html` dan `_includes/head.html` untuk menyisipkan meta tag anti-cache di setiap halaman.
- **Diperbarui**: Situs sekarang akan menginstruksikan browser untuk selalu memuat versi terbaru, mengatasi masalah cache.
- **Diperbarui**: Menambahkan aturan baru ke `GEMINI.md` mengenai fitur ini.

---

## v0.24.0 - Debugging Cache GitHub Pages
*Tanggal: 2025-09-05*

- **Diperbaiki**: Memulai proses perbaikan cache dengan menonaktifkan tema kustom untuk sementara waktu guna memaksa server melakukan build ulang total.

---

## v0.23.0 - Demonstrasi Daftar Isi Dinamis
*Tanggal: 2025-09-05*

- **Ditambahkan**: Membuat placeholder untuk Bab 2 (`cerita/02_desa_pertama/`) untuk mendemonstrasikan bahwa daftar isi di halaman utama bersifat dinamis dan akan otomatis menampilkan bab baru.

---

## v0.22.0 - Perbaikan Cache Daftar Isi
*Tanggal: 2025-09-05*

- **Diperbaiki**: Memaksa GitHub Pages untuk membangun ulang situs dengan menambahkan komentar pada `_config.yml` untuk mengatasi masalah cache yang menampilkan daftar isi lama.

---

## v0.21.0 - Revisi Alur Cerita Bab 1
*Tanggal: 2025-09-05*

- **Ditulis Ulang**: Merevisi bagian cerita Mira di Bab 1 agar lebih realistis, di mana ia selamat karena kebetulan, bukan karena sihir.
- **Diperbarui**: Menyesuaikan adegan pertarungan dan prompt gambar yang relevan untuk mencerminkan perubahan alur.

---

## v0.20.0 - Implementasi Daftar Isi Dinamis
*Tanggal: 2025-09-05*

- **Diperbarui**: Mengkonfigurasi `cerita` sebagai *Jekyll Collection* di `_config.yml`.
- **Diperbarui**: Mengganti daftar isi statis di `index.md` dengan kode Liquid dinamis yang secara otomatis membuat daftar bab dari koleksi.
- **Diperbarui**: Menambahkan `title` pada *front matter* Bab 1 untuk mendukung sistem dinamis.
- **Diperbarui**: Menambahkan aturan baru ke `GEMINI.md` mengenai penggunaan sistem koleksi ini.

---

## v0.19.0 - Perbaikan Tampilan Situs & Galeri
*Tanggal: 2025-09-05*

- **Diperbaiki**: Menghapus file layout kustom (`_layouts/default.html`) yang merusak tema dan menggantinya dengan sistem `include` Jekyll yang lebih aman.
- **Ditambahkan**: Membuat komponen galeri terpisah di `_includes/image_gallery.html`.
- **Diperbarui**: Menyisipkan pemanggil komponen galeri di akhir Bab 1 agar gambar dapat ditampilkan tanpa merusak gaya situs.

---

## v0.18.0 - Penulisan Ulang Bab 1
*Tanggal: 2025-09-05*

- **Ditulis Ulang**: Menulis ulang keseluruhan Bab 1 berdasarkan `IDECERITA.md` untuk alur yang lebih detail dan perkenalan karakter yang terpisah.
- **Diperbarui**: Mengganti semua prompt gambar di Bab 1 agar sesuai dengan adegan-adegan baru yang lebih spesifik.

---

## v0.17.0 - Fokus Ulang Cerita ke Bab 1
*Tanggal: 2025-09-05*

- **Dihapus**: Menghapus semua bab (termasuk intro) kecuali Bab 1 untuk memfokuskan kembali alur cerita.
- **Diperbarui**: Memperbarui halaman utama (`index.md`) untuk hanya menampilkan tautan ke Bab 1.

---

## v0.16.0 - Perbaikan Logika Galeri Gambar
*Tanggal: 2025-09-05*

- **Diperbaiki**: Memperbaiki bug pada `_layouts/default.html` yang menyebabkan galeri gambar tidak menemukan gambar di dalam folder bab yang benar.
- **Diperbarui**: Logika pencarian gambar sekarang menggunakan variabel `page.dir` yang lebih akurat.

---

## v0.15.0 - Implementasi Galeri Gambar Otomatis
*Tanggal: 2025-09-05*

- **Ditambahkan**: Membuat layout Jekyll kustom (`_layouts/default.html`) untuk secara otomatis menampilkan galeri gambar di setiap halaman bab.
- **Diperbarui**: Logika situs sekarang akan mencari dan menampilkan semua file gambar yang ada di dalam folder bab yang bersangkutan.
- **Diperbarui**: Menambahkan aturan baru ke `GEMINI.md` mengenai fungsionalitas galeri otomatis ini.

---

## v0.14.0 - Pembaruan Aturan Kerja (Prompt Granular)
*Tanggal: 2025-09-05*

- **Diperbarui**: Menambahkan aturan baru ke `GEMINI.md` untuk selalu menyisipkan prompt gambar tersembunyi setelah setiap paragraf/adegan kunci.

---

## v0.13.0 - Restrukturisasi Prompt Gambar Granular
*Tanggal: 2025-09-05*

- **Diperbarui**: Merombak total sistem prompt gambar. Prompt sekarang disisipkan setelah setiap paragraf/adegan kunci di semua bab, bukan satu prompt di akhir.
- **Diperbarui**: Membuat prompt baru yang lebih kontekstual dan spesifik untuk setiap adegan di semua bab cerita.

---

## v0.12.0 - Peningkatan Kejelasan Prompt Gambar
*Tanggal: 2025-09-05*

- **Diperbarui**: Merevisi semua prompt gambar di setiap bab agar lebih spesifik, terutama dalam mendeskripsikan jumlah karakter (3 laki-laki, 2 perempuan) untuk meningkatkan akurasi dan konsistensi gambar yang dihasilkan.

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

---