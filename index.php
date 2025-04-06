<?php
    include 'includes/header.php';
?>

<main id="main">
<!-- Hero section begins -->

<div class="hero-section">

<div class="get-started">
  <h1>Empowering Voices, <br>Resolving Issues.</h1>
  <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsam dolor praesentium nisi hic incidunt quidem velit.</p>
  <a href="login-user.php"><Button>Get Started</Button></a>
</div>

<div class="carousel">
    <div class="slider">
      <div class="slide active">
        <img src="images/vecteezy_golden-logo-template_23654784.png" style="border:none;" alt="">
        <h1>Hello1</h1>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsam dolor praesentium nisi hic incidunt quidem velit.</p>
      </div>
      <div class="slide">
        <img src="images/vecteezy_golden-logo-template_23654784.png" style="border:none;"alt="">
        <h1>Hello2</h1>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsam dolor praesentium nisi hic incidunt quidem velit.</p>
      </div>
      <div class="slide">
        <img src="images/vecteezy_golden-logo-template_23654784.png" style="border:none;"alt="">
        <h1>Hello3</h1>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsam dolor praesentium nisi hic incidunt quidem velit.</p>
      </div>
    </div>
    
</div>

<div class="indicators">
      <div class="dot active" attr="0" onclick="slideFun(this)"></div>
      <div class="dot" attr="1" onclick="slideFun(this)"></div>
      <div class="dot" attr="2" onclick="slideFun(this)"></div>
</div>

</div>

<!-- Hero section ends -->


<!-- About us section begins -->

<div id="aboutus">
    <h1>About Us</h1>

    <div class="about-elem">
    <img src="images/vecteezy_golden-logo-template_23654784.png" alt="">
    <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Facilis explicabo voluptatibus rem temporibus laborum. Tempora nam sint quam fugit quo eum, recusandae omnis expedita aspernatur quae nesciunt facere minima maiores. Lorem ipsum dolor sit amet consectetur, adipisicing elit. Rerum rem et nostrum dolores assumenda blanditiis ullam nulla laborum vero. Beatae voluptas voluptatum amet iste nobis nisi quis accusantium? Qui, asperiores.</p>
    </div>

    <div class="about-elem">
    <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Facilis explicabo voluptatibus rem temporibus laborum. Tempora nam sint quam fugit quo eum, recusandae omnis expedita aspernatur quae nesciunt facere minima maiores. Lorem ipsum dolor sit amet consectetur, adipisicing elit. Rerum rem et nostrum dolores assumenda blanditiis ullam nulla laborum vero. Beatae voluptas voluptatum amet iste nobis nisi quis accusantium? Qui, asperiores.</p>
    <img src="images/vecteezy_golden-logo-template_23654784.png" alt="">
    </div>

    <div class="about-elem">
    <img src="images/vecteezy_golden-logo-template_23654784.png" alt="">
    <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Facilis explicabo voluptatibus rem temporibus laborum. Tempora nam sint quam fugit quo eum, recusandae omnis expedita aspernatur quae nesciunt facere minima maiores. Lorem ipsum dolor sit amet consectetur, adipisicing elit. Rerum rem et nostrum dolores assumenda blanditiis ullam nulla laborum vero. Beatae voluptas voluptatum amet iste nobis nisi quis accusantium? Qui, asperiores.</p>
    </div>
    
    <div class="about-elem">
    <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Facilis explicabo voluptatibus rem temporibus laborum. Tempora nam sint quam fugit quo eum, recusandae omnis expedita aspernatur quae nesciunt facere minima maiores. Lorem ipsum dolor sit amet consectetur, adipisicing elit. Rerum rem et nostrum dolores assumenda blanditiis ullam nulla laborum vero. Beatae voluptas voluptatum amet iste nobis nisi quis accusantium? Qui, asperiores.</p>
    <img src="images/vecteezy_golden-logo-template_23654784.png" alt="">
    </div>

</div>

<!-- About us section ends -->

</main>
<script>
const slide = document.querySelectorAll(".slide");
const dots = document.querySelectorAll(".dot");
let counter = 0;
function slideFun(currentSlide){
  currentSlide.classList.add('active');
  let slideId = currentSlide.getAttribute('attr');
  if(slideId > counter)
  {
    slide[counter].style.animation = 'next1 0.5s ease-in forwards';
    counter = slideId;
    slide[counter].style.animation = 'next2 0.5s ease-in forwards';


  }
  else if(slideId == counter){return;}
  else{
    slide[counter].style.animation = 'prev1 0.5s ease-in forwards';
    counter=slideId;
    slide[counter].style.animation = 'prev2 0.5s ease-in forwards';
  }
  indicators();
}

	// Add and remove active class from the indicators


function indicators(){
  for(i=0; i<dots.length; i++)
  {
    dots[i].className = dots[i].className.replace(' active','');
  }
  dots[counter].className += ' active';
}

// Code for auto sliding

function slideNext(){
  slide[counter].style.animation = 'next1 0.5s ease-in forwards';
  if(counter >= slide.length -1)
  {
    counter = 0;
  }
  else
  {
    counter++;
  }
  slide[counter].style.animation = 'next2 0.5s ease-in forwards';
  indicators();
}

function autoSliding(){
  deleteInterval = setInterval(timer,2000);
  function timer(){
    slideNext();
    indicators();
  }
}
autoSliding();

// Stop auto sliding when mouse is over the indicators

const indi_cont = document.querySelector('.indicators');
indi_cont.addEventListener('mouseover',()=>{
  clearInterval(deleteInterval);
});

// Resume sliding when mouse is out of the indicators

indi_cont.addEventListener('mouseout',()=>{
  autoSliding();
})

</script>
<?php
    include 'includes/footer.php';
?>
