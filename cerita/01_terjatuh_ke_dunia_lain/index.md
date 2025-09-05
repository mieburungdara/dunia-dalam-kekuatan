---
title: Bab 1 - Tersesat di Hutan Asing
---
# Bab 1: Tersesat di Hutan Asing

Bab ini menceritakan momen-momen pertama kelima pahlawan kita saat mereka terlempar ke dunia Eryndor, terpisah, dan menghadapi ancaman pertama mereka sebelum takdir mempertemukan mereka.

## Sub-Bab

{% for sub_chapter in site.static_files %}
  {% if sub_chapter.path contains page.dir and sub_chapter.extname == '.md' and sub_chapter.name != 'index.md' %}
- [{{ sub_chapter.basename | remove: ".md" | replace: "_", " " }}]({{ sub_chapter.path | relative_url }})
  {% endif %}
{% endfor %}

{% include image_gallery.html %}