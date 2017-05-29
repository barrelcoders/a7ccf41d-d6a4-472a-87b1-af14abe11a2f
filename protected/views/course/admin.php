<div class="container-fluid">
	<header class="section-header">
		<div class="tbl">
			<div class="tbl-row">
				<div class="tbl-cell">
					<h2>Manage Course</h2>
					<div class="subtitle"></div>
				</div>
			</div>
		</div>
	</header>
	<div class="box-typical box-typical-padding">
		<?php $this->widget('zii.widgets.grid.CGridView', array(
			'id'=>'course-grid',
			'itemsCssClass' => 'table table-bordered table-hover',
			'dataProvider'=>$model->search(),
			'filter'=>$model,
			'columns'=>array(
				'NAME',
				array(
					'header'=>'Subjects',
					'type'=>'raw',
					'value'=>function ($data){ 
						$CourseSubjects = CourseSubjects::model()->findAll('COURSE_ID='.$data->ID);
						$subjects = array();
						foreach($CourseSubjects as $subject){
							array_push($subjects, Subject::model()->findByPk($subject->SUBJECT_ID)->NAME);
						}
						return implode(", ", $subjects);
					}
				),
				array(
					'class'=>'CButtonColumn',
					'htmlOptions' => array('style'=>'width:100px'),
					'template' => '{view}{update}{delete}',
					'buttons'=>array
					(
						'view' => array
						(
							'url'=>'Yii::app()->createUrl("Course/View", array("id"=>$data->ID))',
							'options'=>array('class'=>'glyphicon glyphicon-search'),
							'imageUrl'=>'',
							'label'=>''
						),
						'update' => array
						(
							'url'=>'Yii::app()->createUrl("Course/Update", array("id"=>$data->ID))',
							'options'=>array('class'=>'glyphicon glyphicon-pencil'),
							'imageUrl'=>'',
							'label'=>''
						),
						'delete' => array
						(
							'url'=>'Yii::app()->createUrl("Course/Delete", array("id"=>$data->ID))',
							'options'=>array('class'=>'glyphicon glyphicon-trash'),
							'imageUrl'=>'',
							'label'=>''
						),
					),
				),
			),
		)); ?>

	</div>
</div>
<style>
	a{color:#000; text-decoration: none;border:none !important;margin-right: 5px;}
	a:hover{color:#000;text-decoration: underline;}
</style>




