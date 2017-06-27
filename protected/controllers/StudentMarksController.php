<?php

class StudentMarksController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/contentLayout';

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
				'actions'=>array('index','view','create','update','admin','delete','LoadMarks'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array(),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array(),
				'users'=>array('admin'),
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
		$model=new StudentMarks;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['StudentMarks']))
		{
            $students = $_POST['StudentMarks']['Student'];
            foreach($students as $student){
                $student_id = $student['STUDENT_ID'];
                $subjects = $student['Subject'];
                foreach($subjects as $subject){
                    if(StudentMarks::model()->exists('STUDENT_ID='.$student_id.' AND SUBJECT_ID='.$subject['SUBJECT_ID'])){
                        $studentMarks = $model->find('STUDENT_ID='.$student_id.' AND SUBJECT_ID='.$subject['SUBJECT_ID']);
                        $studentMarks->OBTAINED_GRADE = $subject['OBTAINED_GRADES'];
                        $studentMarks->save(false);
                    }
                    else{
                        $studentMarks = new StudentMarks;
                        $studentMarks->STUDENT_ID = $student_id;
                        $studentMarks->SUBJECT_ID = $subject['SUBJECT_ID'];
                        $studentMarks->OBTAINED_GRADE = $subject['OBTAINED_GRADES'];
                        $studentMarks->save(false);   
                    }
                }
            }
            echo "<script type='text/javascript'>alert('Marks Saved Successfully');</script>";
        }

		$this->render('create',array(
			'model'=>$model,
		));
	}
    
    public function actionLoadMarks($course){
        $Students = StudentCourse::model()->findAll('COURSE_ID='.$course.' AND STATUS=1');
        $data = array();
        foreach($Students as $student){
            $STUDENT_ID = $student->STUDENT_ID;
            $student = array(
                "ID"=>$student->STUDENT_ID, 
                "NAME"=>Student::model()->findByPK($student->STUDENT_ID)->NAME);
            
            $courseSubjects = CourseSubjects::model()->findAll('COURSE_ID='.$course);
            $marks = array();
            foreach($courseSubjects as $subject){
             array_push($marks, array(
                    "ID"=>$subject->SUBJECT_ID,
                    "SUBJECT_NAME"=>Subject::model()->findByPK($subject->SUBJECT_ID)->NAME,
                    "OBT_GRADES"=>StudentMarks::model()->exists('STUDENT_ID='.$STUDENT_ID.' AND SUBJECT_ID='.$subject->SUBJECT_ID) ? StudentMarks::model()->find('STUDENT_ID='.$STUDENT_ID.' AND SUBJECT_ID='.$subject->SUBJECT_ID)->OBTAINED_GRADE : '',
              ));
            }
            $student['MARKS'] = $marks;
            array_push($data, $student);
        }
        echo json_encode($data);exit;
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

		if(isset($_POST['StudentMarks']))
		{
			$model->attributes=$_POST['StudentMarks'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->ID));
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
		$dataProvider=new CActiveDataProvider('StudentMarks');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new StudentMarks('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['StudentMarks']))
			$model->attributes=$_GET['StudentMarks'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=StudentMarks::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='student-marks-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
