<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="UTF-8">
    <title> MyPlant </title>
    <!-- Adding css file and a tab icon-->
    <link href="<?php echo base_url(); ?>assets/css/style.css" rel="stylesheet" type="text/css" />
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo base_url(); ?>assets/images/favicon-32x32.png">
    <link media="print" href="<?php echo base_url(); ?>assets/css/tisk.css" />

</head>
<body>
<header class="header">
    <div class="container">
        <div class="header_inner">
            <div class="logo">
                <!--Logo and logo icon-->
                <img class="list_icon" src="<?php echo base_url(); ?>assets/images/list.png" alt="list">
                <a class="logo_name" href="<?php echo base_url(); ?>"> MyPlant </a>
            </div>
            <nav class="nav">
                <button class="toggle-theme"></button>
                <!--Links for logged user-->
                <?php if($this->session->userdata('logged_in')) : ?>
                    <a class="link" href="<?php echo base_url(); ?>posts/create">Create</a>
                    <a class="link" href="<?php echo base_url(); ?>posts">Posts</a>
                    <a class="link" href="<?php echo base_url(); ?>categories">Categories</a>
                    <a class="link" href="<?php echo base_url(); ?>learnMore">Learn more</a>
                    <a class="link" href="<?php echo base_url();?>users/logout">Log out</a>
                <?php endif; ?>
                <!--Links for guests-->
                <?php if(!$this->session->userdata('logged_in')) : ?>
                    <a class="link" href="<?php echo base_url();?>users/register">Register</a>
                    <a class="link" href="<?php echo base_url();?>users/login">LogIn</a>
                <?php endif; ?>
            </nav>
        </div>
    </div>
</header>
<!--Dark/light mode script-->
<script src="<?php echo base_url(); ?>assets/js/script.js"></script>