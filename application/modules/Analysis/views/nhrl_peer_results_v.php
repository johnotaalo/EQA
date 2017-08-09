

<div class = "card-block">
    <?php if($this->session->flashdata('success')){ ?>
        <div class = 'alert alert-success'>
            <?= @$this->session->flashdata('success'); ?>
        </div>
    <?php }elseif($this->session->flashdata('error')){ ?>
        <div class = 'alert alert-danger'>
            <?= @$this->session->flashdata('error'); ?>
        </div>
    <?php } ?>
</div>


<div class = "row">
    <div class="col-md-12">
        <div class = "card">
            <div class="card-header col-4">
                <i class = "icon-chart"></i>
                &nbsp;

                    PT Round List

                <div class = "pull-right">
                    <a href = "<?= @base_url('Dashboard/'); ?>"> <button class = "btn btn-primary btn-sm"><i class = "fa fa-arrow-left"></i>  Back to Dashboard</button></a><br /><br />
                </div>
            </div>

            <div class = "card-block">

	            <div class = "row">
				    <div class="col-md-12">
				    <div class="card ">

						<div class="col-md-6">
							<div class = "card">
					            <div class="card-header col-6">
					            	<i class = "icon-chart"></i>
				                &nbsp;

				                    NHRL Results
					            </div>
					            <div class = "card-block">
					            <!-- Table 1 here -->
					                <?= @$nhrl_table; ?>
					            </div>
						    </div>
					    </div>

						<div class="col-md-6">
							<div class = "card">
					            <div class="card-header col-6">
					            	<i class = "icon-chart"></i>
				                &nbsp;

				                    Peer Results
					            </div>
					            <div class = "card-block">
					            <!-- Table 2 here -->
					                <?= @$peer_table; ?>
					            </div>
						    </div>
					    </div>

				    </div>
				    </div>
				</div>


				<div class = "row">
				    <div class="col-md-12">
				        <div class = "card">
				            <div class="card-header col-4">
				                <i class = "icon-chart"></i>
				                &nbsp;
				                    Participant Results
				            </div>

				            <div class = "card-block col-12">
				            <!-- Table 3 here -->
				                <?= @$participant_results; ?>
				            </div>


				        </div>
				    </div>
				</div>


            </div>
        </div>
    </div>
</div>
        

