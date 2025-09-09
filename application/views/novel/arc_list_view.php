<div class="container">
    <h1 class="mt-4 mb-3">Novel: {{ @novel_title }}</h1>
    <h2 class="mb-3"><small class="text-muted">Slug: {{ @novel_slug }}</small></h2>

    <div class="list-group">
        <repeat group="{{ @arcs }}" value="{{ @arc }}">
            <a href="{{ @arc.url }}" class="list-group-item list-group-item-action">
                {{ @arc.name }}
            </a>
        </repeat>
    </div>
</div>
