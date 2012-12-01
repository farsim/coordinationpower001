<!DOCTYPE html>
<html>
    <head>
        <title>Coordinator Power::Admin</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url() . 'public/adminuser/css/style.css' ?>" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url() . 'public/adminuser/css/form.css' ?>" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url() . 'public/adminuser/css/kendo.default.min.css' ?>" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url() . 'public/adminuser/css/kendo.common.min.css' ?>" />
        <script type="text/javascript" charset="utf-8" src="<?php echo base_url() . 'public/script/jquery-1.8.2.js' ?>"></script>
        <script type="text/javascript" charset="utf-8" src="<?php echo base_url() . 'public/script/kendo.web.min.js' ?>"></script>
        
    </head>
    <body>
        <div id="header">
            <h1>Co-ordination Power App</h1>
        </div>
        <div id="menuDiv">
            <ul id="menu">
                <li><a href="<?php echo base_url(); ?>">Dashboard</a></li>
                <li><a href="<?php echo base_url().'admin/adminuser/usermgt'; ?>">User</a></li>
                <li><a href="<?php echo base_url().'admin/adminuser/agendamgt'; ?>">Agenda</a></li>
                <li><a href="<?php echo base_url().'admin/adminuser/meetingmgt'; ?>">Meeting</a></li>
                <li><a href="<?php echo base_url().'admin/logout'; ?>">Logout</a></li>
            </ul>
        </div>
        <div id="content"><?php echo $content; ?></div>
        <div id="footer"></div>

        <script>
            
            $(document).ready(function(){
                
                $("ul#menu").kendoMenu({
                    animation: { open: { effects: "fadeIn" } }
                });
            });
        </script>
    </body>

</html>
