---
layout: page
title: Referensi Profesi Dunia Fantasi
---
# 📜 Referensi Profesi Dunia Fantasi

Data profesi sekarang dikelola dalam format JSON untuk kemudahan akses dan konsistensi.

Untuk melihat daftar lengkap profesi dan detailnya, silakan merujuk ke file:
*   `PROFESI.json`

## Struktur Data Profesi (JSON)

Setiap objek kategori profesi dalam `PROFESI.json` mengikuti struktur berikut:

```json
[
  {
    "CategoryName": "Nama Kategori Profesi",
    "Professions": [
      {"Name": "Nama Profesi", "Aliases": ["Alias 1", "Alias 2"], "Description": "Deskripsi singkat (opsional)", "Subtypes": ["Subtipe 1", "Subtipe 2"]},
      // ... profesi lainnya
    ],
    "LevelMastery": "Penjelasan jalur penguasaan level untuk kategori ini (opsional)"
  }
  // ... kategori profesi lainnya
]
```