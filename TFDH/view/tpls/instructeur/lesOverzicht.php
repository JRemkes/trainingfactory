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

            <nav>
                <ul>
                    <li><a href="?control=instructeur&action=default">Home</a></li>
                    <li><a href="?control=instructeur&action=lesOverzicht" class="active">Overzicht Lessen</a></li>
                    <li><a href="?control=instructeur&action=lesToevoegen">Les Toevoegen</a></li>
                </ul>
            </nav>

            <div id="content-wrapper">
                <section id="photo-col">
                    <figure>
                        <img src="TFDH/img/boksen_1.jpg">
                    </figure>
                    <figure>
                        <img src="TFDH/img/boksen_2.jpg">
                    </figure>
                    <figure>
                        <img src="TFDH/img/boksen_3.png">
                    </figure>
                    <div class="clear"></div>
                </section>

                <section id="main-content">
                    <h1>Overzicht lessen</h1>
                    <table id="dataTable">
                    <tr><td>Tijd</td><td>Datum</td><td>Locatie</td><td>Maximaal aantal deelnemers</td><td>Instructeur</td><td>Acties</td></tr>
                    <?php foreach($lessen as $les):?>
                        <tr><td><?= $les->getTime(); ?></td><td><?= $les->getDate(); ?></td><td><?= $les->getLocation(); ?></td><td><?= $les->getMax_persons(); ?></td>
                        <td><?= $les->getFirstname();?></td><td><a></a><a action="lesVerwijderen"><img src="TFDH/img/delete.png"></a></td></tr>
                    <?php endforeach ?>
                    </table>
                </section>
            </div>
        </div>
    </body>
</html>





