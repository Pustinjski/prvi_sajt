const image = document.querySelector('.slika img');
image.addEventListener('click', function(e) {

console.log('dawdaw');
const prozor = document.querySelector('.modal-view');
prozor.style.display='block';

  const imgModal = document.querySelector('.modal-view img');

  imgModal.src=image.src;

});

const prozor = document.querySelector('.modal-view');
prozor.addEventListener('click', function(e) {

  if(e.target === prozor){
    prozor.style.display= 'none';
  }

});
