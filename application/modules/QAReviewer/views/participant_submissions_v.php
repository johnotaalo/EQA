<strong><center>METHODOLOGY</center></strong>



<?php if($this->session->flashdata('success')){ ?>
        <div id="data-info" class = 'alert alert-success'>
            <?= @$this->session->flashdata('success'); ?>
        </div>
  <?php }elseif($this->session->flashdata('error')){ ?>
        <div class = 'alert alert-danger'>
            <?= @$this->session->flashdata('error'); ?>
        </div>
  <?php } ?>


  	<div class = 'alert alert-warning'>
	    Please submit this form to NHRL through e-mail or hand delivery <span class="text-danger"><?= @date('dS F, Y', strtotime($pt_round_to)); ?></span>
    </div>
    <div class="col-md-12 mb-2 pull-right"><a href = "<?= @base_url('QAReviewer/PTRound/Round/'.$pt_uuid); ?> "> <button class = "btn btn-primary btn-sm"><i class = "fa fa-arrow-left"></i>  Back to Ready Participants</button></a><br /><br /></div>
		<div class="col-md-12 mb-2">
    <!-- Modal -->

    
			<?= @$equipment_tabs; ?>

    </div> 




