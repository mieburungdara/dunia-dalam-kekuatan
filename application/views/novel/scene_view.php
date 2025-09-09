<div class="container py-4">
    <h1 class="mb-3">Scene: {{ @scene_name }}</h1>
    <p class="text-muted">Novel: {{ @novel_title }} | Arc: {{ @arc_title }} | Chapter: {{ @chapter_title }}</p>
    <p class="fst-italic mb-4">{{ @chapter_summary }}</p>

    <div class="story-content">
        <?= /* @php echo */ @rendered_content ?>
    </div>
</div>