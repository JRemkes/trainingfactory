<?php
    include('includes/header.php');
    include('includes/nav.php');
?>  
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
                    <h1>Beschikbare lessen</h1>
                    <table id="dataTable">
                        <tr>
                            <th>Naam</th>
                            <th>Datum</th>
                            <th>Tijd</th>
                            <th>locatie</th>
                            <th>Duur</th>
                            <th>Prijs</th>
                            <th>inschrijven</th>
                        </tr>
                        <?php
                        foreach($lessons as $l) {
                            echo "<tr>";
                            echo "<td>" . $l->getDescription() . "</td>";
                            echo "<td>" . $l->getDate() . "</td>";
                            echo "<td>" . $l->getTime() . "</td>";
                            echo "<td>" . $l->getLocation() . "</td>";
                            echo "<td>" . $l->getDuration() . " min</td>";
                            echo "<td> €" . $l->getCosts() . "</td>";
                            echo "<td><a href='?control=lid&action=signinLesson&userId=" . $gebruiker->getId() . "&lessonId=" . $l->getId() . "'><img src='TFDH/img/signin.png'></a></td> ";
                        }
                        ?>
                    </table>
                </section>
            </div>
        </div>
    </body>
</html>