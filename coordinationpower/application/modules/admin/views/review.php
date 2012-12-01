<?php
if(isset($questionList)){
   ?>
<form name="" action="<?php echo base_url().'admin/user/review'?>" method="POST">
    <input type="hidden" name="<?php echo 'userMeetingId'; ?>" value="<?php echo $userMeetingId; ?>" />
    
    <?php
    $i = 0;
    foreach($questionList as $ql){
        ?>
    
    <label for=""><?php echo ++$i.'. '.$ql->Agenda;?></label>
    <input type="hidden" name="<?php echo 'meetingAgendaId_'.$i; ?>" value="<?php echo $ql->MeetingAgendaId;?>" />
    <div class="clr"></div>
   
    <?php
    if($ql->Type == 1){
        ?>
    <input type="radio" name="<?php echo 'question_'.$i; ?>" value="10"/>হা
    <input type="radio" name="<?php echo 'question_'.$i; ?>" value="0"/>না
    <?php
    }
    else if($ql->Type == 2){
        ?>
    <input type="text" name="<?php echo 'question_'.$i; ?>" />/১০
    <?php
    }
    ?>
    <div class="clr"></div>
    <?php
    } ?>
    <div class="clr"></div>
    <input type="hidden" name="count" value="<?php echo $i; ?>"/>
    <input type="submit" name="submit" value="Submit" />
</form>
<?php if(isset($ErrorMessage)) echo '<p class=error>'.$ErrorMessage.'</p>'?>

<?php
}
else{
    ?>
<p>There is no question for this user</p>
<?php
}
?>