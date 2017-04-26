<style>
    a.btn{
        color: #FFF !important;
    }
</style>
<div class = "card-block">
    <?php if($this->session->flashdata('success')){ ?>
        <div class = 'alert alert-info'>
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
    
    <a href = "<?= @base_url('Dashboard/viewMessages/'); ?>"> <button class = "btn btn-primary btn-sm"><i class = "fa fa-arrow-left"></i>  Back to Messages</button></a><br /><br />
        <div class = "card">
        <div class="card-header col-4">
                <i class = "icon-user"></i>
                &nbsp;
                My Message
            </div>
            <div class = "card-block">
                <div class = "row">
                    <div class = "col-md-12">
                        <div class = "form-group row">
                            
                        </div>

                        <div class = "form-group row">
                            <label class = "col-md-3 form-control-label">From: <strong><?= @$from; ?></strong></label>

                            <label class = "col-md-3 form-control-label">Email: <strong><?= @$email; ?></strong></label> 
                        </div>

                        <div class = "form-group row">
                            <label class = "col-md-3 form-control-label">Subject: <strong><?= @$subject; ?></strong></label>
                            
                        </div>

                        <div class = "form-group row">
                            <label class = "col-md-1 form-control-label">Message:</label>
                            <div class = "col-md-11">
                                <?= @$message; ?>
                            </div>
                        </div>        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>