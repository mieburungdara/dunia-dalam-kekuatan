<div class="container py-4">
    <h1 class="mb-3">Scene: {{ @scene_name }}</h1>
    <p class="text-muted">Novel: {{ @novel_title }} | Arc: {{ @arc_title }} | Chapter: {{ @chapter_title }}</p>
    <p class="fst-italic mb-4">{{ @chapter_summary }}</p>

    <div class="story-content">
        {{ @rendered_content | raw }}
    </div>

    <hr class="my-4">

    <div class="row">
        <div class="col text-start">
            <check if="{{ @prev_link_url }}">
                <a href="{{ @prev_link_url }}" class="btn btn-secondary">&laquo; Adegan Sebelumnya</a>
            </check>
        </div>
        <div class="col text-end">
            <check if="{{ @next_link_url }}">
                <a href="{{ @next_link_url }}" class="btn btn-primary">Adegan Selanjutnya &raquo;</a>
            </check>
        </div>
    </div>
</div>