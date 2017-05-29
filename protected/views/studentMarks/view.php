<?php
/* @var $this StudentMarksController */
/* @var $model StudentMarks */

$this->breadcrumbs=array(
	'Student Marks'=>array('index'),
	$model->ID,
);

$this->menu=array(
	array('label'=>'List StudentMarks', 'url'=>array('index')),
	array('label'=>'Create StudentMarks', 'url'=>array('create')),
	array('label'=>'Update StudentMarks', 'url'=>array('update', 'id'=>$model->ID)),
	array('label'=>'Delete StudentMarks', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->ID),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage StudentMarks', 'url'=>array('admin')),
);
?>

<h1>View StudentMarks #<?php echo $model->ID; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'ID',
		'STUDENT_ID',
		'SUBJECT_ID',
		'MAX_MARKS',
		'OBTAINED_MARKS',
	),
)); ?>
