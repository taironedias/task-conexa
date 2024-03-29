<?php

class PostController extends Controller {
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @var CActiveRecord the currently loaded data model instance.
	 */
	private $_model;

	public $permissionUpdate='';
	/**
	 * @return array action filters
	 */
	public function filters() {
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules() {
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 */
	public function actionView() {
		$model=$this->loadModel();
		$modelComment=new Comentario;
		$htmlOptions= array();

		$categoria=Categoria::model()->findbyPk($model->idCategoria);	
		
		$comentarios = Yii::app()->db->createCommand()
		->select('c.texto, u.username')
		->from('Comentario c, User u')
		->where('c.idPost=:id and u.id=c.idUser', array(':id'=>$model->id))
		->queryAll();
		
		$nameUserLogged=Yii::app()->user->name;
		$checkUser=(int)Yii::app()->db->createCommand('SELECT COUNT(*) FROM User WHERE username=:nameUser')->queryScalar(array(':nameUser'=>$nameUserLogged));

		if($checkUser > 0){
			if(isset($_POST['Comentario'])) {
				$modelComment->attributes=$_POST['Comentario'];
				$modelComment->idUser=(int)User::model()->findByAttributes(array('username'=>$nameUserLogged))->id;
				$modelComment->idPost=(int)$model->id;
				
				if($modelComment->validate() && $modelComment->save())
					$this->redirect(array('view','id'=>$model->id));
			}
		} else {
			$htmlOptions = array('disabled'=>true);
		}
					


		$this->render('view',array(
			'model'=>$model,
			'modelComment'=>$modelComment,
			'categoria'=>$categoria,
			'comentarios'=>$comentarios,
			'htmlOptions'=>$htmlOptions,
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate() {
		$model=new Post;
		global $permissionUpdate;

		$this->performAjaxValidation($model);

		// Autor
		$model->autor=Yii::app()->user->name;
		$idUserLogged=(int)User::model()->findByAttributes(array('username'=>$model->autor))->id;
		// Data
		$model->dataPost=date('Y-m-d h:i:s');

		// Categoria
		$model->idCategoria='';

		if(isset($_POST['Post'])) {
			$model->attributes=$_POST['Post'];
			$model->idUser=$idUserLogged;

			if($model->validate()) {
				$model->idCategoria=(int)$model->attributes['idCategoria'];
				if($model->save())
					$this->redirect(array('view','id'=>$model->id));
			}
		}

		$this->render('create',array(
			'model'=>$model,
			'permissionUpdate'=>$permissionUpdate,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionUpdate() {
		$model=$this->loadModel();
		global $permissionUpdate;
		$this->performAjaxValidation($model);

		// Autor
		$idUserLogged=User::model()->findByAttributes(array('username'=>Yii::app()->user->name))->id;

		
		if(isset($_POST['Post'])) {
			if($model->idUser === $idUserLogged) {
				$model->attributes=$_POST['Post'];
				if($model->validate()) {
					
					if($model->save())
						$this->redirect(array('view','id'=>$model->id));
				}
			} else {
				$permissionUpdate='Vocẽ não tem permissão para fazer essa atualização! Apenas o criador desse post pode editá-la.';
			}
	
		}

		$this->render('update',array(
			'model'=>$model,
			'permissionUpdate'=>$permissionUpdate,
		));
		


	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 */
	public function actionDelete() {
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			$this->loadModel()->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(array('index'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex() {

		$dataProvider=new CActiveDataProvider('Post', array(
			'criteria'=>array(
				'order'=>'dataPost DESC',
			)
		));


		$model=Categoria::model()->findAll();

		if(isset($_GET['id'])){
			$idCategorySelected=Categoria::model()->findbyPk($_GET['id'])->id;
			$dataProvider=new CActiveDataProvider('Post', array(
				'criteria'=>array(
					'condition'=>'idCategoria='. $idCategorySelected,
					'order'=>'dataPost DESC',
				)
			));
	
		}

		$this->render('index',array(
			'dataProvider'=>$dataProvider,
			'model'=>$model,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin() {
		$model=new Post('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Post']))
			$model->attributes=$_GET['Post'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 */
	public function loadModel() {
		if($this->_model===null) {
			if(isset($_GET['id']))
				$this->_model=Post::model()->findbyPk($_GET['id']);
			if($this->_model===null)
				throw new CHttpException(404,'A página solicitada não existe.');
		}
		return $this->_model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model) {
		if(isset($_POST['ajax']) && $_POST['ajax']==='post-form') {
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
