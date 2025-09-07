---
layout: page
title: Jepit Rambut Berukir
---
# Jepit Rambut Berukir

Data item Jepit Rambut Berukir sekarang dikelola dalam format JSON untuk kemudahan akses dan konsistensi.

Untuk melihat detail lengkap item Jepit Rambut Berukir, silakan merujuk ke file:
*   `_items/jepit_rambut_berukir.json`

## Struktur Data Item (JSON)

Objek item Jepit Rambut Berukir dalam `_items/jepit_rambut_berukir.json` mengikuti struktur berikut:

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