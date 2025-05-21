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
   <title>Reservations</title>

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
   <h3>Reservations</h3>
   <p><a href="home.php">Accueil</a> <span> / Reservations</span></p>
</div>

<section class="reservations">

   <h1 class="title">vos reservations</h1>

   <div class="box-container">

   <?php
      if($user_id == ''){
         echo '<p class="empty">veuillez vous connecter pour voir vos reservations</p>';
      }else{
         $select_reservations = $conn->prepare("SELECT * FROM `reservations` WHERE user_id = ?");
         $select_reservations->execute([$user_id]);
         if($select_reservations->rowCount() > 0){
            while($fetch_reservations = $select_reservations->fetch(PDO::FETCH_ASSOC)){
   ?>
   <div class="box">
      <p> Référence : <span><?= $fetch_reservations['id_prefixe']; ?>-<?= $fetch_reservations['id']; ?></span> </p>
      <p>Reservation passee le : <span><?= $fetch_reservations['placed_on']; ?></span></p>
      <p>Date de reservation : <span><?= $fetch_reservations['reservation_start']; ?></span></p>
      <p>Nom : <span><?= $fetch_reservations['name']; ?></span></p>
      <p>Numero de tel : <span><?= $fetch_reservations['number']; ?></span></p>
      <p>Mode de paiement : <span><?= $fetch_reservations['method']; ?></span></p>
      <p>vos commandes : <span><?= $fetch_reservations['total_products']; ?></span></p>
      <p>Prix Tolat : <span><?= $fetch_reservations['total_price']; ?>  TND</span></p>
      <p>Statut : <span style="color:<?php if($fetch_reservations['payment_status'] == 'En attente'){ echo 'red'; }else{ echo 'green'; }; ?>"><?= $fetch_reservations['payment_status']; ?></span> </p>
   </div>
   <?php
      }
      }else{
         echo '<p class="empty">aucune reservations passee pour le moment !</p>';
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