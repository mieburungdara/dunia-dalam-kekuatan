---
layout: page
title: Daftar Cerita
permalink: /cerita/
---

# Daftar Cerita

{% assign chapters_by_chapter_title = site.cerita | group_by: "chapter_title" | sort: "name" %}

{% for chapter_group in chapters_by_chapter_title %}
  ## {{ chapter_group.name }}
  <ul>
  {% assign sorted_chapters = chapter_group.items | sort: "order" %}
  {% for chapter in sorted_chapters %}
    <li><a href="{{ chapter.url }}">{{ chapter.title }}</a></li>
  {% endfor %}
  </ul>
{% endfor %}