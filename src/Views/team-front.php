<?php echo $this->insert('header-front'); ?>

<div class="container">
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-6">
						<h2>Manage <b>Teams</b></h2>
					</div>
					<div class="col-sm-6">
						<a href="#addTeamModal" onclick="enableButtonTeam();" class="btn btn-success" data-toggle="modal"><i class="material-icons">&#xE147;</i> <span>Add New</span></a>
						<!-- <a href="#deleteEmployeeModal" class="btn btn-danger" data-toggle="modal"><i class="material-icons">&#xE15C;</i> <span>Delete</span></a> -->
					</div>
                </div>
            </div>
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
						<th>Referal ID</th>
						<th>Name</th>
                        <th>Country</th>
						<th>Logo</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="table-team">
                    
                </tbody>
            </table>
			<div class="clearfix">
                <!--
				<div class="hint-text">Showing <b>5</b> out of <b>25</b> entries</div>
                <ul class="pagination">
                    <li class="page-item disabled"><a href="#">Previous</a></li>
                    <li class="page-item"><a href="#" class="page-link">1</a></li>
                    <li class="page-item"><a href="#" class="page-link">2</a></li>
                    <li class="page-item active"><a href="#" class="page-link">3</a></li>
                    <li class="page-item"><a href="#" class="page-link">4</a></li>
                    <li class="page-item"><a href="#" class="page-link">5</a></li>
                    <li class="page-item"><a href="#" class="page-link">Next</a></li>
                </ul>
				-->
            </div>
        </div>
    </div>
	<!-- Edit Modal HTML -->
	<div id="addTeamModal" class="modal fade" aria-hidden="true">
     <!-- <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true"> -->
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<form id="add-team">
					<div class="modal-header">						
						<h4 class="modal-title">Add Team</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<div class="modal-body">
						<div id="msg-send-team" class="form-group">

						</div>					
						<div class="form-group">
							<label>Referal Team ID</label>
							<input type="text" value="118" name="referal_team_id" class="form-control" required>
						</div>
						<div class="form-group">
							<label>Name</label>
							<input type="text" value="Bahia" name="name" class="form-control" required>
						</div>
                        <div class="form-group">
							<label>League</label>
							<input type="text" value="" name="league" class="form-control" required>
						</div>
						<div class="form-group">
							<label>Coutry</label>
							<input type="text" value="Brazil" name="country" class="form-control" required>
						</div>
						<div class="form-group">
							<label>Logo</label>
							<input type="text" value="https://media-1.api-sports.io/football/teams/118.png" name="logo" class="form-control" required>
						</div>
                        					
					</div>
					<div class="modal-footer">
						<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
						<input type="button" id="btn-save-team" onclick="addTeam()" class="btn btn-success" value="Add">
					</div>
				</form>
			</div>
		</div>
	</div>
	<!-- Edit Modal HTML -->
	<div id="editTeamModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
			<form id="edit-team">
					<div class="modal-header">						
						<h4 class="modal-title">Edit Team</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<div class="modal-body">
						<div id="msg-send-team-edit" class="form-group">

						</div>					
						<div class="form-group">
							<label>Referal Team ID</label>
							<input type="text" value="" name="referal_team_id" class="form-control" required>
						</div>
						<div class="form-group">
							<label>Name</label>
							<input type="text" value="" name="name" class="form-control" required>
						</div>
                        <div class="form-group">
							<label>League</label>
							<input type="text" value="Goiano - 1" name="league" class="form-control" required>
						</div>
						<div class="form-group">
							<label>Coutry</label>
							<input type="text" value="" name="country" class="form-control" required>
						</div>
						<div class="form-group">
							<label>Logo</label>
							<input type="text" value="" name="logo" class="form-control" required>
						</div>
                        				
					</div>
					<div class="modal-footer">
						<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
						<input type="button" id="btn-edit-team" onclick="editTeam()" class="btn btn-success" value="Update">
					</div>
					<div id="json-edit-team">
						<input type="hidden" value="" name="json-team">
						<input type="hidden" value="" name="id-team">
					</div>
				</form>
			</div>
		</div>
	</div>
	<!-- Delete Modal HTML -->
	<div id="deleteTeamModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<form>
					<div class="modal-header">						
						<h4 class="modal-title">Delete Team</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<div class="modal-body">
					<div id="msg-send-team-delete" class="form-group">

					</div>						
						<p>Are you sure you want to delete these Records?
							<table>
								<tbody>
									<tr>
										<td><b>Referal ID:</b> <span id="referal_id_team"></span></td>
									</tr>
									<tr>
										<td><b>Name:</b> <span id="name_team"></span></td>
									</tr>	
								</tbody>
							</table>
						</p>
						<p class="text-warning"><small>This action cannot be undone.</small></p>
					</div>
					<div class="modal-footer">
						<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
						<input type="button" id="btn-delete-team" class="btn btn-danger" onclick="deleteTeam()" value="Delete">
					</div>
				</form>
			</div>
		</div>
	</div>
	<div>
        <input type="hidden" name="url_site" value="<?php echo $this->e($siteUrl);?>">
    </div>
    <script>
        setTimeout(function (){
            listAllTeams();
        }, 1000);
        
    </script>
<?php echo $this->insert('footer-front'); ?>