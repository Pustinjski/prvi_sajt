
var createSlideshow = function(slideshowElem, duration) {
	// TODO: Implement createSlideshow.

  const images = slideshowElem.children;

  var i=0;
  let prviProlazak=true;


    const slider = function () {

      let fOut =1;
      let fIn =0;
      const trenutna = images[i];
      let prethodna;
      if(i==0) prethodna = images[images.length-1];
      else prethodna = images[i-1];

      const fadeOut = function () {
        if(prviProlazak){
          fadeIn();
          return;
        }
        fOut-=0.1;
        prethodna.style.opacity = fOut;
        if(prethodna.style.opacity>0){
          setTimeout(fadeOut,100);
        }else {

          fadeIn();
        }

      }

      const fadeIn = function () {
        fIn+=0.1;
        trenutna.style.opacity =fIn;
        if(trenutna.style.opacity<1){
          setTimeout(fadeIn,122);
        }
      }

      fadeOut();

      if(i==images.length-1) i=0;
        else   i++;

      prviProlazak=false;
      setTimeout(slider,duration);
    }

    slider();
};


////////////////////////////////////////////////////////
const slike = document.querySelectorAll('.slideshow img');
for(var i =0;i<slike.length;i++){
  slike[i].style.opacity=0;
}
const slideshowE =  document.querySelector('.slideshow');
createSlideshow(slideshowE,5000);
