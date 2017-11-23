<?php
    include_once "db.php";
    $roomId = $_POST['id'];

    $checkRoom = $conn->prepare("SELECT * FROM room WHERE roomId='$roomId'");
    $checkRoom->execute();
    $row = $checkRoom->fetch(PDO::FETCH_ASSOC);

    if($row['currPlayers'] >= '2'){
        

    } else{
      $updatePlayersRoom = $conn->prepare("UPDATE characters SET roomId = '$roomId' WHERE name = '$_SESSION[character]'");
      $updatePlayersRoom->execute();

      $updateRoomQuantity = $conn->prepare("UPDATE room SET currPlayers = currPlayers+1 WHERE roomId = '$roomId'");
      $updateRoomQuantity->execute();

      $newRoomLog = $conn->prepare("INSERT INTO room_chat(roomId,name,message)
      VALUES('$roomId','$_SESSION[character]','test')");
      $newRoomLog->execute();

    }


?>
