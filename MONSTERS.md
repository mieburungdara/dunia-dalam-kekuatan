# Daftar Monster

Data monster sekarang dikelola dalam format JSON untuk kemudahan akses dan konsistensi.

Untuk melihat daftar lengkap monster dan detailnya, silakan merujuk ke file:
*   `MONSTERS.json`

## Struktur Data Monster (JSON)

Setiap objek monster dalam `MONSTERS.json` mengikuti struktur berikut:

```json
{
  "Name": "Nama Monster",
  "Description": "Deskripsi singkat tentang penampilan dan karakteristik umum monster.",
  "Habitat": "Di mana monster ini biasanya ditemukan.",
  "Abilities": [
    {"Name": "Nama Kemampuan", "Description": "Deskripsi kemampuan."},
    {"Name": "Nama Kemampuan Lain", "Description": "Deskripsi kemampuan lain."}
  ],
  "Weaknesses": "Kelemahan yang diketahui dari monster.",
  "Behavior": "Bagaimana monster ini berinteraksi dengan lingkungannya atau karakter.",
  "AdditionalNotes": "Informasi lain yang relevan."
}
```