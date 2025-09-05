# Dunia dalam Kekuatan

Selamat datang di dunia Eryndor. Ini adalah kisah tentang lima orang asing dari Bumi yang ditakdirkan untuk mengubah takdir sebuah dunia.

## Daftar Isi

### Cerita Utama

{% for chapter in site.cerita %}
- [{{ chapter.title }}]({{ chapter.url | relative_url }})
{% endfor %}