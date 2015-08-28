<?php
session_start();
require_once("spelbord.class.php");

if (isset($_GET["reset"])) {
    unset($_SESSION["spelbord"]);
}

if (!isset($_SESSION["spelbord"])) {
    $spelbord = new Spelbord(4, 4);
    $_SESSION["spelbord"] = serialize($spelbord);
} else {
    $spelbord = unserialize($_SESSION["spelbord"]);
}

$alleLichtenZijnUit = false;
if (isset($_GET["schakelkolom"]) && isset($_GET["schakelrij"])) {
    $alleLichtenZijnUit = $spelbord->schakelOm($_GET["schakelkolom"], $_GET["schakelrij"]);
    $_SESSION["spelbord"] = serialize($spelbord);
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Lights out!</title>
    </head>
    <body>
        <h1>Lights out!</h1>
        <?php
        if ($alleLichtenZijnUit == true) {
            ?>
            <h2>U hebt gewonnen!!</h2>
            <?php
        } else {
            ?>
            <table>
                <tbody>
                    <?php
                    for ($kolom = 0; $kolom < $spelbord->getAantalKolommen(); $kolom++) {
                        ?>
                        <tr>
                            <?php
                            for ($rij = 0; $rij < $spelbord->getAantalRijen(); $rij++) {
                                ?>
                                <td>
                                    <a href="spelen.php?schakelkolom=<?php print($kolom); ?>&schakelrij=<?php print($rij); ?>">
                                        <?php
                                        if ($spelbord->getStatus($kolom, $rij) == 1) {
                                            ?>
                                            <img src="img/lightsout-aan.png">
                                            <?php
                                        } else if ($spelbord->getStatus($kolom, $rij) == 0) {
                                            ?>
                                            <img src="img/lightsout-uit.png">
                                            <?php
                                        }
                                        ?>
                                    </a>
                                </td>
                                <?php
                            }
                            ?>
                        </tr>
                        <?php
                    }
                    ?>
                </tbody>
            </table>
            <?php
        }
        ?>
        <a href="spelen.php?reset=1">Nieuw spel</a>
    </body>
</html>