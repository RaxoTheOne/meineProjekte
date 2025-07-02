<?php
$servername = "localhost";
$benutzername = "root";
$passwort ="";
$datenbank = "kontaktverwaltung";

//Verbindung herstellen PDO
$conn = new mysqli($servername, $benutzername, $passwort, $datenbank);

if($conn->connect_error){
    die ("Verbindung fehlgeschlage:" . $conn->connect_error);
}

//Kontakt in der Datenbank eintragen

if(isset($_POST['insert'])){
    $vname = $_POST['vname'];
    $nname = $_POST['nname'];
    $email = $_POST['email'];

    $sql = $conn->prepare("INSERT INTO kontakte VALUES(NULL, ?, ?, ?)");
    $sql->bind_param("sss", $vname, $nname, $email);

    if($sql->execute()){
        header("location:index.php");
        exit();
    }else{
        echo "Fehler:" . $sql->error;
    }

}









?>