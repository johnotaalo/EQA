<form method="POST" action="<?= @base_url('Equipments/addFlourochromes/'); ?><?php echo $equipment; ?>" class="p-a-4" id="flourochrome-form">

<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <strong>NEW FLOUROCHROMES</strong>
            </div>
            <div class="card-block">

                   <h4 class="m-t-0 m-b-4 text-xs-center font-weight-semibold">NEW FLOUROCHROMES</h4>
                 <div id="flourochromes">

                  <?php
                    if(isset($flouro_display)){
                        echo $flouro_display;
                    }
                  ?>

                  </div>

              	<div class="col-md-12">
                  <a class = "btn btn-success btn-sm" id = "add-flouro"><i class = "icon-plus"></i> Add flourochrome
                  </a>
              	</div>

          		


                </div>  

                <div class="col-md-12">
                  <button type="submit" class="btn btn-block btn-lg btn-primary m-t-3">Next</button>
				        </div>


            </div>
        </div>
    </div>

</form>