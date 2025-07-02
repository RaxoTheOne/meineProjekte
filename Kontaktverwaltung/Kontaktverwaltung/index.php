<?php
//datenbank verbindung importieren
include("db.php");
?>
<html>
    <head>
        <title>Kontakt Verwaltung</title>
    </head>
    <body>
        <h2> Kontakt hinzufügen</h2>
        <form action="db.php" method="POST">
            <label for="vname" > Vorname:</label>
            <input type="text" name="vname" >   <br>
            <label for="nname" >Nachname: </label>
            <input type="text" name="nname" >   <br>
            <label for="email">Email:</label>   
            <input type="text"  name="email" >  <br>

            <input type="submit" name="insert" value="Hinzufügen" >

        </form>
        <table>
            <tr>
                <th>No.</th>
                <th>Vorname</th>
                <th>Nachname</th>
                <th>Email</th>
            </tr>
            <?php
                $kontaktsql= $conn->query("SELECT * FROM kontakte;");
                while($zeile = $kontaktesql->fetch_array()){
                    echo "<tr>";
                        echo "<td>".$zeile['kID']."</td>";
                        echo "<td>".$zeile['vorname']."</td>";
                        echo "<td>".$zeile['nachname']."</td>";
                        echo "<td>".$zeile['email']."</td>";
                    echo "</tr>";
                }
            ?> 
        </table>


    </body>

</html>