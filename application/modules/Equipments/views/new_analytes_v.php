<form method="POST" action="<?= @base_url('Equipments/addAnalytes/'); ?><?php echo $equipment; ?>" class="p-a-4" id="analytes-form">

<div class="row">
    <div class="col-sm-12">

        <div class="card">
            <div class="card-header">
                <strong>NEW ANALYTES</strong>
            </div>
            <div class="card-block">

                  <!-- <h4 class="m-t-0 m-b-4 text-xs-center font-weight-semibold">PARTICIPANT DETAILS</h4> -->

                  <div class="form-group row">


                  <div class="col-md-6">
                    <label class="col-md-3 form-control-label">Absolute</label>
                    <div class="col-md-9">
                        <div class="checkbox">
                            <label for="checkbox1">
                                <input type="checkbox" id="absolute" name="absolute" value="1">
                            </label>
                        </div>

                        <div class="absolute">
                          <div class="checkbox">
                              <label for="checkbox2">
                                  <input type="checkbox" id="absolutecd3" name="absolutecd3" value="1">&nbsp;&nbsp;CD3
                              </label>
                          </div>
                          <div class="checkbox">
                              <label for="checkbox3">
                                  <input type="checkbox" id="absolutecd4" name="absolutecd4" value="1">&nbsp;&nbsp;CD4
                              </label>
                          </div>
                        </div>



                    </div>
                  </div>  
                  <div class="col-md-6">
                    <label class="col-md-3 form-control-label">Percent</label>
                    <div class="col-md-9">
                        <div class="checkbox">
                            <label for="checkbox1">
                                <input type="checkbox" id="percent" name="percent" value="1">
                            </label>
                        </div>
                        <div class="percent">
                          <div class="checkbox">
                              <label for="checkbox2">
                                  <input type="checkbox" id="percentcd3" name="percentcd3" value="1">&nbsp;&nbsp;CD3
                              </label>
                          </div>
                          <div class="checkbox">
                              <label for="checkbox3">
                                  <input type="checkbox" id="percentcd4" name="percentcd4" value="1">&nbsp;&nbsp;CD4
                              </label>
                          </div>
                        </div>
                    </div>
                  </div> 


                  </div>

                  

                  <button type="submit" class="btn btn-block btn-lg btn-primary m-t-3">Complete</button>

                </div>   
            </div>
        </div>
    </div>

</form>