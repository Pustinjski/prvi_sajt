<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Hoteli i moteli</title>
    <script  src="../js/ScripteLogIn.js" defer></script>
    <script  src="../js/modal.js" defer></script>
    <script>
      <?php  if(isset($_POST['prijava'])&&!isset($_SESSION['username']))  include  '../js/scripte.js';  ?>
    </script>


    <link rel="stylesheet"  href="../css/stilHotela.css" type="text/css"  />
    <link rel="stylesheet"  href="../css/stilovi.css" type="text/css"  />
    <link rel="stylesheet"  href="../css/modal-view.css" type="text/css"  />

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

<form class="" action="" method="post">
   <button id="btn" type="submit"  name="prijava" onclick=""> <?php if(isset($_SESSION['username'])) echo 'Odjavi se';  else echo 'Prijavi se'; ?></button>
</form>


  </div>


</div>


<div class="prijava-prozor">
  <?php if(isset($_POST['prijava'])&&!isset($_SESSION['username'])){
        include  'prozor.php';

      }else if(isset($_POST['prijava'])&&isset($_SESSION['username'])){

        header("Location: logOut.php");
      }else {
      }
   ?>
</div>



<div class="modal-view">
    <img src="" alt="">
</div>

</div>

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

$id=6;
if($_GET){
          $id = $_GET["id"];

    }




$query = "SELECT * FROM  slike s , hoteli h  where  s.smjestaj_id = $id and h.id=s.smjestaj_id";

$ime='leka';
$slika='aaaaaaaaaa';
$grad = 'Pljevljaaa';
$opis='s';
if($query_run= mysqli_query($mysqlcon,$query))
{
  $row = mysqli_fetch_array($query_run);

  $slika = $row["putanja"];
 $ime = $row["naziv"];
  $ocjena = $row["ocjena"];
  $grad=$row['grad'];
  $opis=$row['opis'];

}


echo '
<div class="sve">
<div class="slika">

<a href="#">  <img src="'.$slika .'"  width="400px" height="300px">
</a>

</div>

<div class="detalji">
  <h2>'.$ime.'</h2>

  <span>Grad : </span> <span>'.$grad.'</span>

  <div >
    ocijena <span class="krug">'.$ocjena.'</span>
  </div>
  <br>
  <br>

  <span>Opis : </span>
  <p>'.$opis.'</p>



</div>



</div>
';

echo '

<div class="komentari">
<h4>Komentari</h4>

<ul>
';
if(isset($_POST['komentar'])){
  $koment = $_POST['komentar'];
  $username = $_SESSION['username'];
  $query ="INSERT INTO komentari (smjestaj_id, sadrzaj,username) VALUES (\"$id \", \" $koment\",\"$username\")";
  $query_run= mysqli_query($mysqlcon,$query);


}


$query = "SELECT * FROM  komentari k, hoteli h  where  k.smjestaj_id = $id and h.id=k.smjestaj_id";


if($query_run= mysqli_query($mysqlcon,$query))
{


  while($row=mysqli_fetch_assoc($query_run))
  {


    $sadrzaj=$row['sadrzaj'];
    $username = $row ['username'];
    $id_komentara =$row['k_id'];
    echo '

      <li>
      <form class="" action="" method="post">

        <span class="ime">'.$username.'</span>
        <a href= ""> <button id="ime" type="submit" name="k_prijava" value="'.$id_komentara.'">Prijavi</button> </a>

        </form>
      <br>
       <span >'.$sadrzaj.'</span>
     </li>';

}

}

if(isset($_SESSION['username'])){


echo '

</ul>

<form class="" action="" method="post">

  <textarea   type="text" name="komentar" placeholder="Ostavi komentar"></textarea>
  <button type="submit" name="komentar-btn" >Objavi</button>
</form>


</div>

';
}else{
  echo '

  </ul>

  <form class="" action="" method="post">

    <textarea   type="text" name="komentar" placeholder="Prijavi se da bi ostavio komentar!"></textarea>
    <button type="button" name="komentar-btn" >Objavi</button>
  </form>


  </div>

  ';
}


if(isset($_POST['k_prijava'])){
  $k_id = $_POST['k_prijava'];


  $query = "UPDATE  komentari set prijava = 1 where   k_id = $k_id";
  $query_run= mysqli_query($mysqlcon,$query);
  header("Location: ./hotel.php?id=$id");


}

?>

</body>
</html>
