
window.onload =function () {

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


const forma = document.querySelector('#regforma');
const poruka1 = document.createElement('span');
const poruka2 = document.createElement('span');

const sifra = document.querySelector('#sifra');
const potvrdaSifre = document.querySelector('#potvrdi');
const telefon = document.querySelector('#telefon');

potvrdaSifre.onchange = function () {
  if(sifra.value!=potvrdaSifre.value){
    poruka1.classList.add('potvrda');
    poruka1.textContent = "Unesite istu sifru!";
    forma.insertBefore(poruka1,potvrdaSifre);
  }else{
    let por = document.querySelector('.potvrda');
    forma.removeChild(por);
  }
}

telefon.onchange = function () {

  if(isNaN(telefon.value)){
    poruka2.classList.add('telefon');
    poruka2.textContent = "Pogresan format!";
    forma.insertBefore(poruka2,telefon);
  }else{
    let por = document.querySelector('.telefon');
    forma.removeChild(por);
  }


}







}
