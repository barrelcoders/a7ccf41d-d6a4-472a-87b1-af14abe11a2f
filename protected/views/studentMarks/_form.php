<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'student-marks-form',
	'enableAjaxValidation'=>false,
)); ?>
    <div class="form-group row">
		<?php echo $form->labelEx($model,'COURSE_ID', array('class'=>'col-sm-2 form-control-label')); ?>
		<div class="col-sm-10">
			<p class="form-control-static">
				<?php 
				$studentCourse = StudentCourse::model();
				echo $form->dropDownList($studentCourse,'COURSE_ID',CHtml::listData(Course::model()->findAll(), 'ID', 'NAME'), array(
				'empty'=>array('0'=>'Select Course'),
				'options' => array("'".$studentCourse->COURSE_ID."'" => array('selected'=>true)),
				'disabled'=>Yii::app()->controller->action->id == 'update')); ?>
			</p>
		</div>
	</div>
    <div id="content">
        
    </div>
	<div class="form-group row">
		<label class='col-sm-2 form-control-label'></label>
		<div class="col-sm-10">
			<p class="form-control-static">
				<?php echo CHtml::button('Load Students', array('class'=>'btn btn-inline', 'id'=>'btnLoadStudents')); ?>
                <?php echo CHtml::submitButton('Save Marks', array('class'=>'btn btn-inline')); ?>
			</p>
		</div>
	</div>

<?php $this->endWidget(); ?>
<script type="text/javascript">
    $(document).ready(function(){
        $('#btnLoadStudents').click(function(){
            var courseId = $("#StudentCourse_COURSE_ID").val(), content = "";
            $.post("<?php echo Yii::app()->createUrl('StudentMarks/LoadMarks')?>&course="+courseId,{},
               function(data){
                    data = JSON.parse(data);
                    if(data.length > 0){
                        content +="<table class='table table-bordered table-hover'>\
					                   <tbody>";
						for(var i=0; i<=data.length-1; i++){
                            content +="<tr>\
                                        <td rowspan='"+data[i].MARKS.length+"'>"+data[i].NAME+"<input type='hidden' name='StudentMarks[Student]["+data[i].ID+"][STUDENT_ID]' value='"+data[i].ID+"'></td>";
                            
                            for(var j=0; j<=data[i].MARKS.length-1; j++){
                                if(j==0){
                                    content +="<td>"+data[i].MARKS[j].SUBJECT_NAME+"<input type='hidden' name='StudentMarks[Student]["+data[i].ID+"][Subject]["+j+"]Id' value='"+data[i].ID+"'><input type='hidden' name='StudentMarks[Student]["+data[i].ID+"][Subject]["+j+"][SUBJECT_ID]' value='"+data[i].MARKS[j].ID+"'/></td>\
                                       <td><input type='text' name='StudentMarks[Student]["+data[i].ID+"][Subject]["+j+"][MAX_MARKS]' value='"+data[i].MARKS[j].MAX_MARKS+"'/></td>\
                                       <td><input type='text' name='StudentMarks[Student]["+data[i].ID+"][Subject]["+j+"][OBTAINED_MARKS]' value='"+data[i].MARKS[j].OBT_MARKS+"'/></td>";
                                }
                                else{
                                    content +="</tr><tr><td>"+data[i].MARKS[j].SUBJECT_NAME+"<input type='hidden' name='StudentMarks[Student]["+data[i].ID+"][Subject]["+j+"]Id' value='"+data[i].ID+"'><input type='hidden' name='StudentMarks[Student]["+data[i].ID+"][Subject]["+j+"][SUBJECT_ID]' value='"+data[i].MARKS[j].ID+"'/></td>\
                                       <td><input type='text' name='StudentMarks[Student]["+data[i].ID+"][Subject]["+j+"][MAX_MARKS]' value='"+data[i].MARKS[j].MAX_MARKS+"'/></td>\
                                       <td><input type='text' name='StudentMarks[Student]["+data[i].ID+"][Subject]["+j+"][OBTAINED_MARKS]' value='"+data[i].MARKS[j].OBT_MARKS+"'/></td></tr>";
                                }
                            }
                        }
                        content += "</tbody></table>";
                        $('#content').html(content);
                    }
                    else{
                        alert('No Records Found');
                    }
               });
            
        });
    });
</script>
