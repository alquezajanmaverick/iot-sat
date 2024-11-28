<!-- Edit -->
<div class="modal fade" id="edit_<?php echo $department_id; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header py-2 px-0">
            	<div class="row float-left ml-2"><h4 class="modal-title float-left" id="myModalLabel"><i class="fa-solid fa-pen-to-square mr-1"></i>Edit Department</h4></div>
                <div class="row float-right mr-2"><button type="button" class="close float-right" data-dismiss="modal" aria-hidden="true">&times;</button></div>
            </div>
            <div class="modal-body">
			<div class="px-2">
			<form method="POST">
				<input type="hidden" class="form-control" name="department_id" value="<?php echo $department_id; ?>" required>
				<div class="row form-group">
					<div class="col-sm-4">
						<label class="control-label modal-label">Department Code</label>
					</div>
					<div class="col-sm-8">
						<input type="text" class="form-control" name="department_code" value="<?php echo $department_code; ?>" placeholder="Input department code.." required>
					</div>
				</div>
				<div class="row form-group">
					<div class="col-sm-4">
						<label class="control-label modal-label">Department Name</label>
					</div>
					<div class="col-sm-8">
						<textarea class="form-control" name="department_name" value="" rows="4" placeholder="Input department name.." required><?php echo $department_name; ?></textarea>
					</div>
				</div>
            </div> 
			</div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="submit" name="edit" class="btn btn-success" id="updateDepartment_<?php echo $department_id; ?>"></i>Update</a>
			</form>
            </div>

        </div>
    </div>
</div>
