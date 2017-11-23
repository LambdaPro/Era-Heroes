<?php
    include_once "db.php";
    try {
        $chatText = $_POST['id'];
        $chat_filtered = str_replace(array(',', ' '), ' ', $chatText);
        $protected_chat = mysql_real_escape_string($chat_filtered);
        $stmt = $conn->prepare("INSERT INTO messages(id, CharID, Message)
        VALUES($_SESSION[user_id], '$_SESSION[character]', '$protected_chat')");
        $stmt->execute();
    }
    catch (PDOException $e) {
      echo $e->getMessage();
    }
?>
