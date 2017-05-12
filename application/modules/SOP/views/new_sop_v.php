
<div class="row">
    <div class="col-md-12">
    <a href = "<?= @base_url('SOP/soplist'); ?>"> <button class = "btn btn-primary btn-sm"><i class = "fa fa-arrow-left"></i>  Back to SOP</button></a><br /><br />

<form method="POST" action="<?= @base_url('SOP/create'); ?>" class="p-a-4" id="sop-form" enctype='multipart/form-data'>

        <div class="card">
            <div class="card-header">
                <strong>NEW SOP</strong>
            </div>
            <div class="card-block">

                  <!-- <h4 class="m-t-0 m-b-4 text-xs-center font-weight-semibold">PARTICIPANT DETAILS</h4> -->

                  <fieldset class="page-signup-form-group form-group form-group-lg">
                   <div class = "form-group">
                        <label class = "control-label col-md-3">SOP Name</label>
                        <div class="col-md-9">
                            <input type = "text" name = "sop_name" class = "form-control"/>
                        </div>
                    </div>
                  </fieldset>

                  <fieldset class="page-signup-form-group form-group form-group-lg">
                    <div class = "form-group">
                        <label class = "control-label col-md-3">SOP File</label>
                        <div class="col-md-9">
                            <input type = 'file' name = 'sop_file' required = 'true' class = 'form-control'/>
                        </div>
                    </div>
                  </fieldset>

                  <button type="submit" class="btn btn-block btn-lg btn-primary m-t-3">Save</button>

                </div>   
            </div>

            </form>
        </div>

        
    </div>

