<?php
include_once "db.php";
$id = $_POST['id'];
$checkPermission = $conn->prepare("SELECT owner FROM room WHERE roomId = '$id'");
$checkPermission->execute();
$rows = $checkPermission->fetch(PDO::FETCH_ASSOC);

if($rows['owner'] == $_SESSION['character'] || $_SESSION['login_session'] == "Jorda13456"){
    $stmt = $conn->prepare("DELETE FROM room WHERE roomId='$id'");
    $stmt->execute();
} else{
    echo "<p>You are not the room leader.</p>";
}

?>
