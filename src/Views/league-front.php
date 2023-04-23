<?php echo $this->insert('header-front'); ?>

<div class="container">
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-6">
                        <h2>Manage <b>Leagues</b></h2>
                    </div>
                    <div class="col-sm-6">
                        <a href="#addLeagueModal" onclick="enableButton();" class="btn btn-success" data-toggle="modal"><i class="material-icons">&#xE147;</i> <span>Add New</span></a>
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
                        <th>Flag</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="table-league">
                    
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
    <div id="addLeagueModal" class="modal fade" aria-hidden="true">
     <!-- <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true"> -->
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form id="add-league">
                    <div class="modal-header">                      
                        <h4 class="modal-title">Add League</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div id="msg-send" class="form-group">

                        </div>                  
                        <div class="form-group">
                            <label>Referal League ID</label>
                            <input type="text" value="4894" name="referal_league_id" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" value="Goiano - 1" name="name" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Coutry</label>
                            <input type="text" value="Brazil" name="country" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Logo</label>
                            <input type="text" value="https://media-3.api-sports.io/football/leagues/628.png" name="logo" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Flag</label>
                            <input type="text" value="https://media-3.api-sports.io/flags/br.svg" name="flag" class="form-control" required>
                        </div>                  
                    </div>
                    <div class="modal-footer">
                        <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                        <input type="button" id="btn-save-league" onclick="addLeague()" class="btn btn-success" value="Add">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Edit Modal HTML -->
    <div id="editLeagueModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
            <form id="edit-league">
                    <div class="modal-header">                      
                        <h4 class="modal-title">Edit League</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div id="msg-send-edit" class="form-group">

                        </div>                  
                        <div class="form-group">
                            <label>Referal League ID</label>
                            <input type="text" value="" name="referal_league_id" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" value="" name="name" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Coutry</label>
                            <input type="text" value="" name="country" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Logo</label>
                            <input type="text" value="" name="logo" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Flag</label>
                            <input type="text" value="" name="flag" class="form-control" required>
                        </div>                  
                    </div>
                    <div class="modal-footer">
                        <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                        <input type="button" id="btn-edit-league" onclick="editLeague()" class="btn btn-success" value="Update">
                    </div>
                    <div id="json-edit-league">
                        <input type="hidden" value="" name="json-league">
                        <input type="hidden" value="" name="id-league">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Delete Modal HTML -->
    <div id="deleteleagueModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <form>
                    <div class="modal-header">                      
                        <h4 class="modal-title">Delete League</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                    <div id="msg-send-delete" class="form-group">

                    </div>                      
                        <p>Are you sure you want to delete these Records?
                            <table>
                                <tbody>
                                    <tr>
                                        <td><b>Referal ID:</b> <span id="referal_id_league"></span></td>
                                    </tr>
                                    <tr>
                                        <td><b>Name:</b> <span id="name_league"></span></td>
                                    </tr>   
                                </tbody>
                            </table>
                        </p>
                        <p class="text-warning"><small>This action cannot be undone.</small></p>
                    </div>
                    <div class="modal-footer">
                        <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                        <input type="button" id="btn-delete-league" class="btn btn-danger" onclick="deleteLeague()" value="Delete">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div>
        <input type="hidden" name="url_site" value="<?php echo $this->e($siteUrl);?>">
    </div>
    

<?php echo $this->insert('footer-front'); ?>
