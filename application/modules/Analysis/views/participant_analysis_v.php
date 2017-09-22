

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

                    Participants Analysis

                <div class = "pull-right">
                    <a href = "<?= @base_url('Analysis/Results/'); ?><?= @$round_uuid?>"> <button class = "btn btn-primary btn-sm"><i class = "fa fa-arrow-left"></i>  Back to Analysis Results</button></a><br /><br />
                </div>
            </div>

            <div class = "card-block">

                <?= @$participants_info; ?>
            	<?= @$results_table; ?>
          
            </div>
        </div>
    </div>
</div>
        

