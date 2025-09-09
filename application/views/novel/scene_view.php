<div class="container my-4">
    <!-- Header Scene -->
    <div class="mb-4">
        <h4 class="text-muted">
            Novel: {{ @novel_title }} - Arc: {{ @arc_title }} - Chapter: {{ @chapter_title }}
        </h4>
        <p class="text-muted">{{ @chapter_summary }}</p>
        <h1 class="mt-3">{{ @scene_name }}</h1>
    </div>

    <!-- Scene Contents -->
    <div class="scene-contents">
        <check if="{{ @scene_data['Chapters'][0]['Scenes'][0]['Contents'] }}">
            <repeat group="{{ @scene_data['Chapters'][0]['Scenes'][0]['Contents'] }}" value="{{ @block }}">
                
                <!-- Exposition -->
                <check if="{{ @block['Type'] == 'Exposition' }}">
                    <div class="card mb-3 border-info">
                        <div class="card-header bg-info text-white">Exposition: {{ @block['Topic'] ?? '' }}</div>
                        <div class="card-body">{{ @block['Text'] ?? '' }}</div>
                    </div>
                </check>

                <!-- Action -->
                <check if="{{ @block['Type'] == 'Action' }}">
                    <div class="alert alert-primary mb-2">
                        <strong>{{ @block['Actor']['Name'] ?? @block['Actor'] ?? 'Unknown' }}</strong> 
                        performs action on <strong>{{ @block['Target'] ?? '-' }}</strong>: {{ @block['Text'] ?? '' }} 
                        (Outcome: {{ @block['Outcome'] ?? '-' }})
                    </div>
                </check>

                <!-- Dialogue -->
                <check if="{{ @block['Type'] == 'Dialogue' }}">
                    <div class="card mb-2 border-success">
                        <div class="card-header bg-success text-white">
                            {{ @block['Speaker']['Name'] ?? @block['Speaker'] ?? 'Unknown' }} 
                            (Tone: {{ @block['Tone'] ?? '-' }})
                        </div>
                        <div class="card-body">{{ @block['Line'] ?? '' }}</div>
                    </div>
                </check>

                <!-- InnerThought -->
                <check if="{{ @block['Type'] == 'InnerThought' }}">
                    <div class="alert alert-secondary mb-2">
                        <strong>{{ @block['Character']['Name'] ?? @block['Character'] ?? 'Unknown' }}</strong>'s inner thoughts: {{ @block['Text'] ?? '' }}
                    </div>
                </check>

                <!-- Emotion -->
                <check if="{{ @block['Type'] == 'Emotion' }}">
                    <div class="badge bg-warning mb-2">
                        Emotion ({{ @block['Character']['Name'] ?? @block['Character'] ?? 'Unknown' }}): 
                        {{ @block['Text'] ?? '-' }} 
                        (Intensity: {{ @block['Intensity'] ?? '-' }})
                    </div>
                </check>

                <!-- Clue -->
                <check if="{{ @block['Type'] == 'Clue' }}">
                    <div class="alert alert-info mb-2">
                        Clue: {{ @block['Text'] ?? '' }} 
                        (Source: {{ @block['Source'] ?? '-' }}, Relevance: {{ @block['Relevance'] ?? '-' }})
                    </div>
                </check>

                <!-- Conflict -->
                <check if="{{ @block['Type'] == 'Conflict' }}">
                    <div class="alert alert-danger mb-2">
                        Conflict: {{ @block['Text'] ?? '' }} 
                        (Participants: {{ @block['Participants'] | join(', ') ?? '-' }}, Nature: {{ @block['Nature'] ?? '-' }})
                    </div>
                </check>

                <!-- Decision -->
                <check if="{{ @block['Type'] == 'Decision' }}">
                    <div class="card mb-2 border-warning">
                        <div class="card-header bg-warning">
                            Decision by {{ @block['Character']['Name'] ?? @block['Character'] ?? 'Unknown' }}
                        </div>
                        <div class="card-body">
                            {{ @block['Text'] ?? '' }}<br>
                            Options: {{ @block['Options'] | join(', ') ?? '-' }}, Consequence: {{ @block['Consequence'] ?? '-' }}
                        </div>
                    </div>
                </check>

                <!-- Default fallback for unhandled types -->
                <check if="{{ @block['Type'] != 'Exposition' && @block['Type'] != 'Action' && @block['Type'] != 'Dialogue' && @block['Type'] != 'InnerThought' && @block['Type'] != 'Emotion' && @block['Type'] != 'Clue' && @block['Type'] != 'Conflict' && @block['Type'] != 'Decision' }}">
                    <div class="card mb-2 border-secondary">
                        <div class="card-header bg-secondary text-white">{{ @block['Type'] }}</div>
                        <div class="card-body">{{ @block['Text'] ?? 'No content available.' }}</div>
                    </div>
                </check>

            </repeat>
        </check>
    </div>
</div>
