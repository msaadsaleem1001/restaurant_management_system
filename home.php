<?php
session_start();

?>
<!doctype html>
<html lang="en">
  <head>
    
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="http://code.jquery.com/jquery-latest.js"></script>
    <link rel="stylesheet" href="style/design.css?v=<?php echo time(); ?>">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/6f3c4e01cb.js" crossorigin="anonymous"></script>
    <link rel="icon" href="images/Icon.png" type="image/png">
    <title>DineOut/Home</title>
  </head>
  <body>
  <?php require 'partials/nav_bar.php'; ?>

    <div class="slide-container">

            <div class="slide">
                <img src="images/poboy.jpg" alt="Image">
                <div class="caption">Crispy Burger!</div>
            </div>

            <div class="slide">
                <img src="images/hmbrger.jpg" alt="Image">
                <div class="caption">Zinger berger and Finger's.</div>
            </div>

            <div class="slide">
                <img src="images/mldessert.jpeg" alt="Image">
                <div class="caption">Our special Dessert's item and you should must try it.</div>
            </div>

            <div class="slide">
                <img src="images/turkey-fajitas.jpg" alt="Image" >
                <div class="caption">Special paratha roll!</div>
            </div>
    </div>
    <div class="container">
    <div class = "decide_cart">Select Category.</div> 
    </div>
<!-- Body Content -->
<div class="container" style = "margin-bottom:20px;">
<div class="cards">

                <div class="card home_cards Beaf" style="width: 18rem;">
                <img src="uploaded_images/beaf.jfif" class="card-img-top" alt="img" style = "height:200px;">
                <div class="card-body text-center">
                    <h5 class="card-title">Beaf</h5>
                </div>
                </div>

                <div class="card home_cards Mutton" style="width: 18rem;">
                <img src="images/mutton.jpg" class="card-img-top" alt="img" style = "height:200px;">
                <div class="card-body text-center">
                    <h5 class="card-title">Mutton</h5>
                </div>
                </div>

                <div class="card home_cards Chicken" style="width: 18rem;">
                <img src="images/Chicken.jfif" class="card-img-top" alt="img" style = "height:200px;">
                <div class="card-body text-center">
                    <h5 class="card-title">Chicken</h5>
                </div>
                </div>

                <div class="card home_cards Bread" style="width: 18rem;">
                <img src="images/bread.jfif" class="card-img-top" alt="img" style = "height:200px;">
                <div class="card-body text-center">
                    <h5 class="card-title">Bread</h5>
                </div>
                </div>

                <div class="card home_cards Fish" style="width: 18rem;">
                <img src="images/fish.webp" class="card-img-top" alt="img" style = "height:200px;">
                <div class="card-body text-center">
                    <h5 class="card-title">Fish</h5>
                </div>
                </div>

                <div class="card home_cards Rice" style="width: 18rem;">
                <img src="images/Rice.jpg" class="card-img-top" alt="img" style = "height:200px;">
                <div class="card-body text-center">
                    <h5 class="card-title">Rice</h5>
                </div>
                </div>

                <div class="card home_cards Salad" style="width: 18rem;">
                <img src="images/Salad.webp" class="card-img-top" alt="img" style = "height:200px;">
                <div class="card-body text-center">
                    <h5 class="card-title">Salad</h5>
                </div>
                </div>

                <div class="card home_cards Fast_Food" style="width: 18rem;">
                <img src="images/fast_food.webp" class="card-img-top" alt="img" style = "height:200px;">
                <div class="card-body text-center">
                    <h5 class="card-title">Fast Food</h5>
                </div>
                </div>

                <div class="card home_cards Desserts" style="width: 18rem;">
                <img src="images/desserts.jfif" class="card-img-top" alt="img" style = "height:200px;">
                <div class="card-body text-center">
                    <h5 class="card-title">Desserts</h5>
                </div>
                </div>

                <div class="card home_cards Drinks" style="width: 18rem;">
                <img src="images/drinks.jfif" class="card-img-top" alt="img" style = "height:200px;">
                <div class="card-body text-center">
                    <h5 class="card-title">Drinks</h5>
                </div>
                </div>
</div>
<!-- <div class="container">
<div class ="rating" >
        <div class = "stars" style="position:absolute; right:20px;">
            <h5>Our Ratings average:</h5> 
            <span class="fa fa-star checked"></span>
            <span class="fa fa-star checked"></span>
            <span class="fa fa-star checked"></span>
            <span class="fa fa-star checked"></span>
            <span class="fa fa-star checking"></span>
            <p>Out of abc</p> 
        </div>
</div>
</div> -->
</div>


<form id="selected_category" action="customer.php" method="POST" style="display:none;">
			<input type="text" id="category_selected" name="category_selected">
</form>

<?php require 'partials/footer.php'; ?>
<!-- Button At the bottom to navigate at top: -->
<button onclick="topFunction()" id="top_button"><i class="fa-solid fa-arrow-up"></i></button>
<script src="style/function.js"></script>
<script>
    let Beaf = document.getElementsByClassName('Beaf');
    Array.from(Beaf).forEach((element) => {
      element.addEventListener("click", (e) => {
		let category = "Beaf";
        let selected = document.getElementById('category_selected');
        selected.value = category;
		let form = document.getElementById("selected_category");
        form.submit();
      })
    })

    let Mutton = document.getElementsByClassName('Mutton');
    Array.from(Mutton).forEach((element) => {
      element.addEventListener("click", (e) => {
		let category = "Mutton";
        let selected = document.getElementById('category_selected');
        selected.value = category;
		let form = document.getElementById("selected_category");
        form.submit();
      })
    })

    let Chicken = document.getElementsByClassName('Chicken');
    Array.from(Chicken).forEach((element) => {
      element.addEventListener("click", (e) => {
		let category = "Chicken";
        let selected = document.getElementById('category_selected');
        selected.value = category;
		let form = document.getElementById("selected_category");
        form.submit();
      })
    })

    let Bread = document.getElementsByClassName('Bread');
    Array.from(Bread).forEach((element) => {
      element.addEventListener("click", (e) => {
		let category = "Bread";
        let selected = document.getElementById('category_selected');
        selected.value = category;
		let form = document.getElementById("selected_category");
        form.submit();
      })
    })

    let Fish = document.getElementsByClassName('Fish');
    Array.from(Fish).forEach((element) => {
      element.addEventListener("click", (e) => {
		let category = "Fish";
        let selected = document.getElementById('category_selected');
        selected.value = category;
		let form = document.getElementById("selected_category");
        form.submit();
      })
    })

    let Rice = document.getElementsByClassName('Rice');
    Array.from(Rice).forEach((element) => {
      element.addEventListener("click", (e) => {
		let category = "Rice";
        let selected = document.getElementById('category_selected');
        selected.value = category;
		let form = document.getElementById("selected_category");
        form.submit();
      })
    })

    let Salad = document.getElementsByClassName('Salad');
    Array.from(Salad).forEach((element) => {
      element.addEventListener("click", (e) => {
		let category = "Salad";
        let selected = document.getElementById('category_selected');
        selected.value = category;
		let form = document.getElementById("selected_category");
        form.submit();
      })
    })

    let Fast_Food = document.getElementsByClassName('Fast_Food');
    Array.from(Fast_Food).forEach((element) => {
      element.addEventListener("click", (e) => {
		let category = "Fast Food";
        let selected = document.getElementById('category_selected');
        selected.value = category;
		let form = document.getElementById("selected_category");
        form.submit();
      })
    })


    let Desserts = document.getElementsByClassName('Desserts');
    Array.from(Desserts).forEach((element) => {
      element.addEventListener("click", (e) => {
		let category = "Desserts";
        let selected = document.getElementById('category_selected');
        selected.value = category;
		let form = document.getElementById("selected_category");
        form.submit();
      })
    })

    let Drinks = document.getElementsByClassName('Drinks');
    Array.from(Drinks).forEach((element) => {
      element.addEventListener("click", (e) => {
		let category = "Drinks";
        let selected = document.getElementById('category_selected');
        selected.value = category;
		let form = document.getElementById("selected_category");
        form.submit();
      })
    })
  
</script>
  </body>
</html>





