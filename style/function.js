// code that is below untill another comment is for slider in any page.
var slideIndex = 0;
let flag = 0;
showSlides();
// auto function that show slides one by one at a time.
function showSlides() {
  var i;
  var slides = document.getElementsByClassName("slide");
  for (i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";
  }
  slideIndex++;
  if (slideIndex > slides.length) {slideIndex = 1}
  slides[slideIndex-1].style.display = "block";
  setTimeout(showSlides, 3000); // Change image every 3 seconds
}
// function for controll slides throw arrow buttons.
function Controller (x){
    flag = flag + x;
    SlideShow(flag);
}

function SlideShow (num){
    let slides = document.getElementsByClassName ('slide');
    if(num == slides.length){
        flag = 0;
        num = 0;
    }
    if(num < 0){
        flag = slides.length-1;
        num = slides.length-1;
    }
    for(let i of slides){
        i.style.display = "none";
    }
    slides[num].style.display = "block";
  }//end of slides functions



// function for top navigation bar
function myFunction() {
    var showhide = document.getElementById('myLinks');
    if(showhide.style.display === "block")
    {
     showhide.style.display = "none";
    }
     else
    {
     showhide.style.display = "block";
    }
}


// Button for navigate to top.
// When the user scrolls down 20px from the top of the document, show the button.
var mybutton = document.getElementById("top_button");

window.onscroll = function(){scrollFunction()};

function scrollFunction() {
  if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
    mybutton.style.display = "block";
  } else {
    mybutton.style.display = "none";
  }
}
// When the user clicks on the button, scroll to the top of the document
function topFunction() {
  document.body.scrollTop = 0;
  document.documentElement.scrollTop = 0;
}//end of the above code





