<?php mb_internal_encoding("8bit");?>
<div class="container-fluid">
	<header class="section-header">
		<div class="tbl">
			<div class="tbl-row">
				<div class="tbl-cell">
					<h2>Upload Student</h2>
					<div class="subtitle"></div>
				</div>
			</div>
		</div>
	</header>
	<div class="box-typical box-typical-padding">
		<?php $form=$this->beginWidget('CActiveForm', array(
		'id'=>'student-form',
		// Please note: When you enable ajax validation, make sure the corresponding
		// controller action is handling ajax validation correctly.
		// There is a call to performAjaxValidation() commented in generated controller code.
		// See class documentation of CActiveForm for details on this.
		'enableAjaxValidation'=>false,
		'htmlOptions'=>array('enctype'=>'multipart/form-data'),
	)); ?>
		<div class="form-group row">
			<?php echo $form->labelEx($model,'COURSE_ID', array('class'=>'col-sm-2 form-control-label')); ?>
			<div class="col-sm-10">
				<p class="form-control-static">
					<?php 
					$studentCourse = StudentCourse::model();
					echo $form->dropDownList($studentCourse,'COURSE_ID',CHtml::listData(Course::model()->findAll(), 'ID', 'NAME'), array(
					'empty'=>array('0'=>'Select Course'),
					'options' => array("'".$studentCourse->COURSE_ID."'" => array('selected'=>true)),
					'disabled'=>Yii::app()->controller->action->id == 'update')); ?>
				</p>
			</div>
		</div>
		<div class="form-group row">
			<?php echo $form->labelEx($model,'file', array('class'=>'col-sm-2 form-control-label')); ?>
			<div class="col-sm-10">
				<p class="form-control-static">
					<?php echo $form->fileField($model, 'file',array('id'=>'flFile')); ?>
				<span>Select only <b>.xls</b> File</span>
				</p>
			</div>
		</div>
		
		<div class="form-group row">
			<label class='col-sm-2 form-control-label'></label>
			<div class="col-sm-10">
				<p class="form-control-static">
					<?php echo CHtml::submitButton('Upload', array('class'=>'btn btn-inline')); ?>
				</p>
			</div>
		</div>

	<?php $this->endWidget(); ?>

	</div><!-- form -->
	<div>
		<?php 
			if(count($this->importStatus)> 0){
				foreach($this->importStatus as $status){
				?>
					<p class="<?php echo $status[1];?>"><?php echo $status[0];?></p>
				<?php
				}
			}
		?>
	</div>
	</div>
</div>

