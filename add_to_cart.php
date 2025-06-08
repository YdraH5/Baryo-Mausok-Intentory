<?php
  $page_title = 'Add To Cart';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   page_require_level(1);
?>
<?php 
    $products = find_all_product();
   if(isset($_POST['add_to_cart'])){
      $req_fields = array('product_id','quantity','price');
      validate_fields($req_fields);
          if(empty($errors))
          {
            $p_id      = $db->escape((int)$_POST['product_id']);
            $c_qty     = $db->escape((int)$_POST['quantity']);
            $c_total   = $db->escape((int)$_POST['price']*$c_qty);
            $stocks = find_product_by_id($p_id);
            foreach($stocks as $stock)
            if($c_qty < $stock['quantity'])
              {
                $sql  = "INSERT INTO cart (";
                $sql .= " prod_id,cart_qty,cart_total,status";
                $sql .= ") VALUES (";
                $sql .= "'{$p_id}','{$c_qty}','{$c_total}',1";
                $sql .= ")";
                  if($db->query($sql))
                  {
                    $session->msg('s',"Added to Cart.");
                    redirect('add_sale.php', true);
                  } 
                  else 
                  {
                    $session->msg('d',' Sorry failed to add!');
                    redirect('add_sale.php', false);
                  } 
            
             } 
             else{
              $session->msg('d'," We are low of stocks.");
              redirect('add_sale.php', false);
            }    
        }else{
          $session->msg("d", $errors);
          redirect('add_sale.php',false);
        }
        }
        

   
?>