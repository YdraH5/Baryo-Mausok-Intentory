<?php
  $page_title = 'Edit sale';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   page_require_level(1);
?>
<?php
$restocks = find_by_id('supplier',(int)$_GET['id']);
if(!$restocks){
  $session->msg("d","Missing supplier id.");
  redirect('stocks.php');
}
?>
<?php $product = find_by_id('products',$restocks['prod_id']); ?>

<?php
   $previous_qty =  remove_junk($restocks['supplied_qty']);
  if(isset($_POST['update_stock'])){
    $req_fields = array('restock-qty','supplier-name');
    validate_fields($req_fields);
        if(empty($errors)){
          $p_id      = $db->escape((int)$product['id']);
          $s_qtys     = $db->escape($_POST['restock-qty']);
          $s_name   = $db->escape($_POST['supplier-name']);

            if( $s_qtys > $previous_qty){    
               $sql  = "UPDATE supplier SET";
               $sql .= " supplied_qty={$s_qtys},supplier_name='{$s_name}'";
               $sql .= " WHERE id ='{$restocks['id']}'";
               
               $result = $db->query($sql);
                  if( $result && $db->affected_rows() === 1){
                           $s_qty = $s_qtys - $previous_qty;
                           restock_product($s_qty,$p_id);
                           $session->msg('s',"Stock updated.");
                           redirect('stocks.php?id='.$restocks['id'], false);
                           } else {
                           $session->msg('d',' Sorry failed to updated!');
                           redirect('stocks.php', false);
                           }
               } 
               elseif( $sqtys < $previous_qty) {
                  $sql  = "UPDATE supplier SET";
                  $sql .= " supplied_qty={$s_qtys},supplier_name='{$s_name}'";
                  $sql .= " WHERE id ='{$restocks['id']}'";
                  $result = $db->query($sql);
                     if( $result && $db->affected_rows() === 1){
                              $s_qty = $previous_qty-$s_qtys;
                              update_product_qty($s_qty,$p_id);
                              $session->msg('s',"Stock updated.");
                              redirect('stocks.php?id='.$restocks['id'], false);
                              } else {
                              $session->msg('d',' Sorry failed to updated!');
                              redirect('stocks.php', false);
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
       <a href="stocks.php" class="btn btn-primary">Show restock</a>
     </div>
    </div>
    <div class="panel-body"style="overflow-x:auto;">
       <table class="table table-bordered">
         <thead>
          <th> Product Name</th>
          <th> Supplier Name </th>
          <th> Restock Quantity </th>
          <th> Action</th>
         </thead>
           <tbody  id="product_info">
              <tr>
              <form method="post" action="edit_stock.php?id=<?php echo (int)$restocks['id']; ?>">
                <td id="s_name">
                  <input type="text" class="form-control" id="sug_input" name="title" value="<?php echo remove_junk($product['name']); ?>"style="background-color:transparent;border:none"readonly>
                </td>
                <td id="s_qty">
                  <input type="text" class="form-control" name="supplier-name" value="<?php echo $restocks['supplier_name']; ?>"style="background-color:transparent">
                </td>
                <td id="s_price">
                  <input type="number" class="form-control" name="restock-qty" value="<?php echo remove_junk($restocks['supplied_qty']); ?>" style="background-color:transparent;border:none">
                </td>
                <td>
                  <button type="submit" name="update_stock" class="btn btn-primary"onclick="return confirm('Are You Sure ?') ">Update stocks</button>
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
