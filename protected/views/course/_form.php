<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'course-form',
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
		<label class="col-sm-2 form-control-label">Subjects</label>
		<div class="col-sm-10">
			<p class="form-control-static">
				<div class="small-container"  style="background: #CCC;padding: 10px;">
					<?php
						$subjects = Subject::model()->findAll();
						foreach($subjects as $subject){
							?>
								<input type="checkBox" name="Course[Subjects][]" value="<?php echo $subject->ID;?>"><span><?php echo $subject->NAME;?></span><br/>
							<?php
						}
					?>
				</div>
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