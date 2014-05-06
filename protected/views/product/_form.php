<?php
/* @var $this ProductController */
/* @var $model Product */
/* @var $form CActiveForm */
?>

<div class="form" style="float: left;">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'product-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
    'htmlOptions'=>array('enctype'=>'multipart/form-data'),
));

Yii::app()->clientScript->registerScript('category-checkboxes', "
var categoriesArr=new Array();
$('.category-checkboxes input[type=\"checkbox\"]').change(function(){
    categoriesArr=new Array();
    $('.category-checkboxes input[type=\"checkbox\"]:checked').each(function(i, el) {
        var id=$(el).attr('id').split('_')[1];
        categoriesArr.push(id);
    });
    $('#categories').val(categoriesArr.join());
});
"); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'description'); ?>
		<?php echo $form->textField($model,'description',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'description'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'price'); ?>
		<?php echo $form->textField($model,'price'); ?>
		<?php echo $form->error($model,'price'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'image'); ?>
		<?php echo $form->fileField($model,'image'); ?>
		<?php echo $form->error($model,'image'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'manufacture'); ?>
		<?php echo $form->textField($model,'manufacture',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'manufacture'); ?>
	</div>

    <?php if (!$model->isNewRecord): ?>
	<div class="row">
		<?php echo $form->labelEx($model,'created_at'); ?>
		<?php echo $model->created_at; ?>
		<?php echo $form->error($model,'created_at'); ?>
	</div>
    <?php endif;?>

	<div class="row">
		<?php echo $form->labelEx($model,'qty'); ?>
		<?php echo $form->textField($model,'qty'); ?>
		<?php echo $form->error($model,'qty'); ?>
	</div>

    <div class="row category-checkboxes">
        <label>Product Categories</label>
        <input type="hidden" name="categories" id="categories"<?php if(!$model->isNewRecord && is_array($categories)): ?> value="<?php echo implode(',',$categories) ?>"<?php endif;?> />
        <?php Yii::import('application.controllers.CategoryController'); ?>
        <?php CategoryController::renderCheckboxes(Category::model()->findAll(),$model->isNewRecord?array():$categories,0) ?>
    </div>

    <div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->

<?php if(!$model->isNewRecord && !empty($model->image) && is_file(Yii::getPathOfAlias('webroot.images.upload.product').'/'.$model->image)):?>
<div class="image" style="float: right;">
    <img width="200" alt="image_<?php echo $model->name ?>" src="<?php echo Yii::app()->request->baseUrl ?>/images/upload/product/<?php echo $model->image ?>" />
</div>
<?php endif;?>
