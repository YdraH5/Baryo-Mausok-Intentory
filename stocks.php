<?php
  $page_title = 'All Product';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   page_require_level(1);
  $restocks = join_product_table();
?>
<?php include_once('layouts/header.php'); ?>
  <div class="row">
     <div class="col-md-12">
       <?php echo display_msg($msg); ?>
     </div>
    <div class="col-md-12">
      <div class="panel panel-default" id="table-container">
        <div class="panel-heading clearfix" id="label">
        <strong>
            <span class="glyphicon glyphicon-th"></span>
            <span>Stocks Monitoring</span>
          </strong>
          <div class="pull-right">
           <a href="restocks.php" class="btn btn-primary">Restock History</a>
         </div>
        </div>
        <div class="panel-body" style="overflow-x:auto;">
          <table class="table table-bordered" id="tables">
            <thead>
              <tr>
                <th class="text-center" style="width: 20%;"> Product Name  </th>
                <th class="text-center" style="width: 15%;">Category/Nicotine  </th>
                <th class="text-center" style="width: 10%;"> Available Stocks </th>
                <th class="text-center" style="width: 10%;"> Add Stocks </th>
                <th class="text-center" style="width: 10%;"> Supplier Name </th>
                <th class="text-center" style="width: 5%;"> Actions </th>
              </tr>
            </thead>
            <tbody>
              
              <?php foreach ($restocks as $restock):?>
                <form action="add_stock.php"method="post">
              <tr>
                <input type="number"name="product-id"hidden value="<?php echo remove_junk($restock['id']); ?>">
                <td class="text-center">
                   <?php echo remove_junk($restock['name']); ?>
                </td>
                <td class="text-center"> 
                  <?php echo "{$restock['categorie']}/{$restock['nicotine']}"; ?>
                </td>
                <td class="text-center"> 
                  <?php  

                  echo check_qty($restock['quantity']); 
                  ?>
                </td>
                <td>
                  <input type="number"min="1"name="restock-quantity"style="border:none;background-color:transparent"placeholder="Enter restock quantity">
                </td>
                <td>
                  <input type="text"name="supplier-name"style="border:none;background-color:transparent"placeholder="Supplier Name">
                </td>
                <td class="text-center">
                  <div class="btn-group">
                    <button type="submit" name="add_stock" class="glyphicon glyphicon-plus green"style="color:green;border:none;">
                    </button>
                  </div>
                </td>
              </tr>
              </form>
             <?php endforeach; ?>
          
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  <?php include_once('layouts/footer.php'); ?>
