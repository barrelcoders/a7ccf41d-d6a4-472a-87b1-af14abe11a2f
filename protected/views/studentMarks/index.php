<?php
/* @var $this StudentMarksController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Student Marks',
);

$this->menu=array(
	array('label'=>'Create StudentMarks', 'url'=>array('create')),
	array('label'=>'Manage StudentMarks', 'url'=>array('admin')),
);
?>

<h1>Student Marks</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
