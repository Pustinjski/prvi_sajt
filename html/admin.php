<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Hoteli i moteli</title>
    <script  src="../js/ScripteLogIn.js" defer></script>
    <script >
      <?php  if(!isset($_SESSION['username']))  include  'scripte.js';  ?>
    </script>


    <link rel="stylesheet"  href="../css/stilovi.css" type="text/css"  />
    <link rel="stylesheet"  href="../css/modal-view.css" type="text/css"  />

<style media="screen">

</style>
  </head>
<body>

<div class="vrh">

<div class="naslov-pretraga">
  <a href="index.php"> <h1>Moteli i Hoteli</h1></a>
  <h3>Administrator </h3>
</div>


<div class="nalog">

  <div>
    <img src="../images/user32px.png" alt="s">
    <span> <?php if(isset($_SESSION['username'])) echo ''.$_SESSION['username'];  ?> </span>

  </div>

  <a href="logOut.php">  <button id="btn" type="button"  onclick=""> <?php if(isset($_SESSION['username'])) echo 'Odjavi se';  else echo 'Prijavi se'; ?></button></a>

  </div>
  <br><br><br><br><br><br>

<div class="">


  <form class="" name="forma"action="" method="post" enctype="multipart/form-data">

    <div  class="admin-edit">

      <div class="topedit">
        <input id="naziv" type="text" name="naziv" value="" placeholder="naziv hotela" >
        <button type="submit" name="promjeni" >Promjeni</button>
        <button type="submit" name="upload" >Napravi novi</button>
        <button type="submit" name="obrisi" >Obriši</button>

      </div>
<div id="inputi">

    <br><br>
    <br>
    <label for="ime">Naziv </label>
    <input id="ime" type="text" name="ime" value="">

    <label for="grad">Grad </label>
    <input id="grad" type="text" name="grad" value="">
    <label for="ocjena">Ocijena </label>
    <input id="ocjena" type="number" name="ocjena" value="">
    <input id="fajl" type="file" name="image" >
<br>
    <label for="opis">Opis </label>
    <br>
    <textarea id="opis" type="text" name="opis" value=""> </textarea>
    <br>


    <br>
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

    $adminIme=$_SESSION['username'];
    $query = "SELECT * FROM admini where  name =\"$adminIme\" ";


    if($query_run= mysqli_query($mysqlcon,$query)){
      echo "string";
      if(mysqli_num_rows($query_run)==NULL){

    		header("Location: ./index.php");

     	}
    }



              if (isset($_POST['obrisi'])||isset($_POST['promjeni'])||isset($_POST['upload'])) {

                $naziv_hotela = $_POST['naziv'];

                $query = "DELETE  FROM hoteli WHERE naziv =\"$naziv_hotela\" ";

                mysqli_query($mysqlcon, $query);

              if(!isset($_POST['obrisi'])&&($_POST['ime']!='')&&($_POST['ocjena']!='')&&($_POST['grad']!='')&&($_POST['opis']!='')){
                $naziv = $_POST['ime'];
                $ocjena = $_POST['ocjena'];
                $grad = $_POST['grad'];
                $opis = $_POST['opis'];

              	$image  = $_FILES['image']['name'];

              	$target = "../images/".basename($image);

                $query = "INSERT INTO vrsta (naziv) VALUES ('$grad')";

                mysqli_query($mysqlcon, $query);

              	$query = "INSERT INTO hoteli (naziv, ocjena, opis,grad ) VALUES ('$naziv', '$ocjena','$opis','$grad')";

              	mysqli_query($mysqlcon, $query);

                $query = "SELECT * FROM hoteli where naziv =\"$naziv\"";


                if($query_run= mysqli_query($mysqlcon,$query)){

                  while($row = mysqli_fetch_assoc($query_run)){

                                $id_hotela = $row['id'];

                                echo "<a href=\"hotel.php?id=$id_hotela \">$naziv</a>";
                                $query = "INSERT INTO slike (smjestaj_id,putanja ) VALUES ('$id_hotela', '$target')";
                                break;
                  }
                }


              	mysqli_query($mysqlcon, $query);

              	if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {

              	}else{
                  // odgovarajuca poruka
              	}
              }

            }



     ?>


  </div>
</div>

<div class="admin-edit">
  <div class="topedit">
    Prijavljeni komentari
  </div>
<br>
  <ul>
  <?php





                  $query = "SELECT * FROM  komentari   where  prijava = 1";


                  if($query_run= mysqli_query($mysqlcon,$query))
                  {
                    while($row=mysqli_fetch_assoc($query_run))
                    {


                      $sadrzaj = $row['sadrzaj'];
                      $username = $row['username'];
                      $id_komentara = $row['k_id'];
                       echo "
                       <li>
                             <span class=\"ime\">$username</span>
                             <form  action=\"\" method=\"post\">
                             <button type=\"submit\" name=\"komentar-obrisi\" value=\"".$id_komentara."\">Obriši</button>
                             <p> $sadrzaj </p>

                             </form>
                      </li>
                        ";
                    }
                  }



        if(isset($_POST['komentar-obrisi'])){

          $id_komentara = $_POST['komentar-obrisi'];

          $query = "DELETE FROM komentari where k_id = \"$id_komentara\" ";
          $query_run = mysqli_query($mysqlcon, $query);
          header("Location: ./admin.php");

        }




   ?>





  </ul>

</div>




</div>


  </form>

  <div class="admin-edit">
    <div class="topedit">
      <form class="" action="" method="post">
        <label for="korisnik">Obriši korisnika : </label>
          <input type="text" name="korisnik" value="" placeholder="Korisničko ime">
          <button type="submit" name="delete">Obriši</button>
      </form>

    </div>
  <br>

  <?php
  if(isset($_POST['delete'])){
    $korisnik = $_POST['korisnik'];
    $query = "DELETE  FROM users WHERE usernam =\"$korisnik\" ";
    mysqli_query($mysqlcon, $query);

  }else{
  }
   ?>

</div>


</div>




</body>

</html>
