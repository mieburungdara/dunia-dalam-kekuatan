# Agama dan Kepercayaan

Data agama dan kepercayaan sekarang dikelola dalam format JSON untuk kemudahan akses dan konsistensi.

Untuk melihat daftar lengkap agama dan kepercayaan serta detailnya, silakan merujuk ke file:
*   `AGAMA_KEPERCAYAAN.json`

## Struktur Data Agama/Kepercayaan (JSON)

Setiap objek agama/kepercayaan dalam `AGAMA_KEPERCAYAAN.json` mengikuti struktur berikut:

```json
{
  "Name": "Nama Agama/Kepercayaan",
  "Description": "Penjelasan singkat tentang inti ajaran atau filosofi.",
  "Origin": "Bagaimana agama/kepercayaan ini muncul atau didirikan.",
  "DeityOrEntity": "Entitas ilahi atau spiritual yang disembah/dipercaya.",
  "PracticesAndRituals": "Upacara, ibadah, atau kebiasaan penting.",
  "Followers": "Siapa saja yang menganut agama/kepercayaan ini (ras, faksi, wilayah).",
  "InfluenceInWorld": "Bagaimana agama/kepercayaan ini memengaruhi politik, budaya, atau konflik.",
  "AdditionalNotes": "Informasi lain yang relevan."
}
```