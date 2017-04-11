<!-- <form method="POST" action="<?= @base_url('Participant/PTRound/dataSubmission/draft/'); ?><?php echo $pt_uuid; ?>" class="p-a-4" id="data-submission"> -->

<strong><center>METHODOLOGY</center></strong>

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

			<?= @$equipment_tabs; ?>

    </div> 
