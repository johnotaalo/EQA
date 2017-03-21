<div class="row">
	<div class="col-sm-12">

	    <div class="card">
	        <div class="card-header">
	            <strong>Participant Details</strong>
	        </div>
	        <div class="card-block">

	        <div class="row">
	            <div class="form-group col-sm-3">
	                <label for="company">Participant Code</label>
	                <h5><?= @$user->username; ?></h5>
	            </div>

	            <div class="form-group col-sm-3">
	                <label for="vat">Name</label>
	                <h5><?= @$user->lastname . ' ' . $user->firstname; ?></h5>
	            </div>

	            <div class="form-group col-sm-3">
	                <label for="street">Telephone</label>
	                <h5><?= @$user->phone; ?></h5>
	            </div>

          	</div>

            <div class="row">

                <div class="form-group col-sm-2">
                    <label for="city">MFL Code</label>
                    <h5><?= @$user->facility_code; ?></h5>
                </div>

                <div class="form-group col-sm-4">
                    <label for="postal-code">Site Name</label>
                    <h5><?= @$user->facility_name; ?></h5>
                </div>

                <div class="form-group col-sm-4">
	                <label for="country">Email Address</label>
	                <h5><?= @$user->email_address; ?></h5>
                </div>

	            <div class="form-group col-sm-2">
                	<label for="country">Site Telephone</label>
               		<h5><?php if($user->telephone && $user->alt_telephone) { $user->telephone .' / '. $user->alt_telephone; } else if($user->telephone) { $user->telephone; }else if($user->alt_telephone){$user->alt_telephone;}else{ echo 'N/A'; }?></h5>
	            </div>
            </div>
            <!--/row-->

	            
	        </div>
	    </div>
	</div>

	<div class="col-sm-12">

	    <div class="card">
	        <div class="card-header">
	            <strong>Questionnaire</strong>
	        </div>
	        <div class="card-block">
	          <form method = "post" action="<?php echo base_url('Participant/Readiness/submitReadiness');?>" class="p-a-4" id="page-signin-form">

                <?= @$questionnair; ?>

                <button id="submit-readiness" type="submit" class="btn btn-block btn-primary">Submit PT Readiness Checklist</button>
          	</form>
	            
	        </div>
	    </div>
	</div>


</div>