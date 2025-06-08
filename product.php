<?php
  $page_title = 'All Product';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   page_require_level(2);
  $products = join_product_table();
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
            <span>Products Monitor</span>
          </strong>
         <div class="pull-right">
           <a href="add_product.php" class="btn btn-primary">Add New</a>
         </div>
        </div>
        <div class="panel-body" style="overflow-x:auto;">
          <table class="table table-bordered" id="tables">
            <thead>
              <tr>
                <th class="text-center" style="width: 5%;">#</th>
                <th class="text-center" style="width: 15%"> Product Name  </th>
                <th class="text-center" style="width: 15%;"> Categories </th>
                <th class="text-center" style="width: 10%;"> Nicotine </th>
                <th class="text-center" style="width: 10%;"> Supplier Price </th>
                <th class="text-center" style="width: 10%;"> Selling Price </th>
                <th class="text-center" style="width: 10%;"> Date Added </th>
                <th class="text-center" style="width: 10%;"> Actions </th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($products as $product):?>
              <tr>
                <td class="text-center"><?php echo count_id();?></td>
                <td class="text-center"> <?php echo remove_junk($product['name']); ?></td>
                <td class="text-center"> <?php echo remove_junk($product['categorie']); ?></td>
                <td class="text-center"> <?php echo remove_junk($product['nicotine']); ?></td>
                <td class="text-center"> ₱<?php echo remove_junk($product['buy_price']); ?></td>
                <td class="text-center"> ₱<?php echo remove_junk($product['sale_price']); ?></td>
                <td class="text-center"> <?php echo read_date($product['date']); ?></td>
                <td class="text-center">
                  <div class="btn-group">
                    <a href="edit_product.php?id=<?php echo (int)$product['id'];?>" class="btn btn-warning btn-xs"  title="Edit" data-toggle="tooltip">
                      <span class="glyphicon glyphicon-edit"></span>
                    </a>
                    <a href="delete_product.php?id=<?php echo (int)$product['id'];?>" class="btn btn-danger btn-xs"  title="Delete" data-toggle="tooltip"onclick="return confirm('Are You Sure ?')">
                      <span class="glyphicon glyphicon-trash"></span>
                    </a>
                  </div>
                </td>
              </tr>
             <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  <?php include_once('layouts/footer.php'); ?>
