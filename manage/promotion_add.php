
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
<h3>新增促销选项卡</h3>
<form action='promotion_add.php' method= "POST">
<ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#discount">新建折扣促销</a></li>
    <li><a data-toggle="tab" href="#buyget">新增买赠促销</a></li>
    <li><a data-toggle="tab" href="#shippingfree">新增批发包邮</a></li>

  </ul>

<div class="tab-content" style='padding:10px;'>
<!-- 一下是价格优惠百分比优惠输入form 	-->
    <div id="discount" class="tab-pane fade in active">
      <h2>优惠按照原价的百分比</h2>
     

      <button class='btn btn-danger btn-xs' id='min3'  name='' type='button' value='-' />-</button>

      <input   id='pro_discount' name='pro_discount' type='text' value='100' size='3' readonly/>%
 
      <button class='btn btn-danger btn-xs' id='add3' name='' type='button' value='+' />+</button> 

      <button class='btn btn-danger' name='pro_submit' type='submit' value='discount_submit' />新增促销选项</button> 
    </div>

<!-- 一下是买赠促销输入form 	-->
    <div id="buyget" class="tab-pane fade">
    <div style='margin:10px'>

      <h3>买赠优惠</h3>
      <h3> 
      买 
      
      <button class='btn btn-danger btn-xs' id='min1'  name='' type='button' value='-' />-</button>

      <input   id='pro_buy' name='pro_buy' type='text' value='1' size='3' readonly/>
 
      <button class='btn btn-danger btn-xs' id='add1' name='' type='button' value='+' />+</button> 
       
      赠 

      <button class='btn btn-danger btn-xs' id='min2'  name='' type='button' value='-' />-</button>
     
      <input id='pro_get'  name='pro_get' type='text' value='1' size='3' readonly/>
      
      <button class='btn btn-danger btn-xs' id='add2' name='' type='button' value='+' />+</button> 
      </h3>
      



      <button class='btn btn-danger' name='pro_submit' type='submit' value='buy_get_submit' />新增促销选项</button> 

	</div>
</div>

<!-- 一下是免邮费促销输入form 	-->

    <div id="shippingfree" class="tab-pane fade">
      <h3>商品免除邮费</h3><br/>
      <input type='hidden' name = 'pro_type_shippingfree'>
      <button class='btn btn-danger' name='pro_submit' type='submit' value='shippingfree_submit' />新增促销选项</button> 
    </div>
    <br/><input type='checkbox' value='1' name ='pro_endless'>永久有效
    <br/><input type='checkbox' value='1' name ='pro_enabled'>优惠上线
 
  </div>

</div>
</form>
<?php   ///////add promotion to database

function promotion_add(){
global $db_connect;


$promotion_id = time();

if ($_POST['pro_submit'] == 'buy_get_submit')  //////////////buy and get promotion //////////
{

	//echo "AASSAAAA".$_POST['pro_type_discount'];
	$pro_type = 2;
	$pro_buy = $_POST['pro_buy'];
	$pro_get = $_POST['pro_get'];

	if (isset($_POST['pro_endless'])){
		$pro_endless = '1';

	}
	else{
		$pro_endless = '0';
	}
	if (isset($_POST['pro_enabled'])){
		$pro_enabled = '1';
	}
	else{
		$pro_enabled = '0';
	}

	$promotion_db = "INSERT INTO pro_discount (promotion_id,
											pro_buy,pro_get,
											pro_type,
											dis_endless,
											dis_enabled
											) 
									VALUES ('$promotion_id',
										'$pro_buy',
										'$pro_get',
										'$pro_type',
										'$pro_endless',
										'$pro_enabled')";
	$promotion_db = mysqli_query($db_connect,$promotion_db) or die;
	
}
elseif ($_POST['pro_submit'] == 'discount_submit') {
	$pro_type = 1;
	$pro_discount = $_POST['pro_discount'];
	if (isset($_POST['pro_endless'])){
		$pro_endless = '1';

	}
	else{
		$pro_endless = '0';
	}
	if (isset($_POST['pro_enabled'])){
		$pro_enabled = '1';
	}
	else{
		$pro_enabled = '0';
	}
	$promotion_db = "INSERT INTO pro_discount (promotion_id,
											discount_value,
											pro_type,
											dis_endless,
											dis_enabled
											) 
									VALUES ('$promotion_id',
										'$pro_discount',
						
										'$pro_type',
										'$pro_endless',
										'$pro_enabled')";
	$promotion_db = mysqli_query($db_connect,$promotion_db) or die;


}
elseif ($_POST['pro_submit'] == 'shippingfree_submit') {
	$pro_type = 4;

	//$pro_discount = $_POST['pro_discount'];
	if (isset($_POST['pro_endless'])){
		$pro_endless = '1';

	}
	else{
		$pro_endless = '0';
	}
	if (isset($_POST['pro_enabled'])){
		$pro_enabled = '1';
	}
	else{
		$pro_enabled = '0';
	}
	$promotion_db = "INSERT INTO pro_discount (promotion_id,
											pro_type,
											dis_endless,
											dis_enabled
											) 
									VALUES ('$promotion_id',
										'$pro_type',
										'$pro_endless',
										'$pro_enabled')";
	$promotion_db = mysqli_query($db_connect,$promotion_db) or die;


}









}



if (isset($_POST['pro_submit'])){

	promotion_add();
}
?>

<div class = 'col-lg-6'>
<?php
/////////////////////////////////////////////////////  list on the rightside col //////////////////////////////////
echo "<h3>优惠活动浏览表</h3>";
/////load promotion list ////

$promotion_list = 'SELECT discount_value,pro_buy,pro_get,pro_type,dis_endless,dis_enabled,pro_price from pro_discount order by id desc';
$promotion_list = mysqli_query($db_connect,$promotion_list);
echo "<table class='table table-hover'>";
echo "<thead><th>促销类型</th><th>促销内容</th><th>永久有效</th><th>促销上线</th></thead>";
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
	echo "</tr>";
}

echo "</table>";
?>
</div>
</body>
</html>