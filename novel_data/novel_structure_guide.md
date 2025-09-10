# Pedoman Struktur Folder Novel yang Konsisten

Dokumen ini menjelaskan struktur folder yang direkomendasikan untuk setiap novel dalam proyek "Pecahan Dunia" untuk memastikan konsistensi dan kemudahan pengelolaan.

Setiap novel harus berada di direktorinya sendiri di dalam `cerita/` (misalnya, `/home/rezaiturere/pecahan-dunia/cerita/nama-novel-anda/`). Direktori ini harus berisi:

1.  **`arcs.json`**:
    *   File JSON yang mencantumkan semua arc dalam novel.
    *   Berisi referensi ke direktori masing-masing arc.
    *   Contoh struktur:
        ```json
        [
          {
            "arc_id": "arc-001",
            "arc_name": "Nama Arc Pertama",
            "path": "Nama_Arc_Pertama/"
          },
          {
            "arc_id": "arc-002",
            "arc_name": "Nama Arc Kedua",
            "path": "Nama_Arc_Kedua/"
          }
        ]
        ```

2.  **`GUIDE.md`**:
    *   Dokumen panduan utama untuk novel.
    *   Berisi poin plot utama, detail karakter, dan aturan dunia yang berlaku untuk novel ini.

3.  **`index.json`**:
    *   File indeks atau manifes untuk konten novel.
    *   Mungkin berisi tautan ke semua bab dan adegan untuk navigasi cepat.

4.  **`meta.json`**:
    *   File JSON yang berisi metadata novel (misalnya, judul, sinopsis, genre).
    *   Mengikuti struktur `novel_data/novel_template.json`.
    *   Contoh struktur (sesuai `novel_data/novel_template.json`):
        ```json
        {
          "novel_id": "novel-001",
          "title": "Judul Novel Anda",
          "series": "Nama Seri (jika ada)",
          "series_order": 1,
          "logline": "Logline singkat novel.",
          "synopsis": "Sinopsis lengkap novel.",
          "genre": ["Fantasi", "Petualangan"],
          "target_audience": "Remaja",
          "themes": ["Takdir", "Persahabatan"],
          "main_characters": ["Karakter Utama 1", "Karakter Utama 2"],
          "arcs": [],
          "world_setting": "Deskripsi singkat latar dunia.",
          "key_conflicts": [],
          "resolution": "",
          "notes": ""
        }
        ```

---

### Struktur Folder Arc

Untuk setiap arc dalam novel, harus ada subdirektori yang dinamai sesuai arc (misalnya, `/home/rezaiturere/pecahan-dunia/cerita/nama-novel-anda/Nama_Arc/`). Setiap subdirektori arc harus berisi:

1.  **`chapters.json`**:
    *   File JSON yang mencantumkan semua bab dalam arc tersebut.
    *   Berisi referensi ke direktori masing-masing bab.
    *   Contoh struktur:
        ```json
        [
          {
            "chapter_id": "chapter-001",
            "chapter_title": "Judul Bab Pertama",
            "path": "Nama_Bab_Pertama/"
          },
          {
            "chapter_id": "chapter-002",
            "chapter_title": "Judul Bab Kedua",
            "path": "Nama_Bab_Kedua/"
          }
        ]
        ```

2.  **`meta.json`**:
    *   File JSON yang berisi metadata untuk arc.
    *   Mengikuti struktur `novel_data/arc_template.json`.
    *   Contoh struktur (sesuai `novel_data/arc_template.json`):
        ```json
        {
          "arc_id": "arc-001",
          "arc_name": "Nama Arc Anda",
          "novel_id": "novel-001",
          "arc_order": 1,
          "logline": "Logline singkat arc.",
          "synopsis": "Sinopsis lengkap arc.",
          "main_conflict": "Konflik utama arc.",
          "inciting_incident": "Pemicu arc.",
          "rising_action_points": [],
          "climax": "Klimaks arc.",
          "falling_action_points": [],
          "resolution": "Resolusi arc.",
          "pov_characters": [],
          "key_locations": [],
          "themes": [],
          "notes": ""
        }
        ```

---

### Struktur Folder Bab

Untuk setiap bab dalam arc, harus ada subdirektori yang dinamai sesuai bab (misalnya, `/home/rezaiturere/pecahan-dunia/cerita/nama-novel-anda/Nama_Arc/Nama_Bab/`). Setiap subdirektori bab harus berisi:

1.  **`scenes.json`**:
    *   File JSON yang mencantumkan semua adegan dalam bab tersebut.
    *   Berisi referensi ke file Markdown masing-masing adegan.
    *   Contoh struktur:
        ```json
        [
          {
            "scene_id": "scene-001",
            "scene_title": "Judul Adegan Pertama",
            "file": "Judul_Adegan_Pertama.md"
          },
          {
            "scene_id": "scene-002",
            "scene_title": "Judul Adegan Kedua",
            "file": "Judul_Adegan_Kedua.md"
          }
        ]
        ```

2.  **`meta.json`**:
    *   File JSON yang berisi metadata untuk bab.
    *   Mengikuti struktur `novel_data/chapter_template.json`.
    *   Contoh struktur (sesuai `novel_data/chapter_template.json`):
        ```json
        {
          "chapter_id": "chapter-001",
          "chapter_number": 1,
          "chapter_title": "Judul Bab Anda",
          "arc_id": "arc-001",
          "novel_id": "novel-001",
          "logline": "Logline singkat bab.",
          "summary": "Ringkasan bab.",
          "pov_character": "Karakter POV",
          "setting": "Latar tempat bab.",
          "time_of_day": "Waktu hari.",
          "date": "Tanggal dalam cerita.",
          "main_goal": "Tujuan utama bab.",
          "obstacles": [],
          "key_events": [],
          "characters_present": [],
          "new_information_revealed": [],
          "character_growth_focus": [],
          "notes": ""
        }
        ```

3.  **File Markdown Adegan**:
    *   File Markdown untuk setiap adegan (misalnya, `Judul_Adegan.md`).
    *   Berisi konten narasi aktual dari adegan tersebut.
