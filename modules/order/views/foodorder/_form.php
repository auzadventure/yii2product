<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\grid\GridView;

use app\models\FoodOrderItem;
use app\models\FoodOrder;
use app\models\MenuItem;
use yii\data\ActiveDataProvider;

use yii\db\Expression;


/* @var $this yii\web\View */
/* @var $model app\models\FoodOrder */
/* @var $form yii\widgets\ActiveForm */

$itemStr = '[ { "itemID": 1, "qty": 3 }, { "itemID": 2, "qty": 1 } ] ';
$itemA = json_decode($itemStr);

//FoodorderItem::addItems(1,$itemA);
$query = FoodorderItem::find()->where(['foodOrderID' => 1]);
$provider = new ActiveDataProvider([
    'query' => $query,

]);

$session = Yii::$app->session;
$items = json_decode($session['items']);


?>

<div class="food-order-form">

<?php 
$js = " $('#orderTable').hide(); 
		$('#showOrder').click(function(e) {
			$('#orderTable').slideToggle('slow'); 
		});";
$this->registerJs($js);		
?> 

<h4> My Order
<button id='showOrder' class='btn btn-primary' style='margin:10px'>Show Order</button>	
</h4>
<div id='orderTable'><table  class="table table-bordered">
  <thead>
    <tr>
      <th>#</th>
      <th>Item</th>
      <th>Price</th>
      <th>Quantity</th>
	  <th>SubTotal</th>
    </tr>
  </thead>
  <tbody>

	<?php 
	$total = 0;
	$i=0;
	foreach ($items as $item): 
			$i++;
			$menuItemObj = MenuItem::findOne($item->itemID); 
			$subTotal = 0;
			$subTotal = $menuItemObj->price * $item->qty;
			$total = $total + $subTotal; 
		
			?>
			<tr>
			  <th scope="row"><?=$i?></th>
			  <td><?=$menuItemObj->name?></td>
			  <td><?=$menuItemObj->price?></td>
			  <td><?=$item->qty;?></td>
			  <td><?=$subTotal;?></td>
			</tr>		
		
	<?php endforeach; ?>

	<?php 
	$deliveryFee = FoodOrder::$deliveryFee;
	$gst = ($total+$deliveryFee) * (FoodOrder::$gst);
	$full_total = $total+$deliveryFee + $gst;
	
	?>
	
   <tr>
      <td colspan='3'></td>
	  <td colspan='1'>Delivery Fee</td>
	  <td><?=FoodOrder::moneyF($deliveryFee)?></td>
   </tr>	
   <tr>
      <td colspan='3'></td>
	  <td colspan='1'>GST </td>
	  <td><?=FoodOrder::moneyF($gst)?></td>
   </tr>	
   <tr>
      <td colspan='3'></td>
	  <td colspan='1'>Total </td>
	  <td><?=FoodOrder::moneyF($full_total)?></td>
   </tr>	
	
</tbody>
</table>
</div>

	
	
<?php

//Ajax Get Customer 
$getCustUrl = Url::toRoute(['customer/ajax_get'],true);
//echo $getCustUrl;
 
$js = <<<EOD

function getCustomer(data) {
	var c_status = data.c_status;

	if(c_status==0) {
		$('#cus_error').text('You are not registered')
	}
	else if(c_status==1) {
		$('#cus_error').text('Incorrect password')
	}
	else {

		var cus_obj = data.c_model;
		$('#foodorder-email').val(data.c_model.email);
		$('#foodorder-name').val(data.c_model.name);
		$('#foodorder-contactno').val(data.c_model.contactNo);
		$('#foodorder-address').val(data.c_model.address);
		$('#cus_get_form').slideUp();
	}
}

$('#get_cus').click(function(e) {

	e.preventDefault();
	var email = $('#cus_email').val();
	var pass = $('#cus_pass').val();
	alert(email)
	$.post("{$getCustUrl}",
		  {p_email: email, p_pass: pass}, 
		  function(data) {
				getCustomer(data)
				}
		  )
});




EOD;

Yii::$app->view->registerJs($js);		
?>
	
	<div id='cus_get_form'>		
	<h4> I am a returning customer </h4>	
		<div class="form-inline" >
		<?= Html::textInput('email','',['id'=>'cus_email',"placeholder"=>'email',"class"=>"form-control"]) ?>
		<?= Html::passwordInput('pass','',['id'=>'cus_pass',"placeholder"=>'password',"class"=>"form-control"]) ?>
		<?= Html::submitButton('fetch',['id'=>'get_cus',"class"=>"form-control btn btn-primary"]) ?>
		<div class="text-danger" id='cus_error'></div>
		</div>
	</div>
	
	<hr style='color: grey;padding: 20px 0;'>
	
	<h4> Guest Order </h4>
	
    <?php $form = ActiveForm::begin(); ?>


	
	<?= $form->field($model, 'name')->textInput() ?>
	
	<?= $form->field($model, 'email')->textInput() ?>

    <?= $form->field($model, 'contactNo')->textInput(['maxlength' => true,'value'=>'555']) ?>

    <?= $form->field($model, 'address')->textInput(['maxlength' => true,'value'=>'addressdddd']) ?>

    <?= $form->field($model, 'remark')->textArea(['maxlength' => true,'rows'=>2]) ?>

    <?= $form->field($model, 'itemTotal')->hiddenInput(['maxlength' => true,'value'=>$total]) 
		->label(false)?>

	<?= $form->field($model, 'deliveryFee')->hiddenInput(['maxlength' => true,'value'=>FoodOrder::$deliveryFee]) 
		->label(false)?>

	
    <?= $form->field($model, 'gst')
		->hiddenInput(['maxlength' => true,'value'=>$gst])
		->label(false)?>	

    <?= $form->field($model, 'total')->hiddenInput(['value'=>$full_total])
		->label(false)?>

    <?= $form->field($model, 'datetimeCreate')
			->hiddenInput(['value'=>Yii::$app->params['datetimeSQL']])
			->label(false)?>

    <?= $form->field($model, 'status')->hiddenInput(['value'=>$model::$STATUS_OPEN])
		->label(false)?>
			

    <div class="form-group">
        <?= Html::submitButton('Checkout and Pay', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
