# Assassin (Pembunuh Bayangan)

Data profesi Assassin sekarang dikelola dalam format JSON untuk kemudahan akses dan konsistensi.

Untuk melihat detail lengkap profesi Assassin, silakan merujuk ke file:
*   `_role/ASSASSIN.json`

## Struktur Data Profesi Assassin (JSON)

Objek profesi Assassin dalam `_role/ASSASSIN.json` mengikuti struktur berikut:

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