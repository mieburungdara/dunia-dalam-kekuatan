# Dunia dalam Kekuatan

Selamat datang di dunia Eryndor. Ini adalah kisah tentang lima orang asing dari Bumi yang ditakdirkan untuk mengubah takdir sebuah dunia.

## Daftar Isi

### Cerita Utama

{% for chapter in site.cerita %}
{% if chapter.basename == "index.md" %}
- [{{ chapter.title }}]({{ chapter.url | relative_url }})
{% endif %}
{% endfor %}