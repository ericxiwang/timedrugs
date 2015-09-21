
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
$recommend_query = "SELECT pro_name,pro_img,pro_o_price,pro_code from product_info";
          $recommend_query = mysqli_query($db_connect,$recommend_query);
          //$recommend_query = mysqli_fetch_assoc($recommend_query);

?>



<div class='col-lg-12' style='text-align:center'><p><h3>拖拽左侧产品到右侧推荐产品栏</h3></p></div>
<div class='row'>
<form method = 'POST' action='product_recommend.php' >

	<div class = 'col-lg-4' >

            <div class='span4 panel panel-primary'>
              <ol class='simple_with_animation vertical'>
               <?php

               foreach ($recommend_query as $one_product) {
               	echo "<li name='$one_product[pro_code]' >";
               	echo" <img src='../$one_product[pro_img]' height=100 width=100>";

               	echo "<div class='btn'>".$one_product['pro_name']."</div>";
               	echo "<input name = 'pro_code' type= hidden value = '$one_product[pro_code]'/>";
               	echo "</li>";
               	# code...
               }
               ?>
              </ol>
            </div>
            </div>
          <div class = 'col-lg-4' >




            <div class='span4 panel panel-info'>
            <p>拖拽到此以添加推荐</p>
  
              <ol class='simple_with_animation vertical'>

               
          
              </ol>
            </div>
          </div>
        </div>
	
            
             
	

	</div>
	<input class='btn btn-success' type=submit value=ok>
</form>

<?php

function update_recommed(){

	if (isset($_POST['pro_code'])){


		echo "AAAAA";
	}



}


?>

<?php 
ob_end_flush();
?>