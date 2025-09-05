---
title: Bab 1 - Tersesat di Hutan Asing
---
# Bab 1: Tersesat di Hutan Asing

Langit malam di atas hutan asing itu retak tanpa suara. Lima sosok manusia terlempar dari kehampaan, jatuh di lokasi berbeda. Saat tubuh mereka menyentuh tanah, pilar cahaya putih yang menyilaukan menjulang tinggi dari titik masing-masing, menusuk langit sebelum lenyap seketika. Fenomena aneh itu tidak luput dari perhatian para penghuni hutan. Bagi para goblin, makhluk primitif yang lapar, cahaya itu adalah pertanda: mangsa baru telah tiba.

## Sudut Pandang

{% for sub_chapter in site.static_files %}
  {% if sub_chapter.path contains page.dir and sub_chapter.extname == '.md' and sub_chapter.name != 'index.md' %}
- [{{ sub_chapter.basename | remove: ".md" | replace: "_", " " | slice: 2, 100 }}]({{ sub_chapter.path | relative_url }})
  {% endif %}
{% endfor %}

{% include image_gallery.html %}
