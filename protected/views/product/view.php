<?php
/* @var $this ProductController */
/* @var $model Product */

$this->breadcrumbs=array(
	'Products'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List Product', 'url'=>array('index')),
	array('label'=>'Create Product', 'url'=>array('create')),
	array('label'=>'Update Product', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Product', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Product', 'url'=>array('admin')),
);
?>

<h1>View Product #<?php echo $model->id; ?></h1>
<div class="info" style="float: left;width: 500px;">
<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'description',
		'price',
		'image',
		'manufacture',
		'created_at',
		'qty',
	),
)); ?>
</div>
<?php if(!empty($model->image) && is_file(Yii::getPathOfAlias('webroot.images.upload.product').'/'.$model->image)):?>
<div class="image" style="float: right;">
    <img width="200" alt="image_<?php echo $model->name ?>" src="<?php echo Yii::app()->request->baseUrl ?>/images/upload/product/<?php echo $model->image ?>" />
</div>
<?php endif;?>