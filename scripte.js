
window.onload = function () {

  const div = document.querySelector('.prijava-prozor');

  div.style.display='block';
  console.log('sda');

  const prijavaDiv = document.querySelector('.prijava');
  const logDiv = document.querySelector('.login');
  const regDiv = document.querySelector('.register');


  document.getElementById('novi-kor').addEventListener('click', function(e) {

    const btn = e.currentTarget;
    prijavaDiv.style.display='none';
    logDiv.style.display='block';
  });

  document.getElementById('reg-kor').addEventListener('click', function(e) {

    const btn = e.currentTarget;
    prijavaDiv.style.display='none';
    regDiv.style.display='block';

  });

  div.addEventListener('click', function(e) {

      if(e.target == div ){
        div.style.display='none';
      }
  });





}
