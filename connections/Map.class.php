<?php
    class Map
    {
        private $db;

        public $x;
        public $y;
        public $width = 5;
        public $height = 5;

        function __construct($db,$x,$y)
        {
            $this->db = $db;
            $this->x = $x;
            $this->y = $y;
        }

        public function createMap(){
          for($x=0; $x < $this->width; $x++){
              for($y=0; $y < $this->height; $y++){
                  echo "<div id='map'>";
                  echo "<div class='map_columns' data-x='{$x}' data-y='{$y}' id='{$x}_{$y}'>";
                  $this->spawnPlayers($x,$y);
                  echo "</div>";
              }
              echo "<div class=\"break\"></div>";
          }
      }

        public function spawnPlayers($x,$y){
            $getroom = $this->db->prepare("SELECT roomId FROM characters WHERE name = '$_SESSION[character]'");
            $getroom->execute();
            $roomId = $getroom->fetch(PDO::FETCH_ASSOC);

            $stmt = $this->db->prepare("SELECT * FROM characters WHERE x = {$x} AND y = {$y} AND roomId = '$roomId[roomId]'");

            $stmt->execute();
            while($rows = $stmt->fetch(PDO::FETCH_ASSOC)){
                echo "<span class='playerdetail matchname'>{$rows['name']}</span>";
                echo "<br/>";
                echo "<span class='playerdetail'>Lv.{$rows['level']}</span>";
                echo "<br/>";
                echo "<span class='playerdetail'>Dmg:{$rows['dmg']}</span>";
                echo "<br/>";
            }
        }

        public function battle(){
            $getroom = $this->db->prepare("SELECT roomId FROM characters WHERE name = '$_SESSION[character]'");
            $getroom->execute();
            $roomId = $getroom->fetch(PDO::FETCH_ASSOC);

            $player = $this->db->prepare("SELECT * FROM characters WHERE name != '$_SESSION[character]' AND roomId = '$roomId[roomId]'");
            $player->execute();
            $name = $player->fetch(PDO::FETCH_ASSOC);

            $stmt = $this->db->prepare("SELECT * FROM characters WHERE roomId = '$roomId[roomId]' GROUP BY x,y HAVING count(*) > 1");
            $stmt->execute();
            $rows = $stmt->fetch(PDO::FETCH_ASSOC);
            if($rows){
                echo "<input type='submit' id='battle-btn' value='Challenge {$name['name']}'>";
            } else{
            }


         }

         public function move(){
           if(isset($this->x) && isset($this->y)){
              $stmt = $this->db->prepare("UPDATE characters SET x = '$this->x', y = '$this->y' WHERE name = '$_SESSION[character]'");
              $stmt->execute();
           }
         }
    }
?>
