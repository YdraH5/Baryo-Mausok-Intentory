<?php
  $page_title = 'Add Sale';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   page_require_level(2);
?>
<?php
$carts = find_all_cart();
$products = join_product_table();

?>
<?php
  if(isset($_POST['add_sale'])){
      $s_qty = $_POST['purchase_quantity'];
      $p_id = $_POST['product_id'];
        $sql  = "INSERT INTO sales (";
        $sql .= " product_id,qty,price,status";
        $sql .= ") SELECT prod_id,cart_qty,cart_total,status FROM cart";
        
          if($db->query($sql)){
            $query = "UPDATE products SET quantity =quantity-(SELECT cart_qty FROM cart WHERE cart.prod_id = products.id)WHERE id=(SELECT prod_id FROM cart WHERE cart.prod_id = products.id)";
            if($db->query($query)){
              $delete_cart = "DELETE FROM cart";
              $db->query($delete_cart);
            }
            $session->msg('s',"Purchase Added. ");
            redirect('add_sale.php', false);
              } else {
                $session->msg('d',' Sorry failed to add!');
                redirect('add_sale.php', false);
              }
            } 
if(isset($_POST['cancel'])){
    $cancel = "DELETE FROM cart";
    if($db->query($cancel)){
      $session->msg('s',"Cart is clear ");
      redirect('add_sale.php', false);
    }
    }
    ?>
<?php include_once('layouts/header.php'); ?>
<div class="row">
  <div class="col-md-6">
    <?php echo display_msg($msg); ?>
    <form method="post" action="ajax.php" autocomplete="off" id="sug-form">
        <div class="form-group">
          <div class="input-group" style="border-radius: 20px; border:0 solid black;border-spacing: 0;overflow: hidden;">
            <span class="input-group-btn">
              <button type="submit" class="btn btn-primary">Find It</button>
            </span>
            <input type="text" id="sug_input" class="form-control" name="title"  placeholder="Search for product name">
         </div>
         <div id="result" class="list-group"></div>
        </div>
    </form>
  </div>
</div>
<div class="row">
  <div class="col-md-12">
    <div class="panel panel-default" id="table-container">
      <div class="panel-heading clearfix" id="label" >
        <strong>
          <span class="glyphicon glyphicon-th"></span>
          <span>POS</span>
          <div class="pull-right">
            <a href="sales.php" class="btn btn-primary">Sales Record</a>
          </div>
       </strong>
      </div>
      <div class="panel-body col-lg-8"style="overflow-x:auto;background-color:whitesmoke;">
       <table class="table table-bordered" id="tables">
         <thead>
          <th class="text-center"> Product Name </th>
          <th class="text-center"> Categories </th>
          <th class="text-center"> Available Stocks</th>
          <th class="text-center"> Price </th>
          <th class="text-center"> Quantity</th>
          <th class="text-center"> Action</th>
         </thead>
           <tbody  id="product_info">
            
           <?php foreach ($products as $product):?>
              <tr>
                <form action="add_to_cart.php"method="post">
                <input type="text"name="product_id"value="<?php echo (int)$product['id'] ?>"hidden>
                <td class="text-center">
                  <input style="border:none;background-color:transparent"type="text"name="name"value="<?php echo remove_junk($product['name']); ?>"readonly>
                </td>
                <td>
                <?php echo "{$product['categorie']}/{$product['nicotine']}";?>
                </td>
                <td class="text-center"><?php echo remove_junk($product['quantity']); ?></td>
                <td class="text-center">₱<input readonly style="border:none;background-color:transparent;display:inline;width:60px"type="number"name="price"value="<?php echo remove_junk($product['sale_price']); ?>">
                </td>
                <td class="text-center"> <input type="number" class="form-control text-center" name="quantity" placeholder="Enter quantity" style="background-color:transparent;border:none;"min="1"></td>
                <td class="text-center">
                  <button id ="add_search"type="submit" name="add_to_cart" class="glyphicon glyphicon-plus green"style="color:green;border:none">
                  </button>
                </td>
                </form>
              </tr>
             <?php endforeach; ?>
            </tbody>
           
          </table>
          
    </div>
    <div class="col-lg-4"style="overflow-x:auto;background-color:whitesmoke"><h3 class="text-center">Receipt</h3>
   <table class="table table-bordered" id="tables">
         <thead>
          <th class="text-center"> Product Name </th>
          <th class="text-center"> Price</th>
          <th class="text-center"> Quantity </th>
          <th class="text-center"> Remove </th>
         </thead>
           <tbody  id="product_info">
    <?php $total = 0; foreach ($carts as $cart):$total+=$cart['cart_total']?>
      <form action="add_sale.php"method="POST">
          <tr>
            <input type="text"name="cart_id"value="<?php echo (int)$cart['id'] ?>"hidden>
            <input type="text"name="product_id"value="<?php echo (int)$cart['prod_id'] ?>"hidden>
            <td><?php echo remove_junk($cart['name']);?></td>
            <td><input type="number"name="price"
                      value="<?php echo remove_junk($cart['cart_total']);?>"
                      style="width:50px;border:none;background-color:transparent">
            </td>
            </td>
            <td><input type="number"name="purchase_quantity"
                      value="<?php echo remove_junk($cart['cart_qty']);?>"
                      style="width:50px;border:none;background-color:transparent">
            </td>
            <td class="text-center">
            <a href="delete_cart.php?id=<?php echo (int)$cart['id'];?>" class="btn btn-danger btn-xs"onclick="return confirm('Are You Sure ?') "title="Delete" data-toggle="tooltip">
                       <span class="glyphicon glyphicon-trash"></span>
            </td>

            </tr>
      <?php endforeach; ?>
      <tr>
        <td>  TOTAL:</td>
        <td>  <?php echo $total?> </td>
        <td> <button class="btn btn-danger"type="submit" name="cancel">Cancel</button> </td>
        <td><button class="btn btn-primary "type="submit" name="add_sale">Proceed</button></td>
      </tr>
      </form>
    </div>
  </div>
  </div>
</div>

<?php include_once('layouts/footer.php'); ?>
