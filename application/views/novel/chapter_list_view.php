<div class="container">
    <h1 class="mt-4 mb-3">Arc: {{ @arc_title }}</h1>
    <h2 class="mb-3"><small class="text-muted">Arc Name: {{ @arc_name }}</small></h2>
    <h3 class="mb-4"><small class="text-muted">Novel Slug: {{ @novel_slug }}</small></h3>

    <div class="list-group">
        <repeat group="{{ @chapters }}" value="{{ @chapter }}">
            <a href="{{ @chapter.url }}" class="list-group-item list-group-item-action">
                {{ @chapter.title }}
            </a>
        </repeat>
    </div>
</div>
