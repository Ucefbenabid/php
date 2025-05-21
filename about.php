<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>about</title>

   <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<!-- header section starts  -->
<?php include 'components/user_header.php'; ?>
<!-- header section ends -->

<div class="heading">
   <h3>A propos de nous</h3>
   <p><a href="home.php">Accueil</a> <span> / A propos</span></p>
</div>

<!-- about section starts  -->

<section class="about">

   <div class="row">

      <div class="image">
         <img src="images/about1.png" alt="">
      </div>

      

      <div class="content">
         <h3>C'EST MOINS CHER</h3>
         <p>Pas d intermediaires, c'est payant! Absence de frais de service, vous pouvez profiter de la livraison de moins chere du marché.</p>
         <a href="menu.html" class="btn">our menu</a>
      </div>

   </div>

</section>

<section class="about">

   <div class="row">

      <div class="image">
         <img src="images/about.png" alt="">
      </div>

      

      <div class="content">
         <h3>çA VIENT DU RESTO</h3>
         <p>Pourquoi utiliser une tierce partie quand vous pouvez faire affaire directement avec le reso? Trouve les menus de notre restaurant en ligne et commandez chez nous. Gardez le contact et coupe les frais inutiles!</p>
         <a href="menu.html" class="btn">Voir le menu</a>
      </div>

   </div>

</section>

<section class="about">

   <div class="row">

      <div class="image">
         <img src="images/about2.png" alt="">
      </div>

      

      <div class="content">
         <h3>C'EST LOCAL</h3>
         <p>Nous travaillons avec des entreprises de transport deja etablies et creons ainsi des ecosystemes locaux. En etilisant une appli d'ici aui soutient le commerce local, vous fetes la difference et fetes en sorte que les revenus restent dans votre communauté!</p>
         <a href="menu.html" class="btn">Voir le menu</a>
      </div>

   </div>

</section>

<section class="about">

   <div class="row">

      <div class="image">
         <img src="images/about3.png" alt="">
      </div>

      

      <div class="content">
         <h3>C'EST ETHIQUE</h3>
         <p>I FOOD est transparent, ça permet de connaire les client et de les fidéliser.</p>
         <a href="menu.html" class="btn">Voir le menu</a>
      </div>

   </div>

</section>

<!-- about section ends -->

<!-- steps section starts  -->

<section class="steps">

   <h1 class="title">étapes simples</h1>

   <div class="box-container">
   

      <div class="box">
         <img src="images/order1.png" alt="">
         <h3>choisir la commande</h3>
      </div>
      
      <div class="box">
         <img src="images/delivery.png" alt="">
         <h3>livraison rapide</h3>
      </div>

      <div class="box">
         <img src="images/eating.png" alt="">
         <h3>profiter de la nourriture</h3>
      </div>

   </div>

</section>


<!-- steps section ends -->













<!-- footer section starts  -->
<?php include 'components/footer.php'; ?>
<!-- footer section ends -->=






<script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>

<!-- custom js file link  -->
<script src="js/script.js"></script>

<script>

var swiper = new Swiper(".reviews-slider", {
   loop:true,
   grabCursor: true,
   spaceBetween: 20,
   pagination: {
      el: ".swiper-pagination",
      clickable:true,
   },
   breakpoints: {
      0: {
      slidesPerView: 1,
      },
      700: {
      slidesPerView: 2,
      },
      1024: {
      slidesPerView: 3,
      },
   },
});

</script>

</body>
</html>



