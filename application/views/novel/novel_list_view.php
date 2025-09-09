<div class="container">
    <h1 class="mt-4 mb-3">Daftar Novel</h1>

    <div class="list-group">
        <?php var_dump($f3->get('novels'));?>
        <repeat group="{{ @novels }}" value="{{ @novel }}">
    <a href="{{ @novel.url }}" class="list-group-item list-group-item-action">
        {{ @novel.title }}
    </a>
</repeat>

    </div>
</div>