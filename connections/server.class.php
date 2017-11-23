<?php
    class Server
    {
        private $db;

        function __construct($db)
        {
            $this->db = $db;
        }

        public function data($name, $serverID)
        {
            $stmt = $this->db->prepare("SELECT $name FROM serverstatus WHERE ServerID = $serverID LIMIT 1");
            $stmt->execute();
            $rows = $stmt->fetch(PDO::FETCH_ASSOC);
            print($rows[$name]);
        }

    }


?>
