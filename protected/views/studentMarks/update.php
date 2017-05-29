<?php
/* @var $this StudentMarksController */
/* @var $model StudentMarks */

$this->breadcrumbs=array(
	'Student Marks'=>array('index'),
	$model->ID=>array('view','id'=>$model->ID),
	'Update',
);

$this->menu=array(
	array('label'=>'List StudentMarks', 'url'=>array('index')),
	array('label'=>'Create StudentMarks', 'url'=>array('create')),
	array('label'=>'View StudentMarks', 'url'=>array('view', 'id'=>$model->ID)),
	array('label'=>'Manage StudentMarks', 'url'=>array('admin')),
);
?>

<h1>Update StudentMarks <?php echo $model->ID; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>