<?php
  $page_title = 'All sale';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   page_require_level(1);
?>
<?php
$sales = find_all_sale();
?>
<?php include_once('layouts/header.php'); ?>
<div class="row">
  <div class="col-md-6">
    <?php echo display_msg($msg); ?>
  </div>
</div>
  <div class="row">
    <div class="col-md-12">
      <div class="panel panel-default" id="table-container">
        <div class="panel-heading clearfix" id="label">
          <strong>
            <span class="glyphicon glyphicon-th"></span>
            <span>Sales History</span>
          </strong>
          <div class="pull-right">
            <a href="add_sale.php" class="btn btn-primary"style="border-radius:12px">New Sales</a>
          </div>
        </div>
        <div class="panel-body" style="overflow-x:auto;">
          <table class="table table-bordered table-striped" id="tables">
            <thead>
              <tr>
                <th class="text-center"style="width: 20%;">Product name </th>
                <th class="text-center"style="width: 20%;"> Categorie/Nicotine </th>
                <th class="text-center" style="width: 15%;"> Quantity</th>
                <th class="text-center" style="width: 15%;"> Total </th>
                <th class="text-center" style="width: 15%;"> Date </th>
                <th class="text-center" style="width: 5%"> Actions </th>
             </tr>
            </thead>
           <tbody>
             <?php foreach ($sales as $sale):?>
             <tr>
               <td class="text-center"><?php echo remove_junk($sale['name']); ?></td>
               <td class="text-center"><?php echo "{$sale['categorie']}/{$sale['nicotine']}";?></td>
               <td class="text-center"><?php echo (int)$sale['qty']; ?></td>
               <td class="text-center">₱<?php echo remove_junk($sale['price']); ?></td>
               <td class="text-center"><?php echo read_date($sale['date']); ?></td>
               <td class="text-center">
                  <div class="btn-group">
                     <a href="edit_sale.php?id=<?php echo (int)$sale['id'];?>" class="btn btn-warning btn-xs"  title="Edit" data-toggle="tooltip">
                       <span class="glyphicon glyphicon-edit"></span>
                     </a>
                     <a href="delete_sale.php?id=<?php echo (int)$sale['id'];?>" class="btn btn-danger btn-xs"onclick="return confirm('Are You Sure ?') "title="Delete" data-toggle="tooltip">
                       <span class="glyphicon glyphicon-trash"></span>
                     </a>
                  </div>
               </td>
             </tr>
             <?php endforeach;?>
           </tbody>
         </table>
        </div>
      </div>
    </div>
  </div>
<?php include_once('layouts/footer.php'); ?>
