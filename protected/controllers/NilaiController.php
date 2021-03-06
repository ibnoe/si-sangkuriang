<?php

class NilaiController extends Controller {

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/column2';

    /**
     * @return array action filters
     */
    public function filters() {
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
    public function accessRules() {
        
		return array(
        array('allow',
                    'actions'=>array('index','view','update','delete','admin','create'),
                    'expression'=>'$user->getLevel()<=3',
            ),
        array('allow',
                    'actions'=>array('view'),
                    'expression'=>'$user->getLevel()==3',
            ),
		/*	array('allow',  // allow all users to perform 'index' and 'view' actions
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
			),*/
			array('deny',  // deny all users
				'users'=>array('*'),
			),
	
        
        );
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id) {
             
//        if (isset($_GET['daftarKelasSiswa'])) {
//            $model = new DaftarKelasSiswa('search');
//            $allt = new DaftarKelasSiswa('search');
//            $allt->unsetAttributes();
//            $allt->id_daftar_kelas = $_GET['daftarKelasSiswa'];
//
//            $dataProvider = new CActiveDataProvider('DaftarKelasSiswa');
//
//            $this->render('viewDaftarKelasSiswa', array(
//                'allt' => $allt,
//                'dataProvider' => $dataProvider,
//                'model'=>  $model->id_daftar_kelas=$_GET['daftarKelasSiswa'],
//            ));
//        } else if (isset($_GET['nilai'])) {
//            $model = new Nilai('search');
//            $allt = new Nilai('search');
//            $allt->unsetAttributes();
//            $allt->nis = $_GET['nilai'];
//
//            $dataProvider = new CActiveDataProvider('Nilai');
//
//            $this->render('view', array(
//                'allt' => $allt,
//                'dataProvider' => $dataProvider,
//                'model'=>  $model->id_daftar_kelas=$_GET['nilai'],
//            ));
//        } else {
//            $allt = new Nilai('search');
//            $allt->unsetAttributes();
//            $allt->id_daftar_kelas = $id;
//
//            $dataProvider = new CActiveDataProvider('Nilai');
//
//            $this->render('view', array(
//                'allt' => $allt,
//                'dataProvider' => $dataProvider,
//                'model'=> $model->id_daftar_kelas=$id,
//            ));
            
            
            $model = new Nilai('search');
            $model->unsetAttributes();  // clear any default values
            if (isset($_GET['Nilai'])) {
                $model->attributes = $_GET['Nilai'];
                $model->id_daftar_kelas = $id;
            }

            $this->render('admin', array(
                'model' => $model,
                //'model' => $this->loadModel($id),
            ));
        
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $model = new Nilai;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Nilai'])) {
            $model->attributes = $_POST['Nilai'];
            $model->nilai_akhir = ($model->nilai_ulangan1 + $model->nilai_ulangan2 + $model->nilai_ulangan3
                    + $model->nilai_uts + $model->nilai_uas) / 5;
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->id));
        }

        $this->render('create', array(
            'model' => $model,
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id) {
        $model = $this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Nilai'])) {
            $model->attributes = $_POST['Nilai'];
            $model->nilai_akhir = ($model->nilai_ulangan1 + $model->nilai_ulangan2 + $model->nilai_ulangan3
                    + $model->nilai_uts + $model->nilai_uas) / 5;
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->id));
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id) {
        $this->loadModel($id)->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {
       $model = new Nilai('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Nilai']))
            $model->attributes = $_GET['Nilai'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new Nilai('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Nilai']))
            $model->attributes = $_GET['Nilai'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer the ID of the model to be loaded
     */
    public function loadModel($id) {
        $model = Nilai::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'nilai-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
