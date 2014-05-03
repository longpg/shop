<?php
/* @var $this CategoryController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Categories',
);

$this->menu=array(
	array('label'=>'Create Category', 'url'=>array('create')),
	array('label'=>'Manage Category', 'url'=>array('admin')),
    array('label'=>'View Category as Tree', 'url'=>array('treeview')),
);
?>

<h1>Categories</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
