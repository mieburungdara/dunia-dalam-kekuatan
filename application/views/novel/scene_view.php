<div class="container py-5">

    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><span class="text-muted">{{ @novel_title }}</span></li>
            <li class="breadcrumb-item"><span class="text-muted">{{ @arc_title }}</span></li>
            <li class="breadcrumb-item"><span class="text-muted">{{ @chapter_title }}</span></li>
            <li class="breadcrumb-item active" aria-current="page">{{ @scene_name }}</li>
        </ol>
    </nav>

    <!-- Scene Header -->
    <div class="mb-4">
        <h1 class="display-5 fw-bold">{{ @scene_name }}</h1>
        <p class="lead text-muted mb-1">Chapter: {{ @chapter_title }}</p>
        <p class="text-muted mb-1">Arc: {{ @arc_title }}</p>
        <p class="text-muted">Novel: {{ @novel_title }}</p>
        <hr>
        <p class="fst-italic text-secondary">{{ @chapter_summary }}</p>
    </div>

    <!-- Scene Content -->
    <div class="card shadow-sm">
        <div class="card-body scene-content">
            {{ @scene_content | raw }}
        </div>
    </div>
</div>
