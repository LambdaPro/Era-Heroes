<?php
    function playersInformation(){
    include_once "connections/db.php";
    if(isset($_POST['id'])){
    $id = $_POST['id'];
    try {
      $stmt = $conn->prepare("SELECT * FROM characters WHERE Id = '$id'");
      $stmt->execute();
      $rows = $stmt->fetch(PDO::FETCH_ASSOC);
      if($rows > strlen($rows['id'])){
        echo "<div class='playerCard'>
            <span class='card-x'>&times;</span>
            <div class='userDisplay'>
                <img src='images/display.png'>
            </div>
            <div class='userStats'>
              <div class='stats-left' id='player-name'>
                <span>Name: </span>
                <span style='color:#3e7dbc;'>{$rows['name']}</span>
              </div>
              <div class='stats-left' id='player-level'>
                <span>Level: </span>
                <span style='color:#3e7dbc;'>{$rows['level']}</span>
              </div>
              <div class='stats-left' id='player-wins'>
                <span>Wins: </span>
                <span style='color:#3e7dbc;'>{$rows['wins']}</span>
              </div>
              <div class='stats-left' id='player-losses'>
                <span>Losses: </span>
                <span style='color:#3e7dbc;'>{$rows['losses']}</span>
              </div>
              <div class='stats-left' id='player-clan'>
                <span>Clan: </span>
                <span style='color:#3e7dbc;'>{$rows['clan']}</span>
              </div>
              <div class='stats-left' id='player-registerDate'>
                <span>Class: </span>
                <span style='color:#3e7dbc;'>{$rows['race']}</span>
              </div>
            </div>
        </div>";

      }
    }
    catch (PDOException $e) {
      echo $e->getMessage();
    }
  }
}

playersInformation();
?>
