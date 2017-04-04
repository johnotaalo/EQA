<div class="row">
    <a href = "<?= @base_url('Dashboard/'); ?>"> <button class = "btn btn-primary btn-sm"><i class = "fa fa-arrow-left"></i>  Back to Dashboard</button></a>
</div>

<div class="container-fluid pt-2">
    <div class="animated fadeIn">
        <div class="animated fadeIn">
            <div class="row">


    <div class="col-md-12 mb-2">
        <ul class="nav nav-tabs" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#submission" role="tab" aria-controls="home"><i class="icon-calculator"></i> PT Data Submission &nbsp;
                <!-- <span class="tag tag-success">New</span> -->
                </a>
            </li>
            <!-- <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#equipment" role="tab" aria-controls="profile"><i class="icon-basket-loaded"></i> CD4 Equipment Info &nbsp;
                <!-- <span class="tag tag-pill tag-danger">29</span> -->
                </a>
            </li> -->
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#report" role="tab" aria-controls="messages"><i class="icon-pie-chart"></i> Participant Report &nbsp;
                <!-- <span class="tag tag-pill tag-danger">29</span> -->
                </a>
            </li>
        </ul>

        <div class="tab-content">
            <div class="tab-pane active" id="submission" role="tabpanel">
                <?= @$this->load->view($data_submission); ?>
            </div>
            <!-- <div class="tab-pane" id="equipment" role="tabpanel">
                <?= @$this->load->view($equipment_information); ?>
            </div> -->
            <div class="tab-pane" id="report" role="tabpanel">
               <?= @$this->load->view($participant_report); ?>
            </div>
        </div>
    </div>

            </div>
        </div>
    </div>
</div>
