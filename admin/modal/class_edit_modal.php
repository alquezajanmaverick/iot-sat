<!-- Edit -->
<div class="modal fade" id="edit_<?php echo $class_id; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header py-2 px-0">
            	<div class="row float-left ml-2"><h4 class="modal-title float-left" id="myModalLabel"><i class="fa-solid fa-pen-to-square mr-1"></i>Edit Class</h4></div>
                <div class="row float-right mr-2"><button type="button" class="close float-right" data-dismiss="modal" aria-hidden="true">&times;</button></div>
            </div>
            <div class="modal-body">
			<div class="px-2">
			<form method="POST">
				<input type="hidden" class="form-control" name="class_id" value="<?php echo $class_id; ?>" required>
				<div class="row form-group">
					<div class="col-sm-4">
						<label class="control-label modal-label">Program</label>
					</div>
					<div class="col-sm-8">
						<select class="form-control custom-select" id="program_id_<?php echo $class_id; ?>" name="program_id">
                            <?php
                                $sqlFetchHost = "SELECT * FROM program_tbl WHERE deleted = 0";
                                $resultFetchHost = $conn->query($sqlFetchHost);

                                if ($resultFetchHost->num_rows > 0) {
                                    
                                    while ($rowFetchHost = $resultFetchHost->fetch_assoc()) {

                                        $prog_id = $rowFetchHost['program_id'];
                                        $program_code = $rowFetchHost['program_code'];
                                        $selected = ($prog_id == $program_id) ? 'selected' : ''; 
                                        echo "<option value='$prog_id' $selected>$program_code</option>";
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
						<select class="form-control custom-select" id="year_<?php echo $class_id; ?>" name="year" required>
						    <option value="1" <?php echo $year == 1 ? 'selected' : ''; ?>>1st Year</option>
						    <option value="2" <?php echo $year == 2 ? 'selected' : ''; ?>>2nd Year</option>
						    <option value="3" <?php echo $year == 3 ? 'selected' : ''; ?>>3rd Year</option>
						    <option value="4" <?php echo $year == 4 ? 'selected' : ''; ?>>4th Year</option>
						</select>
					</div>
				</div>
				<div class="row form-group">
					<div class="col-sm-4">
						<label class="control-label modal-label">Section</label>
					</div>
					<div class="col-sm-8">
						<select class="form-control custom-select" id="section_<?php echo $class_id; ?>" name="section" required>
						    <option value="A" <?php echo $section == 'A' ? 'selected' : ''; ?>>A</option>
						    <option value="B" <?php echo $section == 'B' ? 'selected' : ''; ?>>B</option>
						    <option value="C" <?php echo $section == 'C' ? 'selected' : ''; ?>>C</option>
						    <option value="D" <?php echo $section == 'D' ? 'selected' : ''; ?>>D</option>
						    <option value="E" <?php echo $section == 'E' ? 'selected' : ''; ?>>E</option>
						</select>
					</div>
				</div>
            </div> 
			</div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="submit" name="edit" class="btn btn-success" id="updateClass_<?php echo $class_id; ?>"></i>Update</a>
			</form>
            </div>

        </div>
    </div>
</div>
