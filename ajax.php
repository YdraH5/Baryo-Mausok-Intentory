<?php
  require_once('includes/load.php');
?>

<?php
 // Auto suggetion
    $html = '';
   if(isset($_POST['product_name']) && strlen($_POST['product_name']))
   {
    $carts = find_all_cart();
    $products = find_all_product();
    $search_product = find_product_by_title($_POST['product_name']);
     if($products){
        foreach ($search_product as $product):
           $html .= "<li class=\"list-group-item\">";
           $html .= $product['name'];
           $html .= "</li>";
         endforeach;
      } else {

        $html .= '<li onClick=\"fill(\''.addslashes(true).'\')\" class=\"list-group-item\">';
        $html .= 'Not found';
        $html .= "</li>";

      }

      echo json_encode($html);
   }
 ?>
 
 <?php
 // find all product
  if(isset($_POST['p_name']) && strlen($_POST['p_name']))
  {
    $product_title = remove_junk($db->escape($_POST['p_name']));
    if($results = find_all_product_info_by_title($product_title)){
        foreach ($results as $result) {
          $html .= "<form action='add_to_cart.php' method='post'>";

          $html .= "<tr>";
          $html .= "<td id=\"s_name\">".$result['name']."</td>";
          $html .= "<input type=\"hidden\" name=\"product_id\" value=\"{$result['id']}\">";
          $html  .= "<td>";
          $html  .= "{$result['quantity']}";
          $html  .= "</td>";
          $html .= "<td id=\"s_qty\">";
          $html .= "<input type=\"number\" class=\"form-control\" name=\"price\" value=\"{$result['sale_price']}\"style='background-color:transparent'readonly>";
          $html  .= "</td>";
          $html  .= "<td>";
          $html .= "<input type=\"number\" class=\"form-control\"placeholder=\"Enter quantity\" name=\"quantity\"style=\"background-color:transparent;border:none;\">";
          $html  .= "</td>";
          $html  .= "<td>";
          $html  .= "<button id=\"add_search\"type=\"submit\" name=\"add_to_cart\" class=\"glyphicon glyphicon-plus green\"style=\"color:green;border:none\"></button>";

          $html  .= "</td>";
          $html  .= "</tr>";
          $html  .= "</form>";


        }

    } else {
        $html ='<tr><td>product name not resgister in database</td></tr>';
    }

    echo json_encode($html);
  }
  
 ?>
