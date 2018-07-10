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




if(isset($_POST['prijava'])){
  $k_id = $_POST['prijava'];


  $query = "UPDATE  komentari set prijava = 1 where   k_id = $k_id";
  $query_run= mysqli_query($mysqlcon,$query);
  header("Location: ./hotel.php");


}














 ?>
