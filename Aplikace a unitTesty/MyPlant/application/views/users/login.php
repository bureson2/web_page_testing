<div class="login_intro">
    <div class="container">
        <div class="form">
            <?php echo form_open('users/login', 'class="jsValid"'); ?>
                <div class="sign_in">
                    <div class="message">
                        <?php if($this->session->flashdata('login_failed')){
                            echo $this->session->flashdata('login_failed');
                            unset($_SESSION['login_failed']);} ?>
                    </div>
                    <h1 class="login_title print"><?php echo htmlspecialchars($title); ?></h1>

                    <label for="username"></label>
                    <input type="text" value="<?= htmlspecialchars(set_value('username')) ?>" name="username" id='username' placeholder="Enter Username" pattern="[A-Z]{1}[a-z]{2,23}|[a-z]{3,23}" title="More than 2 letters" required autofocus>
                    <div class="errors"></div>

                    <label for="password"></label>
                    <input type="password" value="<?= htmlspecialchars(set_value('password')) ?>" name="password" id="password" placeholder="Enter Password" required>
                    <div class="errors"></div>

                    <button type="submit">Login</button>
                </div>
            <?php echo form_close(); ?>
        </div>
        <?php if(validation_errors()):?>
        <div class='validator_message'
        <?php echo validation_errors();?>
        <?php endif;?>
    </div>
</div>

<script src="<?php echo base_url(); ?>assets/js/validlogin.js"></script>