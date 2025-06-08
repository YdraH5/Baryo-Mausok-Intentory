<?php
  $page_title = 'All Product';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   page_require_level(1);
  $restocks = join_restock_table();
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
            <span>Restock History</span>
          </strong>
         <div class="pull-right">
           <a href="stocks.php" class="btn btn-primary">Stocks</a>
         </div>
        </div>
        <div class="panel-body" style="overflow-x:auto;">
          <table class="table table-bordered" id="tables">
            <thead>
              <tr>
                <th class="text-center" style="width: 20%;"> Product Name  </th>
                <th class="text-center" style="width: 15%;">Category/Nicotine  </th>
                <th class="text-center" style="width: 20%;"> Supplier Name </th>
                <th class="text-center" style="width: 10%;"> Updated Stocks </th>
                <th class="text-center" style="width: 10%;"> Stocks Added </th>
                <th class="text-center" style="width: 20%;"> Re-stock date </th>
                <th class="text-center" style="width: 5%;"> Actions </th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($restocks as $restock):?>
              <tr>
                <td class="text-center"> <?php echo remove_junk($restock['name']); ?></td>
                <td class="text-center"> <?php echo "{$restock['categ_name']}/{$restock['nicotine']}"; ?></td>
                <td class="text-center"> <?php echo remove_junk($restock['supplier_name']); ?></td>
                <td class="text-center"> <?php echo remove_junk($restock['quantity']); ?></td>
                <td class="text-center"> <?php echo remove_junk($restock['supplied_qty']); ?></td>
                <td class="text-center"> <?php echo read_date($restock['supplied_date']); ?></td>
                <td class="text-center">
                  <div class="btn-group">
                    <a href="edit_stock.php?id=<?php echo (int)$restock['id'];?>" class="btn btn-warning btn-xs"  title="Edit" data-toggle="tooltip">
                      <span class="glyphicon glyphicon-edit"></span>
                    </a>
                    <a href="delete_stock.php?id=<?php echo (int)$restock['id'];?>" class="btn btn-danger btn-xs"  title="Delete" data-toggle="tooltip"onclick="return confirm('Are You Sure ?')">
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
