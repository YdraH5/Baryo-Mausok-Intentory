<?php
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(1);
?>
<?php
  $d_sale = find_by_id('cart',(int)$_GET['id']);
  if(!$d_sale){
    $session->msg("d","Missing sale id.");
    redirect('add_sale.php');
  }
?>
<?php
// $delete_cart = "DELETE FROM cart";
// $db->query($delete_cart);
  $delete_id = delete_to_cart('cart',(int)$d_sale['id']);
  if($delete_id){
      $session->msg("s","cart item deleted.");
      redirect('add_sale.php');
  } else {
      $session->msg("d","cart item deletion failed.");
      redirect('add_sale.php');
  }
?>
