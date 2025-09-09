<div class="container">
    <h1 class="mt-4 mb-3">Chapter: {{ @chapter_title }}</h1>
    <h2 class="mb-3"><small class="text-muted">Arc: {{ @arc_name }}</small></h2>
    <h3 class="mb-4"><small class="text-muted">Novel: {{ @novel_slug }}</small></h3>

    <div class="list-group">
        <repeat group="{{ @scenes }}" value="{{ @scene }}">
            <a href="{{ @scene.url }}" class="list-group-item list-group-item-action">
                {{ @scene.name }}
            </a>
        </repeat>
    </div>
</div>
