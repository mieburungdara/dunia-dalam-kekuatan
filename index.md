---
layout: default
title: Beranda
---

<style>
    /* Hero Section */
    .hero-section {
        background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('https://via.placeholder.com/1500x500?text=Dunia+Fantasi') no-repeat center center; /* Ganti dengan gambar latar belakang Anda */
        background-size: cover;
        color: white;
        padding: 100px 0;
        text-align: center;
        margin-bottom: 40px;
    }
    .hero-section h1 {
        font-size: 3.5rem;
        margin-bottom: 20px;
    }
    .hero-section p {
        font-size: 1.25rem;
    }

    /* Card Grid for Chapters */
    .chapter-card-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 20px;
    }
    .chapter-card {
        border: 1px solid var(--card-border);
        border-radius: 0.5rem;
        transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
        background-color: var(--card-bg);
        text-decoration: none; /* Remove underline from link */
        color: inherit; /* Inherit text color */
        display: block; /* Make the whole card clickable */
    }
    .chapter-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 0.5rem 1rem var(--hover-shadow);
    }
    .chapter-card .card-body {
        padding: 20px;
    }
    .chapter-card .card-title {
        color: var(--primary-color);
        font-size: 1.5rem;
        margin-bottom: 10px;
    }
    .chapter-card .card-text {
        font-size: 1rem;
    }
</style>

<div class="hero-section">
    <div class="container">
        <h1>Dunia dalam Kekuatan</h1>
        <p>Sebuah kisah epik tentang takdir, petualangan, dan kekuatan yang tersembunyi.</p>
    </div>
</div>

<div class="container">
    <h2 class="mb-4">Daftar Isi Cerita</h2>
    <div class="chapter-card-grid">
        {% assign sorted_chapters = site.cerita | sort: 'path' %}
        {% for chapter in sorted_chapters %}
            {% assign chapter_path_parts = chapter.path | split: '/' %}
            {% assign chapter_file = chapter_path_parts | last %}

            {% comment %}
                Logic to display main chapters (index.md in chapter folder)
                and sub-chapters (other .md files in chapter folder)
            {% endcomment %}

            {% if chapter_file == "index.md" %}
                <a href="{{ chapter.url | relative_url }}" class="chapter-card">
                    <div class="card-body">
                        <h5 class="card-title">{{ chapter.title }}</h5>
                        <p class="card-text">Baca bab utama ini untuk memulai petualangan.</p>
                    </div>
                </a>
            {% elsif chapter_file contains ".md" %}
                {% comment %}
                    This section handles sub-chapters.
                    You might want to display them differently or group them under their main chapter.
                    For simplicity, I'm listing them as separate cards here.
                    Consider adding a 'parent_chapter' variable in front matter for better grouping.
                {% endcomment %}
                <a href="{{ chapter.url | relative_url }}" class="chapter-card">
                    <div class="card-body">
                        <h5 class="card-title">{{ chapter.title }}</h5>
                        <p class="card-text">Lanjutkan membaca sub-bab ini.</p>
                    </div>
                </a>
            {% endif %}
        {% endfor %}
    </div>
</div>