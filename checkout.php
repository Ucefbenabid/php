<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
   header('location:home.php');
};

if(isset($_POST['submit'])){

   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $number = $_POST['number'];
   $number = filter_var($number, FILTER_SANITIZE_STRING);
   $email = $_POST['email'];
   $email = filter_var($email, FILTER_SANITIZE_STRING);
   $method = $_POST['method'];
   $method = filter_var($method, FILTER_SANITIZE_STRING);
   $address = $_POST['address'];
   $address = filter_var($address, FILTER_SANITIZE_STRING);
   $total_products = $_POST['total_products'];
   $total_price = $_POST['total_price'];

   $check_cart = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
   $check_cart->execute([$user_id]);

   if($check_cart->rowCount() > 0){

      if($address == ''){
         $message[] = 'veuillez ajouter votre adresse!';
      }else{
         
         $insert_order = $conn->prepare("INSERT INTO `orders`(user_id, name, number, email, method, address, total_products, total_price) VALUES(?,?,?,?,?,?,?,?)");
         $insert_order->execute([$user_id, $name, $number, $email, $method, $address, $total_products, $total_price]);

         $delete_cart = $conn->prepare("DELETE FROM `cart` WHERE user_id = ?");
         $delete_cart->execute([$user_id]);

         $message[] = 'commande passée avec succès !';
      }}
      
   }else{


if(isset($_POST['reserve'])){

   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $number = $_POST['number'];
   $number = filter_var($number, FILTER_SANITIZE_STRING);
   $email = $_POST['email'];
   $email = filter_var($email, FILTER_SANITIZE_STRING);
   $method = $_POST['method'];
   $method = filter_var($method, FILTER_SANITIZE_STRING);
   $total_products = $_POST['total_products'];
   $total_price = $_POST['total_price'];
   $reservation_start = $_POST['reservation_start'];

   $check_cart = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
   $check_cart->execute([$user_id]);

   if($check_cart->rowCount() > 0){

      
               
         $insert_order = $conn->prepare("INSERT INTO `reservations`(user_id, name, number, email, method, total_products, total_price, reservation_start) VALUES(?,?,?,?,?,?,?,?)");
         $insert_order->execute([$user_id, $name, $number, $email, $method, $total_products, $total_price ,$reservation_start]);

         $delete_cart = $conn->prepare("DELETE FROM `cart` WHERE user_id = ?");
         $delete_cart->execute([$user_id]);

         $message[] = 'reservation passée avec succès !';
      }
      
   }else{
      $message[] = 'votre panier est vide';
   }
   }


?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Vérification</title>

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
   <h3>Vérification</h3>
   <p><a href="home.php">home</a> <span> / Vérification</span></p>
</div>

<section class="checkout">

   <h1 class="title">détails</h1>

<form action="" method="post">

   <div class="cart-items">
      <h3>Les Articles du panier
      </h3>
      <?php
         $grand_total = 0;
         $cart_items[] = '';
         $select_cart = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
         $select_cart->execute([$user_id]);
         if($select_cart->rowCount() > 0){
            while($fetch_cart = $select_cart->fetch(PDO::FETCH_ASSOC)){
               $cart_items[] = $fetch_cart['name'].' ('.$fetch_cart['price'].' x '. $fetch_cart['quantity'].') - ';
               $total_products = implode($cart_items);
               $grand_total += ($fetch_cart['price'] * $fetch_cart['quantity']);
      ?>
      <p><span class="name"><?= $fetch_cart['name']; ?> : ---></span> <span class="price"><?= $fetch_cart['quantity']; ?> x <?= $fetch_cart['price']; ?>  TND</span></p>
      <?php
            }
         }else{
            echo '<p class="empty">Votre panier est vide !</p>';
         }
      ?>
      <p class="grand-total"><span class="name">grand total : ---></span><span class="price"><?= $grand_total; ?>  TND</span></p>
      <a href="cart.php" class="btn">Voir le panier</a>
   </div>

   <input type="hidden" name="total_products" value="<?= $total_products; ?>">
   <input type="hidden" name="total_price" value="<?= $grand_total; ?>" value="">
   <input type="hidden" name="name" value="<?= $fetch_profile['name'] ?>">
   <input type="hidden" name="number" value="<?= $fetch_profile['number'] ?>">
   <input type="hidden" name="email" value="<?= $fetch_profile['email'] ?>">
   <input type="hidden" name="address" value="<?= $fetch_profile['address'] ?>">

   <div class="user-info"><br>
      <h3>Vos Informations :</h3>
      <p><i class="fas fa-user"></i><span><?= $fetch_profile['name'] ?></span></p>
      <p><i class="fas fa-phone"></i><span><?= $fetch_profile['number'] ?></span></p>
      <p><i class="fas fa-envelope"></i><span><?= $fetch_profile['email'] ?></span></p>
      <a href="update_profile.php" class="btn">MAJ vos informations</a>
      <br><br>
      <h3>adresse de la livraison :</h3>
      <p><i class="fas fa-map-marker-alt"></i><span><?php if($fetch_profile['address'] == ''){echo 'please enter your address';}else{echo $fetch_profile['address'];} ?></span></p>
      <a href="update_address.php" class="btn">MAJ l adresse</a>
      <br><br>
      <h3>Date de la reservation :</h3>
      <input  type="datetime-local" id="reservation_start" name="reservation_start" required>
      <select name="method" class="box" required>
         <option value="" disabled selected>sélectionnez le mode de paiement --</option>
         <option value="Virement">Virement</option>
         <option value="credit card">credit card</option>       
      </select>
      <input type="submit" value="passer commande" class="btn <?php if($fetch_profile['address'] == ''){echo 'disabled';} ?>" style="width:100%; background:var(--red); color:var(--white);" name="submit">
      <input type="submit" value="reserver" class="btn" style="width:100%; background:var(--red); color:var(--white);" name="reserve">
   </div>

</form>
   
</section>









<!-- footer section starts  -->
<?php include 'components/footer.php'; ?>
<!-- footer section ends -->






<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>