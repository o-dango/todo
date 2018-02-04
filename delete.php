<!-- Camilla Piskonen, 0451801
www-sovellukset -->
<?php
require_once('utils.php');

$id = $_POST['id'];
$db = new PDO('mysql:host=localhost;dbname=todo;charset=utf8', 'todo', 'todo');
$query = "'DELETE FROM `notes` WHERE `notes`.`id`= :id'";
$stmt = $db->prepare('DELETE FROM `notes` WHERE `notes`.`id`= :id');
$stmt->bindValue(':id', $id);
$stmt->execute();
