<!-- Camilla Piskonen, 0451801
www-sovellukset -->


<?php
require_once("utils.php");

if(isset($_POST["username"]) && isset($_POST["password"]) && isset($_POST["password-repeat"])) {
    if($_POST["password"] === $_POST["password-repeat"]) {
        $db = new PDO('mysql:host=localhost;dbname=todo;charset=utf8', 'todo', 'todo');
        $password = $_POST["password"];
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $db->prepare("SELECT username FROM users WHERE username=:username");
        $stmt->execute(array(":username" => $_POST["username"]));
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if(count($rows) === 0) {

            if(strlen($password) < 8) {
                print "<p>Salasanan oltava vähintään 8 merkkiä pitkä!</p>";
                registerForm();
            }
            else if(strlen($password) >= 255) {
                print "<p>Salasanasi on liian pitkä</p>";
                registerForm();
            }

            else if(preg_match('/[A-Za-z].*[0-9]|[0-9].*[A-Za-z]/', $password)) {
                if (preg_match('#^[a-zA-Z0-9äöüÄÖÜ]+$#', $_POST["username"])) {
                    $stmt = $db->prepare("INSERT INTO users(username, password) VALUES(:f1, :f2)");
                    $stmt->execute(array(":f1" => $_POST["username"], ":f2" => $hashed_password));
                    ?>
                    <div class="redirect">
                        <p>Käyttäjätili luotu.</p>
                        <button type="button" class="button cancel" name="frontpage" onclick="location.href='index.php'">Etusivulle</button>
                    </div>
                    <?php
                }

                else {
                    print "<p>Käyttäjänimessä saa olla vain numeroita tai kirjaimia!</p>";
                    registerForm();
                }

            }

            else {
                print "<p>Salasanassa oltava numeroita ja isoja sekä pieniä kirjaimia!</p>";
                registerForm();
            }

        }

        else {
            print "<p>Käyttäjänimi on jo olemassa!</p>";
            registerForm();
        }

    }

}

else {
    registerForm();
}
?>
