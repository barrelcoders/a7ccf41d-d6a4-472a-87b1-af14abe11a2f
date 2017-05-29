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
			<label class='col-sm-2 form-control-label'>COURSE</label>
			<div class="col-sm-10">
				<p class="form-control-static">
					<span><?php echo Course::model()->findByPK(StudentCourse::model()->find('STUDENT_ID='.$model->ID.' AND STATUS=1')->COURSE_ID)->NAME;?></span>
				</p>
			</div>
		</div>
		<div class="form-group row">
			<label class='col-sm-2 form-control-label'>FATHER NAME</label>
			<div class="col-sm-10">
				<p class="form-control-static">
					<span><?php echo $model->FATHER;?></span>
				</p>
			</div>
		</div>
		<div class="form-group row">
			<label class='col-sm-2 form-control-label'>MOTHER NAME</label>
			<div class="col-sm-10">
				<p class="form-control-static">
					<span><?php echo $model->MOTHER;?></span>
				</p>
			</div>
		</div>
		<div class="form-group row">
			<label class='col-sm-2 form-control-label'>ADDRESS</label>
			<div class="col-sm-10">
				<p class="form-control-static">
					<span><?php echo $model->ADDRESS;?></span>
				</p>
			</div>
		</div>
		<div class="form-group row">
			<label class='col-sm-2 form-control-label'>PHONE</label>
			<div class="col-sm-10">
				<p class="form-control-static">
					<span><?php echo $model->PHONE;?></span>
				</p>
			</div>
		</div>
		<div class="form-group row">
			<label class='col-sm-2 form-control-label'>REGISTRATION ID</label>
			<div class="col-sm-10">
				<p class="form-control-static">
					<span><?php echo $model->REG_ID;?></span>
				</p>
			</div>
		</div>
		<div class="form-group row">
			<label class='col-sm-2 form-control-label'>ROLL NO</label>
			<div class="col-sm-10">
				<p class="form-control-static">
					<span><?php echo $model->ROLL_NO;?></span>
				</p>
			</div>
		</div>
	</div>
</div>
