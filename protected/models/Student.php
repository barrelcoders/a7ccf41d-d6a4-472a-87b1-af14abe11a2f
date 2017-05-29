<?php

/**
 * This is the model class for table "tbl_student".
 *
 * The followings are the available columns in table 'tbl_student':
 * @property string $ID
 * @property string $NAME
 * @property string $FATHER
 * @property string $MOTHER
 * @property string $ADDRESS
 * @property string $PHONE
 * @property string $REG_ID
 * @property string $ROLL_NO
 */
class Student extends CActiveRecord
{
	public $file;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_student';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('NAME, FATHER, MOTHER, ADDRESS, PHONE, REG_ID, ROLL_NO', 'required'),
			array('NAME, FATHER, MOTHER', 'length', 'max'=>100),
			array('ADDRESS', 'length', 'max'=>500),
			array('PHONE, REG_ID, ROLL_NO', 'length', 'max'=>45),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('ID, NAME, FATHER, MOTHER, ADDRESS, PHONE, REG_ID, ROLL_NO', 'safe', 'on'=>'search'),
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
			'NAME' => 'Name',
			'FATHER' => 'Father Name',
			'MOTHER' => 'Mother Name',
			'ADDRESS' => 'Address',
			'PHONE' => 'Phone',
			'REG_ID' => 'Registration ID',
			'ROLL_NO' => 'Roll No',
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
		$criteria->compare('NAME',$this->NAME,true);
		$criteria->compare('FATHER',$this->FATHER,true);
		$criteria->compare('MOTHER',$this->MOTHER,true);
		$criteria->compare('ADDRESS',$this->ADDRESS,true);
		$criteria->compare('PHONE',$this->PHONE,true);
		$criteria->compare('REG_ID',$this->REG_ID,true);
		$criteria->compare('ROLL_NO',$this->ROLL_NO,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Student the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
