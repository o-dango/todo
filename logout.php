<!-- Camilla Piskonen, 0451801
www-sovellukset -->

<?php
session_start();
session_destroy();
?>
<div class="redirect">
    <p>Kirjauduit ulos!</p>
    <button type="button" class="button cancel" name="frontpage" onclick="location.href='index.php'">Etusivulle</button>
</div>
<?php
?>
