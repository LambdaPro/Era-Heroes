<?php
    class Lobby extends Character
    {
        private $db;

        function __construct($db)
        {
            $this->db = $db;
        }

        public function usersOnline()
        {
          try
          {
              $getStatus = $this->db->prepare("SELECT * FROM account LEFT JOIN characters
              ON characters.id=account.id
              WHERE account.status='1'");
              $getStatus->execute();
              while($row=$getStatus->fetch(PDO::FETCH_ASSOC))
              {
                $isAdmin = ($row['UGradeID']=="254" ? $color = "orange" : $color = "#FFF");
                $isStaff = ($row['UGradeID']=="253" ? $color = "cyan" : $color = $color);
                echo "<div class='player' data-id='{$row['Id']}'>";
                echo "<span id='levelBox'>Lv.{$row['level']}</span>
                <span style='color:{$color};'>{$row['name']}</span>";
                echo "</div>";
              }
          }
          catch(PDOException $e)
          {
              echo $e->getMessage();
          }
        }

        public function lobbySession()
        {
          try
          {
              $stmt = $this->db->prepare("SELECT status FROM account WHERE Id='$_SESSION[user_id]'");
              $stmt->execute();
              $rows = $stmt->fetch(PDO::FETCH_ASSOC);
              if($rows['status']=="0")
              {
                  unset($_SESSION['login_session']);
                  unset($_SESSION['character']);
                  $stmt = $this->db->prepare("UPDATE serverstatus SET CurrPlayer=CurrPlayer-1");
                  $stmt->execute();
              }
              else if($rows['status']=="1"){
                  return true;
              }
          }
          catch(PDOException $e)
          {
              echo $e->getMessage();
          }
        }

        public function getChat()
        {
          try
          {
              $stmt = $this->db->prepare("SELECT * FROM messages ORDER BY TimeSent DESC");
              $stmt->execute();
              while($rows = $stmt->fetch(PDO::FETCH_ASSOC))
              {
                  echo "<span>{$rows['CharID']}: {$rows['Message']}</span>";
              }
          }
          catch(PDOException $e)
          {
              echo $e->getMessage();
          }
        }

        public function killAllSessions()
        {
          try
          {
              $resetServer = $this->db->prepare("UPDATE serverstatus SET CurrPlayer='0'");
              $resetServer->execute();
              $resetStatus = $this->db->prepare("UPDATE account SET status='0'");
              $resetStatus->execute();
          }
          catch(PDOException $e)
          {
              echo $e->getMessage();
          }
        }
    }

$lobby = new Lobby($conn);

?>
