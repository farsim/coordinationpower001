<a id="createMeeting" href="<?php echo base_url() . 'admin/adminuser/createmeeting' ?>">Create Meeting</a>
<div id="agendaList">
    <h2>Meeting History of <?php echo $this->session->userdata('union_name'); ?> Union</h2>
    <?php
    if (isset($meetingList)) {
        $i = 0;
        ?>
        <table id="customers">
            <tr>
                <th>#</th>
                <th>Meeting Date</th>
            </tr>
            <?php
            foreach ($meetingList as $ml) {
                $time = getdate($ml->MeetingDate);
                $date = $time['mday'] . ' ' . $time['month'] . ', ' . $time['year'];
                if ($i % 2 == 0) {
                    ?>
                    <tr class="alt">
                        <td><?php echo++$i; ?></td>
                        <td><a href="<?php echo base_url().'admin/adminuser/meetinghistory/'.$ml->MeetingId; ?>"><?php echo $date; ?></a></td>
                    </tr>
                    <?php
                } else {
                    ?>
                    <tr>
                        <td><?php echo++$i; ?></td>
                        <td><a href="<?php echo base_url().'admin/adminuser/meetinghistory/'.$ml->MeetingId; ?>"><?php echo $date; ?></a></td>
                    </tr>
                    <?php
                }
            }
            ?>

        </table>
        <?php
    } else {
        ?>
        <p>There is no meeting for <?php echo $this->session->userdata('union_name'); ?>Union </p>
        <?php
    }
    ?>
</div>