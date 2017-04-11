<div class="row">
    <a href = "<?= @base_url('Dashboard/'); ?>"> <button class = "btn btn-primary btn-sm"><i class = "fa fa-arrow-left"></i>  Back to Dashboard</button></a>
</div>

<div class="container-fluid pt-2">
    <div class="animated fadeIn">
        <div class="animated fadeIn">
            <div class="row">


    <div class="col-md-12 mb-2">
       
                <?= @$this->load->view($data_submission); ?>
            
    </div>

            </div>
        </div>
    </div>
</div>
