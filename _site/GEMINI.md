# Directory Overview

This directory contains the foundational documents for a fantasy novel project titled "Dunia dalam Kekuatan" (The World in Power). The story revolves around a simple shepherd named Ardan who is chosen by fate to become the "Fates Shepherd" and unite 12 legendary zodiac guardians to fight against a rising darkness.

The project is structured as a collection of Markdown files that detail the plot, characters, world-building rules, and specific skills or abilities within the story's universe.

# Key Files

*   **`README.md`**: Provides a brief, narrative introduction to the story's protagonist, Ardan, and the initial premise of his journey.
*   **`GUIDE.md`**: This is a crucial file acting as a guide for an AI writer. It establishes the core plot points, character personalities (Ardan, Aries, Taurus), the story's timeline, and the fundamental rules of the world to ensure narrative consistency.
*   **`WORLDBUILDING.md`**: Details the fantasy world's mechanics. It explains the primary energy source ("Aether"), the system of magic, the concept of "Skills", powerful "Relics", and the different factions that exist within the world.
*   **`SKILL_PATTERN.md`**: Contains a standard template for creating new skill description files to ensure consistency.
*   **`SKILL_LIST.md`**: An empty file likely intended to list and describe the various skills and powers that characters can possess.
*   **Character/Skill Files**: The directory contains numerous other Markdown files (e.g., `Bulls_Might.md`, `Fates_Shepherd.md`) that appear to be detailed descriptions of individual skills, powers, or character-specific abilities.

# Usage

The contents of this directory are used for the creative development and writing of a fantasy novel. The files serve as a "single source of truth" to maintain consistency in the story's lore, characters, and plot.

When working on this project, it is important to:
1.  Adhere to the rules and character traits defined in `GUIDE.md` and `WORLDBUILDING.md`.
2.  When creating a new skill, **always follow the template in `SKILL_PATTERN.md`**.
3.  Use the individual skill files as a reference for character abilities.
4.  Update the `SKILL_LIST.md` as new skills are conceptualized.

# Konfigurasi

- **Bahasa**: Selalu gunakan Bahasa Indonesia untuk semua percakapan.
- **Alur Kerja Git**: Tunggu perintah "commit" dari pengguna. Saat diperintahkan, perbarui `changelogs.md` terlebih dahulu, baru jalankan `git add .`, `git commit`, dan `git push`.
- **Metode Revisi**: Revisi cerita adalah proses **penggabungan**, bukan penggantian. Pertahankan narasi yang ada sambil mengintegrasikan ide-ide baru dari file revisi.
- **Struktur Bab Dinamis**: Gunakan sistem Koleksi Jekyll (`collections`) untuk `cerita`. Setiap bab baru harus memiliki `title` di dalam *front matter* agar muncul di daftar isi secara otomatis.
- **Konsistensi Cerita**: Setiap kali mengubah atau menulis ulang sebuah bagian cerita, lakukan pemeriksaan silang dengan `GUIDE.md` dan bab-bab lain untuk memastikan tidak ada konflik plot, karakter, atau aturan dunia.
- **Tampilan Gambar Otomatis**: Setiap halaman bab di situs harus secara otomatis menampilkan semua gambar yang ada di dalam folder bab tersebut, diurutkan berdasarkan nama file.
- **Anti-Cache**: Situs dikonfigurasi untuk selalu memuat versi terbaru dan tidak menyimpan cache di browser.

# Gaya Penulisan

- **Pronomina**: Gunakan "aku, kamu, kau, kita". Hindari "loe, gue", kecuali untuk dialog atau monolog internal karakter tertentu (seperti Bimo) dalam adegan yang bersifat komedi/santai.
- **Paragraf**: Setiap adegan baru dimulai di paragraf baru.
- **Dialog**: Gunakan tanda kutip (“”) dan pisahkan tiap pembicara.
- **Deskripsi & Aksi**: Gabungkan dengan narasi, buat agar lebih terasa dan dapat dibayangkan.
- **Latar Lokasi**: Setiap bab atau sub-bab harus secara eksplisit menyebutkan latar lokasi utama di awal atau di bagian yang relevan untuk memberikan gambaran yang jelas kepada pembaca.
- **Istilah Asing**: Untuk setiap istilah asing yang dicetak miring (misalnya, `*spawn*`, `*glitch*`), tambahkan penjelasan singkat di bagian bawah cerita atau bab terkait.

