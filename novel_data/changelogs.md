## v0.70.3 - Perbaikan Spesifisitas Warna Header
*Tanggal: 2025-09-13*

- **Perbaikan**: Memperbaiki masalah warna header dengan menambahkan aturan CSS dengan spesifisitas lebih tinggi (`.appHeader.scrolled.bg-primary.is-active`) untuk menimpa gaya bawaan tema yang paling kuat sekalipun.

---

## v0.70.2 - Perbaikan Warna Header
*Tanggal: 2025-09-13*

- **Perbaikan**: Memperbaiki masalah di mana `.appHeader` tidak mengikuti skema warna tema. Aturan CSS spesifik ditambahkan ke `custom.css` untuk secara eksplisit mengatur warna latar belakang header.

---

## v0.70.1 - Refactor Implementasi Tema Global
*Tanggal: 2025-09-13*

- **Refactor**: Merombak `custom.css` untuk menimpa variabel CSS inti (`--bs-primary`, dll.) milik framework, sesuai saran pengguna. Ini adalah metode yang lebih efisien dan bersih untuk menerapkan tema global dibandingkan menimpa setiap komponen secara individual.

---

## v0.70.0 - Implementasi Tema Global (Parchment)
*Tanggal: 2025-09-13*

- **Fitur**: Mengimplementasikan skema warna perkamen secara global di seluruh situs.
  - Membuat file `assets/css/custom.css` untuk menampung semua gaya kustom.
  - Memuat `custom.css` di `header.php` untuk menimpa gaya bawaan tema.
  - Membersihkan CSS lokal dari `scene_view.php` dan memindahkannya ke file global.
  - Memastikan komponen UI seperti header, tombol, dan sidebar sekarang mengikuti skema warna tematik yang baru.

---

## v0.69.3 - Penyesuaian Skema Warna (Menghilangkan Biru)
*Tanggal: 2025-09-13*

- **Perbaikan**: Menghilangkan sisa warna biru dari skema warna lama pada bilah progres dan tombol apung (FAB), diganti dengan warna dari tema perkamen untuk konsistensi visual.

---
