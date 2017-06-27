<header class="section-header">
	<div class="tbl">
		<div class="tbl-row">
			<div class="tbl-cell">
				<h2>Result</h2>
				<div class="subtitle"></div>
			</div>
		</div>
	</div>
</header>
<div class="container-fluid">
	<div class="box-typical box-typical-padding" >
	<?php $form=$this->beginWidget('CActiveForm', array(
		'id'=>'exp-form',
		'enableAjaxValidation'=>false,
	)); ?>

	<div class="form-group row">
		<label for="ROLL_NO" class="col-sm-2 form-control-label">ROLL NO</label>
		<div class="col-sm-10">
			<p class="form-control-static">
				<?php echo $form->textField($model,'ROLL_NO',array('size'=>45,'maxlength'=>45, 'value'=>$this->rollNo)); ?>
			</p>
		</div>
	</div>
	
	<div class="form-group row">
		<label class="col-sm-2 form-control-label"></label>
		<div class="col-sm-10">
			<p class="form-control-static">
				<?php echo CHtml::submitButton('View Result', array('class'=>'btn btn-inline')); ?>
			</p>
		</div>
	</div>
	
	<?php $this->endWidget(); ?>

	<?php
		if(isset($this->result) && count($this->result) > 0){
			?>
				<table class="table table-bordered table-hover">
					<tbody>
						<tr><td><b>NAME: </b><?php echo $this->result['NAME']?></td><td><b>ROLL NO: </b><?php echo $this->result['ROLL_NO']?></td><td><b>REGISTRATION ID: </b><?php echo $this->result['REG_ID']?></td></tr>
						<tr><td><b>COURSE: </b><?php echo $this->result['COURSE']?></td><td><b>FATHER NAME: </b><?php echo $this->result['FATHER']?></td><td><b>MOTHER NAME: </b><?php echo $this->result['MOTHER']?></td></tr>
						<tr>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
						</tr>
						<tr>
							<td colspan="2"><b>SUBJECT</b></td>
							<td><b>OBTAINED GRADES</b></td>
						</tr>
						<?php 
							foreach($this->result['MARKS'] as $mark){ 
						?>
						<tr>
							<td colspan="2"><?php echo $mark['SUBJECT']?></td>
							<td><?php echo $mark['OBTAINED_GRADES']?></td>
						</tr>
						<?php } ?>
					</tbody>
					</table>
			<?php
		}
	?>
	
	</div>
</div>
