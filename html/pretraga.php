<?php



session_start(); ?>

 <!DOCTYPE html>
 <html lang="en" dir="ltr">
   <head>
     <meta charset="utf-8">
     <title>Moteli i Hoteli</title>
     <script  src="../js/ScripteLogIn.js" defer></script>
     <script  src="../js/prikazivanje.js" defer></script>
     <script >
       <?php  if(!isset($_SESSION['username']))  include  'scripte.js';  ?>
     </script>


     <link rel="stylesheet"  href="../css/stilovi.css" type="text/css"  />

   </head>
   <body>
     <div class="vrh">

     <div class="naslov-pretraga">
      <a href="index.php"> <h1>Hoteli i Moteli</h1></a>
       <form class="" action="pretraga.php" method="post">
         <input type="text" name="pretraga" value="" placeholder="pretraga">
         <button type="submit" name="button">Traži</button>
         <br>
         <br>
         <select  name="pretrazivac">
           <option value="Baza">Baza</option>
           <option value="Google">Google</option>
         </select>
           <input type="number" name="ocijena" value="" placeholder="Najmanja ocijena">

           <select  name="vrsta" >
             <option value="svi" >Sve</option>
             <option value="hotel" >Hoteli</option>
             <option value="motel">Moteli</option>
           </select>

           <select  name="grad">
             <option value="svi" >Svi gradovi</option>

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
                         $query = "SELECT * FROM vrsta ";


                         $br=0;
                         if($query_run= mysqli_query($mysqlcon,$query))
                         {
                           while($row=mysqli_fetch_assoc($query_run))
                           {
                             $imeGrada = $row['naziv'];
                              echo "<option value=\"$imeGrada\" >$imeGrada </option>";
                           }
                         }



              ?>

           </select>



         </form>

     </div>


     <div class="nalog">

       <div>
         <img src="../images/user32px.png" alt="s">
         <span> <?php if(isset($_SESSION['username'])) echo ''.$_SESSION['username'];  ?> </span>

       </div>

       <a href="logOut.php">  <button id="btn" type="button"  onclick=""> <?php if(isset($_SESSION['username'])) echo 'Odjavi se';  else echo 'Prijavi se'; ?></button></a>


       </div>



       <div class="proizvodi ">


         <ul id="pretraga" class="products " >

           <?php





            $vrsta_select='';
            $grad_select='';
            $ocijena_input='';
            $unosPretrage='';
            $query='';
            $ukupan_broj=0;
            if(isset($_POST['button']))
            {
              $vrsta_select=$_POST['vrsta'];
              $grad_select=$_POST['grad'];
              $ocijena_input=$_POST['ocijena'];
              $unosPretrage=$_POST['pretraga'];
              $pretrazivac = $_POST['pretrazivac'];

              if($pretrazivac=="Google"){
                header("Location : https://www.google.me/search?q=$unosPretrage");
              }

          }

          $ukupan_broj=ceil(prikazi(1,$mysqlcon,$vrsta_select,$grad_select,$ocijena_input,$unosPretrage)/5);

            echo '<br>';
            function prikazi($value,$mysqlcon,$vrsta_select,$grad_select,$ocijena_input,$unosPretrage)
            {
            $broj_prikazanih =0;

            $query = "SELECT * FROM hoteli h, slike s where s.smjestaj_id=h.id";


            $br=0;
            if($query_run= mysqli_query($mysqlcon,$query))
            {
              while($row=mysqli_fetch_assoc($query_run))
              {
                if(isset($_POST['unos'])){

                  $unosPretrage=$_POST['unos'];
                  if($unosPretrage=='') break;

                }

                $naziv = $row['naziv'];
                $opis = $row['opis'];
                $grad = $row['grad'];
                $ocijena = $row['ocjena'];
                $vrsta = $row['vrsta'];
                $id= $row['id'];
                $slika = $row['putanja'];
                $href= "hotel.php?id=$id";




                if($unosPretrage==''||(stripos('.'.$naziv,$unosPretrage)>0 || stripos('.'.$opis,$unosPretrage)>0|| stripos('.'.$grad,$unosPretrage)>0))
                {

                  if(($grad_select==''||$grad_select=='svi'||$grad_select==$grad)&&($vrsta_select==''||$vrsta_select=='svi'||$vrsta_select==$vrsta)&&($ocijena_input==0||$ocijena_input<=$ocijena)){
                    $broj_prikazanih++;
                    $br++;
                 echo "
                  <li>

                      <a href=".$href.">
                          <h4>".$naziv."</h4>
                      </a>
                          <p>".$grad."</p>

                          <p>".$ocijena."</p>

                  </li>
                  ";
                }
                }
              }
              if($br==0){
                echo "<h3>Nema rezultata pretrage</h3>";
              }

            	}


              return $broj_prikazanih;
           }
           $br =1;
           echo '         <div class="dugmad" >';
           while($br<=$ukupan_broj){
             echo ' <button type="button"  name="dugme" value="'.$br.'">'.$br.'</button>';
             $br++;
           }
           echo ' </div>';


            ?>


         </ul>



         </div>

   </body>
 </html>
