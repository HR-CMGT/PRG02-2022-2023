<?php

// controleer of er op de link geklikt is. Dit doe je door te controleren of de $_GET de juist info bevat.

// Als dat waar is, stel je de variabele $code gelijkt aan de meegestuurde info


?>
<!doctype html>
<html lang="en">
<head>
    <meta name="description" content="width=device-width, user-scalable=no"/>
    <meta charset="utf-8"/>
    <title>Oefening 2 - GET - Postback</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">
</head>
<body>
<section class="section">
    <div class="container">
        <h1>Oefening 2 - GET - Postback</h1>

        <p>
            In deze opdracht is het de bedoeling dat informatie uit een link
            verstuurd wordt naar DEZELFDE pagina. Dit noemen we een postback.
            PHP moet echter controleren of deze postback heeft plaatsgevonden.
            <br>
            Vul de PHP code hierboven aan, zodat de postback goed afgehandeld wordt
            en er geen foutmeldingen meer optreden.
        </p>

        <?php if (isset($code)) { ?>
            <p>
                De code is: <?= $code ?>
            </p>
        <?php } else { ?>

            <a href="?info=42">Deze link stuurt je naar dezelfde pagina</a>

        <?php } ?>
        <footer class="footer">
            <a href="index.html">Terug naar het overzicht van de lesopdrachten</a>
        </footer>
    </div>
</section>

</body>
</html>