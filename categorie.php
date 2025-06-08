<?php
  $page_title = 'All categories';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(1);
  
  $category_match = find_all('categories');
?>
<?php
 if(isset($_POST['add_cat'])){
   $req_field = array('categorie-name','nicotine-level');
   
   validate_fields($req_field);
   
   if(findCategoryMatch($_POST['categorie-name'],$_POST['nicotine-level']) === true ){
    $session->msg('d','<b>Sorry!</b> Entered Categorie name already in database!');
    redirect('categorie.php', false);
  }
   $cat_name = remove_junk($db->escape($_POST['categorie-name']));
   $nic_level = remove_junk($db->escape($_POST['nicotine-level']));
   if(empty($errors)){
      $sql  = "INSERT INTO categories (name,nicotine,status)";
      $sql .= " VALUES ('{$cat_name}','{$nic_level}',1";
      $sql .= ")";
      if($db->query($sql)){
        $session->msg("s", "Successfully Added New Category");
        redirect('categorie.php',false);
      } else{
        $session->msg("d", "Sorry Failed to insert.");
        redirect('categorie.php',false);
      }
   } else {
     $session->msg("d", $errors);
     redirect('categorie.php',false);
   }
 }
?>
<?php include_once('layouts/header.php'); ?>

  <div class="row">
     <div class="col-md-12">
       <?php echo display_msg($msg); ?>
     </div>
  </div>
   <div class="row">
    <div class="col-md-5">
      <div class="panel panel-default" id="table-container">
        <div class="panel-heading" id="label">
          <strong>
            <span class="glyphicon glyphicon-th"></span>
            <span>Add New Category</span>
         </strong>
        </div>
        <div class="panel-body"style="overflow-x:auto;">
          <form method="post" action="categorie.php">
            <div class="form-group">
                <input type="text" class="form-control" name="categorie-name" placeholder="Category Name" id="separate-col">
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="nicotine-level" placeholder="Nicotine Level" id="separate-col">
            </div>
            <button type="submit" name="add_cat" class="btn btn-primary">Add To Category</button>
        </form>
        </div>
      </div>
    </div>
    <div class="col-md-7">
    <div class="panel panel-default" id="table-container">
      <div class="panel-heading" id="label">
        <strong>
          <span class="glyphicon glyphicon-th"></span>
          <span>All Categories</span>
       </strong>
      </div>
        <div class="panel-body"style="overflow-x:auto;">
          <table class="table table-bordered table-striped table-hover" id="tables">
            <thead>
                <tr>
                    <th class="text-center" style="width: 50px;">#</th>
                    <th>Categories</th>
                    <th>Nicotine Level</th>
                    <th class="text-center" style="width: 100px;">Actions</th>
                </tr>
            </thead>
            <tbody>
              <?php foreach ($category_match as $cat):?>
                <tr>
                    <td class="text-center"><?php echo count_id();?></td>
                    <td><?php echo remove_junk(ucfirst($cat['name'])); ?></td>
                    <td><?php echo remove_junk(ucfirst($cat['nicotine'])); ?></td>
                    <td class="text-center">
                      <div class="btn-group">
                        <a href="edit_categorie.php?id=<?php echo (int)$cat['id'];?>"  class="btn btn-xs btn-warning" data-toggle="tooltip" title="Edit">
                          <span class="glyphicon glyphicon-edit"></span>
                        </a>
                        <a href="delete_categorie.php?id=<?php echo (int)$cat['id'];?>"  class="btn btn-xs btn-danger" data-toggle="tooltip" title="Remove"onclick="return confirm('Are You Sure ?') ">
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
  </div>
  <?php include_once('layouts/footer.php'); ?>
