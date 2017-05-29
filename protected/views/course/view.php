<div class="container-fluid">
	<header class="section-header">
		<div class="tbl">
			<div class="tbl-row">
				<div class="tbl-cell">
					<h2><?php echo $model->NAME?> Details</h2>
					<div class="subtitle"></div>
				</div>
			</div>
		</div>
	</header>
	<div class="box-typical box-typical-padding">
		<div class="form-group row">
			<label class='col-sm-2 form-control-label'>NAME</label>
			<div class="col-sm-10">
				<p class="form-control-static">
					<span><?php echo $model->NAME;?></span>
				</p>
			</div>
		</div>
		<div class="form-group row">
			<label class='col-sm-2 form-control-label'>SUBJECTS</label>
			<div class="col-sm-10">
				<p class="form-control-static">
					<?php 
						$subjects = CourseSubjects::model()->findAll('COURSE_ID='.$model->ID);
						foreach($subjects as $subject){
							?>
								<p><?php echo Subject::model()->findByPK($subject->SUBJECT_ID)->NAME;?></p>
							<?php
						}
					?>
				</p>
			</div>
		</div>
	</div>
</div>