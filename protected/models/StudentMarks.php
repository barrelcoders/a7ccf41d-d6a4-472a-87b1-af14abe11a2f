<?php

/**
 * This is the model class for table "tbl_student_marks".
 *
 * The followings are the available columns in table 'tbl_student_marks':
 * @property string $ID
 * @property string $STUDENT_ID
 * @property string $SUBJECT_ID
 * @property string $MAX_MARKS
 * @property string $OBTAINED_MARKS
 */
class StudentMarks extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_student_marks';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('STUDENT_ID, SUBJECT_ID, OBTAINED_GRADE', 'required'),
			array('STUDENT_ID, SUBJECT_ID, OBTAINED_GRADE', 'length', 'max'=>10),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('ID, STUDENT_ID, SUBJECT_ID, OBTAINED_GRADE', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ID' => 'ID',
			'STUDENT_ID' => 'Student',
			'SUBJECT_ID' => 'Subject',
			'OBTAINED_GRADE' => 'Obtained Grade',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('ID',$this->ID,true);
		$criteria->compare('STUDENT_ID',$this->STUDENT_ID,true);
		$criteria->compare('SUBJECT_ID',$this->SUBJECT_ID,true);
		$criteria->compare('OBTAINED_GRADE',$this->OBTAINED_GRADE,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return StudentMarks the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
