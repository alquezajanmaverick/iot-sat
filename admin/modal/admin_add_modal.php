<!-- Edit -->
<div class="modal fade" id="addnew" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header py-2 px-0">
            	<div class="row float-left ml-2"><h4 class="modal-title float-left" id="myModalLabel"><i class="fa-solid fa-plus mr-1"></i>Add New Admin</h4></div>
                <div class="row float-right mr-2"><button type="button" class="close float-right" data-dismiss="modal" aria-hidden="true">&times;</button></div>
            </div>
            <div class="modal-body">
			<div class="px-2">
			<form method="POST">
				<div class="row form-group">
					<div class="col-sm-4">
						<label class="control-label modal-label">First Name</label>
					</div>
					<div class="col-sm-8">
						<input type="text" class="form-control" name="first_name" value="" placeholder="Input first name.." required>
					</div>
				</div>
				<div class="row form-group">
					<div class="col-sm-4">
						<label class="control-label modal-label">Middle Name</label>
					</div>
					<div class="col-sm-8">
						<input type="text" class="form-control" name="mid_name" value="" placeholder="Input middle name..">
					</div>
				</div>
				<div class="row form-group">
					<div class="col-sm-4">
						<label class="control-label modal-label">Last Name</label>
					</div>
					<div class="col-sm-8">
						<input type="text" class="form-control" name="last_name" value="" placeholder="Input last name.." required>
					</div>
				</div>
				<div class="row form-group">
					<div class="col-sm-4">
						<label class="control-label modal-label">Extension Name</label>
					</div>
					<div class="col-sm-8">
						<input type="text" class="form-control" name="ext_name" value="" placeholder="Input extension name..">
					</div>
				</div>
				<div class="row form-group">
					<div class="col-sm-4">
						<label class="control-label modal-label">Email</label>
					</div>
					<div class="col-sm-8">
						<input type="email" class="form-control" name="email" value="" placeholder="Input email.." required>
					</div>
				</div>
				<div class="row form-group">
					<div class="col-sm-4">
						<label class="control-label modal-label">Password</label>
					</div>
					<div class="col-sm-8">
						<input type="password" class="form-control" name="password" value="" placeholder="Input password.." required>
					</div>
				</div>
				<div class="row form-group">
					<div class="col-sm-4">
						<label class="control-label modal-label">Confirm Password</label>
					</div>
					<div class="col-sm-8">
						<input type="password" class="form-control" name="confirm_password" value="" placeholder="Confirm password.." required>
					</div>
				</div>
            </div> 
			</div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                <button type="submit" name="edit" class="btn btn-primary" id="addAdmin"></i>Save</a>
			</form>
            </div>

        </div>
    </div>
</div>
