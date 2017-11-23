<?php
    include_once "db.php";
    $roomId = $_POST['id'];

    $roomAmount = $conn->prepare("SELECT currPlayers FROM room WHERE roomId = '$roomId'");
    $roomAmount->execute();
    $checkAmount = $roomAmount->fetch(PDO::FETCH_ASSOC);

    $per = $conn->prepare("SELECT * FROM room WHERE roomId = '$roomId'");
    $per->execute();
    $rows = $per->fetch(PDO::FETCH_ASSOC);

    $character = $conn->prepare("SELECT * FROM characters WHERE roomId='$roomId'");
    $character->execute();
    $char = $character->fetch(PDO::FETCH_ASSOC);

    $updatePlayer = $conn->prepare("UPDATE characters SET roomId = '0' WHERE name = '$_SESSION[character]'");
    $updatePlayer->execute();
    $updateRoomCount = $conn->prepare("UPDATE room SET currPlayers = currPlayers-1 WHERE roomId = '$roomId'");
    $updateRoomCount->execute();
?>
