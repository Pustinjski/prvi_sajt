<?php


echo '

<div class="prijava-sadrzaj">



  <div class="prijava">
  <h2>Prijava</h2>
  <br>

      <button id="novi-kor" type="button" name="button">Registrovani korisnik</button>
      <button id="reg-kor" type="button" name="button">Novi korisnik</button>

  </div>

  <div class="login">
  <h2>Prijava</h2>
  <br>
    <h3>Uloguj se</h3>

    <form class="" action="server.php" method="post">
      <input type="text" placeholder="Korisnicko ime" name="username">
      <input type="password"  placeholder="Sifra" name="password">

      <button type="submit" name="prijava"> Log in</button>

    </form>

    </div>

  <div class="register">
  <h2>Registracija</h2>
  <br>

    <h3>Napravi nalog</h3>

    <form id="regforma" class="" action="server.php" method="post">
      <input type="text" placeholder="Korisnicko ime"  name="username">
      <input id="sifra" type="password"  placeholder="Sifra"  name="password">
      <input id="potvrdi" type="password"  placeholder="Potvrdi sifru"  name="ppassword">

      <input id="ime" type="text" placeholder="Ime" name="ime">
      <input type="text" placeholder="Prezime"  name="prezime">
      <input type="date" placeholder="Datum rodjenja"  name="datum">
      <input type="text" placeholder="Adresa" name="adresa">
      <input type="text" placeholder="Grad"  name="grad">
      <input type="text" placeholder="Drzava"  name="drzava">
      <input id="telefon" type="text" placeholder="Broj telefona"  name="telefon">

      <button type="submit" name="registracija"> Registruj se</button>

    </form>


  </div>
</div>




';



 ?>
