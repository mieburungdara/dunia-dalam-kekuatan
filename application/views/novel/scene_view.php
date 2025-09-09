<div class="container py-4">
    <h1 class="mb-4">Scene: {{ @scene_name }}</h1>

    <h5 class="text-muted mb-2">Novel: {{ @novel_title }}</h5>
    <h6 class="text-muted mb-2">Arc: {{ @arc_title }}</h6>
    <h6 class="text-muted mb-4">Chapter: {{ @chapter_title }}</h6>
    <p class="fst-italic text-secondary">{{ @chapter_summary }}</p>

    <repeat group="{{ @scene_contents }}" value="{{ @block }}">
        <div class="mb-3">
            <check if="{{ isset(@block['Text']) }}">
                <p>{{ @block['Text'] }}</p>
            </check>

            <check if="{{ isset(@block['Line']) }}">
                <blockquote class="blockquote">
                    “{{ @block['Line'] }}”
                    <footer class="blockquote-footer">
                        {{ @block['Speaker']['Name'] ?? 'Unknown' }}
                    </footer>
                </blockquote>
            </check>
        </div>
    </repeat>
</div>
