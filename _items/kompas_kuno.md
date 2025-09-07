---
layout: page
title: Kompas Kuno
---
# Kompas Kuno

Data item Kompas Kuno sekarang dikelola dalam format JSON untuk kemudahan akses dan konsistensi.

Untuk melihat detail lengkap item Kompas Kuno, silakan merujuk ke file:
*   `_items/kompas_kuno.json`

## Struktur Data Item (JSON)

Objek item Kompas Kuno dalam `_items/kompas_kuno.json` mengikuti struktur berikut:

```json
{
  "ID": "ID Unik Item",
  "Name": "Nama Item",
  "Type": "Tipe Item",
  "Rarity": "Kelangkaan Item",
  "ShortDescription": "Deskripsi singkat item.",
  "Description": "Penjelasan detail tentang item ini dan kegunaannya.",
  "EffectsAndAttributes": {
    "Effects": "Efek item.",
    "Attributes": "Atribut item."
  },
  "CraftingRecipe": {
    "Materials": [
      {"Name": "Nama Material", "Quantity": Jumlah}
    ],
    "Tools": "Alat yang dibutuhkan.",
    "Prerequisites": "Prasyarat crafting."
  },
  "UpgradePath": {
    "UpgradeFrom": "Nama Item sebelumnya.",
    "Materials": [
      {"Name": "Nama Material", "Quantity": Jumlah}
    ],
    "Effects": "Efek upgrade."
  },
  "LoreAndHistory": "Cerita singkat tentang asal-usul item ini."
}
```