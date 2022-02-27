<div class="view_title">
    <h1><?php echo htmlspecialchars($post['title']); ?></h1>
    <h4 class="post-date">Posted on: <?php echo htmlspecialchars($post['created_at']); ?></h4><br>
</div>

<div class="view_items">
    <div class="all_items">
        <div class="post_img">
            <img alt="post_image" src="<?php echo site_url(); ?>assets/images/posts/<?php echo htmlspecialchars($post['post_image']); ?>">
        </div>
        <br>
        <div class="buttns">
<!--        Show edit and delete functions if it created user-->
            <?php if($this->session->userdata('user_id') == $post['user_id']): ?>
                <a href="<?php echo base_url(); ?>posts/edit/<?php echo htmlspecialchars($post['slug']); ?>">Edit</a>
                <?php echo form_open('/posts/delete/'.$post['id']); ?>
                <input type="submit" value="Delete">
                <?php echo form_close(); ?>
            <?php endif; ?>
        </div>
    </div>
    <div class="view_body">
        <?php echo htmlspecialchars($post['body']); ?>
    </div>
</div>


<div class="comments">
    <h1>Comments</h1>
    <?php if(validation_errors()){?>
        <div class="message2">
            <?php echo validation_errors(); ?>
        </div>
    <?php } else {
        if($comments){ //If there are comments
            foreach($comments as $comment){ //Show all the comments?>
                    <div class="comment">
                        <h3>By "<?php echo htmlspecialchars($comment['name']); ?>"</h3>
                        <p><?php echo htmlspecialchars($comment['body']); ?></p>
                    </div>
            <?php }
        } else { //if there are no comments?>
            <p class="no_comments">There are no comments yet. Comment first!</p>
        <?php }
    } ?>
</div>

<div class="add_comment">
    <h1 class="add_title">Add Comment</h1>
<!--Comment form-->
    <?php echo form_open('comments/create/'.$post['id'], 'class="jsValid"'); ?>
    <div class="input_comment">
        <label for="name"></label>
        <input type="text" id="name" value="<?= set_value('name') ?>" name="name" placeholder="Enter your name*" required>
        <div class="errors"></div>
    </div>

    <div class="input_comment">
        <label for="email"></label>
        <input type="email" id="email" value="<?= set_value('email') ?>" name="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2, 4}$" title="Example: Aaa@bbb.ccc" placeholder="Enter your email">
        <div class="errors"></div>
    </div>

    <div class="input_comment">
        <label for="body"></label>
        <textarea name="body" id="body" placeholder="Write something!*" required></textarea>
        <div class="errors"></div>
    </div>
    <button type="submit">Submit</button>
    <input type="hidden" name="slug" id="slug" value="<?php echo htmlspecialchars($post['slug']); ?>">
    <?php echo form_close(); ?>
</div>
<!--Validation script-->
<script src="<?php echo base_url(); ?>assets/js/validation.js"></script>


