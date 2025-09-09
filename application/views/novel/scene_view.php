<div class="container py-4">
    <h1 class="mb-3">Scene: {{ @scene_name }}</h1>
    <p class="text-muted">Novel: {{ @novel_title }} | Arc: {{ @arc_title }} | Chapter: {{ @chapter_title }}</p>
    <p class="fst-italic mb-4">{{ @chapter_summary }}</p>

    <repeat group="{{ @scene_contents }}" value="{{ @block }}">
        <check if="{{ isset(@block['Type']) }}">
            <!-- DIALOGUE -->
            <check if="{{ @block['Type'] == 'Dialogue' }}">
                <blockquote class="blockquote bg-light p-3 border-start border-4 border-success rounded">
                    <p class="mb-1">“{{ @block['Line'] }}”</p>
                    <footer class="blockquote-footer">
                        {{ @block['Speaker']['Name'] ?? 'Unknown' }}
                        <small class="text-muted">({{ @block['Tone'] ?? 'Neutral' }})</small>
                    </footer>
                </blockquote>
            </check>

            <!-- ACTION -->
            <check if="{{ @block['Type'] == 'Action' }}">
                <div class="card mb-3 border-primary">
                    <div class="card-body">
                        <h6 class="card-title">Action: {{ @block['Actor']['Name'] ?? 'Unknown' }}</h6>
                        <p class="card-text">{{ @block['Text'] }}</p>
                        <small class="text-muted">Target: {{ @block['Target'] ?? '-' }} | Outcome: {{ @block['Outcome'] ?? '-' }}</small>
                    </div>
                </div>
            </check>

            <!-- CONFLICT -->
            <check if="{{ @block['Type'] == 'Conflict' }}">
                <div class="alert alert-danger mb-3">
                    <strong>Conflict:</strong> {{ @block['Text'] }}<br>
                    Participants: {{ implode(', ', @block['Participants'] ?? []) }} | Nature: {{ @block['Nature'] ?? '-' }}
                </div>
            </check>

            <!-- EXPOSITION -->
            <check if="{{ @block['Type'] == 'Exposition' }}">
                <div class="card mb-3 bg-light text-dark">
                    <div class="card-body">
                        <h6 class="card-title">Exposition: {{ @block['Topic'] ?? 'World' }}</h6>
                        <p>{{ @block['Text'] }}</p>
                    </div>
                </div>
            </check>

            <!-- INNER THOUGHT -->
            <check if="{{ @block['Type'] == 'InnerThought' }}">
                <div class="callout callout-info mb-3 p-3 border-start border-4 border-info bg-light">
                    <p><strong>Thought:</strong> {{ @block['Text'] }}</p>
                    <small class="text-muted">Character: {{ @block['Character']['Name'] ?? 'Unknown' }} | Theme: {{ @block['Theme'] ?? '-' }}</small>
                </div>
            </check>

            <!-- CLUE -->
            <check if="{{ @block['Type'] == 'Clue' }}">
                <div class="alert alert-warning mb-3">
                    <strong>Clue:</strong> {{ @block['Text'] }}<br>
                    Source: {{ @block['Source'] ?? '-' }} | Relevance: {{ @block['Relevance'] ?? '-' }}
                </div>
            </check>

            <!-- EMOTION -->
            <check if="{{ @block['Type'] == 'Emotion' }}">
                <div class="badge bg-secondary mb-2">Emotion ({{ @block['Character']['Name'] ?? '-' }}): {{ @block['Text'] }} ({{ @block['Intensity'] ?? '-' }})</div>
            </check>

            <!-- DIALOGUE, INNER, ACTION, ETC. lainnya bisa ditambahkan di bawah -->
            <check if="{{ @block['Type'] != 'Dialogue' && @block['Type'] != 'Action' && @block['Type'] != 'Conflict' && @block['Type'] != 'Exposition' && @block['Type'] != 'InnerThought' && @block['Type'] != 'Clue' && @block['Type'] != 'Emotion' }}">
                <div class="card mb-3 border-secondary">
                    <div class="card-body">
                        <h6 class="card-title">{{ @block['Type'] }}</h6>
                        <p>{{ @block['Text'] ?? 'No content' }}</p>
                    </div>
                </div>
            </check>

        </check>
    </repeat>
</div>
