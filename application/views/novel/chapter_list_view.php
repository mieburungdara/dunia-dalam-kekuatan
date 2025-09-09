<div class="container">
    <h1 class="mt-4 mb-3">Arc: {{ @arc_title }}</h1>

    <div class="list-group">
        <repeat group="{{ @chapters }}" value="{{ @chapter }}">
            <a href="{{ @chapter.url }}" class="list-group-item list-group-item-action">
                {{ @chapter.title }}
            </a>
        </repeat>
    </div>
</div>
