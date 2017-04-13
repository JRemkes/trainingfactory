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
                <div id="logout-wrapper">
                    <form>
                        <a>Welkom <?php ?></a>
                        <a><?= $gebruiker->getLoginname(); ?></a>
                        <a><?= $gebruiker->getRole(); ?> </a>
                        <input type="submit" value="uitloggen">
                    </form>
                </div>
                <div class="clear"></div>
            </header>

            <nav>
                <ul>
                    <li><a href="?control=instructeur&action=default">Home</a></li>
                    <li><a href="?control=instructeur&action=lesOverzicht">Overzicht Lessen</a></li>
                    <li><a href="?control=instructeur&action=lesToevoegen" class="active">Les Toevoegen</a></li>
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
                    <h1>Les Toevoegen</h1>
                    <table>
                    <form method="post" action="?control=instructeur&action=lesToevoegen">
                        <tr><td>Tijd</td> <td><input required type="time" placeholder="Tijd invullen" name="tijd"></td></tr>
                        <tr><td>Datum</td> <td><input type="date" placeholder="Datum invullen" name="datum"></td></tr>
                        <tr><td>Locatie</td> <td><input required type="text" placeholder="Locatie kiezen" name="locatie"></td></tr>
                        <tr><td>Maximaal aantal deelnemers</td> <td><input required type="number"  name="maxdeelnemers"></td></tr>
                        <tr><td><input type="submit" value="Les Toevoegen"></td></tr>
                    </form>
                    </table>
                </section>
            </div>
        </div>
    </body>
</html>





