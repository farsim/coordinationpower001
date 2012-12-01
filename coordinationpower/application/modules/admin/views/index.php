<div id="loginBox">
    <h2>Login</h2>
    <?php if(isset ($error))echo $error.'<br/>'; ?>
    <form action ="<?php echo base_url().'admin'?>" name="loginForm" method="post">
        <input type="text" name="username" placeholder="Enter your username" />
        <div class="clr"></div>
        <?php echo form_error('username'); ?>
        <div class="clr"></div>
        <input type="password" name="password" placeholder="Enter your Password" />
        <div class="clr"></div>
        <?php echo form_error('password'); ?>
        <div class="clr"></div>
        <input type="submit" name="submit" value="Login" />
    </form>
</div>



<!--<form action ="<?//php echo base_url().'admin'?>" name="loginForm" method="post">
        <div class="left"></div>
        <div class="right"></div>
        <div class="clr"></div>
    </form>-->