<?php
/* @var $this CategoryController */
/* @var $model Category */

$this->breadcrumbs=array(
	'Categories'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List Category', 'url'=>array('index')),
	array('label'=>'Create Category', 'url'=>array('create')),
	array('label'=>'Update Category', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Category', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Category', 'url'=>array('admin')),
    array('label'=>'View Category as Tree', 'url'=>array('treeview')),
);
?>

<h1>View Category #<?php echo $model->id; ?></h1>
<div class="info" style="float: left;width: 500px;">
<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'image',
		'description',
		'parent_id',
	),
)); ?>
</div>
<?php if(!empty($model->image) && is_file(Yii::getPathOfAlias('webroot.images.upload.category').'/'.$model->image)):?>
    <div class="image" style="float: right;">
        <img width="200" alt="image_<?php echo $model->name ?>" src="<?php echo Yii::app()->request->baseUrl ?>/images/upload/category/<?php echo $model->image ?>" />
    </div>
<?php endif;?>