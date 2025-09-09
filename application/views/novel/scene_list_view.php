<div class="container">
    <h1 class="mt-4 mb-3">Chapter: {{ @chapter_title }}</h1>
    <h2 class="mb-3"><small class="text-muted">Arc: {{ @arc_name }}</small></h2>
    <h3 class="mb-4"><small class="text-muted">Novel: {{ @novel_slug }}</small></h3>

    <div class="list-group">
        <repeat group="{{ @scenes }}" value="{{ @scene }}">
        <a href="{{ @BASE }}/read/{{@novel_slug}}/{{@arc_name}}/{{@chapter_name}}/{{@scene.slug}}" class="list-group-item list-group-item-action">
                <div class="d-flex w-100 justify-content-between">
                    <h5 class="mb-1">{{ @scene.title }}</h5>
                </div>
                <p class="mb-1">{{ @scene.summary }}</p>
                <small>Sudut Pandang: {{ @scene.pov_character_name }}</small>
            </a>
        </repeat>
    </div>
</div>
