<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
   header('location:home.php');
};

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Commandes</title>

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
   <h3>Commandes</h3>
   <p><a href="home.php">Accueil</a> <span> / Commandes</span></p>
</div>

<section class="orders">

   <h1 class="title">vos commandes</h1>

   <div class="box-container">

   <?php
      if($user_id == ''){
         echo '<p class="empty">veuillez vous connecter pour voir vos commandes</p>';
      }else{
         $select_orders = $conn->prepare("SELECT * FROM `orders` WHERE user_id = ?");
         $select_orders->execute([$user_id]);
         if($select_orders->rowCount() > 0){
            while($fetch_orders = $select_orders->fetch(PDO::FETCH_ASSOC)){
   ?>
   <div class="box">
      <p> Référence : <span><?= $fetch_orders['id_prefixe']; ?>-<?= $fetch_orders['id']; ?></span> </p>
      <p>Passée en : <span><?= $fetch_orders['placed_on']; ?></span></p>
      <p>Nom : <span><?= $fetch_orders['name']; ?></span></p>
      <p>Email : <span><?= $fetch_orders['email']; ?></span></p>
      <p>Numero : <span><?= $fetch_orders['number']; ?></span></p>
      <p>Addresse : <span><?= $fetch_orders['address']; ?></span></p>
      <p>Mode de paiement : <span><?= $fetch_orders['method']; ?></span></p>
      <p>Total produits : <span><?= $fetch_orders['total_products']; ?></span></p>
      <p>Prix Total : <span><?= $fetch_orders['total_price']; ?>  TND</span></p>
      <p>Statut : <span style="color:<?php if($fetch_orders['payment_status'] == 'En attente'){ echo 'red'; }else{ echo 'green'; }; ?>"><?= $fetch_orders['payment_status']; ?></span> </p>
   </div>
   <?php
      }
      }else{
         echo '<p class="empty">aucune commande passee pour le moment !</p>';
      }
      }
   ?>

   </div>

</section>










<!-- footer section starts  -->
<?php include 'components/footer.php'; ?>
<!-- footer section ends -->






<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>