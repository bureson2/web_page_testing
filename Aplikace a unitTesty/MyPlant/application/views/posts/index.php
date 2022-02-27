<div class="posts_intro">
    <div class="posts_intro_title">
        <h1><?= htmlspecialchars($title) ?></h1>
        <p class="description">Don't be shy, create your own post about your houseplant!</p>
    </div>
</div>
<!--Show all the posts-->
<?php foreach($posts as $post) : ?>
<div class="post_index">
    <div class="post_title">
        <h3><?php echo htmlspecialchars($post['title']); ?></h3>
    </div>
    <div class="post_inner">
        <div class="post_img">
            <img src="<?php echo site_url(); ?>assets/images/posts/<?php echo htmlspecialchars($post['post_image']); ?>" alt="post_picture">
        </div>
        <div class="post_body">
            <h3 class="post_category"> <?php echo htmlspecialchars($post['name']); ?></h3>
            <?php echo htmlspecialchars(word_limiter($post['body'], 60)); //Limit on the number of words in the preview?>
        </div>
    </div>
    <p><a class="read_more" href="<?php echo site_url('/posts/'.$post['slug']); ?>">Read More</a></p>
</div>
<?php endforeach; ?>

<div class="pagination_links">
    <?php echo $this->pagination->create_links(); ?>
</div>