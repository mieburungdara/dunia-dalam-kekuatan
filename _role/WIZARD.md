# Penyihir Agung (Wizard)

Data profesi Penyihir Agung sekarang dikelola dalam format JSON untuk kemudahan akses dan konsistensi.

Untuk melihat detail lengkap profesi Penyihir Agung, silakan merujuk ke file:
*   `_role/WIZARD.json`

## Struktur Data Profesi Penyihir Agung (JSON)

Objek profesi Penyihir Agung dalam `_role/WIZARD.json` mengikuti struktur berikut:

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