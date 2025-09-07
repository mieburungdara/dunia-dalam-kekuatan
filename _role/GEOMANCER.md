# Geomancer (Pengendali Tanah)

Data profesi Geomancer sekarang dikelola dalam format JSON untuk kemudahan akses dan konsistensi.

Untuk melihat detail lengkap profesi Geomancer, silakan merujuk ke file:
*   `_role/GEOMANCER.json`

## Struktur Data Profesi Geomancer (JSON)

Objek profesi Geomancer dalam `_role/GEOMANCER.json` mengikuti struktur berikut:

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