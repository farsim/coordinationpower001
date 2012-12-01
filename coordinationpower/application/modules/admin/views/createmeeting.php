<div id="agendaList">
    <h2>List of Agenda</h2>
    <?php 
    if(isset($agendaList)){
        ?>
    <ul id="AgendaList">
        <?php
        foreach($agendaList as $al){
            ?>
        <li><?php echo $al->Agenda; ?></li>
        <?php
        }
        ?>
    </ul>
    <?php
    }
    else{
        echo '<p>There is no agenda.</p>';
    }
    ?>
</div>

<form id="createMeeting" action ="<?php echo base_url() . 'admin/adminuser/createmeeting' ?>" name="createMeetingForm" method="post">
    Meeting Date: <input type="text" readonly="readonly" name="createMeetingTime" placeholder="Enter Date" value="<?php echo $date;?>" />
    <div class="clr"></div>
    <?php echo form_error('createMeetingTime'); ?>
    <div class="clr"></div>
    <fieldset>
        <legend>Attendies</legend>
        <?php
        if(isset($unionWiseUserList)){
            foreach($unionWiseUserList as $uwul){
                ?>
        <input type="checkbox" style="margin-right: 3px;" name="userList[]" value="<?php echo $uwul->UserId; ?>"><span style="margin-right: 15px;"><?php echo $uwul->UserName.' ('.$uwul->Designation.')'; ?></span>
        
        <?php
            }
        }
        else{
            ?>
        <p>There is no user</p>
        <?php
        }
        ?>
    </fieldset>
    <div class="clr"></div>
    <input type="submit" name="submit" value="Create" />
</form>
<?php if(isset($errorMessage)){
    ?>
<p class="error"><?php echo $errorMessage; ?></p>
<?php
}?>
<div class="clr"></div>

<?php //echo time('30 November, 2012'); ?>


