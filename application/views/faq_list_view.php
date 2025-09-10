<h1>FAQs in <?= $category_title ?></h1>

<ul>
    <?php foreach ($faqs as $faq): ?>
        <li><a href="<?= $app_base_url . '/faq/' . $category_slug . '/' . $faq['slug'] ?>"><?= $faq['title'] ?></a></li>
    <?php endforeach; ?>
</ul>