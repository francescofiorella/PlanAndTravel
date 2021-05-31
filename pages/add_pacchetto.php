<?php
include_once '../includes/db_connection.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pacchetto selezionato</title>
    <link rel="shortcut icon" href="../drawable/logo-mini.png"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css" integrity="sha512-NmLkDIU1C/C88wi324HBc+S2kLhi08PN5GDeUVVVC/BVt/9Izdsc9SVeVfA1UZbY3sHUlDSyRXhCzHfr6hmPPw==" crossorigin="anonymous" />
    <link rel="stylesheet" href="../style/home_page.css"/>
    <link rel="stylesheet" href="../style/add_pacchetto.css"/>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flickity/2.2.1/flickity.min.css" integrity="sha512-ztsAq/T5Mif7onFaDEa5wsi2yyDn5ygdVwSSQ4iok5BPJQGYz1CoXWZSA7OgwGWrxrSrbF0K85PD5uLpimu4eQ==" crossorigin="anonymous" />

    <script src="https://unpkg.com/scrollreveal@4.0.0/dist/scrollreveal.min.js"></script>

    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;700;900&display=swap" rel="stylesheet">
</head>
<body>
<! navbar>
<div class="navbg">
    <navbar>
        <div class="logo">
            <img src="../drawable/navbar-logo.png" alt="logo-sito">
        </div>
        <ul class="menu">
            <li><a href="homepage.php">Home</a></li>
            <li><a href="mete.html">Mete</a></li>
            <li><a href="pacchetti.html">Pacchetti</a></li>
            <li><a href="contatti.php">Contatti</a></li>
        </ul>
        <div class="cta">
            <a href="login.html" class="button"> Login</a>
        </div>
        <div class="hamburger">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </navbar>
</div>

<div class="bg-cover">
    <div class="form">
        <img src="../drawable/3466640.png" class="avatar">
        <form action="add_pacchetto.php" method="post" enctype="multipart/form-data">
            <label>Nome: <input type="text" name="name"></label><br><br>
            <label>Descrizione: <textarea type="text" name="desc" cols="30" rows="10"></textarea></label><br><br>
            <label>Costo: <input type="number" name="price"></label><br><br>
            <input type="file" name="image"><br><br>
            <button type="submit" name="aggiungi">Aggiungi</button>
        </form>

    </div>
</div>
<?php
if (isset($conn)) {
    if (isset($_POST['aggiungi'])) {
        if (!empty($_POST['name']) && !empty($_POST['desc']) && !empty($_POST['price']) && !empty($_FILES['image']['name'])) {
            $titolo = $_POST['name'];
            $descrizione = $_POST['price'];
            $costo = $_POST['price'];
            $immagine = $_FILES['image']['name'];

            $target = "../drawable/db/" . basename($_FILES['image']['name']);

            $query = "INSERT INTO pacchetto(titolo, descrizione, costo, immagine) VALUES ('$titolo', '$descrizione', '$costo', '$immagine');";
            $run = mysqli_query($conn, $query) or die(mysqli_error($conn));

            if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
                echo "Image added" . "<br>";
            } else {
                echo "Image not added" . "<br>";
            }

            if ($run) {
                echo "Form submitted!" . "<br>";

                $sql = "SELECT * FROM pacchetto;";
                $result = mysqli_query($conn, $sql);
                $result_check = mysqli_num_rows($result);

                if ($result_check > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<br>" . $row['id'] . "<br>";
                        echo $row['titolo'] . "<br>";
                        echo $row['descrizione'] . "<br>";
                        echo $row['costo'] . "<br>";
                        echo $image_path = "../drawable/db/" . $row['immagine'] . "<br>";
                        echo "<div id='img_div'>";
                        echo "<img src='../drawable/db/" . $row['immagine'] . "' >";
                        echo "</div>";
                    }
                }
            } else {
                echo "Form not submitted!";
            }
        } else {
            echo "All fields required";
        }
    }
}
?>

<! Footer>

<footer>
    Plan&Travel | Via Roma, 24 - 55045 Pietrasana (Lucca) ITALIA | P.Iva 000000000 <br>
    <a class="trans-color-text" href="#">info@plan&travel.com</a> | <span itemprop="telephone"><a href="#">0883 200300</a></span>
    <br><a href="privacy_and_cookies.html"> privacy</a> | <a href="privacy_and_cookies.html"> cookie policy</a>

    <div class="social-cont">
        <ul class="social-list">
            <li><a target="_blank" href="#"><img src="https://icon-library.com/images/facebook-png-icon-white/facebook-png-icon-white-18.jpg"  title="facebook" alt="Facebook icon"></a></li>
            <li><a target="_blank" href="#"><img src="https://icon-library.com/images/white-instagram-icon-png/white-instagram-icon-png-14.jpg" title="Instagram" alt="Instagram icon"></a></li>
            <li><a target="_blank" href="#"><img src="https://www.suiteforlife.it/wp-content/uploads/2019/09/whatsapp-logo-112413FAA7-seeklogo-298x300.png" title="WhatsApp" alt="WhatsApp icon"></a></li>
        </ul>
    </div><!--/fine social cont-->
    Designed by<br>
    <div class="credits">
        <a href="homepage.php"><img width="32" src="../drawable/logo-mini.png" title="Plan&Travel" alt="Icona Plan&Travel"></a>
    </div>
</footer>
<!-- Jquery -->
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/flickity/2.2.1/flickity.pkgd.min.js" integrity="sha512-Nx/M3T/fWprNarYOrnl+gfWZ25YlZtSNmhjHeC0+2gCtyAdDFXqaORJBj1dC427zt3z/HwkUpPX+cxzonjUgrA==" crossorigin="anonymous"></script>

<script>
    $( document ).ready(function() {

        /* Open Panel */
        $( ".hamburger" ).on('click', function() {
            $(".menu").toggleClass("menu--open");
        });

    });


    ScrollReveal().reveal('.reveal',  { distance: '100px', duration: 1500, easing: 'cubic-bezier(.215, .61, .355, 1)', interval: 600 });

    ScrollReveal().reveal('.zoom',  { duration: 1500, easing: 'cubic-bezier(.215, .61, .355, 1)', interval: 200, scale: 0.65, mobile: false});
</script>

</body>
</html>
