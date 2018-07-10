<?php


if(isset($_SESSION['username'])){
echo '
<div>
  <img src="images/user32px.png" alt="s">
  <span> <?php  echo '.$_SESSION['username'].' ?> </span>

</div>
<a href="logOut.php">  <button id="btn" type="button"  onclick=""> Log out</button></a>

';
}
else{
  echo '
  <div>
    <img src="images/user32px.png" alt="s">
    <span> s </span>

  </div>
   <button id="btn" type="button"  onclick=""> Sign in</button>
';
}





 ?>
