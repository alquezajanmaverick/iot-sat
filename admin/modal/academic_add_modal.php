<!-- Edit -->
<div class="modal fade" id="addnew" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header py-2 px-0">
                <div class="row float-left ml-2"><h4 class="modal-title float-left" id="myModalLabel"><i class="fa-solid fa-plus mr-1"></i>Add New Academic Year</h4></div>
                <div class="row float-right mr-2"><button type="button" class="close float-right" data-dismiss="modal" aria-hidden="true">&times;</button></div>
            </div>
            <form method="POST">
                <div class="modal-body">
                    <div class="px-2">
                        <div class="row form-group">
                            <div class="col-sm-4">
                                <label class="control-label modal-label">Year Start</label>
                            </div>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" name="year_start" id="year_start" placeholder="Input year start.." min="2009" max="9999" required>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-sm-4">
                                <label class="control-label modal-label">Year End</label>
                            </div>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" name="year_end" id="year_end" placeholder="Input year end.." min="2009" max="9999" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                    <button type="submit" name="edit" class="btn btn-primary" id="addAcademic">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
