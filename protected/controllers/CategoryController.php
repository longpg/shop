<?php

class CategoryController extends Controller
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
                'actions'=>array('index','view','treeview'),
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
		$model=new Category;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Category']))
		{
			$model->attributes=$_POST['Category'];
			if($model->save()){
                $upload=CUploadedFile::getInstance($model,'image');
                if($upload !== null){
                    $imgName = preg_replace('/[^a-z0-9]/ui','-' , $model->name);
                    $imgDir = Yii::getPathOfAlias('webroot.images');
                    $uploadDir = Yii::getPathOfAlias('webroot.images.upload');
                    $dest = Yii::getPathOfAlias('webroot.images.upload.category');
                    if (!is_dir($imgDir)) mkdir($imgDir);
                    if (!is_dir($uploadDir)) mkdir($uploadDir);
                    if (!is_dir($dest)) mkdir($dest);
                    $ext=strtolower($upload->extensionName);
                    $model->image=$model->id . '_' . $imgName . '.' . $ext;
                    $upload->saveAs($dest . '/' .$model->image);
                    $model->save();
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

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Category']))
		{
			$model->attributes=$_POST['Category'];
            $upload=CUploadedFile::getInstance($model,'image');
            if($upload !== null){
                $imgName = preg_replace('/[^a-z0-9]/ui','-' , $model->name);
                $uploadDir = Yii::getPathOfAlias('webroot.images.upload');
                $dest = Yii::getPathOfAlias('webroot.images.upload.category');
                if (!is_dir($uploadDir)) mkdir($uploadDir);
                if (!is_dir($dest)) mkdir($dest);
                $ext=strtolower($upload->extensionName);
                $model->image=$model->id . '_' . $imgName . '.' . $ext;
                $upload->saveAs($dest . '/' .$model->image);
            }
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
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
		$dataProvider=new CActiveDataProvider('Category');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Category('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Category']))
			$model->attributes=$_GET['Category'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

    /**
     * Display all categories as tree
     */
    public function actionTreeview()
    {
        $categories=Category::model()->findAll();
        $this->render('treeview',array(
            'collection'=>$categories,
        ));
    }

    public function renderLinks($categories, $parent_id)
    {
        $categoryList = $this->getChildCategories($categories,$parent_id);
        if($categoryList) {
            echo "<ul>";
            foreach($categoryList as $category){
                echo "<li>";
                echo CHtml::link($category->name,$this->createUrl('view',array('id'=>$category->id)));
                $this->renderLinks($categories, $category->id);
                echo "</li>";
            }
            echo "</ul>";
        }
    }

    public function getChildCategories($categories, $parent_id)
    {
        $result=array();
        foreach($categories as $category){
            if($category->parent_id==$parent_id){
                $result[]=$category;
            }
        }
        if(count($result)){
            return $result;
        }else return false;
    }

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Category the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Category::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Category $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='category-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
