<form method="POST" action="<?= @base_url('Equipments/create'); ?>" class="p-a-4" id="participant-report">

<div class="row">
    <div class="col-sm-12">

        <div class="card">
            <div class="card-header">
                <strong>NEW EQUIPMENT</strong>
            </div>
            <div class="card-block">

                  <!-- <h4 class="m-t-0 m-b-4 text-xs-center font-weight-semibold">PARTICIPANT DETAILS</h4> -->

                  <fieldset class="page-signup-form-group form-group form-group-lg">
                   <div class = "form-group">
                        <label class = "control-label col-md-3">Equipment Name</label>
                        <div class="col-md-9">
                            <input type = "text" name = "equipmentname" class = "form-control"/>
                        </div>
                    </div>
                  </fieldset>

                  <fieldset class="page-signup-form-group form-group form-group-lg">
                    <div class = "form-group">
                        <label class = "control-label col-md-3">Kit Name</label>
                        <div class="col-md-9">
                            <input type = "text" name = "kitnames" class = "form-control"/>
                        </div>
                    </div>
                  </fieldset>

                  <fieldset class="page-signup-form-group form-group form-group-lg">
                    <div class = "form-group">
                        <label class = "control-label col-md-3">Lysis Method</label>
                        <div class="col-md-9">
                            <input type = "text" name = "lysis" class = "form-control"/>
                            <span class="help-block text-info">Leave Lysis method empty if none</span>
                        </div>
                    </div>
                  </fieldset>

                  <fieldset class="page-signup-form-group form-group form-group-lg">
                    <div class = "form-group">
                        <label class = "control-label col-md-3">Leave Absolute Count beads empty, if none</label>
                        <div class="col-md-9">
                            <input type = "text" name = "acb" class = "form-control"/>
                            <span class="help-block text-info">Leave Absolute Count beads empty, if none</span>
                        </div> 
                    </div>
                  </fieldset>

                  <button type="submit" class="btn btn-block btn-lg btn-primary m-t-3">Next</button>

                </div>   
            </div>
        </div>
    </div>

</form>