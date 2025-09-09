<div class="container">
    <h4 class="mb-4"><small class="text-muted">Novel: {{ @novel_title }}</small></h4>
    <h3 class="mb-3"><small class="text-muted">Arc: {{ @arc_title }}</small></h3>
    <h2 class="mb-3"><small class="text-muted">Chapter: {{ @chapter_title }}</small></h2>
    <p class="mb-3"><small class="text-muted">Summary: {{ @chapter_summary }}</small></p>
    <h1 class="mt-4 mb-3">Scene: {{ @scene_name }}</h1>


    <div class="scene-content">
        {{ @scene_content | raw }}
    </div>
</div>
