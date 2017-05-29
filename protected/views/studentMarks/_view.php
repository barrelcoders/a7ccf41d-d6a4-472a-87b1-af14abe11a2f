<?php
/* @var $this StudentMarksController */
/* @var $data StudentMarks */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('ID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->ID), array('view', 'id'=>$data->ID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('STUDENT_ID')); ?>:</b>
	<?php echo CHtml::encode($data->STUDENT_ID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('SUBJECT_ID')); ?>:</b>
	<?php echo CHtml::encode($data->SUBJECT_ID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('MAX_MARKS')); ?>:</b>
	<?php echo CHtml::encode($data->MAX_MARKS); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('OBTAINED_MARKS')); ?>:</b>
	<?php echo CHtml::encode($data->OBTAINED_MARKS); ?>
	<br />


</div>