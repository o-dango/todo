<!-- Camilla Piskonen, 0451801
www-sovellukset -->

<?php
require_once("utils.php");

if(isset($_POST["username"]) && isset($_POST["password"])) {
    $db = new PDO('mysql:host=localhost;dbname=todo;charset=utf8', 'todo', 'todo');

    $stmt = $db->prepare("SELECT * FROM users WHERE username=:username");
    $stmt->execute(array(":username" => $_POST["username"]));
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if(count($rows) === 1) {
        $password_hashed = $rows[0]["password"];
        $password = $_POST["password"];
        if(password_verify($password, $password_hashed)) {

            $_SESSION["userId"] = $rows[0]["id"];
            $_SESSION["username"] = $rows[0]["username"];
            ?>
            <div class="redirect">
                <p>Kirjautuminen onnistui.</p>
                <button type="button" class="button cancel" name="frontpage" onclick="location.href='index.php'">Etusivulle</button>
            </div>
            <?php
        }

        else {
            print "<p>Kirjautuminen epäonnistui!</p>";
            print <<<LOGINFORM
                <form class="forms" id="loginform" action="index.php?p=login" method="post">
                    <div class="container">
                        <label><b>Username</b></label><br>
                        <input type="text" placeholder="Enter Username" name="username" required>
                        <br>
                        <label><b>Password</b></label><br>
                        <input type="password" placeholder="Enter Password" name="password" required>
                        <br>
                    </div>
                    <div class="container">
                        <button type="button" class="button cancel" name="cancel" onclick="location.href='index.php'">Cancel</button>
                        <button type="submit" name="login" class="button">Login</button>
                    </div>
                </form>
LOGINFORM;
        }
    }

    else {
        print "<p>Kirjautuminen epäonnistui!</p>";
        print <<<LOGINFORM
            <form class="forms" id="loginform" action="index.php?p=login" method="post">
                <div class="container">
                    <label><b>Username</b></label><br>
                    <input type="text" placeholder="Enter Username" name="username" required>
                    <br>
                    <label><b>Password</b></label><br>
                    <input type="password" placeholder="Enter Password" name="password" required>
                    <br>
                </div>
                <div class="container">
                    <button type="button" class="button cancel" name="cancel" onclick="location.href='index.php'">Cancel</button>
                    <button type="submit" name="login" class="button">Login</button>
                </div>
            </form>
LOGINFORM;
    }
}

else {
print <<<LOGINFORM
    <form class="forms" id="loginform" action="index.php?p=login" method="post">
        <div class="container">
            <label><b>Username</b></label><br>
            <input type="text" placeholder="Enter Username" name="username" required>
            <br>
            <label><b>Password</b></label><br>
            <input type="password" placeholder="Enter Password" name="password" required>
            <br>
        </div>
        <div class="container">
            <button type="button" class="button cancel" name="cancel" onclick="location.href='index.php'">Cancel</button>
            <button type="submit" name="login" class="button">Login</button>
        </div>
    </form>
LOGINFORM;
}
?>
