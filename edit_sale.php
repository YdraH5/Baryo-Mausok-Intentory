<?php
  $page_title = 'Edit sale';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   page_require_level(1);
?>
<?php
$sale = find_by_id('sales',(int)$_GET['id']);
if(!$sale){
  $session->msg("d","Missing product id.");
  redirect('sales.php');
}
?>
<?php $product = find_by_id('products',$sale['product_id']); 
      $previous_qty = find_by_id('sales',$sale['product_id']); 
?>
<?php

  // if(isset($_POST['update_sale'])){
  //   $req_fields = array('title','quantity','price','total' );
  //   validate_fields($req_fields);
  //       if(empty($errors)){
  //         $p_id      = $db->escape((int)$product['id']);
  //         $s_qty     = $db->escape((int)$_POST['quantity']);
  //         $s_total   = $db->escape($_POST['total']);

  //         $sql  = "UPDATE sales SET";
  //         $sql .= " product_id= '{$p_id}',qty={$s_qty},price='{$s_total}'";
  //         $sql .= " WHERE id ='{$sale['id']}'";
  //         $result = $db->query($sql);
  //         if( $result && $db->affected_rows() === 1){
  //                   update_product_qty($s_qty,$p_id);
  //                   $session->msg('s',"Sale updated.");
  //                   redirect('edit_sale.php?id='.$sale['id'], false);
  //                 } else {
  //                   $session->msg('d',' Sorry failed to updated!');
  //                   redirect('sales.php', false);
  //                 }
  //       } 
  //       else {
  //          $session->msg("d", $errors);
  //          redirect('edit_sale.php?id='.(int)$sale['id'],false);
  //       }
  // }
  $previous_qty =  remove_junk($sale['qty']);
  if(isset($_POST['update_sale'])){
    $req_fields = array('title','quantity','price','total' );
        validate_fields($req_fields);
        if(empty($errors)){
          $p_id      = $db->escape((int)$product['id']);
          $s_qtys    = $db->escape((int)$_POST['quantity']);
          $s_total   = $db->escape($_POST['total']);

            if( $s_qtys < $previous_qty){    
              $sql  = "UPDATE sales SET";
              $sql .= " product_id= '{$p_id}',qty={$s_qtys},price='{$s_total}'";
              $sql .= " WHERE id ='{$sale['id']}'";
               
              $result = $db->query($sql);
              if( $result && $db->affected_rows() === 1){
                       $s_qty = $s_qtys - $previous_qty;
                       update_product_qty($s_qty,$p_id);
                       $session->msg('s',"Sales updated.");
                       redirect('sales.php?id='.$sale['id'], false);
                       } else {
                       $session->msg('d',' Sorry failed to update!');
                       redirect('sales.php', false);
                       }
           } 
               elseif( $s_qtys > $previous_qty) {
                $sql  = "UPDATE sales SET";
                $sql .= " product_id= '{$p_id}',qty={$s_qtys},price='{$s_total}'";
                $sql .= " WHERE id ='{$sale['id']}'";
                  $result = $db->query($sql);
                     if( $result && $db->affected_rows() === 1){
                              $s_qty = $s_qtys-$previous_qty;
                              update_product_qty($s_qty,$p_id);
                              $session->msg('s',"Sales updatedd.");
                              redirect('sales.php?id='.$sale['id'], false);
                              } else {
                              $session->msg('d',' Sorry failed to update!');
                              redirect('sales.php', false);
                              }
               }
            }else {
               $session->msg("d", $errors);
               redirect('edit_stock.php?id='.(int)$sale['id'],false);
            }
           
         }
?>
<?php include_once('layouts/header.php'); ?>
<div class="row">
  <div class="col-md-6">
    <?php echo display_msg($msg); ?>
  </div>
</div>
<div class="row">

  <div class="col-md-12">
  <div class="panel">
    <div class="panel-heading clearfix">
      <strong>
        <span class="glyphicon glyphicon-th"></span>
        <span>All Sales</span>
     </strong>
     <div class="pull-right">
       <a href="sales.php" class="btn btn-primary">Show all sales</a>
     </div>
    </div>
    <div class="panel-body"style="overflow-x:auto;">
       <table class="table table-bordered">
         <thead>
          <th> Product title </th>
          <th> Qty </th>
          <th> Price </th>
          <th> Total </th>
          <th> Action</th>
         </thead>
           <tbody  id="product_info">
              <tr>
              <form method="post" action="edit_sale.php?id=<?php echo (int)$sale['id']; ?>">
                <td id="s_name">
                  <input type="text" class="form-control" id="sug_input" name="title" value="<?php echo remove_junk($product['name']); ?>"style="background-color:transparent;border:none"readonly>
                </td>
                <td id="s_qty">
                  <input type="text" class="form-control" name="quantity" value="<?php echo (int)$sale['qty']; ?>"style="background-color:transparent">
                </td>
                <td id="s_price">
                  <input type="text" class="form-control" name="price" value="<?php echo remove_junk($product['sale_price']); ?>"readonly style="background-color:transparent;border:none">
                </td>
                <td>
                  <input type="text" class="form-control" name="total" value="<?php echo remove_junk($sale['price']); ?>"readonly style="background-color:transparent;border:none">
                </td>
                <td>
                  <button type="submit" name="update_sale" class="btn btn-primary"onclick="return confirm('Are You Sure ?') ">Update sale</button>
                </td>
              </form>
              </tr>
           </tbody>
       </table>

    </div>
  </div>
  </div>

</div>

<?php include_once('layouts/footer.php'); ?>
