<form method="POST" action="<?= @base_url(''); ?>" class="p-a-4" id="data-submission">

<input type="hidden" class="page-signup-form-control form-control" name="ptround">

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

	<div>
		<div class="col-md-12 mb-2">

    	<strong><center>METHODOLOGY</center></strong>

			<?= @$equipment_tabs; ?>


            <!--  <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#home4" role="tab" aria-controls="home"><i class="icon-calculator"></i> BD FacsCalibur &nbsp;
               		 	<span class="tag tag-success">Complete</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#profile4" role="tab" aria-controls="profile"><i class="icon-basket-loaded"></i> Alere Pima &nbsp;
                		<span class="tag tag-success">Complete</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#messages4" role="tab" aria-controls="messages"><i class="icon-pie-chart"></i> FACSPresto
                    	<span class="tag tag-danger">Incomplete</span>
                    </a>
                </li>
            </ul>

            <div class="tab-content">
                <div class="tab-pane active" id="home4" role="tabpanel">
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
                </div>

                <div class="tab-pane" id="profile4" role="tabpanel">
                    2. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure
                    dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                </div>

                <div class="tab-pane" id="messages4" role="tabpanel">
                    3. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure
                    dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                </div>
            </div> -->




        </div>
    </div> 

    <button type="submit" class="btn btn-block btn-lg btn-primary m-t-3">Save as Draft</button>
    <button type="submit" class="btn btn-block btn-lg btn-success m-t-3">Mark as Complete</button>

</form>