
<?php
ob_start();
include '../db_cn.php';
include 'basic_html.php';
require '../uuid_gen.php';

?>

<script src="../bootstrap/js/sort.js"></script>
<style>
body.dragging, body.dragging * {
  cursor: move !important;
}

.dragged {
  position: absolute;
  opacity: 0.5;
  z-index: 2000;
}

ol.example li.placeholder {
  position: relative;
  /** More li styles **/
}
ol.example li.placeholder:before {
  position: absolute;
  /** Define arrowhead **/
}

ol.default li{

	cursor:pointer;
}

ol.vertical{

	min-height:10px;
}

ol.vertical li{

	background:#eeeeee none repeat scroll 0 0;
	border:1px solid #cccccc;
	border-radius: 5px;
	margin: 5px;
	padding: 5px;
}


</style>
<body>

<script type="text/javascript">

	
$(function  () {

	// get value from ul //





$("ol.example").sortable();


var adjustment;

$("ol.simple_with_animation").sortable({
  group: 'simple_with_animation',
  pullPlaceholder: false,
  // animation on drop
  onDrop: function  ($item, container, _super) {
    var $clonedItem = $('<li/>').css({height: 0});
    $item.before($clonedItem);
    $clonedItem.animate({'height': $item.height()});

    $item.animate($clonedItem.position(), function  () {
      $clonedItem.detach();
      _super($item, container);
    });

    /////////////////////////////////////////////////////////
    var newNums = [];
    var nums = document.getElementById("recommend_list");

	   var listItem = nums.getElementsByTagName("li");





   	//document.getElementById("hidden_list").value = listItem.length; 

   	
     	for (var i=0; i < listItem.length; i++) 
      {
         
          var num = listItem[i].id;
      
          newNums.push( num );
    
      }

   	document.getElementById("hidden_list").value = newNums; 
    document.getElementById('submit_recommend').disabled=false;
  },

  // set $item relative to cursor position
  onDragStart: function ($item, container, _super) {
    var offset = $item.offset(),
        pointer = container.rootGroup.pointer;

    adjustment = {
      left: pointer.left - offset.left,
      top: pointer.top - offset.top
    };

    _super($item, container);
  },
  onDrag: function ($item, position) {
    $item.css({
      left: position.left - adjustment.left,
      top: position.top - adjustment.top
    });
  }

  
});
















});
</script>
<?php
///////////////search products which are not include recommend list /////////////////////////////////
$recommend_query_left = "SELECT pro_name,pro_img,pro_o_price,pro_code from product_info where pro_recommend = '0'";
$recommend_query_left = mysqli_query($db_connect,$recommend_query_left);
          //$recommend_query = mysqli_fetch_assoc($recommend_query);

$recommend_query_right = "SELECT pro_name,pro_img,pro_o_price,pro_code from product_info where pro_recommend != '0' order by pro_recommend";
$recommend_query_right = mysqli_query($db_connect,$recommend_query_right);

?>



<div class='col-lg-12' style='text-align:center'><p><h3>拖拽左侧产品到右侧推荐产品栏</h3></p></div>
<div class='row'>
<form method = 'POST' action='product_recommend.php' >

	<div class = 'col-lg-4' style='height:100%;overflow-y:scroll;'>

            <div id='re_resource' class='span4 panel panel-primary'>
              <ol class='simple_with_animation vertical'>
               <?php

               foreach ($recommend_query_left as $one_product_left) {
               	echo "<li id='$one_product_left[pro_code]' name='$one_product_left[pro_code]'>";
               	echo" <img src='../$one_product_left[pro_img]' height=100 width=100>";

               	echo "<div class='btn'>".$one_product_left['pro_name']."</div>";
               	echo "<input name = 'pro_code' type= hidden value = '$one_product_left[pro_code]'/>";
               	echo "</li>";
               	# code...
               }
               ?>
              </ol>
            </div>
  </div>
  <div class = 'col-lg-4' >

            <input class='btn btn-danger' id = 'submit_recommend' type=submit value='提交修改' disabled>


            <div class='span4 panel panel-info'>
            <p>拖拽到此以添加推荐</p>
  
              <ol id = 'recommend_list' class='simple_with_animation vertical'>
               <?php

               foreach ($recommend_query_right as $one_product_right) {
                echo "<li id='$one_product_right[pro_code]' name='$one_product_right[pro_code]'>";
                echo" <img src='../$one_product_right[pro_img]' height=100 width=100>";

                echo "<div class='btn'>".$one_product_right['pro_name']."</div>";
                echo "<input name = 'pro_code' type= hidden value = '$one_product_right[pro_code]'/>";
                echo "</li>";
                # code...
               }
               ?>

               
          
              </ol>
              <input id = 'hidden_list' name='hidden_list' type='hidden' value=''/>
             
            </div>
      </div>
</div>
	
            
             
	

	</div>
	
</form>

<?php

function update_recommed(){
  global $db_connect;

	if (isset($_POST['pro_code'])){


		
		
		$product_array = $_POST['hidden_list'];
		$product_array = explode(",", $product_array);

    $reset_recommed = "UPDATE product_info SET pro_recommend = '0'";
    $reset_recommed = mysqli_query($db_connect,$reset_recommed);


		foreach ($product_array as $key => $one_product) {

			if($one_product != ''){

       // echo "|".$key."|".$one_product."<br/>";



        $update_recommed = "UPDATE product_info SET pro_recommend = '$key' WHERE pro_code = '$one_product'";
        $update_recommed = mysqli_query($db_connect,$update_recommed);

    

      }
      header("Location: product_recommend.php");
		}
	}



}
update_recommed();

?>

<?php 
ob_end_flush();
?>