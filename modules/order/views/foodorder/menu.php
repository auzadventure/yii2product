<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\web\Session;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Menu';
$this->params['breadcrumbs'][] = $this->title;

$this->registerJsFile("https://unpkg.com/vue/dist/vue.js",['position'=>\yii\web\View::POS_HEAD]);

?>

<style>
ul li {
	padding:10px;
}

</style>
<div class="food-order-index">

    <h1><?= Html::encode($this->title) ?></h1>


  <div id="app">

    <h1>Menu Add</h1>

	<ul>
	<?php foreach ($models as $model) : ?>
	
	<li> <strong><?=$model->name?></strong> <br> <?=$model->des?> <br>
	<button class='btn btn-primary' v-on:click='subItem(<?=$model->id?>,<?=$model->price?>)'>Remove Me</button>
	<button class='btn btn-danger' v-on:click='addItem(<?=$model->id?>,<?=$model->price?>)'>Add Me</button>
	</li>
	<?php endforeach;?>
	
	</ul>
	Items: {{items}}
	<ul class="list-group">
		<li class="list-group-item" v-for="item in items">
		#{{item.itemID}} , Qty: {{item.qty}} 
		</li>
	</ul>
	<br>
	Total: {{subTotal}}
	
	<?php 
		
		$items = @$_POST['items'];
		$session = Yii::$app->session;
		if($session->isActive) $session->open;
		
		
		$session['items'] = $items;
		$items = json_decode($items);
		print_r($items[0]);
		
		
	?>
	<?=Html::beginForm('','post')?>
	<input type='hidden' name='items' v-bind:value="JSON.stringify(items)"></input>
	<?=Html::submitButton()?>
	<?=Html::endForm()?>
   <br>
   <?= Html::a('order',['create'])?>
  </div>

  <script>
  
  function inArray(items,itemID) {
	for (var i=0; i< items.length; i++){
		if(items[i].itemID==itemID) return i;
	}
	return false;
  }
  
  
  
    new Vue({
      el: '#app',
      data: {
		items: [],
		subTotal: 0,

      },
      methods: {
		submit : function () {
				alert(JSON.stringify(this.items))
		},
	  
	  
		addItem: function (itemID,price) {
					
					var itemIndex = inArray(this.items,itemID)
					//alert(itemIndex)
					if(itemIndex === false) {
						this.items.push({'itemID':itemID, qty:1})
					}
					else {
						this.items[itemIndex].qty = this.items[itemIndex].qty + 1 
					}
					
					this.subTotal = this.subTotal + price;
				},
		subItem: function (itemID,price) {
					var itemIndex = inArray(this.items,itemID)
					//alert(itemIndex)
					if(itemIndex === false) {
					}
					else {
						
						if(this.items[itemIndex].qty === 1) {
							//alert('Splice Array')
							this.items.splice(itemIndex,1);
						}
						else {
						this.items[itemIndex].qty = this.items[itemIndex].qty - 1 
						}
					}
					
					
		
			}		
	  
	  
	  }
		
    })
  </script>

</div>