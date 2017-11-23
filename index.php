<?php
include_once "connections/db.php";

if($user->is_loggedin())
{
    $user->redirect("character.php");
}
else{}

$user->validate();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Game</title>
    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/index.js"></script>
    <script type="text/javascript">
    </script>
<link rel="stylesheet" type="text/css" href="css/style.css">
<link href='https://fonts.googleapis.com/css?family=Roboto:400,300italic,300,100italic,100,400italic,500,500italic,700' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,400italic,300italic' rel='stylesheet' type='text/css'>
</head>
<body>
    <div class="container">
        <div class="client">
            <div class="client-frame">
                <div class="title">
                    <h1>Era Heroes</h1>
                </div>
                <div class="server">
                    <div class="server-box box-module">
                        <span id="official-server" class = "serverChoice serverActive"><span class="serverOnline"></span><?php $server->data('ServerName','1'); ?>
                        (<div class="reFreshName"><?php $server->data('CurrPlayer', '1'); ?></div>/100)</span>
                        <span id="na-server" class = "serverChoice"><span class="serverOffline"></span><?php $server->data('ServerName', '2'); ?> (0/100)</span>
                        <span id="eu-server" class = "serverChoice"><span class="serverOffline"></span><?php $server->data('ServerName', '3'); ?> (0/100)</span>
                    </div>
                    <div class="login-box box-module">
                        <form action="#" method="post">
                            <input type="text" placeholder="username" name = "login-name">
                            <p>&nbsp;
                              <?php
                                  foreach($user->message as $message){print($message);}
                              ?>
                            </p>
                            <div class="server-btns">
                            <input type="submit" value="Connect" name = "login-btn">
                            <input type="submit" value="Exit">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
