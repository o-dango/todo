<!-- Camilla Piskonen, 0451801
www-sovellukset -->

<?php
define("SALT", "s39p84nyo8jg8o9x46hvyxo9l5r7j98e7h6d8byxky9lotfi6o7jhöo99");

function siteHeader() {
    ?>
    <!doctype html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
        <script src="myscript.js"></script>
        <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
        <link href="https://fonts.googleapis.com/css?family=Nothing+You+Could+Do" rel="stylesheet">
        <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
        <link rel="stylesheet" href="style.css" type="text/css">
        <title>Muistikirja</title>
    </head>

    <body>
        <div id="header">
            <h1>TO DO -lista</h1>
        </div>
    <?php
}

function buttons() {
    ?>
    <div class="buttons">
    <?php if(isset($_SESSION["username"])) {
        print "Kirjautunut käyttäjä: <strong>{$_SESSION['username']}</strong>";?>
        <button type="button" class="button" onclick="location.href='index.php?p=logout'">Log Out</button>
        <?php
    }

    else {
        print "Rekisteröidy tai kirjaudu sisään!";?>
        <button type="button" class="button" name="login" onclick="location.href='index.php?p=login'">Login</button>
        <button type="button" class="button" name="register" onclick="location.href='index.php?p=register'">Sign Up</button>
        <?php
    }
    ?>
    </div>
    <?php
}

function registerForm() {
    print <<<REGISTERFORM
        <form class="forms" id="signupform" action="index.php?p=register" method="post">
            <div class="container">
                <label><b>Username</b></label><br>
                <input type="text" placeholder="Enter Username" name="username" required>
                <br>
                <label><b>Password</b></label><br>
                <input type="password" placeholder="Enter Password" name="password" required>
                <br>
                <label><b>Repeat Password</b></label><br>
                <input type="password" placeholder="Repeat Password" name="password-repeat" required>
            </div>
            <div">
                <button type="button" class="button cancel" name="cancel" onclick="location.href='index.php'">Cancel</button>
                <button type="submit" class="button" name="register" id="signup">Sign Up</button>
            </div>
        </form>
REGISTERFORM;
}


function noteInput() {
    ?>
    <div id="noteinput">
        <form autocomplete="off" id="noteform">
            Lisää merkintä klikkaamalla tallenna.<br/>
            Merkinnän voi poistaa klikkaamalla Poista-nappia.<br/>
            <input type="text" name="note" id="note" placeholder="Lisää...">
            <input class="button" type="button" name="submit" value="Tallenna"
            id="submit">
        </form>
        <script>submitNote();</script>
    </div>
    <?php
}


function noteList() {
    ?>
    <div id="notebook">
        <ul class="list">
            <?php
            if(isset($_SESSION["userId"])) {
                $userid = $_SESSION["userId"];
            }
            else {
                $userid = 0;
            }
            $db = new PDO('mysql:host=localhost;dbname=todo;charset=utf8', 'todo', 'todo');
            $stmt = $db->prepare("SELECT * FROM notes WHERE user_id=:userid");
            $stmt->execute(array(":userid" => $userid));
            //$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            //print_r($result);
            while ($note = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $id = $note['id'];
                $date = $note['note_date'];
                echo '<div class="note" ><li class="list">' . $note['note'] . '</li>';
                echo '<p class="under">' . date("F j, Y, g:i a", strtotime($date));
                ?>
                <button class="button remove" type="button" name="remove"
                value="<?php echo $id;?>">Poista</button>
                <?php
                echo '</p></div>';
            }
            ?>
            <script>
                deleteNote();
                $(".note").on("mouseenter mouseleave", function (event) {
                    $(this).find(".list").toggleClass("inside");
                    $(this).find(".button").toggleClass("visible");
                });
            </script>
        </ul>
    </div>
</body>
<?php
}
?>
