<!-- <form method="POST" action="<?= @base_url('Participant/PTRound/dataSubSubmission/'); ?><?php echo $pt_uuid; ?>" class="p-a-4" id="data-submission"> -->
<form method="POST" class="p-a-4" id="data-submission">
<input type="hidden" class="page-signup-form-control form-control" id="ptround" value="<?php echo $pt_uuid; ?>">

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

		<div class="col-md-12 mb-2">

    	<strong><center>METHODOLOGY</center></strong>

			<?= @$equipment_tabs; ?>

        </div> 

    <button data-type="draft" class="btn btn-block btn-lg btn-primary m-t-3 submit">Save as Draft</button>
    <button data-type="complete" class="btn btn-block btn-lg btn-success m-t-3 submit">Mark as Complete</button>

</form>