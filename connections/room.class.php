<?php
    class Room extends Character
    {
        private $db;

        function __construct($db)
        {
            $this->db = $db;
        }

        public function newRoom()
        {
          if(isset($_POST['create-new-room']))
          {
            if(!empty($_POST['roomName']))
            {
              $hasRoom = $this->db->prepare("SELECT owner FROM room WHERE owner='$_SESSION[character]'");
              $hasRoom->execute();
              $hasRoomRows = $hasRoom->fetch(PDO::FETCH_ASSOC);
              if($hasRoom->rowCount() > 0)
              {
                echo "<p>Please close your room before creating another.</p>";
              }
              else
              {
                $roomN = mysql_real_escape_string($_POST['roomName']);
                $stmt = $this->db->prepare("INSERT INTO room(name,owner)
                VALUES('$roomN','$_SESSION[character]')");
                $stmt->execute();
              }
            }
            else
            {
                echo "<p>Please enter a room name.</p>";
            }
          }
        }

        public function getRooms()
        {
            try
            {
                $stmt = $this->db->prepare("SELECT * FROM room");
                $stmt->execute();
                $maxPlayers = 2;

                while($rows = $stmt->fetch(PDO::FETCH_ASSOC))
                {
                    if($stmt->rowCount() > 0){
                      if($rows['owner'] == $_SESSION['character']){
                        echo "<div class='room' data-id='{$rows['roomId']}'>
                              <span class='delete-room' data-roomid='{$rows['roomId']}' id='delete-room'>&times;</span>
                              <div class='roomBtn' id='{$rows['roomId']}'>
                              </div>
                              <div class='roomNumber'>
                                  <span>#{$rows['roomId']}</span>
                              </div>
                              <div class='roomPlayers'>
                                  <span>{$rows['currPlayers']}/{$maxPlayers}</span>
                              </div>
                              <div class='roomName'>
                                  <span>{$rows['name']}</span>
                              </div>
                              <div class='roomOwner'>
                                  <span>Room Creator: </span><span style='color:#4ea2f6;'> {$rows['owner']}</span>
                              </div>
                          </div>";

                      } else{
                        echo "<div class='room' id='{$rows['roomId']}'>
                              <div class='roomBtn' id='{$rows['roomId']}'>
                              </div>
                              <div class='roomNumber'>
                                  <span>#{$rows['roomId']}</span>
                              </div>
                              <div class='roomPlayers'>
                                  <span>{$rows['currPlayers']}/{$maxPlayers}</span>
                              </div>
                              <div class='roomName'>
                                  <span>{$rows['name']}</span>
                              </div>
                              <div class='roomOwner'>
                                  <span>Room Creator: </span><span style='color:#4ea2f6;'> {$rows['owner']}</span>
                              </div>
                          </div>";
                      }
                    }
                    else{}
                }
            }
            catch(PDOException $e)
            {
                echo $e->getMessage();
            }
        }

        public function displayRoom()
        {

        }
     }
?>
