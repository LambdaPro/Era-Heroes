<?php
include_once "connections/db.php";
$lobby->lobbySession();

// $lobby->killAllSessions();
if($user->is_loggedin())
{}
else
{
    $user->redirect("index.php");
}

if(isset($_SESSION['character']))
{

}
else
{
    $user->redirect("character.php");
}

if(isset($_POST['logout-character']))
{
   $user->logout();
}

if(isset($_POST['character-screen']))
{
    $character->logoutCharacter();
    $user->redirect("character.php");
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Game</title>
    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/server.js"></script>
    <script type="text/javascript" src="js/music.js"></script>
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
                  <div class="game-shade">
                      <div class="game-room">
                      </div>
                      <div class="match-frame">

                      </div>
                      <div class="game-logo">
                          <h4>Era <span style = 'color:#3e7dbc;'>Online</span>
                        </h4>
                      </div>
                      <span id="lobby-name">Lobby &#8250; <span style = 'color:#3e7dbc;'>Newbies Central</span></span>

                      <div class="lobby">
                        <div class="playerInfo">
                        </div>
                          <div class="lobby-frame" id="lobby-left">
                              <?php $room->getRooms(); ?>
                          </div>
                          <div class="lobby-frame" id="lobby-right">
                          </div>
                      </div>
                      <div class="room-creation">
                          <span id="close-room-creation">&times;</span>
                        <div class="room-options">
                          <form action="#" method="post">
                              <span>Room Name</span><input type="text" name="roomName" autocomplete="off"/>
                              <br>
                              <input type="submit" value="Create" id="create-new-room" name="create-new-room"/>
                              <input type="submit" value="Cancel" id="stop-room-creation"/>
                              <?php $room->newRoom(); ?>
                          </form>
                        </div>
                      </div>
                      <div class="room-controls">
                          <span id="new-room">&plus;</span>
                          <form action="" method="post">
                              <input type="submit" value="Inventory" name="inventory-screen"/>
                              <input type="submit" value="Characters" name="character-screen"/>
                              <input type="submit" value="Logout" name="logout-character"/>
                          </form>
                      </div>
                      <div class="user-frame">
                          <div class="user-info">
                            <div class="username">
                              <span><?php echo $_SESSION['character']; ?></span>
                            </div>
                            <div class="user-data">
                              <span>Clan: <?php $character->data("clan"); ?></span>
                              <span>Level: <?php $character->data("level"); ?></span>
                              <span>Gold: <?php $character->data("gold"); ?></span>
                              <span>Wins: <?php $character->data("wins"); ?></span>
                              <span>Losses: <?php $character->data("losses"); ?></span>
                            </div>
                          </div>
                          <div class="chat-frame">
                              <div class="chat-output">
                                <div class="chatOutput">
                                    <?php $lobby->getChat(); ?>
                                </div>
                              </div>
                              <div class="chat">
                                  <form action="#" id="chatForm" method="post" name="sendChat">
                                      <input type="text" name="chatbox" id="chat-box" autocomplete="off"/>
                                      <input type="submit" name="send-chat" id="chat-btn"/>
                                  </form>
                              </div>
                          </div>
                          <div class="lobby-players">
                            <div class="users">
                            <?php $lobby->usersOnline(); ?>
                            </div>
                          </div>
                      </div>

                  </div>
            </div>
        </div>
    </div>
<head>
  <script type="text/javascript" src="js/index.js"></script>
</head>
</body>
</html>
