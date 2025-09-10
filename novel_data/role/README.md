# Penjelasan Detail Profesi

Folder ini berisi penjelasan yang lebih lengkap dan detail mengenai berbagai profesi atau peran yang ada di dunia "Pecahan Dunia". Data untuk setiap profesi sekarang dikelola dalam format JSON.

Untuk melihat detail lengkap profesi, silakan merujuk ke file JSON yang sesuai di dalam folder ini (misalnya, `MAGE.json`, `AEROMANCER.json`, dll.).

## Struktur Data Profesi (JSON)

Setiap objek profesi dalam file JSON mengikuti struktur umum berikut:

```json
{
  "Name": "Nama Profesi",
  "GeneralDescription": "Deskripsi umum profesi.",
  "Requirements": "Persyaratan untuk profesi ini.",
  "TypicalAbilities": [
    {"Name": "Nama Kemampuan", "Description": "Deskripsi kemampuan."}
  ],
  "TypicalEquipment": ["Item 1", "Item 2"],
  "SocialRole": ["Peran 1", "Peran 2"],
  "Specializations": ["Spesialisasi 1", "Spesialisasi 2"],
  "FamousFigures": ["Tokoh 1", "Tokoh 2"],
  "AdditionalNotes": "Catatan tambahan.",
  "ProgressionLevels": [
    {
      "LevelName": "Nama Tingkatan",
      "Description": "Deskripsi tingkatan.",
      "Abilities": ["Kemampuan 1", "Kemampuan 2"]
    }
  ]
}
```