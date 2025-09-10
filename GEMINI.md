# Directory Overview

This directory contains the foundational documents for a fantasy novel project. The project is structured as a collection of Markdown files that detail the plot, characters, world-building rules, and specific skills or abilities within the story's universe.

# Key Files

*   **`README.md`**: Provides a brief, narrative introduction to the story's protagonist, and the initial premise of their journey.
*   **`GUIDE.md`**: This is a crucial file acting as a guide for an AI writer. It establishes the core plot points, character personalities, the story's timeline, and the fundamental rules of the world to ensure narrative consistency.
*   **`WORLDBUILDING.md`**: Details the fantasy world's mechanics. It explains the primary energy source ("Aether"), the system of magic, the concept of "Skills", powerful "Relics", and the different factions that exist within the world.
*   **`SKILL_PATTERN.md`**: Contains a standard template for creating new skill description files to ensure consistency.
*   **`SKILL_LIST.md`**: An empty file likely intended to list and describe the various skills and powers that characters can possess.
*   **`calendar.json`**: Mendefinisikan sistem kalender kustom dunia, termasuk nama bulan, jumlah hari, dan era.
*   **`timeline.json`**: Mencatat peristiwa-peristiwa besar dan penting dalam sejarah dunia, lengkap dengan tanggal dan signifikansinya.
*   **`CHARACTER_TEMPLATE.json`**: Template untuk membuat entri karakter baru di `CHARACTERS.json` agar konsisten.
*   **`scene_template.json`**: Template untuk melacak detail per adegan, termasuk kondisi karakter (HP/MP/Stamina) dan perkembangan plot.
*   **`novel_template.json`**: Template untuk struktur data novel secara keseluruhan.
*   **`arc_template.json`**: Template untuk struktur data arc cerita.
*   **`chapter_template.json`**: Template untuk struktur data bab cerita.
*   **Character/Skill Files**: The directory contains numerous other Markdown files (e.g., `Bulls_Might.md`, `Fates_Shepherd.md`) that appear to be detailed descriptions of individual skills, powers, or character-specific abilities.

# Usage

The contents of this directory are used for the creative development and writing of a fantasy novel. The files serve as a "single source of truth" to maintain consistency in the story's lore, characters, and plot.

When working on this project, it is important to:
1.  Adhere to the rules and character traits defined in `GUIDE.md` and `WORLDBUILDING.md`.
2.  When creating a new skill, **always follow the template in `SKILL_PATTERN.md`**.
3.  Use the individual skill files as a reference for character abilities.
4.  Update the `SKILL_LIST.md` as new skills are conceptualized.

# Konfigurasi Proyek (Fat-Free Framework - F3)

Proyek ini sekarang menggunakan **Fat-Free Framework (F3)** untuk menyajikan konten. File-file Markdown yang berisi cerita, karakter, dan FAQ akan diproses oleh F3.

- **Bahasa**: Selalu gunakan Bahasa Indonesia untuk semua percakapan.
- **Alur Kerja Git**: Tunggu perintah "commit" dari pengguna. Saat diperintahkan, perbarui `changelogs.md` terlebih dahulu, baru jalankan `git add .`, `git commit`, dan `git push`.
- **Metode Revisi Cerita**: Revisi cerita adalah proses **penggabungan**, bukan penggantian. Pertahankan narasi yang ada sambil mengintegrasikan ide-ide baru dari file revisi.
- **Penanganan Konten Markdown (FAQ, dll.)**:
    - File Markdown (seperti FAQ) sekarang dibaca dan dikonversi ke HTML menggunakan library **Parsedown** di dalam controller F3 (`app/controllers/FaqController.php`).
    - Konten HTML kemudian diteruskan ke view F3 untuk ditampilkan.
    - Struktur URL untuk FAQ adalah `/faq`, `/faq/@category`, dan `/faq/@category/@faq_name`.
- **Struktur Direktori Data**: Semua file data utama proyek (cerita, worldbuilding, skill, item, FAQ) sekarang berada di dalam folder `novel_data/` di root proyek.
    - Contoh: `novel_data/cerita/`, `novel_data/faq/`, `novel_data/skills/`.
- **Manajemen Karakter (Pendukung/Figuran)**: Untuk karakter pendukung atau figuran, buat entri deskripsi di file `novel_data/KARAKTER_PENDUKUNG.md` dengan format yang konsisten.
- **Konsistensi Cerita**: Setiap kali mengubah atau menulis ulang sebuah bagian cerita, lakukan pemeriksaan silang dengan `novel_data/GUIDE.md` dan bab-bab lain untuk memastikan tidak ada konflik plot, karakter, atau aturan dunia.
- **Tampilan Website**: F3 menggunakan sistem template untuk merender halaman. Header dan footer umum berada di `application/views/templates/header.php` dan `application/views/templates/footer.php`.

# Gaya Penulisan

- **Pronomina**: Gunakan "aku, kamu, kau, kita". Hindari "loe, gue", kecuali untuk dialog atau monolog internal karakter tertentu (seperti Bimo) dalam adegan yang bersifat komedi/santai.
- **Paragraf**: Setiap adegan baru dimulai di paragraf baru.
- **Dialog**: Gunakan tanda kutip (“”) dan pisahkan tiap pembicara.
- **Deskripsi & Aksi**: Gabungkan dengan narasi, buat agar lebih terasa dan dapat dibayangkan.
- **Latar Lokasi**: Setiap bab atau sub-bab harus secara eksplisit menyebutkan latar lokasi utama di awal atau di bagian yang relevan untuk memberikan gambaran yang jelas kepada pembaca.
- **Istilah Asing**: Untuk setiap istilah asing yang dicetak miring (misalnya, `*spawn*`, `*glitch*`), tambahkan penjelasan singkat di bagian bawah cerita atau bab terkait.

