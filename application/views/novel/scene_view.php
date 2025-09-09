<div class="container py-4">

    <h2 class="mb-4">Scene Contents</h2>

    <repeat group="{{ @scene_content }}" value="{{ @c }}">
        <div class="card mb-3 shadow-sm">
            <div class="card-header bg-light d-flex justify-content-between align-items-center">
                <span class="fw-bold">{{ @c['Type'] }}</span>
                <small class="text-muted">
                    <check if="{{ isset(@c['Actor']['Name']) }}">
                        <true>Actor: {{ @c['Actor']['Name'] }}</true>
                    </check>
                    <check if="{{ isset(@c['Speaker']['Name']) }}">
                        <true>Speaker: {{ @c['Speaker']['Name'] }}</true>
                    </check>
                    <check if="{{ isset(@c['Character']['Name']) }}">
                        <true>Character: {{ @c['Character']['Name'] }}</true>
                    </check>
                </small>
            </div>
            <div class="card-body">
                <!-- Text / Line -->
                <check if="{{ isset(@c['Text']) }}">
                    <p class="card-text">{{ @c['Text'] }}</p>
                </check>
                <check if="{{ isset(@c['Line']) }}">
                    <blockquote class="blockquote">
                        <p>“{{ @c['Line'] }}”</p>
                        <footer class="blockquote-footer">
                            {{ @c['Speaker']['Name'] ?? 'Unknown' }}
                        </footer>
                    </blockquote>
                </check>

                <!-- Extra Metadata -->
                <check if="{{ isset(@c['Topic']) }}">
                    <span class="badge bg-info me-1">Topic: {{ @c['Topic'] }}</span>
                </check>
                <check if="{{ isset(@c['Tone']) }}">
                    <span class="badge bg-warning text-dark me-1">Tone: {{ @c['Tone'] }}</span>
                </check>
                <check if="{{ isset(@c['Outcome']) }}">
                    <span class="badge bg-success me-1">Outcome: {{ @c['Outcome'] }}</span>
                </check>
                <check if="{{ isset(@c['Impact']) }}">
                    <span class="badge bg-danger me-1">Impact: {{ @c['Impact'] }}</span>
                </check>
            </div>
        </div>
    </repeat>
</div>
