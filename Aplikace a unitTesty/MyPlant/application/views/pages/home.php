<!--Message for registered user-->
<div class="message2">
    <?php if($this->session->flashdata('user_registered')){
        echo $this->session->flashdata('user_registered');
        unset($_SESSION['user_registered']);} ?>
</div>
<!--Massage for logged user -->
<div class="message2">
    <?php if($this->session->flashdata('user_loggedin')){
        echo $this->session->flashdata('user_loggedin');
        unset($_SESSION['user_loggedin']);} ?>
</div>

<div class="intro">
    <div class="container">
        <h1 class="intro_title"> Welcome to <br/> MyPlant!</h1>
    </div>
</div>
    <section class="section" id="about">
        <div class="container">
            <div class="section_header">
                <h2 class="section_title"> About us</h2>
                <div class="section_text">
                    <p>
                        MyPlant is a new little project for people who love their plants and want to share them with the whole world. Tell us about your love for plants, express your opinion on other people's posts,
                        post a beautiful photo of your plant, ask a question of interest and learn more about the nature around. Join us!

                </div>
            </div>
        </div>
    </section>

<section class="properties">
    <div class="properties_item">
        <p class="properties_img">
            <img class="home_img" src="<?php echo base_url(); ?>assets/images/1.png" alt="cactus" >
        </p>
        <div class="properties_text">
            <h3>
                Upload a photo of your plant
            </h3>
            <p>
                Growing your plant? Or bought something lovely at a flower shop? It does not matter! You have every chance to share your beautiful plant with other people.
            </p>
        </div>
    </div>


    <div class="properties_item">
        <p class="properties_img">
            <img class="home_img" src="<?php echo base_url(); ?>assets/images/2.png" alt="photo" >
        </p>
        <div class="properties_text">
            <h3>
                Look at other people's posts
            </h3>
            <p>
                Look what other people have posted today. Maybe you will find something unusual or interesting and you will want to comment on this.
            </p>
        </div>
    </div>

    <div class="properties_item">
        <p class="properties_img">
            <img class="home_img" src="<?php echo base_url(); ?>assets/images/3.png" alt="question" >
        </p>
        <div class="properties_text">
            <h3>
                Learn more about houseplants
            </h3>
            <p>
                We have a great section to help you learn more about houseplants and caring for them. Will be constantly updated!
            </p>
        </div>
    </div>
</section>