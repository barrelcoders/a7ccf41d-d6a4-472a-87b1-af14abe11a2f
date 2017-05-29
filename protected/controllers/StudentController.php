<?php

class StudentController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/contentLayout', $result = array(), $rollNo = "", $importStatus;

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
				'actions'=>array('index','view','create','update','admin','delete'),
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
	
	public function actionViewResult()
	{
		$model=new Student;
		$courseID = 0;

		if(isset($_POST['Student']))
		{
			$this->rollNo = $_POST['Student']['ROLL_NO'];
			if(Student::model()->exists('ROLL_NO="'.$this->rollNo.'"')){
				$student = Student::model()->find('ROLL_NO="'.$this->rollNo.'"');
				$this->result["NAME"] = $student->NAME;
				$this->result["FATHER"] = $student->FATHER;
				$this->result["MOTHER"] = $student->MOTHER;
				$this->result["REG_ID"] = $student->REG_ID;
				$this->result["ROLL_NO"] = $student->ROLL_NO;
				
				if(StudentCourse::model()->find('STUDENT_ID='.$student->ID.' AND STATUS = 1')){
					$courseID = StudentCourse::model()->find('STUDENT_ID='.$student->ID.' AND STATUS = 1')->COURSE_ID;
					$this->result["COURSE"] = Course::model()->findByPk($courseID)->NAME;
				}
				else{
					$this->result["COURSE"] = 'NA';
				}
				
				$marks_array = array();
				$subjects = CourseSubjects::model()->findAll('COURSE_ID='.$courseID);
                foreach($subjects as $subject){
                    $subjectNAME = Subject::model()->findByPk($subject->SUBJECT_ID)->NAME;
                    $marks = StudentMarks::model()->find('STUDENT_ID='.$student->ID.' AND SUBJECT_ID='.$subject->SUBJECT_ID);
					$markArray = array('SUBJECT'=>$subjectNAME, 'MAX_MARKS'=>$marks->MAX_MARKS, 'OBTAINED_MARKS'=>$marks->OBTAINED_MARKS);
					array_push($marks_array, $markArray);
				}
				$this->result["MARKS"] = $marks_array;
				
			}
			else{
				echo "<script type='text/javascript'>alert('Student not found')</script>";
			}
		}
		
		$this->render('viewResult',array(
			'model'=>$model,
		));
	}
	
	public function actionUpload(){
		$model=new Student;
		
		if(isset($_POST['Student']))
		{
			$COURSE_ID = $_POST['StudentCourse']['COURSE_ID'];
			$UploadFile = CUploadedFile::getInstance($model, 'file');
			if($UploadFile !== null){ 
				$FileExt=$UploadFile->getExtensionName();
				if($FileExt=="xls" || $FileExt=="xlsx"){
					$FileNewName = Yii::getPathOfAlias("webroot")."/upload/".time().".".$FileExt;
					$UploadFile->saveAs($FileNewName);
					Yii::import('application.extensions.JPhpExcelReader.Spreadsheet_Excel_Reader');      
					$data = new Spreadsheet_Excel_Reader($FileNewName); 
					$this->importStatus=array();
					if(intVal($data->sheets[0]['numRows']) === count($data->sheets[0]['cells'])){
						for ($j = 2; $j <= $data->sheets[0]['numRows']; $j++) {
							$NAME=$data->sheets[0]['cells'][$j][1];
							$FATHER=$data->sheets[0]['cells'][$j][2];
							$MOTHER=$data->sheets[0]['cells'][$j][3];
							$ADDRESS=$data->sheets[0]['cells'][$j][4];
							$PHONE=$data->sheets[0]['cells'][$j][5];
							$REG_ID=$data->sheets[0]['cells'][$j][6];
							$ROLL_NO=$data->sheets[0]['cells'][$j][7];						
							if(Student::model()->exists('NAME="'.$NAME.'" AND FATHER="'.$FATHER.'" AND MOTHER="'.$MOTHER.'"')){
								array_push($this->importStatus,array(" <b>Student Name: </b>".$NAME." already exists in database","fail"));
							}
							else
							{
								$studentModel = new Student;
								$studentModel->NAME=$NAME;
								$studentModel->FATHER=$FATHER;
								$studentModel->MOTHER=$MOTHER;
								$studentModel->ADDRESS=$ADDRESS;
								$studentModel->PHONE=$PHONE;
								$studentModel->NAME=$NAME;
								$studentModel->REG_ID=$REG_ID;
								$studentModel->ROLL_NO=$ROLL_NO;
								if($studentModel->save(false)){
									$studentCourse = new StudentCourse;
									$studentCourse->COURSE_ID = $COURSE_ID;
									$studentCourse->STUDENT_ID = $studentModel->ID;
									$studentCourse->STATUS = 1;
									$studentCourse->save(false);
									array_push($this->importStatus,array("<b>Student Name :</b> ".$NAME." successfully saved ","success"));
								}
									
							}
						}						
					}
					else{
						array_push($this->importStatus,array("You have left blank rows in Excel. Please remove them before upload. ","warning"));
					}
					unlink($FileNewName);
				}
				else{
					$this->redirect(array('upload','message'=>1));
				}
			}
	
		}
		$this->render('upload',array(
			'model'=>$model,
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Student;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Student']))
		{
			$model->attributes=$_POST['Student'];
			if($model->save(false)){
				$studentCourse = new StudentCourse;
				$studentCourse->STUDENT_ID = $model->ID;
				$studentCourse->COURSE_ID = $_POST['StudentCourse']['COURSE_ID'];
				$studentCourse->STATUS = 1;
				$studentCourse->save(false);
				$this->redirect(array('admin'));
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

		if(isset($_POST['Student']))
		{
			$model->attributes=$_POST['Student'];
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
		$dataProvider=new CActiveDataProvider('Student');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Student('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Student']))
			$model->attributes=$_GET['Student'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Student the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Student::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Student $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='student-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
