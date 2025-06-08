<?php
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(1);
?>
<?php
  $restocks = find_by_id('supplier',(int)$_GET['id']);
  if(!$restocks){
    $session->msg("d","Missing Supplier id.");
    redirect('restocks.php');
  }
?>
<?php
  $delete_id = delete_by_id('supplier',(int)$restocks['id']);
  if($delete_id){
      $session->msg("s","Restock information deleted.");
      redirect('restocks.php');
  } else {
      $session->msg("d","failed to delete re-stocks information .");
      redirect('restocks.php');
  }
?>
