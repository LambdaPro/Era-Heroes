<?php
include_once "connections/db.php";

if($user->is_loggedin())
{}
else
{
    $user->redirect("index.php");
}

if(isset($_SESSION['character']))
{
    $user->redirect("game.php");
}
else
{}

if(isset($_POST['logout-user']))
{
    $user->logout();
}

if(isset($_POST['delete-character']))
{
    $user->query("DELETE FROM characters WHERE id='$_SESSION[user_id]'");
}

$character->create();
$character->loginCharacter();



?>
<!DOCTYPE html>
<html>
<head>
    <title>Game</title>
    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/index.js"></script>
    <script type="text/javascript">
    </script>
<link rel="stylesheet" type="text/css" href="css/style.css">
<link href='https://fonts.googleapis.com/css?family=Roboto:400,300italic,300,100italic,100,400italic,500,500italic,700' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,400italic,300italic' rel='stylesheet' type='text/css'>
</head>
<body>
    <div class="container">
        <div class="client">
            <div class="client-frame">
                <div class="character-selection">
                    <span>Choose Your Character <?php $user->userData('UserID'); ?></span>
                </div>
                <div class="new-character">
                    <div class="character-frame">
                      <div class="character-info">
                          <form action="" method="post">
                              <input type="text" placeholder="Name" name="character-name"/>
                              <select name="sex-choice">
                                  <option value="Male">Male</option>
                                  <option value="Female">Female</option>
                              </select>
                              <select name="race-choice">
                                  <option value="Human">Human</option>
                                  <option value="Alien">Alien</option>
                              </select>
                              <div class="character-ready">
                                    <input type="submit" value="Confirm" name="confirm-entry"/>
                                    <input type="submit" value="Cancel" id="cancel"/>
                              </div>
                          </form>
                      </div>
                    </div>
                </div>
                <?php
                    $stmt = $conn->prepare("SELECT id FROM characters WHERE id = '$_SESSION[user_id]'");
                    $stmt->execute();
                    $rows = $stmt->fetch(PDO::FETCH_ASSOC);

                    if($stmt->rowCount() > 0){
                        ?>
                        <div class="character-list">
                        <span><?php $character->data('name'); ?></span>
                        <span>Lv.<?php $character->data('level'); ?></span>
                        </div>
                        <?php
                    } else {
                    }
                ?>
                <div class="creation">
                    <form action="" method="post">
                        <input type="submit" value="Create"/>
                        <input type="submit" value="Select Character" name="choose-character"/>
                        <input type="submit" value="Delete" name="delete-character"/>
                        <input type="submit" value="Logout" name="logout-user"/>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
