
<div class="create_intro">
    <div class="container">
        <?php echo form_open_multipart('posts/create', 'class="jsValid"'); ?>
        <div class="create_post">
            <h2><?= htmlspecialchars($title); ?></h2>
            <div class="not_to_print">
                <label for="title">Add your title:</label>
                <input type="text"  id="title" value="<?= set_value('title') ?>" class="form-control" name="title" placeholder="Add Title" required>
                <div class="errors"></div>

                <label for="editor1">Tell us something about your plant:</label>
                <textarea id="editor1" name="body"  placeholder="Add Body" required></textarea>
                <div class="errors"></div>

                <label for="category">Choose a category:</label>
                <select name="category_id" id="category">
                    <!--Show all categories in select menu-->
                    <?php foreach($categories as $category): ?>
                        <option value="<?php echo htmlspecialchars($category['id']); ?>"><?php echo htmlspecialchars($category['name']); ?></option>
                    <?php endforeach; ?>
                </select>

                <label for="userfile">Upload a photo of your plant:</label>
                <input type="file" id="userfile" name="userfile" size="20">
                <button type="submit" class="btn btn-default">Submit</button>
            </div>
    </div>
        <?php echo form_close(); ?>
        <!--Show validation errors-->
        <?php if(validation_errors()):?>
        <div class='validator_message'>
            <?php echo validation_errors();?>
        </div>
        <?php endif;?>
    </div>
</div>
<!--Validation script-->
<script src="<?php echo base_url(); ?>assets/js/validation.js"></script>
