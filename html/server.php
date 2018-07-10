
<?php
session_start();


 $username='';
 $password='';
 $ime='';
 $prezime='';

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
 		echo 'konektovano na bazu';
 	}else
 	{
 		echo 'ne postoji baza';
 	}

 }
 else {
 	echo 'neuspjesno konektovanje';
 }


 if(isset($_POST['prijava']))
 {
$admin=1;
 //provjera inputa
 if(isset($_POST['password'])&&isset($_POST['username']))//&&!isset($_POST['ime']))
 {
 	$password=$_POST['password'];
 	$username= $_POST['username'];
 	//dobili smo ime i sifru iz forme


   $query = "SELECT *  FROM users  u , admini a  WHERE u.id=a.user_id AND usernam='".$username." 'AND password= '".$password."' ";
   echo "<br>";
   echo $username;

   if($query_run= mysqli_query($mysqlcon,$query))
   {
     echo "<br>";
     echo $username;
   	//  provjerava direktno sa sql upitom
   	if(mysqli_num_rows($query_run)!=NULL){

  		$_SESSION['username'] = $username;
  		header("Location: ./admin.php");
      $admin=0;

   		echo 'uspjesno ste se ulogovali';
   	}
  }


 $query = "SELECT usernam , password  FROM users WHERE usernam='".$username." 'AND password= '".$password."' ";

 echo '<br>';
 if($admin==1&&$query_run= mysqli_query($mysqlcon,$query))
 {

 	//  provjerava direktno sa sql upitom
 	if(mysqli_num_rows($query_run)!=NULL){

		$_SESSION['username'] = $username;
		header("Location: ./index.php");

 		echo 'uspjesno ste se ulogovali';
 	}else {
    header("Location: ./index.php");

 		echo 'pogresan unos';
    exit;
 	}

 /* //drugi nacin da idemo while i provjeramo svaki username i password sa unesenim podacima
 	while($row=mysqli_fetch_assoc($query_run))
 	{
 		$username = $row['usernam'];
 		$userpass = $row['password'];
 		if($username==$ime&&$userpass==$password)
 		{
 			echo 'uspjesno ste se ulogovali';
 			break;
 		}
 	}

 */
 }
 else
 {
 	echo 'greska';
 }



 }

}else if(isset($_POST['registracija']))
 {
 	$password=$_POST['password'];
 	$username= $_POST['username'];
 	$ime=$_POST['ime'];
  $prezime=$_POST['prezime'];
  $adresa=$_POST['adresa'];
  $telefon=$_POST['telefon'];
  $grad=$_POST['grad'];
  $drzava=$_POST['drzava'];




 		$upit ="SELECT usernam FROM users WHERE usernam='".$username."'";
 		if($mojUpit=mysqli_query($mysqlcon,$upit))
 		{

 			if(mysqli_num_rows($mojUpit)!=NULL)
 			{
 				echo ' <br> vec postoji korisnik sa istim imenom!';
        header("Location: ./index.php");

 			}
 			else{

 				$upitUnosenje="INSERT INTO `users` (`id`, `usernam`, `password`, `firstname`, `surname`) VALUES (NULL, '".$username."', '".$password."', '".$ime."', '".$prezime."')";

 				if($mojUpit2=mysqli_query($mysqlcon,$upitUnosenje))
 				{
 					echo '<br> uspjesno ste se registrovali';
          header("Location: ./index.php");

 				}
 			}

 		}



 }




 ?>
