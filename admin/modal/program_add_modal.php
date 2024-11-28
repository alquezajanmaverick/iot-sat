<!-- Edit -->
<div class="modal fade" id="addnew" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header py-2 px-0">
            	<div class="row float-left ml-2"><h4 class="modal-title float-left" id="myModalLabel"><i class="fa-solid fa-plus mr-1"></i>Add New Program</h4></div>
                <div class="row float-right mr-2"><button type="button" class="close float-right" data-dismiss="modal" aria-hidden="true">&times;</button></div>
            </div>
            <form method="POST">
	            <div class="modal-body">
					<div class="px-2">
						<div class="row form-group">
							<div class="col-sm-4">
								<label class="control-label modal-label">Program Code</label>
							</div>
							<div class="col-sm-8">
								<input type="text" class="form-control" name="program_code" placeholder="Input program code.." required>
							</div>
						</div>
						<div class="row form-group">
							<div class="col-sm-4">
								<label class="control-label modal-label">Program Name</label>
							</div>
							<div class="col-sm-8">
								<textarea class="form-control" name="program_name" rows="4" placeholder="Input program name.." required></textarea>
							</div>
						</div>
						<div class="row form-group">
							<div class="col-sm-4">
								<label class="control-label modal-label">Department</label>
							</div>
							<div class="col-sm-8">
								<select class="form-control custom-select" name="department_id" required>
		                            <option value="" selected disabled>-- Select Department --</option>
		                            <?php

		                                    $sqlFetchDept = "SELECT * FROM department_tbl WHERE deleted = 0";
		                                    $resultFetchDept = $conn->query($sqlFetchDept);

		                                    if ($resultFetchDept->num_rows > 0) {
		                                        
		                                        while ($rowFetchDept = $resultFetchDept->fetch_assoc()) {

		                                            $dept_id = $rowFetchDept['department_id'];
		                                            $dept_code = $rowFetchDept['department_code'];
		                                            echo "<option value='$dept_id'>$dept_code</option>";
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
	                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
	                <button type="submit" name="edit" class="btn btn-primary" id="addProgram"></i>Save</a>
	            </div>
			</form>
        </div>
    </div>
</div>
