<?php
// Anslut till databasen
$host = "hostname";
$user = "root";
$password = "";
$dbname = "webbserverprogrammering";

// Skapa anslutning
$conn = mysqli_connect($host, $user, $password, $dbname);

// Kontrollera anslutning
if (!$conn) {
    die("Anslutning misslyckades: " . mysqli_connect_error());
}

// Spara data från formuläret
if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $homepage = $_POST['homepage'];
    $comment = $_POST['comment'];
    $time = time();

    // Spara data i databasen
    $sql = "INSERT INTO guestbook (name, email, homepage, comment, time)
    VALUES ('$name', '$email', '$homepage', '$comment', '$time')";

    if (mysqli_query($conn, $sql)) {
        echo "Inlägget har sparats";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}

// Hämta data från databasen
$sql = "SELECT id, name, email, homepage, comment, time FROM guestbook";
$result = mysqli_query($conn, $sql);

// Skriv ut data i en tabell
if (mysqli_num_rows($result) > 0) {
    echo "<table>";
    echo "<tr>";
    echo "<th>ID</th>";
    echo "<th>Namn</th>";
    echo "<th>E-postadress</th>";
    echo "<th>Hemsida</th>";
    echo "<th>Kommentar</th>";
    echo "<th>Tid</th>";
    echo "</tr>";
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row['id'] . "</td>";
        echo "<td>" . $row['name'] . "</td>";
        echo "<td>" . $row['email'] . "</td>";
        echo "<td>" . $row['homepage'] . "</td>";
        echo "<td>" . $row['comment'] . "</td>";
        echo "<td>" . $row['time'] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "Inga inlägg har gjorts än.";
}

// Stäng anslutning
mysqli_close($conn);
?>

<!-- HTML formulär -->
<h1>Sahar's Guestbook</h1>
    <form action="" method="post">
        Name: <input type="text" name="name"> <br> <br>
        Email: <input type="email" name="email"> <br> <br>
        Tel: <input type="number" name="tel"> <br> <br>
        Comment: <input type="text" name="comment"> <br> <br>
        <input type="submit" value="Lägg till">
    </form>