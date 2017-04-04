<form method="POST" action="<?= @base_url(''); ?>" class="p-a-4" id="data-submission">

<?php if($this->session->flashdata('success')){ ?>
        <div class = 'alert alert-success'>
            <?= @$this->session->flashdata('success'); ?>
        </div>
  <?php }elseif($this->session->flashdata('error')){ ?>
        <div class = 'alert alert-danger'>
            <?= @$this->session->flashdata('error'); ?>
        </div>
  <?php } ?>

  	<div class = 'alert alert-warning'>
	    Please submit this form to NHRL through e-mail or hand delivery <span class="text-danger">before April 24th, 2017</span>
	</div>

  <div class="row">
    <div class="col-sm-12">
    	
        <div class="card">
            <div class="card-header">
                <strong>PARTICIPANT DETAILS</strong>
            </div>
            <div class="card-block">

		         	<div class="row">
			            <div class="form-group col-sm-4">
			                <label for="username">Participant Name : </label>
			                <!-- <h5><?= @$user->fname . $user->lname; ?></h5> -->
			            </div>

			            <div class="form-group col-sm-4">
			                <label for="cell">Cell : </label>
			                <!-- <h5><?= @$user->cell . ' ' . $user->firstname; ?></h5> -->
			            </div>

			            <div class="form-group col-sm-4">
			                <label for="email">Email : </label>
			                <!-- <h5><?= @$user->email_address; ?></h5> -->
		                </div>

			            <div class="form-group col-sm-4">
			                <label for="facility">Facility : </label>
			                <!-- <h5><?= @$user->facility; ?></h5> -->
			            </div>

			            <div class="form-group col-sm-4">
			                <label for="sample_code">Sample Split Code : </label>
			                <!-- <h5><?= @$user->sample_code . ' ' . $user->firstname; ?></h5> -->
			            </div>

			            <div class="form-group col-sm-4">
			                <label for="date_received">Date Received (DD/MM/YYYY) : </label>
			                <!-- <h5><?= @$user->date_received; ?></h5> -->
		                </div>

			            <div class="form-group col-sm-4">
			                <label for="date_analyzed">Date Analyzed (DD/MM/YYYY) : </label>
			                <!-- <h5><?= @$user->date_analyzed; ?></h5> -->
			            </div>
		          	</div>

                </div>   
            </div>
        </div>
    </div>



    <div class="row">
    <div class="col-sm-12">
    	
        <div class="card">
            <div class="card-header">
                <strong>METHODOLOGY</strong>
            </div>
            <div class="card-block">

	            <div class="row">
	            	<table class="table table-bordered">
	            		<tr>
			            	<th style="text-align: center;">
			            		Equipment
			            	</th>
			            	<th style="text-align: center;">
			            		Reagent
			            	</th>
			            	<th style="text-align: center;">
			            		Lot Number
			            	</th style="text-align: center;">
			            	<th>
			            		Expiry Date
			            	</th>
		            	</tr>
		            	<tr>
		            		<td>
		            			<strong>FACSCalibar</strong>
		            		</td>
		            		<td>
		            			<input type="text" class="page-signup-form-control form-control" placeholder="" name = "equipment1_reagent">
		            		</td>
		            		<td>
		            			<input type="text" class="page-signup-form-control form-control" placeholder="" name = "equipment1_lot">
		            		</td>
		            		<td>
		            			<input type="text" class="page-signup-form-control form-control" placeholder="" name = "equipment1_expiry">
		            		</td>
		            	</tr>
		            	<tr>
		            		<td>
		            			<strong>FACSCount</strong>
		            		</td>
		            		<td>
		            			<input type="text" class="page-signup-form-control form-control" placeholder="" name = "equipment2_reagent">
		            		</td>
		            		<td>
		            			<input type="text" class="page-signup-form-control form-control" placeholder="" name = "equipment2_lot">
		            		</td>
		            		<td>
		            			<input type="text" class="page-signup-form-control form-control" placeholder="" name = "equipment2_expiry">
		            		</td>
		            	</tr>
		            	<tr>
		            		<td>
		            			<strong>Alere PIMA</strong>
		            		</td>
		            		<td>
		            			<input type="text" class="page-signup-form-control form-control" placeholder="" name = "equipment3_reagent">
		            		</td>
		            		<td>
		            			<input type="text" class="page-signup-form-control form-control" placeholder="" name = "equipment3_lot">
		            		</td>
		            		<td>
		            			<input type="text" class="page-signup-form-control form-control" placeholder="" name = "equipment3_expiry">
		            		</td>
		            	</tr>
		            	<tr>
		            		<td>
		            			<strong>FACSPresto</strong>
		            		</td>
		            		<td>
		            			<input type="text" class="page-signup-form-control form-control" placeholder="" name = "equipment4_reagent">
		            		</td>
		            		<td>
		            			<input type="text" class="page-signup-form-control form-control" placeholder="" name = "equipment4_lot">
		            		</td>
		            		<td>
		            			<input type="text" class="page-signup-form-control form-control" placeholder="" name = "equipment4_expiry">
		            		</td>
		            	</tr>
		            	<tr>
		            		<td>
		            			<strong>GUAVA easyCyte</strong>
		            		</td>
		            		<td>
		            			<input type="text" class="page-signup-form-control form-control" placeholder="" name = "equipment5_reagent">
		            		</td>
		            		<td>
		            			<input type="text" class="page-signup-form-control form-control" placeholder="" name = "equipment5_lot">
		            		</td>
		            		<td>
		            			<input type="text" class="page-signup-form-control form-control" placeholder="" name = "equipment5_expiry">
		            		</td>
		            	</tr>
		            	<tr>
		            		<td>
		            			<strong>Partec CyFlow</strong>
		            		</td>
		            		<td>
		            			<input type="text" class="page-signup-form-control form-control" placeholder="" name = "equipment6_reagent">
		            		</td>
		            		<td>
		            			<input type="text" class="page-signup-form-control form-control" placeholder="" name = "equipment6_lot">
		            		</td>
		            		<td>
		            			<input type="text" class="page-signup-form-control form-control" placeholder="" name = "equipment6_expiry">
		            		</td>
		            	</tr>
		            	<tr>
		            		<td>
		            			<strong>Other (Specify)</strong>
		            		</td>
		            		<td>
		            			<input type="text" class="page-signup-form-control form-control" placeholder="" name = "equipment7_reagent">
		            		</td>
		            		<td>
		            			<input type="text" class="page-signup-form-control form-control" placeholder="" name = "equipment7_lot">
		            		</td>
		            		<td>
		            			<input type="text" class="page-signup-form-control form-control" placeholder="" name = "equipment7_expiry">
		            		</td>
		            	</tr>
	            	</table>
	          	</div>

            </div>   
            </div>
        </div>
    </div>

	<div class = 'alert alert-warning'>
	    Please identify the antibody (CD) and Flourochrome for each tube of the panel e.g CD3-FITC
	</div>


    <div class="row">
    <div class="col-sm-12">
    	
        <div class="card">
            <!-- <div class="card-header">
                <strong>METHODOLOGY</strong>
            </div> -->
            <div class="card-block">

	            <div class="row">
	            	<table class="table table-striped">
	            		<tr>
	            			<th style="text-align: center;">
	            				MAb-FL1
	            			</th>
	            			<th style="text-align: center;">
	            				MAb-FL2
	            			</th>
	            			<th style="text-align: center;">
	            				MAb-FL3
	            			</th>
	            			<th style="text-align: center;">
	            				MAb-FL4
	            			</th>
	            		</tr>
	            		<tr>
	            			<td>
	            				<input type="text" class="page-signup-form-control form-control" placeholder="" name = "fl1">
	            			</td>
	            			<td>
	            				<input type="text" class="page-signup-form-control form-control" placeholder="" name = "fl2">
	            			</td>
	            			<td>
	            				<input type="text" class="page-signup-form-control form-control" placeholder="" name = "fl3">
	            			</td>
	            			<td>
	            				<input type="text" class="page-signup-form-control form-control" placeholder="" name = "fl4">
	            			</td>
	            		</tr>
	            	</table>
	          	</div>

            </div>   
            </div>
        </div>
    </div>


    <div class="row">
    <div class="col-sm-12">
    	
        <div class="card">
            <!-- <div class="card-header">
                <strong>METHODOLOGY</strong>
            </div> -->
            <div class="card-block">

	            <div class="row">
	            	<table class="table table-bordered">
	            		<tr>
	            			<th>
	            				Lysing Method
	            			</th>
	            			<td>
	            				<input type="text" class="page-signup-form-control form-control" placeholder="" name = "lysing">
	            			</td>
	            		</tr>
	            		<tr>
	            			<th>
	            				Absolute Count Method
	            			</th>
	            			<td>
	            				<input type="text" class="page-signup-form-control form-control" placeholder="" name = "absolute">
	            			</td>
	            		</tr>
	            	</table>
	          	</div>

            </div>   
            </div>
        </div>
    </div>



    <div class="row">
    <div class="col-sm-12">
    	
        <div class="card">
            <div class="card-header">
                <strong>RESULTS</strong>
            </div>
            <div class="card-block">

	            <div class="row">
	            	<table class="table table-bordered">
	            		<tr>
	            			<th style="text-align: center;" rowspan="3">
	            				PANEL
	            			</th>
	            			<th style="text-align: center;" colspan="7">
	            				RESULT
	            			</th>
	            		</tr>
	            		<tr>
	            			<th style="text-align: center;" colspan="2">
	            				CD3
	            			</th>
	            			<th style="text-align: center;" colspan="2">
	            				CD4
	            			</th>
	            			<th style="text-align: center;" colspan="2">
	            				Other (Specify)
	            			</th>
	            		</tr>
	            		<tr>
	            			<th style="text-align: center;">
	            				Absolute
	            			</th>
	            			<th style="text-align: center;">
	            				Percent
	            			</th>
	            			<th style="text-align: center;">
	            				Absolute
	            			</th>
	            			<th style="text-align: center;">
	            				Percent
	            			</th>
	            			<th style="text-align: center;">
	            				Absolute
	            			</th>
	            			<th style="text-align: center;">
	            				Percent
	            			</th>
	            		</tr>
	            		<tr>
	            			<th style="text-align: center;">
	            				SS-R17-036
	            			</th>
	            			<td>
	            				<input type="text" class="page-signup-form-control form-control" placeholder="" name = "cd3_abs_1">
	            			</td>
	            			<td>
	            				<input type="text" class="page-signup-form-control form-control" placeholder="" name = "cd3_per_1">
	            			</td>
	            			<td>
	            				<input type="text" class="page-signup-form-control form-control" placeholder="" name = "cd4_abs_1">
	            			</td>
	            			<td>
	            				<input type="text" class="page-signup-form-control form-control" placeholder="" name = "cd4_per_1">
	            			</td>
	            			<td>
	            				<input type="text" class="page-signup-form-control form-control" placeholder="" name = "other_abs_1">
	            			</td>
	            			<td>
	            				<input type="text" class="page-signup-form-control form-control" placeholder="" name = "other_per_1">
	            			</td>
	            		</tr>
	            		<tr>
	            			<th style="text-align: center;">
	            				SS-R17-037
	            			</th>
	            			<td>
	            				<input type="text" class="page-signup-form-control form-control" placeholder="" name = "cd3_abs_2">
	            			</td>
	            			<td>
	            				<input type="text" class="page-signup-form-control form-control" placeholder="" name = "cd3_per_2">
	            			</td>
	            			<td>
	            				<input type="text" class="page-signup-form-control form-control" placeholder="" name = "cd4_abs_2">
	            			</td>
	            			<td>
	            				<input type="text" class="page-signup-form-control form-control" placeholder="" name = "cd4_per_2">
	            			</td>
	            			<td>
	            				<input type="text" class="page-signup-form-control form-control" placeholder="" name = "other_abs_2">
	            			</td>
	            			<td>
	            				<input type="text" class="page-signup-form-control form-control" placeholder="" name = "other_per_2">
	            			</td>
	            		</tr>
	            		<tr>
	            			<th style="text-align: center;">
	            				SS-R17-038
	            			</th>
	            			<td>
	            				<input type="text" class="page-signup-form-control form-control" placeholder="" name = "cd3_abs_3">
	            			</td>
	            			<td>
	            				<input type="text" class="page-signup-form-control form-control" placeholder="" name = "cd3_per_3">
	            			</td>
	            			<td>
	            				<input type="text" class="page-signup-form-control form-control" placeholder="" name = "cd4_abs_3">
	            			</td>
	            			<td>
	            				<input type="text" class="page-signup-form-control form-control" placeholder="" name = "cd4_per_3">
	            			</td>
	            			<td>
	            				<input type="text" class="page-signup-form-control form-control" placeholder="" name = "other_abs_3">
	            			</td>
	            			<td>
	            				<input type="text" class="page-signup-form-control form-control" placeholder="" name = "other_per_3">
	            			</td>
	            		</tr>
	            	</table>
	          	</div>

            </div>   
            </div>
        </div>
    </div>



    <div class="row">
    <div class="col-sm-12">
    	
        <div class="card">
            <div class="card-header">
                <strong>Quality Assurance</strong>
            </div>
            <div class="card-block">

	            <div class="row">
	            	<fieldset class="page-signup-form-group form-group form-group-lg">
	                    <div class="form-group col-sm-4">
                            <label for="ccmonth">QA Reveiwer Name</label>
                            <select class="form-control" id="ccmonth">
                                <option>10777_001 - QA Name 1</option>
                                <option>10231_005 - QA Name 2</option>
                                <option>10233_010 - QA Name 3</option>
                                <option>10520_015 - QA Name 4</option>
                                <option>10609_020 - QA Name 5</option>
                            </select>
                        </div>
                  	</fieldset>
	          	</div>

            </div>   
            </div>
        </div>
    </div>



    <button type="submit" class="btn btn-block btn-lg btn-primary m-t-3">Save as Draft</button>
    <button type="submit" class="btn btn-block btn-lg btn-success m-t-3">Mark as Complete</button>

</form>