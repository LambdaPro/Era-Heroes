<?php
    include_once "db.php";
    $stmt = $conn->prepare("SELECT roomId FROM characters WHERE name = '$_SESSION[character]'");
    $stmt->execute();
    $rows = $stmt->fetch(PDO::FETCH_ASSOC);

    $storeID = $conn->prepare("UPDATE room SET sess_id = '$rows[roomId]' WHERE roomId = '$rows[roomId]'");
    $storeID->execute();

    $newID = $conn->prepare("SELECT * FROM room WHERE roomId = '$rows[roomId]'");
    $newID->execute();

    while($getData = $newID->fetch(PDO::FETCH_ASSOC)){
        echo "<div class='room-description'>
            <span>Room &nbsp;&#8250;&nbsp;<span style='color:#3e7dbc;'>&nbsp;#{$getData['roomId']}&nbsp;</span>&nbsp;&#8250;&nbsp;<span style='color:#3e7dbc;'>&nbsp;{$getData['name']}</span>
        </div>
        <div class='game-room-frame'>";
          $checkPlayers = $conn->prepare("SELECT * FROM characters WHERE roomId = '$getData[roomId]' LIMIT 2");
          $checkPlayers->execute();
          while($checkRow = $checkPlayers->fetch(PDO::FETCH_ASSOC)){
          if($checkRow['roomId'] == $getData['roomId']){
            $playerCheck = $conn->prepare("SELECT roomId FROM characters WHERE roomId ='$getData[roomId]'");
            $playerCheck->execute();
            $check = $playerCheck->fetch(PDO::FETCH_ASSOC);
              if($playerCheck->rowCount() <= 1 && $getData['currPlayers'] >= 1){
                  echo "<div class='room-players'>
                      <div class='room-user' id='player-left'>
                          <div class='user-name'>
                              <span>{$checkRow['name']}</span>
                          </div>
                      </div>
                      <div class='room-user' id='player-right'>
                          <div class='user-name'>
                              <span>Waiting for players...</span>
                          </div>
                      </div>";
              } else{
                echo "<div class='room-players'>
                    <div class='room-user' id='player-left'>
                        <div class='user-name'>
                            <span>{$checkRow['name']}</span>
                        </div>
                    </div>";
              }
                  }
              else{}
              }
              if($playerCheck->rowCount() <= 1 && $getData['currPlayers'] >= 1){
                echo "<p id='vsLogo' style='position:absolute;left:0px;'>VS</p>
            <div class='room-settings' style='margin-top:123px;'>
                <form action='#' method='post'>
                    <input type='submit' value='Leave Room' data-roomid='{$getData['roomId']}' id='close-game-room' name='leaveRoom'/>
                    <input type='submit' value='Join Game' id='startGame' name='start-game-btn'/>
                </form>
            </div>
        </div>";
              } else{
                $roomLog = $conn->prepare("SELECT * FROM room_chat WHERE roomId = '$getData[roomId]'");
                $roomLog->execute();

                while($row = $roomLog->fetch(PDO::FETCH_ASSOC)){
                  if($row['roomId'] == $getData['roomId']){
                  echo "<div class='room-log'>
                        <span style='color:#3e7dbc;margin-right:3px;'>{$row['name']}</span><span>has joined the room.</span>
                        </div>";
          } else{}

        }
        echo "<p id='vsLogo'>VS</p>
        </div>
        <div class='room-settings'>
            <form action='#' method='post'>
                <input type='submit' value='Leave Room' data-roomid='{$getData['roomId']}' id='close-game-room' name='leaveRoom'/>
                <input type='submit' value='Join Game' id='startGame' name='start-game-btn'/>
            </form>
        </div>
    </div>";

      }

    }
    // <input type='submit' value='Start Game' data-match='{$getData['roomId']}' id='startGame' name='start-game-btn'/>
?>
