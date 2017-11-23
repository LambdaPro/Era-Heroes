<?php
    include_once "db.php";

    $grabstats = $conn->prepare("SELECT * FROM characters WHERE name = '$_SESSION[character]'");
    $grabstats->execute();
    $fetchStats = $grabstats->fetch(PDO::FETCH_ASSOC);

    $stmt = $conn->prepare("SELECT * FROM characters WHERE name = '$_SESSION[character]'");
    $stmt->execute();
    $rows = $stmt->fetch(PDO::FETCH_ASSOC);

    if($rows['roomId'] == '0'){
        header("Location: ../game.php");
    } else{
    }

    $getRoomId = $conn->prepare("SELECT roomId FROM characters WHERE name = '$_SESSION[character]'");
    $getRoomId->execute();
    $myId = $getRoomId->fetch(PDO::FETCH_ASSOC);

    $userId = $conn->prepare("SELECT * FROM characters WHERE roomId='$myId[roomId]'");
    $userId->execute();
      echo "<div class='currentPlayers'>";
    while($rows = $userId->fetch(PDO::FETCH_ASSOC)){
        echo "<div class='playervsplayer'>
              <h2>{$rows['name']}</h2>
              <div class='player'>
                  <span>Health: {$rows['hp']}</span>
              </div>
              <div class='level'>
                  <span>Level: {$rows['level']}</span>
              </div>
              <div class='damage'>
                  <span>Damage: {$rows['dmg']}</span>
              </div>
          </div>";
    }

    $stmt = $conn->prepare("SELECT * FROM characters WHERE name != '$_SESSION[character]' AND roomId = '$myId[roomId]'");
    $stmt->execute();
    $rows2 = $stmt->fetch(PDO::FETCH_ASSOC);

    if($rows2['hp'] <= 0){
        echo "<p style='position:absolute;left:45%;top:50%;'>" . $rows2['name'] . " has been defeated.</p>" . "<br/>";
        $stmt = $conn->prepare("DELETE FROM room WHERE roomId = '$myId[roomId]'");
        $stmt->execute();
    }

    if(isset($_POST['leavegameroom'])){
      $winner = $conn->prepare("UPDATE characters SET level = level + '1' WHERE roomId = '$myId[roomId]' AND hp != '0'");
      $winner->execute();
      $winner = $conn->prepare("UPDATE characters SET wins = wins + '1' WHERE roomId = '$myId[roomId]' AND hp != '0'");
      $winner->execute();
      $loser = $conn->prepare("UPDATE characters SET losses = losses + '1' WHERE roomId = '$myId[roomId]' AND hp = '0'");
      $loser->execute();
      $stmt = $conn->prepare("UPDATE characters SET hp = '200' WHERE roomId = '$myId[roomId]'");
      $stmt->execute();
      $stmt = $conn->prepare("DELETE FROM room WHERE roomId = '$myId[roomId]'");
      $stmt->execute();
      header("Location: ../game.php");

    }
    echo "</div>";

    $stmt = $conn->prepare("SELECT * FROM characters WHERE roomId = '$myId[roomId]'");
    $stmt->execute();
    while($rows22 = $stmt->fetch(PDO::FETCH_ASSOC)){
        if($rows22['hp'] == '0'){

        }else{
          echo "<div class='attack-options'>
              <form action='#' method='post'>
                  <input type='submit' data-id='{$fetchStats['dmg']}' name='hitUser' id='hituser' value='Attack'>
                  <input type='submit' id='leavegameroom' name='leavegameroom' value='Leave'>
              </form>";
        }
    }

?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="../css/game.css"/>
<script type="text/javascript" src="../js/jquery.js"></script>
<script type="text/javascript" src="../js/index.js"></script>
<script type="text/javascript" src="../js/server.js"></script>
<script type="text/javascript">
</script>
</head>
<body>


</body>
</html>
