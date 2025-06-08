<?php
  $page_title = 'Add Stock';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(1);
  $products = find_all_product();
?>
<?php
 if(isset($_POST['add_stock'])){

   $req_fields = array('product-id','supplier-name','restock-quantity');
   validate_fields($req_fields);
   if(empty($errors)){
     $p_id  = remove_junk($db->escape($_POST['product-id']));
     $s_name = remove_junk($db->escape($_POST['supplier-name']));
     $s_qty   = remove_junk($db->escape($_POST['restock-quantity']));
     $query  = "INSERT INTO supplier (";
     $query .=" prod_id,supplier_name,supplied_qty,status";
     $query .=") VALUES (";
     $query .=" '{$p_id}','{$s_name}','{$s_qty}',1";
     $query .=")";
     if($db->query($query)){
      restock_product($s_qty,$p_id);
      $session->msg('s',"Stock Added. ");
      redirect('stocks.php', false);
        } else {
          $session->msg('d',' Sorry failed to add stock!');
          redirect('stocks.php', false);
        }
      } else{
        $session->msg("d", $errors);
        redirect('stocks.php',false);
      }

 }

?>
