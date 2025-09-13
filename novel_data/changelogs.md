## v0.69.3 - Penyesuaian Skema Warna (Menghilangkan Biru)
*Tanggal: 2025-09-13*

- **Perbaikan**: Menghilangkan sisa warna biru dari skema warna lama pada bilah progres dan tombol apung (FAB), diganti dengan warna dari tema perkamen untuk konsistensi visual.

---

## v0.69.2 - Refactor Tampilan Pembaca (Menghilangkan Card)
*Tanggal: 2025-09-13*

- **Refactor**: Menghilangkan `card` atau kontainer kotak pada tampilan pembaca. Teks sekarang mengalir langsung di atas latar belakang halaman untuk tampilan yang lebih luas dan menyatu, sambil mempertahankan skema warna perkamen.

---

## v0.69.1 - Perbaikan Latar Belakang Mode Gelap
*Tanggal: 2025-09-13*

- **Perbaikan**: Memperbaiki bug di mana latar belakang utama tidak menjadi gelap saat mode gelap diaktifkan. Aturan CSS ditambahkan untuk memastikan `#appCapsule` memiliki latar belakang transparan dalam mode gelap.

---

## v0.69.0 - Penyegaran Tampilan Pembaca Novel (Tema Perkamen)
*Tanggal: 2025-09-13*

- **Fitur**: Mengganti desain `card` pada tampilan pembaca dengan tema perkamen (parchment) yang lebih imersif.
  - Mengubah skema warna total (latar belakang, teks, tombol) agar sesuai dengan nuansa fantasi/klasik.
  - Mode terang menggunakan tema kertas perkamen, dan mode gelap menggunakan tema gulungan kuno.

---

## v0.68.0 - Peningkatan Fitur Tampilan Baca Novel
*Tanggal: 2025-09-13*

- **Fitur**: Merombak total tampilan pembaca novel (`scene_view.php`) untuk pengalaman yang lebih modern dan interaktif.
  - Menambahkan struktur `card` untuk konten cerita agar lebih rapi.
  - Membuat panel pengaturan mengambang (FAB) yang berisi semua opsi tampilan.
  - Menambahkan fitur pilihan jenis font (Serif & Sans-serif) yang preferensinya disimpan di browser.
  - Mengimplementasikan navigasi geser (swipe left/right) untuk berpindah antar adegan pada perangkat mobile.

---
