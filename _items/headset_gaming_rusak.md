---
layout: page
title: Headset Gaming (rusak)
---
# Headset Gaming (rusak)

Data item Headset Gaming (rusak) sekarang dikelola dalam format JSON untuk kemudahan akses dan konsistensi.

Untuk melihat detail lengkap item Headset Gaming (rusak), silakan merujuk ke file:
*   `_items/headset_gaming_rusak.json`

## Struktur Data Item (JSON)

Objek item Headset Gaming (rusak) dalam `_items/headset_gaming_rusak.json` mengikuti struktur berikut:

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