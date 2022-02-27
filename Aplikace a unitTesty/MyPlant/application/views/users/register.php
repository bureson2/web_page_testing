
<div class="register_intro">
    <div class="container">
        <?php echo form_open('users/register', 'class="jsValid"'); ?>
        <div class="sign_up">
            <h1 class="print"><?= htmlspecialchars($title); ?></h1>

                <label for="name"></label>
                <input type="text" id="name" class="form-control" name="name" value="<?= set_value('name') ?>" placeholder="Enter your name*" pattern="[A-Z]{1}[a-z]{2,23}|[a-z]{3,23}" title="More than 2 letters" required autofocus>
                <div class="errors"></div>

                <label for="email"></label>
                <input type="email" id="email" class="form-control" name="email" value="<?= set_value('email') ?>" placeholder="Enter your email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2, 4}$" title="Example: Aaa@bbb.ccc">
                <div class="errors"></div>

                <label for="username"></label>
                <input type="text" id="username" class="form-control" name="username" value="<?= set_value('username') ?>" placeholder="Enter your username*" pattern="[A-Z]{1}[a-z]{2,23}|[a-z]{3,23}" title="More than 2 letters" required>
                <div class="errors"></div>

                <label for="password"></label>
                <input type="password" id="password" class="form-control formPass" name="password" placeholder="Enter your password*" pattern="(?=.*[A-Z])(?=.*[!@#$&*])(?=.*[0-9])(?=.*[a-z].*[a-z].*[a-z]).{5,20}" title="Enter at least 1 uppercase and 3 lowercase letters, 1 digit and 1 special character" required>
                <div class="errors"></div>

                <label for="password2"></label>
                <input type="password" id="password2" class="form-control formPassConf" name="passwordConfirmation" placeholder="Confirm your password*" required>
                <div class="errors"></div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
        <?php echo form_close(); ?>
        <?php if(validation_errors()):?>
        <div class='validator_message'
             <?php echo validation_errors();?>
        </div>
        <?php endif;?>
    </div>
</div>
<!--Validation script-->
<script src="<?php echo base_url(); ?>assets/js/validation.js"></script>

