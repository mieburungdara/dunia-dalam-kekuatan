<div class="container mt-4">
    <h1>Dokumen Worldbuilding</h1>
    <p>Berikut adalah kumpulan dokumen yang menjelaskan berbagai aspek dunia Pecahan Dunia.</p>
    <div class="list-group">
        <repeat group="{{ @worldbuilding_files }}" value="{{ @file }}">
            <a href="{{ @BASE }}/worldbuilding/{{ @file.slug }}" class="list-group-item list-group-item-action">
                {{ @file.title }}
            </a>
        </repeat>
    </div>
</div>