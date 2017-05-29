<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'student-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<div class="form-group row">
		<?php echo $form->labelEx($model,'NAME', array('class'=>'col-sm-2 form-control-label')); ?>
		<div class="col-sm-10">
			<p class="form-control-static">
				<?php echo $form->textField($model,'NAME',array('size'=>60,'maxlength'=>100, 'value'=>$model->NAME)); ?>
			</p>
		</div>
	</div>
	<div class="form-group row">
		<?php echo $form->labelEx($model,'COURSE_ID', array('class'=>'col-sm-2 form-control-label')); ?>
		
		<?php 
		if(strtoupper(Yii::app()->controller->action->id) == 'UPDATE'){
		?>
			<div class="col-sm-10">
				<p class="form-control-static">
				<?php 
				echo $form->dropDownList(StudentCourse::model(),'COURSE_ID',CHtml::listData(Course::model()->findAll(), 'ID', 'NAME'), array(
				'empty'=>array('0'=>'Select Course'),
				'options' => array(StudentCourse::model()->find('STUDENT_ID='.$model->ID.' AND STATUS = 1')->COURSE_ID => array('selected'=>true)))); ?>							
				</p>
			</div>
		<?php
		}
		else{
		?>
			<div class="col-sm-10">
				<p class="form-control-static">
					<?php 
					echo $form->dropDownList(StudentCourse::model(),'COURSE_ID',CHtml::listData(Course::model()->findAll(), 'ID', 'NAME'), array(
					'empty'=>array('0'=>'Select Course'),)); ?>
				</p>
			</div>
		<?php	
		}
		?>
	</div>
	<div class="form-group row">
		<?php echo $form->labelEx($model,'FATHER', array('class'=>'col-sm-2 form-control-label')); ?>
		<div class="col-sm-10">
			<p class="form-control-static">
				<?php echo $form->textField($model,'FATHER',array('size'=>60,'maxlength'=>100, 'value'=>$model->FATHER)); ?>
			</p>
		</div>
	</div>
	<div class="form-group row">
		<?php echo $form->labelEx($model,'MOTHER', array('class'=>'col-sm-2 form-control-label')); ?>
		<div class="col-sm-10">
			<p class="form-control-static">
				<?php echo $form->textField($model,'MOTHER',array('size'=>60,'maxlength'=>100, 'value'=>$model->MOTHER)); ?>
			</p>
		</div>
	</div>
	<div class="form-group row">
		<?php echo $form->labelEx($model,'ADDRESS', array('class'=>'col-sm-2 form-control-label')); ?>
		<div class="col-sm-10">
			<p class="form-control-static">
				<?php echo $form->textField($model,'ADDRESS',array('size'=>60,'maxlength'=>100, 'value'=>$model->ADDRESS)); ?>
			</p>
		</div>
	</div>
	<div class="form-group row">
		<?php echo $form->labelEx($model,'PHONE', array('class'=>'col-sm-2 form-control-label')); ?>
		<div class="col-sm-10">
			<p class="form-control-static">
				<?php echo $form->textField($model,'PHONE',array('size'=>60,'maxlength'=>100, 'value'=>$model->PHONE)); ?>
			</p>
		</div>
	</div>
	<div class="form-group row">
		<?php echo $form->labelEx($model,'REG_ID', array('class'=>'col-sm-2 form-control-label')); ?>
		<div class="col-sm-10">
			<p class="form-control-static">
				<?php echo $form->textField($model,'REG_ID',array('size'=>60,'maxlength'=>100, 'value'=>$model->REG_ID)); ?>
			</p>
		</div>
	</div>
	<div class="form-group row">
		<?php echo $form->labelEx($model,'ROLL_NO', array('class'=>'col-sm-2 form-control-label')); ?>
		<div class="col-sm-10">
			<p class="form-control-static">
				<?php echo $form->textField($model,'ROLL_NO',array('size'=>60,'maxlength'=>100, 'value'=>$model->ROLL_NO)); ?>
			</p>
		</div>
	</div>
	<div class="form-group row">
		<label class='col-sm-2 form-control-label'></label>
		<div class="col-sm-10">
			<p class="form-control-static">
				<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('class'=>'btn btn-inline')); ?>
			</p>
		</div>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->