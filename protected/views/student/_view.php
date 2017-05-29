<?php
/* @var $this StudentController */
/* @var $data Student */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('ID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->ID), array('view', 'id'=>$data->ID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('NAME')); ?>:</b>
	<?php echo CHtml::encode($data->NAME); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('FATHER')); ?>:</b>
	<?php echo CHtml::encode($data->FATHER); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('MOTHER')); ?>:</b>
	<?php echo CHtml::encode($data->MOTHER); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ADDRESS')); ?>:</b>
	<?php echo CHtml::encode($data->ADDRESS); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('PHONE')); ?>:</b>
	<?php echo CHtml::encode($data->PHONE); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('REG_ID')); ?>:</b>
	<?php echo CHtml::encode($data->REG_ID); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('ROLL_NO')); ?>:</b>
	<?php echo CHtml::encode($data->ROLL_NO); ?>
	<br />

	*/ ?>

</div>