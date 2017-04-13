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
                    <h1>Gegevens bewerken</h1>
                    <form method="post">
                        <table>
                            <tr>
                                <td>Voornaam</td>
                                <td>
                                    <input type="text" placeholder="Vul uw voornaam in" name="firstname"  required="required" value="<?= $gebruiker->getFirstname(); ?>">
                                </td>
                            </tr>
                            <tr >
                                <td>Tussenvoegsel</td>
                                <td>
                                    <input type="text" placeholder='Vul uw tussenvoegsel in' name="prefix" value="<?= $gebruiker->getPreprovision(); ?>" >
                                </td>
                            </tr>
                            <tr> 
                                <td>Achternaam</td>
                                <td>
                                    <input type="text" placeholder='Vul uw achternaam in' name="lastname" required="required" value="<?= $gebruiker->getLastname(); ?>" >
                                </td>
                            </tr>
                            <tr> 
                                <td>Email</td>
                                <td>
                                    <input type="text" placeholder='Vul uw email in' name="email" required="required" value="<?= $gebruiker->getEmailaddress(); ?>" >
                                </td>
                            </tr>
                            <tr> 
                                <td>Adres</td>
                                <td>
                                    <input type="text" placeholder='Vul uw adres in' name="address" required="required" value="<?= $gebruiker->getStreet(); ?>" >
                                </td>
                            </tr>
                            <tr> 
                                <td>Postcode</td>
                                <td>
                                    <input type="text" placeholder='Vul uw postcode in' name="postal" required="required" value="<?= $gebruiker->getPostal_code(); ?>" >
                                </td>
                            </tr>
                            <tr> 
                                <td>Plaats</td>
                                <td>
                                    <input type="text" placeholder='Vul uw plaats in' name="place" required="required" value="<?= $gebruiker->getPlace(); ?>" >
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input type="submit" value="voeg toe">
                                    <input type="reset" value="reset"> 
                                </td>
                            </tr>
                        </table>
                    </form>
                </section>
            </div>
        </div>
    </body>
</html>