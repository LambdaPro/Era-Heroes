<?php
    include_once "db.php";
    $dmg = $_POST['id'];

    $userId = $conn->prepare("SELECT * FROM room JOIN characters
    ON room.roomId=characters.roomId");
    $userId->execute();
    $roomId = $userId->fetch(PDO::FETCH_ASSOC);

    $stmt = $conn->prepare("UPDATE characters SET hp = hp - '$dmg' WHERE roomId = '$roomId[roomId]' AND name != '$_SESSION[character]'");
    $stmt->execute();

?>
