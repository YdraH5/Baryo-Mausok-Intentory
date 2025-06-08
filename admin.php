<?php
  $page_title = 'Admin Home Page';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   page_require_level(1);
?>
<?php
 $c_categorie     = count_by_id('categories');
 $c_product       = count_by_id('products');
 $c_sale          = count_by_id('sales');
 $c_user          = count_by_id('users');
 $products_sold   = find_higest_selling_product('10');
 $low_stocks = find_low_stock_product('20');
 $recent_sales    = find_recent_sale_added('5')
?>
<?php include_once('layouts/header.php'); ?>

<div class="row">
   <div class="col-md-6">
     <?php echo display_msg($msg); ?>
   </div>
</div>
  <div class="row">
    <a href="users.php" style="color:black;" id="table-container">
		<div class="col-md-3">
       <div class="panel panel-box clearfix">
         <div class="panel-icon pull-left bg-secondary1">
          <i class="glyphicon glyphicon-user"></i>
        </div>
        <div class="panel-value pull-right">
          <h2 class="margin-top"> <?php  echo $c_user['total']; ?> </h2>
          <p class="text-muted"style="font-weight:bold">Users</p>
        </div>
       </div>
    </div>
	</a>
	
	<a href="categorie.php" style="color:black;" id="table-container">
    <div class="col-md-3">
       <div class="panel panel-box clearfix">
         <div class="panel-icon pull-left bg-red">
          <i class="glyphicon glyphicon-th-large"></i>
        </div>
        <div class="panel-value pull-right">
          <h2 class="margin-top"> <?php  echo $c_categorie['total']; ?> </h2>
          <p class="text-muted">Categories</p>
        </div>
       </div>
    </div>
	</a>
	
	<a href="product.php" style="color:black;" id="table-container">
    <div class="col-md-3">
       <div class="panel panel-box clearfix">
         <div class="panel-icon pull-left bg-blue2">
          <i class="glyphicon glyphicon-shopping-cart"></i>
        </div>
        <div class="panel-value pull-right">
          <h2 class="margin-top"> <?php  echo $c_product['total']; ?> </h2>
          <p class="text-muted">Products</p>
        </div>
       </div>
    </div>
	</a>
	
	<a href="sales.php" style="color:black;" id="table-container">
    <div class="col-md-3">
       <div class="panel panel-box clearfix">
         <div class="panel-icon pull-left bg-green">
          <i class="glyphicon glyphicon-usd"></i>
        </div>
        <div class="panel-value pull-right">
          <h2 class="margin-top"> <?php  echo $c_sale['total']; ?></h2>
          <p class="text-muted">Sales</p>
        </div>
       </div>
    </div>
	</a>
</div>
  
  <div class="row">
   <div class="col-md-4">
     <div class="panel panel-default" id="table-container">
       <div class="panel-heading" id="label">
         <strong>
           <span class="glyphicon glyphicon-th"></span>
           <span>Best Seller</span>
         </strong>
       </div>
       <div class="panel-body"style="overflow-x:auto;">
         <table class="table table-striped table-bordered table-condensed" id="tables">
          <thead>
           <tr>
             <th>Product Name</th>
             <th>Transaction Count</th>
             <th>Items Sold</th>
           <tr>
          </thead>
          <tbody>
            <?php foreach ($products_sold as  $product_sold): ?>
              <tr>
                <td><?php echo remove_junk(first_character($product_sold['name'])); ?></td>
                <td><?php echo (int)$product_sold['totalSold']; ?></td>
                <td><?php echo (int)$product_sold['totalQty']; ?></td>
              </tr>
            <?php endforeach; ?>
          <tbody>
         </table>
       </div>
     </div>
   </div>
   <div class="col-md-4">
      <div class="panel panel-default" id="table-container">
        <div class="panel-heading" id="label">
          <strong>
            <span class="glyphicon glyphicon-th"></span>
            <span>LATEST SALES</span>
          </strong>
        </div>
        <div class="panel-body"style="overflow-x:auto;">
          <table class="table table-striped table-bordered table-condensed" id="tables">
            <thead>
              <tr>
                <th class="text-center" style="width: 10%;">#</th>
                <th>Product Name</th>
                <th>Date</th>
                <th>Total Sale</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($recent_sales as  $recent_sale): ?>
              <tr>
                <td class="text-center"><?php echo count_id();?></td>
                <td>
                
                    <?php echo remove_junk(first_character($recent_sale['name'])); ?>
                  
                </td>
                <td><?php echo read_date(ucfirst($recent_sale['date'])); ?></td>
                <td>₱<?php echo remove_junk(first_character($recent_sale['price'])); ?></td>
              </tr>
            <?php endforeach; ?>
          </tbody>
     </table>
    </div>
   </div>
  </div>
  
 <div class="col-md-4">
      <div class="panel panel-default" id="table-container">
        <div class="panel-heading" id="label">
          <strong>
            <span class="glyphicon glyphicon-th"></span>
            <span>Low Stocks</span>
          </strong>
        </div>
        <div class="panel-body"style="overflow-x:auto;">
          <table class="table table-striped table-bordered table-condensed" id="tables">
            <thead>
              <tr>
                <th>Product Name</th>
                <th>Categories</th>
                <th>Available Stocks</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($low_stocks as  $low_stock): ?>
              <tr>
                <td class="text-center"><?php echo remove_junk($low_stock['name']);?></td>
                <td class="text-center"><?php echo remove_junk($low_stock['category']);echo "/".remove_junk($low_stock['nicotine']) ?></td>
                <td class="text-center"><?php echo check_qty($low_stock['quantity']); ?>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
     </table>
    </div>
   </div>
  </div>
</div>
 </div>
  <div class="row">

  </div>



<?php include_once('layouts/footer.php'); ?>
