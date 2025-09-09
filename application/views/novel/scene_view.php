<div class="container py-4">
    <h1 class="mb-4">Scene: {{ @scene_name }}</h1>

    <p class="text-muted">Novel: {{ @novel_title }} | Arc: {{ @arc_title }} | Chapter: {{ @chapter_title }}</p>
    <p class="fst-italic">{{ @chapter_summary }}</p>

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
