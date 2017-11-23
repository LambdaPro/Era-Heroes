<?php
    class User
    {
        private $db;
        public $message = array();

        function __construct($db)
        {
            $this->db = $db;
        }

        public function query($query)
        {
            $stmt = $this->db->prepare($query);
            $stmt->execute();
            return $stmt;
        }

        public function register($users)
        {
          try
          {
               $stmt = $this->db->prepare("INSERT INTO account(UserID)
               VALUES(:userID)");
               $stmt->bindparam(":userID", $users);
               $stmt->execute();
               return $stmt;
          }
          catch(PDOException $e)
          {
              echo $e->getMessage();
          }
        }

        public function validate()
        {
            if(isset($_POST['login-btn']))
            {
                $username = $this->secure(trim($_POST['login-name']));
                try
                {
                    $stmt = $this->db->prepare("SELECT * FROM account WHERE UserID=:userID");
                    $stmt->execute(array(":userID"=>$username));
                    $rows = $stmt->fetch(PDO::FETCH_ASSOC);

                    if($stmt->rowCount() > 0)
                    {
                        $userOnline = $this->db->prepare("UPDATE account SET status='1' WHERE UserID='$rows[UserID]'");
                        $userOnline->execute();

                        $serverIncrement = $this->db->prepare("UPDATE serverstatus SET CurrPlayer=CurrPlayer+1 WHERE ServerID='1'");
                        $serverIncrement->execute();

                        $_SESSION['login_session'] = $rows['UserID'];
                        $_SESSION['user_id'] = $rows['Id'];
                        $this->redirect("character.php");
                    }
                    else
                    {
                        $this->register($username);
                        $this->message[] = "Account created, you can now login.";

                    }
                }
                catch(PDOException $e)
                {
                    echo $e->getMessage();
                }
            }
        }

        public function is_loggedin()
        {
            if(isset($_SESSION['login_session']))
            {
                return true;
            }
            else
            {
                return false;
            }
        }

        public function redirect($url)
        {
            header("Location: $url");
        }

        public function secure($val)
        {
            return mysql_real_escape_string($val);
        }

        public function logout()
        {
            $this->query("UPDATE account SET status='0' WHERE UserID='$_SESSION[login_session]'");
            $this->query("UPDATE serverstatus SET CurrPlayer=CurrPlayer-1 WHERE ServerID='1'");
            session_destroy();
            unset($_SESSION['login_session']);
            unset($_SESSION['user_id']);
            $this->redirect("index.php");
        }

        public function userData($data)
        {
            $stmt = $this->db->prepare("SELECT $data FROM account WHERE UserID='$_SESSION[login_session]'");
            $stmt->execute();
            $rows = $stmt->fetch(PDO::FETCH_ASSOC);
            echo $rows[$data];
        }

    }
?>
