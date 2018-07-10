<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Hoteli i moteli</title>
    <script  src="../js/ScripteLogIn.js" defer></script>
    <script  src="../js/slideshow.js" defer></script>

    <script >
      <?php  if(!isset($_SESSION['username']))  include  '../js/scripte.js';  ?>
    </script>


    <link rel="stylesheet"  href="../css/stilovi.css" type="text/css"  />

<style media="screen">

</style>
  </head>
<body>

<div class="vrh">

<div class="naslov-pretraga">
  <a href="index.php"> <h1>Hoteli i Moteli</h1></a>
  <form class="" action="pretraga.php" method="post">

  <input type="text" name="unos" value="" placeholder="pretraga">
 <button type="submit" name="btn">Traži</button>

</form>
</div>


<div class="nalog">

  <div>
    <img src="../images/user32px.png" alt="s">
    <span> <?php if(isset($_SESSION['username'])) echo ''.$_SESSION['username'];  ?> </span>

  </div>

  <a href="logOut.php">  <button id="btn" type="button"  onclick=""> <?php if(isset($_SESSION['username'])) echo 'Odjavi se';  else echo 'Prijavi se'; ?></button></a>


  </div>


</div>


</div>

<div class="slideshow">

  <?php
  $mysql_username = 'root';
  $mysql_host ='localhost';
  $mysql_pass='';

  $mysql_db='moja_database';

 //konektovanje na bazu
  @$mysqlcon = mysqli_connect($mysql_host,$mysql_username,$mysql_pass) or die('greska');
  if($mysqlcon)
  {
    if(@mysqli_select_db($mysqlcon,'moja_database') or die('greska'))
    {
    //	echo 'konektovano na bazu';
    }else
    {
      echo 'ne postoji baza';
    }

  }
  else {
    echo 'neuspjesno konektovanje';
  }



    $query = "SELECT * FROM  slideslike";


    if($query_run= mysqli_query($mysqlcon,$query))
    {
      while($row=mysqli_fetch_assoc($query_run))
      {
        $slika = $row['putanja'];
        echo "
        <img src=\"$slika\">
        ";
      }
    }


?>
	</div>




<div class="prijava-prozor">
  <?php if(!isset($_SESSION['username'])){

        include  'prozor.php';
      }
   ?>
</div>


<div class="proizvodiDiv">


  <ul class="products">


    <?php





                $query = "SELECT * FROM  slike s , hoteli h  where  s.smjestaj_id = h.id";


                if($query_run= mysqli_query($mysqlcon,$query))
                {
                  while($row=mysqli_fetch_assoc($query_run))
                  {


                    $naziv = $row['naziv'];
                    $id = $row['id'];
                    $opis = $row['opis'];
                    $grad = $row['grad'];
                    $ocijena = $row['ocjena'];
                    $vrsta = $row['vrsta'];
                    $slika = $row['putanja'];
                    $href= "hotel.php?id=".$id;

                     echo "
                      <li>

                          <a href=".$href.">
                              <img src=".$slika.">
                              <h4>".$naziv."</h4>
                              <p>".$grad."</p>

                              <p>".$ocijena."</p>
                          </a>
                      </li>
                      ";
                  }
                }

      ?>

  </ul>

</div>

<div class="opis-stranice">

<a href="opisSajta.html">Opis sajta</a>
</div>



  </body>

</html>
