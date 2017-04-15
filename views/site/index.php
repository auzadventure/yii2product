<?php
use yii\helpers\Html;

/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Congratulations!</h1>

        <p class="lead">You have successfully created your Yii-powered application.</p>

        <p><a class="btn btn-lg btn-success" href="http://www.yiiframework.com">Get started with Yii</a></p>
    </div>

    <div class="body-content">

        <div class="row">
            <div class="col-lg-4">
                <h2>Heading</h2>

                
				<p><?php echo Html::a('Customer',['order/customer']) ?></p>

                <p><a class="btn btn-default" href="http://www.yiiframework.com/doc/">Yii Documentation &raquo;</a></p>
            </div>
            <div class="col-lg-4">
                <h2>Ordering</h2>

                
				<p><?php echo Html::a('Order',['order/foodorder']) ?></p>
				<p><?php echo Html::a('Customer Login',['order/foodorder/customerlogin']) ?></p>
                <p><?php echo Html::a('Paypal',['order/foodorder/paypal']) ?></p>
                <p><?php echo Html::a('Paypal_IPN',['order/foodorder/paypal_ipn']) ?></p>
				 <p><?php echo Html::a('Nexmo_sms',['order/foodorder/paypal_return']) ?></p>
				 
				
				<p><?php echo Html::a('menu',['order/foodorder/menu']) ?></p>
				
				<p> - <?php echo Html::a('paypal return',['order/foodorder/paypal_return']) ?></p>
				<p> - <?php echo Html::a('paypal cancel',['order/foodorder/paypal_cancel']) ?></p>
				
				<p><a class="btn btn-default" href="http://www.yiiframework.com/forum/">Yii Forum &raquo;</a></p>
            </div>
            <div class="col-lg-4">
                <h2>Order Admin =</h2>
				<p><?php echo Html::a('Menuitem',['orderAdmin/menuitem']) ?></p>
				<p><?php echo Html::a('Menucat',['orderAdmin/menucat']) ?></p>
				 <p><?php echo Html::a('orderAdmin paid',['orderAdmin/foodorder/index']) ?></p>
				 <p><?php echo Html::a('orderAdmin processed',['orderAdmin/foodorder/indexprocessed']) ?></p>
				
				 <p><?php echo Html::a('orderAdmin shipped',['orderAdmin/foodorder/indexshipped']) ?></p>
				
                <p></p>

                <p><a class="btn btn-default" href="http://www.yiiframework.com/extensions/">Yii Extensions &raquo;</a></p>
            </div>
        </div>


    </div>
</div>
