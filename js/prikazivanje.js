var li  = document.querySelectorAll('li');
for(let i=5;i<li.length;i++){
  li[i].style.display='none';
}

const form = document.querySelector('.dugmad');
form.addEventListener('event', function(e) {
  let btn = e.target;
  let br = btn.value;
  console.log(br);
});
const btns = document.querySelectorAll('.dugmad button');
for (var i = 0; i < btns.length; i++) {
  btns[i].addEventListener('click', function(e) {
    const btn = e.target;
    console.log(btn.value);
    var li  = document.querySelectorAll('li');
    for(let j=0;j<li.length;j++){

      li[j].style.display='none';
    }
    for(let j=0;j<li.length;j++){
      if(j<parseInt(btn.value)*5&&j>=parseInt(btn.value)*5-5)
      li[j].style.display='inline-block';
    }




  });
}


const select = document.querySelector("select");
const input = document.querySelector("input");

const button = document.querySelector('button');
button.addEventListener("click", function() {
  if(select.value == "Google")
      window.open("https://www.google.me/search?q=" + input.value);
});
