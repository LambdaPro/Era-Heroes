<?php
    error_reporting(0);
    session_start();
    $serverConfig = parse_ini_file('config.ini');

    try
    {
        $conn = new PDO("mysql:host={$serverConfig['host']}; dbname={$serverConfig['dbname']}", $serverConfig['username'], $serverConfig['password']);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch (PDOException $e)
    {
        echo $e->getMessage();
    }

    include_once("user.class.php");
    include_once("server.class.php");
    include_once("character.class.php");
    include_once("lobby.class.php");
    include_once("room.class.php");
    include_once("map.class.php");

    $user = new User($conn);
    $server = new Server($conn);
    $character = new Character($conn);
    $lobby = new Lobby($conn);
    $room = new Room($conn);
    $map = new Map($conn,$_POST['x'], $_POST['y']);

?>
