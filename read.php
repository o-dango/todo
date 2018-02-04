<!-- Camilla Piskonen, 0451801
www-sovellukset -->
<?php
require_once('utils.php');

siteHeader();
noteInput();
noteList();

$db = new PDO('mysql:host=localhost;dbname=todo;charset=utf8', 'todo', 'todo');

$stmt = $db->prepare("SELECT * FROM 'notes'");
$stmt->execute();

$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
foreach(new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
    echo $v;
}
