<?php
include 'nav_menu_banner.php';
include 'promotion_function.php';
?>
    <!--nav end -->
   
      <div class="col-md-9 col-lg-9 panel panel-danger product_list" >
     
<?php
     $search_result = $_POST['search'];

     if ((isset($search_result)) and ($search_result != ""))
     {

     $query_search  = "SELECT pro_name,pro_img,pro_o_price,pro_code,promotion_enabled,promotion_id from product_info where pro_name like '%$search_result%' or pro_keyword like '%$search_result%'";
     $query_search = mysqli_query($db_connect,$query_search);

     $search_count = mysqli_num_rows($query_search);

     if ($search_count == '0')
     {

      echo "<div class='panel panel-danger'>未搜到相应商品</div>";
     }

     else
     {
      show_product($query_search);
    }

    }
    else
    {

      echo "<div class='panel panel-danger'>未搜到相应商品</div>";

    }
   
     

    
 ?>     
    </div>
    
 </div>


</div>
<!--inventory row end-->
  
</div>

</body>
</html>