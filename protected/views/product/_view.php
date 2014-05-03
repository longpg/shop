<?php
/* @var $this ProductController */
/* @var $data Product */
?>

<div class="view">
<div class="info" style="float: left;max-width: 500px">
	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::encode($data->name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('description')); ?>:</b>
	<?php echo CHtml::encode($data->description); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('price')); ?>:</b>
	<?php echo CHtml::encode($data->price); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('image')); ?>:</b>
	<?php echo CHtml::encode($data->image); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('manufacture')); ?>:</b>
	<?php echo CHtml::encode($data->manufacture); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('created_at')); ?>:</b>
	<?php echo CHtml::encode($data->created_at); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('qty')); ?>:</b>
	<?php echo CHtml::encode($data->qty); ?>
	<br />
</div>
<div class="image" style="float: right;">
    <?php if(!empty($data->image) && is_file(Yii::getPathOfAlias('webroot.images.upload.product').'/'.$data->image)): ?>
        <img width="200" alt="image_<?php echo $data->name ?>" src="<?php echo Yii::app()->request->baseUrl ?>/images/upload/product/<?php echo $data->image ?>" />
    <?php else:?>
        --Not Available--
    <?php endif;?>
</div>
<div class="clearfix"></div>
</div>
