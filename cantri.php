<?php
include 'nav_menu_banner.php';
include 'list_all.php';
?>
    <!--nav end -->
   
      <div class="col-md-9 col-lg-9 panel product_list" >
      <br/>

     <?php

     $query_cate_all = "SELECT id,menu_cate_name from menu_category";
     $query_cate_all = mysqli_query($db_connect,$query_cate_all);
     foreach ($query_cate_all as $key => $value) {



     	echo "<div class='panel  panel-default'>";
     		/////////panel title ////////
	     	echo "<div class='panel-heading'>".$value['menu_cate_name']."</div>";

	     	///////panel title end ///////



	     	$current_sub_cate = $value['id'];
	     	$sub_cate_query = "SELECT id,upper_cate from pro_category where upper_cate = '$current_sub_cate'";


	     	$sub_cate_query = mysqli_query($db_connect,$sub_cate_query);
	     	echo "<div class='panel-body'>";
	     	foreach ($sub_cate_query as $sub_key => $sub_value) {
	     		$current_pro = $sub_value['id'];

	     		$query_all_pro  = "SELECT pro_name,pro_img,pro_o_price,pro_code,promotion_enabled,promotion_id from product_info where pro_onsell='1' and pro_category='$current_pro' ";
	     		$all_products = mysqli_query($db_connect,$query_all_pro);
	     
	     		
	     		show_product($all_products);
	     		
	     		# code...
	     	}
			echo "</div>";	
	     	
     echo "</div>";	
     	
     }

     //$query_all_pro  = "SELECT pro_name,pro_img,pro_o_price,pro_code,promotion_enabled,promotion_id from product_info where pro_onsell='1' ";
     //$all_products = mysqli_query($db_connect,$query_all_pro);
     

     //show_product($all_products);

     

     ?>
    
      
    </div>
    
 </div>


</div>
<!--inventory row end-->
  
</div>

</body>
</html>