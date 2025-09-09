<div class="container my-4">
    <!-- Judul Scene -->
    <h1 class="mb-3">Scene: {{ @scene_name }}</h1>

    <!-- Info Novel, Arc, Chapter -->
    <div class="mb-4 text-muted">
        <h4>Novel: {{ @novel_title }}</h4>
        <h5>Arc: {{ @arc_title }}</h5>
        <h5>Chapter: {{ @chapter_title }}</h5>
        <p>{{ @chapter_summary }}</p>
    </div>

    <!-- Konten Scene -->
    <div class="scene-contents">
        {{ @scene_data['Chapters'][0]['Scenes'][0]['Contents'] ? @scene_data['Chapters'][0]['Scenes'][0]['Contents'] : [] | each(content) }}
            {{ content.Type == 'Exposition' ? '
                <div class="card mb-3 border-info">
                    <div class="card-header bg-info text-white">Exposition</div>
                    <div class="card-body">
                        <p>' ~ content.Text ~ '</p>
                    </div>
                </div>
            ' : '' }}

            {{ content.Type == 'Atmosphere' ? '
                <div class="alert alert-secondary mb-3">
                    <strong>Atmosphere:</strong> ' ~ content.Text ~ '
                </div>
            ' : '' }}

            {{ content.Type == 'Description' ? '
                <div class="card mb-3 border-light">
                    <div class="card-body">
                        <em>Description:</em> ' ~ content.Text ~ '
                    </div>
                </div>
            ' : '' }}

            {{ content.Type == 'Action' ? '
                <div class="alert alert-warning mb-3">
                    <strong>Action by ' ~ content.Actor.Name ~ ':</strong> ' ~ content.Text ~ '
                </div>
            ' : '' }}

            {{ content.Type == 'Dialogue' ? '
                <div class="card mb-3 border-primary">
                    <div class="card-header bg-primary text-white">' ~ content.Speaker.Name ~ ' says:</div>
                    <div class="card-body">' ~ content.Line ~ '</div>
                </div>
            ' : '' }}

            {{ content.Type == 'InnerThought' ? '
                <div class="card mb-3 border-dark">
                    <div class="card-body"><em>Thought of ' ~ content.Character.Name ~ ':</em> ' ~ content.Text ~ '</div>
                </div>
            ' : '' }}

            {{ content.Type == 'Emotion' ? '
                <div class="alert alert-info mb-3">
                    <strong>Emotion:</strong> ' ~ content.Text ~ '
                </div>
            ' : '' }}

            {{ content.Type == 'Clue' ? '
                <div class="alert alert-success mb-3">
                    <strong>Clue:</strong> ' ~ content.Text ~ '
                </div>
            ' : '' }}

            {{ content.Type == 'Conflict' ? '
                <div class="alert alert-danger mb-3">
                    <strong>Conflict:</strong> ' ~ content.Text ~ '
                </div>
            ' : '' }}

            {{ content.Type == 'Decision' ? '
                <div class="card mb-3 border-warning">
                    <div class="card-header bg-warning text-dark">Decision by ' ~ content.Character.Name ~ '</div>
                    <div class="card-body">
                        <p>' ~ content.Text ~ '</p>
                        <ul>
                        {{ content.Options ? content.Options | each(opt) }}
                            <li>{{ opt }}</li>
                        {{ end }}
                        </ul>
                    </div>
                </div>
            ' : '' }}

            {{ content.Type == 'Transition' ? '
                <hr class="my-4">
                <p class="text-muted"><em>' ~ content.Text ~ '</em></p>
            ' : '' }}

            {{ content.Type == 'BattleMove' ? '
                <div class="alert alert-danger mb-3">
                    <strong>Battle Move by ' ~ content.Actor.Name ~ ':</strong> ' ~ content.Text ~ '
                </div>
            ' : '' }}

            {{ content.Type == 'Vision' ? '
                <div class="card mb-3 border-info">
                    <div class="card-header bg-info text-white">Vision of ' ~ content.Character.Name ~ '</div>
                    <div class="card-body">' ~ content.Text ~ '</div>
                </div>
            ' : '' }}

            {{ content.Type == 'NarratorNote' ? '
                <div class="alert alert-secondary mb-3">
                    <strong>Narrator Note:</strong> ' ~ content.Text ~ '
                </div>
            ' : '' }}

            {{ content.Type == 'Travelogue' ? '
                <div class="card mb-3 border-light">
                    <div class="card-body"><em>Travel:</em> ' ~ content.Text ~ '</div>
                </div>
            ' : '' }}

            {{ content.Type == 'Flashback' ? '
                <div class="card mb-3 border-warning">
                    <div class="card-header bg-warning text-dark">Flashback</div>
                    <div class="card-body">' ~ content.Text ~ '</div>
                </div>
            ' : '' }}

            {{ content.Type == 'Foreshadowing' ? '
                <div class="alert alert-info mb-3">
                    <strong>Foreshadowing:</strong> ' ~ content.Text ~ '
                </div>
            ' : '' }}

            {{ content.Type == 'Symbolism' ? '
                <div class="card mb-3 border-primary">
                    <div class="card-body"><em>Symbolism:</em> ' ~ content.Text ~ '</div>
                </div>
            ' : '' }}

            {{ content.Type == 'Prophecy' ? '
                <div class="card mb-3 border-dark">
                    <div class="card-header bg-dark text-white">Prophecy</div>
                    <div class="card-body">' ~ content.Text ~ '</div>
                </div>
            ' : '' }}

            {{ content.Type == 'Dream' ? '
                <div class="card mb-3 border-info">
                    <div class="card-header bg-info text-white">Dream</div>
                    <div class="card-body">' ~ content.Text ~ '</div>
                </div>
            ' : '' }}

            {{ content.Type == 'Hallucination' ? '
                <div class="alert alert-warning mb-3">
                    <strong>Hallucination:</strong> ' ~ content.Text ~ '
                </div>
            ' : '' }}

            {{ content.Type == 'ItemDiscovery' ? '
                <div class="card mb-3 border-success">
                    <div class="card-header bg-success text-white">Item Discovery</div>
                    <div class="card-body">' ~ content.Text ~ '</div>
                </div>
            ' : '' }}

            {{ content.Type == 'MysteryEvent' ? '
                <div class="alert alert-dark mb-3">
                    <strong>Mystery Event:</strong> ' ~ content.Text ~ '
                </div>
            ' : '' }}

        {{ end }}
    </div>
</div>
