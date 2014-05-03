<?php
/* @var $this CategoryController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
    'Categories',
);

$this->menu=array(
    array('label'=>'List Category', 'url'=>array('index')),
    array('label'=>'Create Category', 'url'=>array('create')),
    array('label'=>'Manage Category', 'url'=>array('admin')),
);
?>

<h1>Categories Tree View</h1>
<?php $this->renderLinks($collection, 0); ?>
