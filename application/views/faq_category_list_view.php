<h1>FAQ Categories</h1>

<ul>
    <?php foreach ($faq_categories as $category): ?>
        <li><a href="<?= $app_base_url . '/faq/' . $category['slug'] ?>"><?= $category['title'] ?></a></li>
    <?php endforeach; ?>
</ul>