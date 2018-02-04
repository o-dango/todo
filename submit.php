<!-- Camilla Piskonen, 0451801
www-sovellukset -->
<?php
require_once('utils.php');
session_start();
if (empty($_POST["note"])) {
    //$nameErr = "notes needed";
    //echo "<p> $nameErr </p>";
    echo "prkl";
}

else {
    $db = new PDO('mysql:host=localhost;dbname=todo;charset=utf8', 'todo', 'todo');
    $note = $_POST["note"];
    $date = date("Y-m-d H:i:s");
    if(isset($_SESSION["userId"])) {
        $userid = $_SESSION["userId"];
    }
    else {
        $userid = 0;
    }
    $stmt = $db->prepare("INSERT INTO notes(user_id, note, note_date) VALUES(:f1, :f2, :f3)");
    $stmt->execute(array(":f1" => $userid, ":f2" => $_POST["note"], ":f3" => $date));
}
