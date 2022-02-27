<div class="category_intro">
    <div class="container">
        <h1 class="category_intro_title"><?= $title ?></h1>
        <ul class="categories">
            <?php foreach ($categories as $category) : ?>
                <li><a href="<?php echo site_url('/categories/posts/'.$category['id']); ?>"><?php echo $category['name']; ?></a></li>
            <?php endforeach; ?>
        </ul>
    </div>
</div>
