<!DOCTYPE html>
<html>
    <head>
        <title>Training factory</title>

        <!-- CSS -->
        <link href="TFDH/css/main.css" rel="stylesheet">

        <!-- JS -->
    </head>
    <body>

        <div id="body-wrapper">

            <header>
                <div id="title">
                    <img src="TFDH/img/logo.png">
                    <h1>Training centrum Den Haag</h1>
                </div>
                <div id="login-wrapper">
                    <p>Welkom <?= $gebruiker->getFirstname(); ?></p>
                    <p><?= $gebruiker->getRole(); ?></p>
                    <?=isset($boodschap)?"<p id = 'boodschap'>$boodschap</p>":""?>
                    <a href="?control=bezoeker&action=uitloggen">uitloggen</a>
                </div>
                <div class="clear"></div>
            </header>