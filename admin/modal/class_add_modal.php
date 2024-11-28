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
								<label class="control-label modal-label">Program</label>
							</div>
							<div class="col-sm-8">
								<select class="form-control custom-select" name="program_id" required>
		                            <option value="" selected disabled>-- Select Program --</option>
		                            <?php

		                                    $sqlFetchDept = "SELECT * FROM program_tbl WHERE deleted = 0";
		                                    $resultFetchDept = $conn->query($sqlFetchDept);

		                                    if ($resultFetchDept->num_rows > 0) {
		                                        
		                                        while ($rowFetchDept = $resultFetchDept->fetch_assoc()) {

		                                            $program_id = $rowFetchDept['program_id'];
		                                            $program_code = $rowFetchDept['program_code'];
		                                            echo "<option value='$program_id'>$program_code</option>";
		                                        }
		                                        
		                                    } else{
		                                        echo "<option value='none' selected disabled>No program available</option>";
		                                    }

		                            ?>
		                        </select>
							</div>
						</div>
						<div class="row form-group">
							<div class="col-sm-4">
								<label class="control-label modal-label">Year</label>
							</div>
							<div class="col-sm-8">
								<select class="form-control custom-select" name="year" required>
		                            <option value="" selected disabled>-- Select Year --</option>
		                            <option value="1">1st Year</option>
		                            <option value="2">2nd Year</option>
		                            <option value="3">3rd Year</option>
		                            <option value="4">4th Year</option>
		                        </select>
							</div>
						</div>
						<div class="row form-group">
							<div class="col-sm-4">
								<label class="control-label modal-label">Section</label>
							</div>
							<div class="col-sm-8">
								<select class="form-control custom-select" name="section" required>
		                            <option value="" selected disabled>-- Select Section --</option>
		                            <option value="A">A</option>
		                            <option value="B">B</option>
		                            <option value="C">C</option>
		                            <option value="D">D</option>
		                            <option value="D">E</option>
		                        </select>
							</div>
						</div>
		            </div>
				</div>
	            <div class="modal-footer">
	                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
	                <button type="submit" name="edit" class="btn btn-primary" id="addClass"></i>Save</a>
	            </div>
			</form>
        </div>
    </div>
</div>
