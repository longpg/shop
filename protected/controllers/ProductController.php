<?php

class ProductController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('create','update','admin','delete'),
				'users'=>$this->adminList(),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Product;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Product']))
		{
			$model->attributes=$_POST['Product'];
            if($model->save()){
                $upload=CUploadedFile::getInstance($model,'image');
                if($upload !== null){
                    $imgName = preg_replace('/[^a-z0-9]/ui','-' , $model->name);
                    $imgDir = Yii::getPathOfAlias('webroot.images');
                    $uploadDir = Yii::getPathOfAlias('webroot.images.upload');
                    $dest = Yii::getPathOfAlias('webroot.images.upload.product');
                    if (!is_dir($imgDir)) mkdir($imgDir);
                    if (!is_dir($uploadDir)) mkdir($uploadDir);
                    if (!is_dir($dest)) mkdir($dest);
                    $ext=strtolower($upload->extensionName);
                    $model->image=$model->id . '_' . $imgName . '.' . $ext;
                    $upload->saveAs($dest . '/' .$model->image);
                    $model->save();
                }

                if(isset($_POST['categories']) && $model->id){
                    $cateList=explode(',',$_POST['categories']);
                    $cateList=array_unique($cateList);
                    $insertRows=array();
                    foreach($cateList as $cateId){
                        $insertRows[]="({$model->id},{$cateId})";
                    }
                    $insertValues=implode(',',$insertRows);
                    $insertSql="INSERT INTO tbl_map (product_id,category_id) VALUES {$insertValues}";
                    Yii::app()->db->createCommand($insertSql)->execute();
                }

                $this->redirect(array('view','id'=>$model->id));
            }
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);
        $cateIds=$this->getMappedCategories($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Product']))
		{
			$model->attributes=$_POST['Product'];
            $upload=CUploadedFile::getInstance($model,'image');
            if($upload !== null){
                $imgName = preg_replace('/[^a-z0-9]/ui','-' , $model->name);
                $uploadDir = Yii::getPathOfAlias('webroot.images.upload');
                $dest = Yii::getPathOfAlias('webroot.images.upload.product');
                if (!is_dir($uploadDir)) mkdir($uploadDir);
                if (!is_dir($dest)) mkdir($dest);
                $ext=strtolower($upload->extensionName);
                $model->image=$model->id . '_' . $imgName . '.' . $ext;
                $upload->saveAs($dest . '/' .$model->image);
            }

            $categorySaver = true;
            if(isset($_POST['categories'])){
                $cateList=explode(',',$_POST['categories']);
                $cateList=array_unique($cateList);
                foreach ($cateList as $cateId) {
                    if (!in_array($cateId, $cateIds)) {
                        $map=new Map;
                        $map->product_id=$id;
                        $map->category_id=$cateId;
                        if(!($map->save())){
                            $categorySaver = false;
                            break;
                        }
                    }
                }

                foreach($cateIds as $cateId){
                    if(!in_array($cateId, $cateList)){
                        Map::model()->deleteAll('product_id=:pid AND category_id=:cid',
                            array(':pid'=>$id,':cid'=>$cateId));
                    }
                }
            }

            if($model->save() && $categorySaver)
                $this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
            'categories'=>$cateIds,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Product');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Product('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Product']))
			$model->attributes=$_GET['Product'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Product the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Product::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Product $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='product-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

    public function getMappedCategories($id)
    {
        $command=Yii::app()->db->createCommand();
        $command->select('category_id');
        $command->from('tbl_Map');
        $command->where('product_id=:id',array(':id'=>$id));
        $cateIds=$command->queryColumn();
        return array_unique($cateIds);
    }
}
