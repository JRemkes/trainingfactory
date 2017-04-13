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
                    <li><a href="?control=instructeur&action=default" class="active">Home</a></li>
                    <li><a href="?control=instructeur&action=lesOverzicht">Overzicht Lessen</a></li>
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
                    <h1>Home</h1>
                    <p>
                        Den Haag Training Center is een sportschool waar onder professionele begeleiding
                        in een veilige omgeving verschillende soorten martial arts- indoor bootcamp, 
                        personal- en small group trainingen worden angeboden. Hier kan je je inschrijven
                        op een les of uitschrijven van een les.
                    </p>
                </section>
            </div>
        </div>
    </body>
</html>