<?php $this->beginContent('@app/views/layouts/main.php'); ?>

<div class="row">
   <div class="col-md-3">
    <div class="pg-sidebar">          
      <?php 
		if(@$this->params['sideBar']!='') 
			echo $this->params['sideBar'];  
	  
	  ?>

      <?= $this->blocks['toolbar']; ?>
    </div>      
  </div>
  <div class="col-md-9">
    <?= $content; ?>
  </div>
</div>

<?php $this->endContent(); ?>