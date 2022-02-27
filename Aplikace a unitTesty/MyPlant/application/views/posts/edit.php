<div class="edit_intro">
    <div class="container">
        <?php echo form_open('posts/update', 'class="jsValid"'); ?>
        <div class="create_post">
            <h2><?= $title; ?></h2>
            <label for="title">Title</label>
            <input type="text" id="title" name="title" placeholder="Add Title" value="<?php echo htmlspecialchars($post['title']); ?>" required>
            <div class="errors"></div>

            <label for="body">Body</label>
            <textarea id="body" name="body" placeholder="Add Body" required><?php echo htmlspecialchars($post['body']); ?></textarea>
            <div class="errors"></div>

            <label for="cat_id">Category</label>
            <select name="category_id" id="cat_id" >
                <!--Show all categories in select menu-->
                <?php foreach($categories as $category): ?>
                    <option value="<?php echo htmlspecialchars($category['id']); ?>"><?php echo htmlspecialchars($category['name']); ?></option>
                <?php endforeach; ?>
            </select>
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($post['id']); ?>">
            <button type="submit" class="btn">Submit</button>
        </div>
        <?php echo form_close(); ?>
        <div class="message">
            <?php echo validation_errors();?>
        </div>
    </div>
</div>
<!--Validation script-->
<script src="<?php echo base_url(); ?>assets/js/validation.js"></script>





