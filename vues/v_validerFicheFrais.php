<!DOCTYPE html>
<html>

<head>
    <title></title>
    <meta charset='UTF-8'>
</head>

<body>

    <?php include("v_menu_comptable.php"); ?>

    <div id="selectionVisiteurs">
        <!-- Titre -->
        <h1>Sélectionnez les visiteurs : </h1>

        <!-- Formulaire -->
        <form action="index.php?uc=etatFrais&action=selectionnerMois" method="POST">
            <?php

            // Choix des visiteurs
            echo '<br><select id="lstVisiteurs" name="lstVisiteurs">';

            foreach ($pdo->getVisiteurs() as $valeur) {
                if ($valeur != NULL) {
                    echo '<option>' . $valeur[0] . ' ' . $valeur[1] . ' </option>';
                }
            }
            echo '</option></select>';
            echo '<br><br><button name="Validez" type="submit"">Envoyez</button>';

            ?>
        </form>
    </div>
</body>

</html>