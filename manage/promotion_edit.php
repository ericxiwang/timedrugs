
<?php
ob_start();
include '../db_cn.php';
include 'basic_html.php';
require '../uuid_gen.php';

?>
<script>
        $(function(){
            var t = $("#pro_buy");
            var f = $("#pro_get");
            var g = $("#pro_discount");


            $("#add1").click(function(){       
                t.val(parseInt(t.val())+1)
                setTotal();
            })

            $("#add2").click(function(){       
                f.val(parseInt(f.val())+1)
                setTotal();
            })


            $("#add3").click(function(){   
            	if (g.val() < 100)  {
                g.val(parseInt(g.val())+1)
                setTotal();}
            })










            $("#min1").click(function(){

                if (t.val() > 1)
                {
                t.val(parseInt(t.val())-1)
                setTotal();}
            })

            $("#min2").click(function(){

                if (f.val() > 1)
                {
                f.val(parseInt(f.val())-1)
                setTotal();}
            })

            $("#min3").click(function(){

                if (g.val() > 1)
                {
                g.val(parseInt(g.val())-1)
                setTotal();}
            })





            function setTotal(){
                $("#total").html((parseInt(t.val())*3.95).toFixed(2));
            }
            setTotal();










        })
</script>

<div class='container-flud'>
<div class='row'>
<div class = 'col-lg-6'>

<?php
function promotion_list($category){
echo "<form action='promotion_edit.php' method = 'POST'>";
echo "<h3>优惠活动浏览表</h3>";
/////load promotion list ////
global $db_connect;
$promotion_list = "SELECT promotion_id,discount_value,pro_buy,pro_get,pro_type,dis_endless,dis_enabled,pro_price from pro_discount where pro_type = '$category' order by id desc";
$promotion_list = mysqli_query($db_connect,$promotion_list);
echo "<table class='table table-hover'>";
echo "<thead><th>促销类型</th><th>促销内容</th><th>永久有效</th><th>促销上线</th><th></th></thead>";
foreach ($promotion_list as $one_promotion) {
	echo "<tr>";

	switch ($one_promotion['pro_type']){
		case 1:
		echo "<td>百分比</td>";
		echo "<td>原价: ".$one_promotion['discount_value']."%</td>";
		if ($one_promotion['dis_endless'] == '1'){
			echo "<td><input class='checkbox' type='checkbox' checked disabled></td>";
		}
		elseif ($one_promotion['dis_endless'] == '0'){
			echo "<td><input class='checkbox' type='checkbox' disabled></td>";
		}


		if ($one_promotion['dis_enabled'] == '1'){
			echo "<td><input class='checkbox' type='checkbox' checked disabled></td>";
		}
		elseif ($one_promotion['dis_enabled'] == '0'){
			echo "<td><input class='checkbox' type='checkbox' disabled></td>";
		}

		break;

		case 2:
		echo "<td>商品买赠</td>";
		echo "<td>买 ".$one_promotion['pro_buy']." 送 ".$one_promotion['pro_get']."</td>";
		if ($one_promotion['dis_endless'] == '1'){
			echo "<td><input class='checkbox' type='checkbox' checked disabled></td>";
		}
		elseif ($one_promotion['dis_endless'] == '0'){
			echo "<td><input class='checkbox' type='checkbox' disabled></td>";
		}

		if ($one_promotion['dis_enabled'] == '1'){
			echo "<td><input class='checkbox' type='checkbox' checked disabled></td>";
		}
		elseif ($one_promotion['dis_enabled'] == '0'){
			echo "<td><input class='checkbox' type='checkbox' disabled></td>";
		}


		break;
		case 3:
		echo "<td>商品特价</td>";
		echo "<td>特价金额: $".$one_promotion['pro_price']."</td>";
		if ($one_promotion['dis_endless'] == '1'){
			echo "<td><input class='checkbox' type='checkbox' checked disabled></td>";
		}
		elseif ($one_promotion['dis_endless'] == '0'){
			echo "<td><input class='checkbox' type='checkbox' disabled></td>";
		}

		if ($one_promotion['dis_enabled'] == '1'){
			echo "<td><input class='checkbox' type='checkbox' checked disabled></td>";
		}
		elseif ($one_promotion['dis_enabled'] == '0'){
			echo "<td><input class='checkbox' type='checkbox' disabled></td>";
		}
		break;

		case 4:
		echo "<td>批发免邮费</td>";
		echo "<td>该商品不计邮费</td>";
		if ($one_promotion['dis_endless'] == '1'){
			echo "<td><input class='checkbox' type='checkbox' checked disabled></td>";
		}
		elseif ($one_promotion['dis_endless'] == '0'){
			echo "<td><input class='checkbox' type='checkbox' disabled></td>";
		}

		if ($one_promotion['dis_enabled'] == '1'){
			echo "<td><input class='checkbox' type='checkbox' checked disabled></td>";
		}
		elseif ($one_promotion['dis_enabled'] == '0'){
			echo "<td><input class='checkbox' type='checkbox' disabled></td>";
		}
		break;
	}
	echo "<td><button class='btn btn-danger' name='promotion_edit' type='submit' value='$one_promotion[promotion_id]'/>编辑</button></td>";
	echo "</tr>";
}

echo "</table>";

}

?>
<h3>促销分类显示列表</h3>
<form action='promotion_edit.php' method= "POST">
<ul class="nav nav-tabs tab-primary">
    <li class="active"><a data-toggle="tab" href="#discount">折扣促销列表</a></li>
    <li><a data-toggle="tab" href="#buyget">买赠促销列表</a></li>
    <li><a data-toggle="tab" href="#shippingfree">批发包邮列表</a></li>

  </ul>

<div class="tab-content" style='padding:10px;'>

    <div id="discount" class="tab-pane fade in active">
      <h3>优惠按照原价的百分比</h3>
      <?php promotion_list(1);?>

    </div>


    <div id="buyget" class="tab-pane fade">
	   

	      <h3>买赠优惠</h3>
	      <?php promotion_list(2);?>
</div>



    <div id="shippingfree" class="tab-pane fade">
      <h3>商品免除邮费</h3>
      <?php promotion_list(4);?>
      
 
  	</div>

</div>
</form>
</div>


<div class = 'col-lg-6'>
<?php
function promotion_edit(){
echo "<form action='promotion_edit.php' method = 'POST'>";
	global $db_connect;


	$promotion_id = $_POST['promotion_edit'];
	//echo $promotion_id;
	$promotion_query = "SELECT * from pro_discount where promotion_id = '$promotion_id'";
	$promotion_query = mysqli_query($db_connect,$promotion_query);
	$promotion_query = mysqli_fetch_assoc($promotion_query);
	switch ($promotion_query['pro_type']){
		case 1:
			echo "<h2>折扣优惠编辑</h2>
     

      	<button class='btn btn-danger btn-xs' id='min3'  name='' type='button' value='-' />-</button>

      	<input   id='pro_discount' name='pro_discount' type='text' value='$promotion_query[discount_value]' size='3' readonly/>%
 
      	<button class='btn btn-danger btn-xs' id='add3' name='' type='button' value='+' />+</button> 
      	<input type='hidden' name = 'promotion_id' value = '$promotion_id'>

      	";

      	



			break;
		case 2:
			echo "<h2>买赠优惠编辑</h2>";
			echo" <h3> 
		      买 
		      
		      <button class='btn btn-danger btn-xs' id='min1'  name='' type='button' value='-' />-</button>

		      <input   id='pro_buy' name='pro_buy' type='text' value='1' size='3' readonly/>
		 
		      <button class='btn btn-danger btn-xs' id='add1' name='' type='button' value='+' />+</button> 
		       
		      赠 

		      <button class='btn btn-danger btn-xs' id='min2'  name='' type='button' value='-' />-</button>
		     
		      <input id='pro_get'  name='pro_get' type='text' value='1' size='3' readonly/>
		      
		      <button class='btn btn-danger btn-xs' id='add2' name='' type='button' value='+' />+</button> 
		      </h3>
		      <input type='hidden' name = 'promotion_id' value = '$promotion_id'>
		      ";









			break;
		case 4:
			echo "免除运费";
			echo "<input name='free_shipping' type = hidden>
			<input type='hidden' name = 'promotion_id' value = '$promotion_id'>
			";
			break;


	}


	if ($promotion_query['dis_endless'] == 1)
		{

      		echo "<br/><input type='checkbox' value='1' name ='pro_endless' checked>永久有效";
      	}
      	else
      	{
      		echo "<br/><input type='checkbox' value='1' name ='pro_endless'>永久有效";
      	}

      	if ($promotion_query['dis_enabled'] == 1)
      	{
      		echo "<br/><input type='checkbox' value='1' name ='pro_enabled' checked>优惠上线";

      	}
      	else
      	{

      		echo "<br/><input type='checkbox' value='1' name ='pro_enabled'>优惠上线";
      	}
      	
    	

    	echo "<br/><button class='btn btn-success' name='pro_submit' type='submit' value='pro_edit' />修改促销选项</button> ";
    	echo "<button class='btn btn-danger' name='pro_submit' type='submit' value='pro_delete' />删除促销选项</button> ";

		echo "</form>";
}

function edit_to_db(){
	global $db_connect;
	if (isset($_POST['pro_submit'])){
		if ($_POST['pro_submit'] == 'pro_edit')
		{

			if (isset($_POST['pro_endless'])){
				$pro_endless = 1;
			}
			else{
				$pro_endless = 0;
			}
			if (isset($_POST['pro_enabled'])){
				$pro_enabled = 1;
			}
			else{
				$pro_enabled = 0;
			}
			$promotion_id   	= $_POST['promotion_id'];

			if(isset($_POST['pro_discount']))
			{
				
				$new_discount		= $_POST['pro_discount'];


			
				$update_discount = "UPDATE pro_discount SET 
									discount_value	=	'$new_discount', 
									dis_endless		=	'$pro_endless',
									dis_enabled		=	'$pro_enabled'
									where promotion_id = '$promotion_id'";
				$update_discount = mysqli_query($db_connect,$update_discount);
				header("Location: promotion_edit.php");

			}
			elseif (isset($_POST['pro_buy']))
			{
				$pro_buy	=	$_POST['pro_buy'];
				$pro_get	=	$_POST['pro_get'];
				$update_buy_get = "UPDATE pro_discount SET
									pro_buy		=	'$pro_buy',
									pro_get 	=	'$pro_get',
									dis_endless =	'$pro_endless',
									dis_enabled =	'$pro_enabled'
									where promotion_id = '$promotion_id'
									";
				$update_buy_get = mysqli_query($db_connect,$update_buy_get);
				header("Location: promotion_edit.php");

			}
			elseif (isset($_POST['free_shipping']))
			{
				$update_free_shipping = "UPDATE pro_discount SET 
									
									dis_endless		=	'$pro_endless',
									dis_enabled		=	'$pro_enabled'
									where promotion_id = '$promotion_id'";
				$update_free_shipping = mysqli_query($db_connect,$update_free_shipping);
				header("Location: promotion_edit.php");
			}
		}
		elseif ($_POST['pro_submit']=='pro_delete')
		{
			echo "delete";
		}

}

}
edit_to_db();



if (isset($_POST['promotion_edit'])){

	promotion_edit();
}

?>


</div>
</body>
</html>