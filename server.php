
<?php


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


 //provjera inputa
 if(isset($_POST['password'])&&isset($_POST['username']))//&&!isset($_POST['ime']))
 {
 	$password=$_POST['password'];
 	$username= $_POST['username'];
 	//dobili smo ime i sifru iz forme





 $query = "SELECT usernam , password  FROM users WHERE usernam='".$username." ' AND password= '".$password."' ";

 echo '<br>';
 if($query_run= mysqli_query($mysqlcon,$query))
 {

 	// jednostavniji nacin provjeravamo direktno sa sql upitom
 	if(mysqli_num_rows($query_run)!=NULL){
 		echo 'uspjesno ste se ulogovali';
 	}else {
 		echo 'pogresan unos';
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
 /*
 if(isset($_POST['password'])&&isset($_POST['username'])&&isset($_POST['ime'])&&isset($_POST['prezime']))
 {
 	$password=$_POST['password'];
 	$username= $_POST['username'];
 	$ime=$_POST['ime'];
 	$prezime=$_POST['prezime'];

 	if($password==''||$username==''||$ime=''||$prezime=='')
 	{
 		echo 'morate popuniti sva polja';
 	}else{


 		$upit ="SELECT usernam FROM users WHERE usernam='".$username."'";
 		if($mojUpit=mysqli_query($mysqlcon,$upit))
 		{

 			if(mysqli_num_rows($mojUpit)!=NULL)
 			{
 				echo ' <br> vec postoji korisnik sa istim imenom!';
 			}
 			else{

 				$upitUnosenje="INSERT INTO `users` (`id`, `usernam`, `password`, `firstname`, `surname`) VALUES (NULL, '".$username."', '".$password."', '".$ime."', '".$prezime."')";

 				if($mojUpit2=mysqli_query($mysqlcon,$upitUnosenje))
 				{
 					echo '<br> uspjesno ste se registrovali';
 				}
 			}

 		}

 	}

 }
*/

include('index.html');


 ?>
