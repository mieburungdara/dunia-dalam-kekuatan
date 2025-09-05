# Dunia dalam Kekuatan

Selamat datang di dunia Eryndor. Ini adalah kisah tentang lima orang asing dari Bumi yang ditakdirkan untuk mengubah takdir sebuah dunia.

## Daftar Isi

<ul>
{% assign sorted_chapters = site.cerita | sort: 'path' %}
{% for chapter in sorted_chapters %}
  <li><a href="{{ chapter.url | relative_url }}">{{ chapter.title }}</a></li>
{% endfor %}
</ul>