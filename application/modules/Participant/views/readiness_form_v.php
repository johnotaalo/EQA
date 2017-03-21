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
	            <div class="form-group">
	                <label for="company">Participant Code</label>
	                <input type="text" class="form-control" id="company" placeholder="Enter your company name">
	            </div>

	            <div class="form-group">
	                <label for="vat">Name</label>
	                <input type="text" class="form-control" id="vat" placeholder="PL1234567890">
	            </div>

	            <div class="form-group">
	                <label for="street">Telephone</label>
	                <input type="text" class="form-control" id="street" placeholder="Enter street name">
	            </div>

	            <div class="row">

	                <div class="form-group col-sm-4">
	                    <label for="city">MFL Code</label>
	                    <input type="text" class="form-control" id="city" placeholder="Enter your city">
	                </div>

	                <div class="form-group col-sm-8">
	                    <label for="postal-code">Site Name</label>
	                    <input type="text" class="form-control" id="postal-code" placeholder="Postal Code">
	                </div>

	            </div>
	            <!--/row-->

	            <div class="form-group">
	                <label for="country">Email Address</label>
	                <input type="text" class="form-control" id="country" placeholder="Country name">
	            </div>

	            <div class="form-group">
	                <label for="country">Site Telephone</label>
	                <input type="text" class="form-control" id="country" placeholder="Country name">
	            </div>
	        </div>
	    </div>
	</div>


</div>