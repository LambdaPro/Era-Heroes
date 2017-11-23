<?php
    class Character extends User
    {
        private $db;

        function __construct($db)
        {
            $this->db = $db;
        }

        public function data($name)
        {
          try
          {
              $stmt = $this->db->prepare("SELECT $name FROM characters WHERE id = '$_SESSION[user_id]' LIMIT 1");
              $stmt->execute();
              $rows = $stmt->fetch(PDO::FETCH_ASSOC);
              print($rows[$name]);
          }
          catch(PDOException $e)
          {
              echo $e->getMessage();
          }
        }

        public function create()
        {
          try
          {
              if(isset($_POST['confirm-entry']))
              {
                  $characterName = $this->secure($_POST['character-name']);
                  $sexChoice = $this->secure($_POST['sex-choice']);
                  $raceHoice = $this->secure($_POST['race-choice']);
                  $stmt = $this->db->prepare("INSERT INTO characters(id, name, sex, race, UserID)
                  VALUES('$_SESSION[user_id]', :name, :sex, :race, '$_SESSION[login_session]')");
                  $stmt->bindparam(":name", $characterName);
                  $stmt->bindparam(":sex", $sexChoice);
                  $stmt->bindparam(":race", $raceHoice);
                  $stmt->execute();
                  return $stmt;
              }
          }
          catch(PDOException $e)
          {}
        }

        public function loginCharacter()
        {
            try
            {
                if(isset($_POST['choose-character']))
                {
                    $stmt = $this->db->prepare("SELECT * FROM characters WHERE id='$_SESSION[user_id]'");
                    $stmt->execute();
                    $rows = $stmt->fetch(PDO::FETCH_ASSOC);
                    $_SESSION['character'] = $rows['name'];
                    $this->redirect("game.php");
                }
            }
            catch(PDOException $e)
            {
                echo $e->getMessage();
            }
        }

        public function logoutCharacter()
        {
            unset($_SESSION['character']);
        }

    }


?>
