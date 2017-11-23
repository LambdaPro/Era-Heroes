<?php
    include_once "db.php";

    $stmt = $conn->prepare("SELECT * FROM characters WHERE name = '$_SESSION[character]'");
    $stmt->execute();
    $rows = $stmt->fetch(PDO::FETCH_ASSOC);

    if($rows['roomId'] == '0'){
        header("Location: ../game.php");
    } else{

    }

    $map->createMap();
    $map->battle();
    $map->move();
?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="../css/game.css"/>
<script type="text/javascript" src="../js/jquery.js"></script>
<script type="text/javascript" src="../js/index.js"></script>
<script type="text/javascript">
</script>
</head>
<body>
<a href = "reload.php"><button id = "leaveroom">Leave</button></a>
<meta http-equiv="refresh" content="3">
</body>
</html>
