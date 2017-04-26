<div class="row">
	<div class="col-sm-12">

	<div class = 'alert alert-warning'>
        <h5>Refreshing the page will cause a loss of some data, and would require another login attempt</h5>
    </div>

	    <div class="card">
	        <!-- <div class="card-header">
	            <strong>Participant Details</strong>
	        </div>
	        <div class="card-block">

	        <div class="row">
	            <div class="form-group col-sm-3">
	                <label for="username">Participant Code</label>
	                <h5><?= @$user->username; ?></h5>
	            </div>

	            <div class="form-group col-sm-3">
	                <label for="name">Name</label>
	                <h5><?= @$user->lastname . ' ' . $user->firstname; ?></h5>
	            </div>

	            <div class="form-group col-sm-3">
	                <label for="email">Email Address</label>
	                <h5><?= @$user->email_address; ?></h5>
                </div>

	            <div class="form-group col-sm-3">
	                <label for="user-tel">Telephone</label>
	                <h5><?= @$user->phone; ?></h5>
	            </div>

          	</div>

            <div class="row">

                <div class="form-group col-sm-2">
                    <label for="code">MFL Code</label>
                    <h5><?= @$user->facility_code; ?></h5>
                </div>

                <div class="form-group col-sm-4">
                    <label for="facility">Site Name</label>
                    <h5><?= @$user->facility_name; ?></h5>
                </div> 

	            <div class="form-group col-sm-2">
                	<label for="facility-tel">Site Telephone</label>
               		<h5><?php if($user->telephone && $user->alt_telephone) { $user->telephone .' / '. $user->alt_telephone; } else if($user->telephone) { $user->telephone; }else if($user->alt_telephone){$user->alt_telephone;}else{ echo 'N/A'; }?></h5>
	            </div>
            </div>

	            
	        </div>
	    </div> -->
	</div>

	<div class="col-sm-12">

	    <div class="card">
	        <div class="card-header">
	            <strong>Questionnaire</strong>
	        </div>
	        <div class="card-block">
	          <form method = "post" action="<?php echo base_url('Participant/Readiness/submitReadiness');?>" class="p-a-4" id="page-signin-form">
				<input type="hidden" class="page-signin-form-control form-control" value="<?= @$pt_uuid; ?>" id="ptround-form" name="ptround">

                <?= @$questionnair; ?>

                <button id="submit-readiness" type="submit" class="btn btn-block btn-primary">Submit PT Readiness Checklist</button>
          	</form>
	            
	        </div>
	    </div>
	</div>


</div>