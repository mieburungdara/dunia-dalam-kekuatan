<div class="container">
    <h1 class="mt-4 mb-3">Novel: {{ @novel_title }}</h1>

    <div class="list-group">
        <repeat group="{{ @arcs }}" value="{{ @arc }}">
            <a href="{{ @arc.url }}" class="list-group-item list-group-item-action">
                {{ @arc.title }}
            </a>
        </repeat>
    </div>
</div>
