<!-- Edit -->
<div class="modal fade" id="edit_<?php echo $program_id; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header py-2 px-0">
            	<div class="row float-left ml-2"><h4 class="modal-title float-left" id="myModalLabel"><i class="fa-solid fa-pen-to-square mr-1"></i>Edit Program</h4></div>
                <div class="row float-right mr-2"><button type="button" class="close float-right" data-dismiss="modal" aria-hidden="true">&times;</button></div>
            </div>
            <div class="modal-body">
			<div class="px-2">
			<form method="POST">
				<input type="hidden" class="form-control" name="program_id" value="<?php echo $program_id; ?>" required>
				<div class="row form-group">
					<div class="col-sm-4">
						<label class="control-label modal-label">Program Code</label>
					</div>
					<div class="col-sm-8">
						<input type="text" class="form-control" name="program_code" value="<?php echo $program_code; ?>" placeholder="Input department code.." required>
					</div>
				</div>
				<div class="row form-group">
					<div class="col-sm-4">
						<label class="control-label modal-label">Program Name</label>
					</div>
					<div class="col-sm-8">
						<textarea class="form-control" name="program_name" value="" rows="4" placeholder="Input department name.." required><?php echo $program_name; ?></textarea>
					</div>
				</div>
				<div class="row form-group">
					<div class="col-sm-4">
						<label class="control-label modal-label">Department</label>
					</div>
					<div class="col-sm-8">
                        <select class="form-control custom-select" name="department_id">
                            <?php

                                    $sqlFetchHost = "SELECT * FROM department_tbl WHERE deleted = 0";
                                    $resultFetchHost = $conn->query($sqlFetchHost);

                                    if ($resultFetchHost->num_rows > 0) {
                                        
                                        while ($rowFetchHost = $resultFetchHost->fetch_assoc()) {

                                            $dept_id = $rowFetchHost['department_id'];
                                            $dept = $rowFetchHost['department_code'];
                                            $selected = ($dept_id == $department_id) ? 'selected' : '';
                                            echo "<option value='$dept_id' $selected>$dept</option>";
                                        }
                                        
                                    } else{
                                        echo "<option value='none' selected disabled>No department available</option>";
                                    }

                            ?>
                        </select>
					</div>
				</div>
            </div> 
			</div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="submit" name="edit" class="btn btn-success" id="updateProgram_<?php echo $program_id; ?>"></i>Update</a>
			</form>
            </div>

        </div>
    </div>
</div>
