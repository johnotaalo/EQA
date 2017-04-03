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
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#equipment" role="tab" aria-controls="profile"><i class="icon-basket-loaded"></i> CD4 Equipment Info &nbsp;
                <!-- <span class="tag tag-pill tag-danger">29</span> -->
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#report" role="tab" aria-controls="messages"><i class="icon-pie-chart"></i> Participant Report &nbsp;
                <!-- <span class="tag tag-pill tag-danger">29</span> -->
                </a>
            </li>
        </ul>

        <div class="tab-content">
            <div class="tab-pane active" id="submission" role="tabpanel">
                1. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure
                dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
            </div>
            <div class="tab-pane" id="equipment" role="tabpanel">
                2. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure
                dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
            </div>
            <div class="tab-pane" id="report" role="tabpanel">
                <form method="POST" action="<?= @base_url(''); ?>" class="p-a-4" id="registrationForm">

                  <?php if($this->session->flashdata('success')){ ?>
                        <div class = 'alert alert-success'>
                            <?= @$this->session->flashdata('success'); ?>
                        </div>
                  <?php }elseif($this->session->flashdata('error')){ ?>
                        <div class = 'alert alert-danger'>
                            <?= @$this->session->flashdata('error'); ?>
                        </div>
                  <?php } ?>

  <div class="row">
    <div class="col-sm-12">

        <div class="card">
            <div class="card-header">
                <strong>PARTICIPANT DETAILS</strong>
            </div>
            <div class="card-block">

                  <!-- <h4 class="m-t-0 m-b-4 text-xs-center font-weight-semibold">PARTICIPANT DETAILS</h4> -->

                  <fieldset class="page-signup-form-group form-group form-group-lg">
                    <label class="col-md-3 form-control-label">Cycle Number</label>
                    <div class="col-md-9">
                        <input type="text" class="page-signup-form-control form-control" placeholder="Cycle Number" name = "cyclenumber">
                    </div>
                  </fieldset>

                  <fieldset class="page-signup-form-group form-group form-group-lg">
                    <label class="col-md-3 form-control-label">Facility Code</label>
                    <div class="col-md-9">
                        <input type="text" class="page-signup-form-control form-control" placeholder="Facility Code" name = "facilitycode">
                    </div>
                  </fieldset>

                  <fieldset class="page-signup-form-group form-group form-group-lg">
                    <label class="col-md-3 form-control-label">Facility Name</label>
                    <div class="col-md-9">
                        <input type="email" class="page-signup-form-control form-control" placeholder="Facility Name" name = "facilityname">
                    </div>
                  </fieldset>

                  <fieldset class="page-signup-form-group form-group form-group-lg">
                    <label class="col-md-3 form-control-label">Analyst Name</label>
                    <div class="col-md-9">
                        <input type="text" class="page-signup-form-control form-control" placeholder="Analyst Name" name = "analystname">
                    </div>
                  </fieldset>

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

                  <fieldset class="page-signup-form-group form-group form-group-lg">
                    <label class="col-md-3 form-control-label">Instrument</label>
                    <div class="col-md-9">
                        <input type="text" class="page-signup-form-control form-control" placeholder="Instrument" name = "instrument">
                    </div>
                  </fieldset>

                  <fieldset class="page-signup-form-group form-group form-group-lg">
                    <label class="col-md-3 form-control-label">SINGLE or DOUBLE Platform</label>
                    <div class="col-md-9">
                        <input type="text" class="page-signup-form-control form-control" placeholder="SINGLE or DOUBLE Platform" name = "sdplatform">
                    </div>
                  </fieldset>

                  <fieldset class="page-signup-form-group form-group form-group-lg">
                    <!-- <div class="form-group row"> -->
                        <label class="col-md-3 form-control-label">Reported Analytes</label>
                        <div class="col-md-9">
                            <label class="radio-inline" for="analytes1">
                                <input type="radio" id="analytes1" name="analytes" value="Lymphocyte Absolute Count">Lymphocyte Absolute Count
                            </label>
                            <label class="radio-inline" for="analytes2">
                                <input type="radio" id="analytes2" name="analytes" value="Lymphocyte Percentages">Lymphocyte Percentages
                            </label>
                            
                        </div>
                    <!-- </div> -->
                  </fieldset>

                  <fieldset class="page-signup-form-group form-group form-group-lg">
                    <label class="col-md-3 form-control-label">Number of Flourochromes</label>
                    <div class="col-md-9">
                        <input type="text" class="page-signup-form-control form-control" placeholder="Number of Flourochromes" name = "flourochromes">
                    </div>
                  </fieldset>

                  <fieldset class="page-signup-form-group form-group form-group-lg">
                    <label class="col-md-3 form-control-label">Antibodies and flourochromes</label>
                    <div class="col-md-9">
                        <input type="text" class="page-signup-form-control form-control" placeholder="Antibodies and flourochromes" name = "antiflourochromes">
                    </div>
                  </fieldset>


                    <fieldset class="page-signup-form-group form-group form-group-lg">
                        <table class="table table-striped">
                            <tr>
                                <thead>
                                    <th>Antibody</th>
                                    <th>FL1</th>
                                    <th>Antibody</th>
                                    <th>FL2</th>
                                    <th>Antibody</th>
                                    <th>FL3</th>
                                    <th>Antibody</th>
                                    <th>FL4</th>
                                </thead>
                            </tr>
                            <tr>
                                <td>CD3</td>
                                <td>
                                    <input type="text" class="page-signup-form-control form-control" placeholder="FL1" name = "fl1">
                                </td>
                                <td>CD4</td>
                                <td>
                                    <input type="text" class="page-signup-form-control form-control" placeholder="FL2" name = "fl2">
                                </td>
                                <td>
                                    <input type="text" class="page-signup-form-control form-control" placeholder="Antibody 3" name = "antibody3">
                                </td>
                                <td>
                                    <input type="text" class="page-signup-form-control form-control" placeholder="FL3" name = "fl3">
                                </td>
                                <td>
                                    <input type="text" class="page-signup-form-control form-control" placeholder="Antibody 4" name = "antibody4">
                                </td>
                                <td>
                                    <input type="text" class="page-signup-form-control form-control" placeholder="FL4" name = "fl4">
                                </td>
                            </tr>
                        </table>
                    </fieldset>

                  <fieldset class="page-signup-form-group form-group form-group-lg">
                    <label class="col-md-3 form-control-label">Lyse Method</label>
                    <div class="col-md-9">
                        <input type="text" class="page-signup-form-control form-control" placeholder="Lyse Method" name = "lysemethod">
                    </div>
                  </fieldset>

                  <fieldset class="page-signup-form-group form-group form-group-lg">
                    <label class="col-md-3 form-control-label">Absolute Count Beads</label>
                    <div class="col-md-9">
                        <input type="text" class="page-signup-form-control form-control" placeholder="Absolute Count Beads" name = "acb">
                    </div>
                  </fieldset>


                </div>   
            </div>
        </div>
    </div>


  <div class="row">
    <div class="col-sm-12">

        <div class="card">
            <div class="card-header">
                <strong>REPORTED RESULTS</strong>
            </div>
                <div class="card-block">
                    <table class="table table-striped">
                        <tr>
                            <thead>
                                <th>PANEL</th>
                                <th>ABSOLUTE COUNT (cells/&mu;l)</th>
                                <th>PERCENTAGES (%)</th>
                            </thead>
                        </tr>
                        <tr>
                            <th>
                                1
                            </th>
                            <td>
                                <input type="text" class="page-signup-form-control form-control" placeholder="Absolute Count 1" name = "ac1">
                            </td>
                            <td>
                                <input type="text" class="page-signup-form-control form-control" placeholder="Percentage 1" name = "p1">
                            </td>
                        </tr>
                        <tr>
                            <th>
                                2
                            </th>
                            <td>
                                <input type="text" class="page-signup-form-control form-control" placeholder="Absolute Count 2" name = "ac2">
                            </td>
                            <td>
                                <input type="text" class="page-signup-form-control form-control" placeholder="Percentage 2" name = "p2">
                            </td>
                        </tr>
                        <tr>
                            <th>
                                3
                            </th>
                            <td>
                                <input type="text" class="page-signup-form-control form-control" placeholder="Absolute Count 3" name = "ac3">
                            </td>
                            <td>
                                <input type="text" class="page-signup-form-control form-control" placeholder="Percentage 3" name = "p3">
                            </td>
                        </tr>
                    </table>


                </div>   
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <strong>STATISTICAL ANALYSIS - Absolute Counts</strong>
                </div>
                <div class="card-block">
                    <table class="table table-bordered">
                        <tr>
                            <td rowspan="2">
                                SPECIMEN
                            </td>
                            <td colspan="2">
                                PANEL 1
                            </td>
                            <!-- <td></td> -->
                            <td colspan="2">
                                PANEL 2
                            </td>
                            <!-- <td></td> -->
                            <td colspan="2">
                                PANEL 3
                            </td>
                            <!-- <td></td> -->
                        </tr>
                        <tr>
                            <!-- <td></td> -->
                            <td>
                                CD3
                            </td>
                            <td>
                                CD4
                            </td>
                            <td>
                                CD3
                            </td>
                            <td>
                                CD4
                            </td>
                            <td>
                                CD3
                            </td>
                            <td>
                                CD4
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Reported
                            </td>
                            <td>
                                <input type="text" class="page-signup-form-control form-control" placeholder="" name = "counts_panel1_rep_cd3">
                            </td>
                            <td>
                                <input type="text" class="page-signup-form-control form-control" placeholder="" name = "counts_panel1_rep_cd4">
                            </td>
                            <td>
                                <input type="text" class="page-signup-form-control form-control" placeholder="" name = "counts_panel2_rep_cd3">
                            </td>
                            <td>
                                <input type="text" class="page-signup-form-control form-control" placeholder="" name = "counts_panel2_rep_cd4">
                            </td>
                            <td>
                                <input type="text" class="page-signup-form-control form-control" placeholder="" name = "counts_panel3_rep_cd3">
                            </td>
                            <td>
                                <input type="text" class="page-signup-form-control form-control" placeholder="" name = "counts_panel3_rep_cd4">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Mean
                            </td>
                            <td>
                                <input type="text" class="page-signup-form-control form-control" placeholder="" name = "counts_panel1_mean_cd3">
                            </td>
                            <td>
                                <input type="text" class="page-signup-form-control form-control" placeholder="" name = "counts_panel1_mean_cd4">
                            </td>
                            <td>
                                <input type="text" class="page-signup-form-control form-control" placeholder="" name = "counts_panel2_mean_cd3">
                            </td>
                            <td>
                                <input type="text" class="page-signup-form-control form-control" placeholder="" name = "counts_panel2_mean_cd4">
                            </td>
                            <td>
                                <input type="text" class="page-signup-form-control form-control" placeholder="" name = "counts_panel3_mean_cd3">
                            </td>
                            <td>
                                <input type="text" class="page-signup-form-control form-control" placeholder="" name = "counts_panel3_mean_cd4">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Residual
                            </td>
                            <td>
                                <input type="text" class="page-signup-form-control form-control" placeholder="" name = "counts_panel1_res_cd3">
                            </td>
                            <td>
                                <input type="text" class="page-signup-form-control form-control" placeholder="" name = "counts_panel1_res_cd4">
                            </td>
                            <td>
                                <input type="text" class="page-signup-form-control form-control" placeholder="" name = "counts_panel2_res_cd3">
                            </td>
                            <td>
                                <input type="text" class="page-signup-form-control form-control" placeholder="" name = "counts_panel2_res_cd4">
                            </td>
                            <td>
                                <input type="text" class="page-signup-form-control form-control" placeholder="" name = "counts_panel3_res_cd3">
                            </td>
                            <td>
                                <input type="text" class="page-signup-form-control form-control" placeholder="" name = "counts_panel3_res_cd4">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                SD
                            </td>
                            <td>
                                <input type="text" class="page-signup-form-control form-control" placeholder="" name = "counts_panel1_sd_cd3">
                            </td>
                            <td>
                                <input type="text" class="page-signup-form-control form-control" placeholder="" name = "counts_panel1_sd_cd4">
                            </td>
                            <td>
                                <input type="text" class="page-signup-form-control form-control" placeholder="" name = "counts_panel2_sd_cd3">
                            </td>
                            <td>
                                <input type="text" class="page-signup-form-control form-control" placeholder="" name = "counts_panel2_sd_cd4">
                            </td>
                            <td>
                                <input type="text" class="page-signup-form-control form-control" placeholder="" name = "counts_panel3_sd_cd3">
                            </td>
                            <td>
                                <input type="text" class="page-signup-form-control form-control" placeholder="" name = "counts_panel3_sd_cd4">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                SDI
                            </td>
                            <td>
                                <input type="text" class="page-signup-form-control form-control" placeholder="" name = "counts_panel1_sdi_cd3">
                            </td>
                            <td>
                                <input type="text" class="page-signup-form-control form-control" placeholder="" name = "counts_panel1_sdi_cd4">
                            </td>
                            <td>
                                <input type="text" class="page-signup-form-control form-control" placeholder="" name = "counts_panel2_sdi_cd3">
                            </td>
                            <td>
                                <input type="text" class="page-signup-form-control form-control" placeholder="" name = "counts_panel2_sdi_cd4">
                            </td>
                            <td>
                                <input type="text" class="page-signup-form-control form-control" placeholder="" name = "counts_panel3_sdi_cd3">
                            </td>
                            <td>
                                <input type="text" class="page-signup-form-control form-control" placeholder="" name = "counts_panel3_sdi_cd4">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Performance
                            </td>
                            <td>
                                <input type="text" class="page-signup-form-control form-control" placeholder="" name = "counts_panel1_per_cd3">
                            </td>
                            <td>
                                <input type="text" class="page-signup-form-control form-control" placeholder="" name = "counts_panel1_per_cd4">
                            </td>
                            <td>
                                <input type="text" class="page-signup-form-control form-control" placeholder="" name = "counts_panel2_per_cd3">
                            </td>
                            <td>
                                <input type="text" class="page-signup-form-control form-control" placeholder="" name = "counts_panel2_per_cd4">
                            </td>
                            <td>
                                <input type="text" class="page-signup-form-control form-control" placeholder="" name = "counts_panel3_per_cd3">
                            </td>
                            <td>
                                <input type="text" class="page-signup-form-control form-control" placeholder="" name = "counts_panel3_per_cd4">
                            </td>
                        </tr>
                        <tr>
                            <td rowspan="2">
                                Key: 
                            </td>
                            <td colspan="3">
                                <strong>Residual</strong> = Reported Value-Mean Value
                            </td>
                            <td colspan="3">
                                <strong>SDI</strong> (Standard Deviation Index) = Residual / SD
                            </td>
                        </tr>
                        <tr>
                            <!-- <td></td> -->
                            <td colspan="3">
                                <strong style="font-size: 20px">&#9786;</strong> = Within Range
                            </td>
                            <td colspan="3">
                                <strong style="font-size: 20px">&#x2639;</strong> = Out of Range
                            </td>
                        </tr>
                    </table>
                </div>   
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <strong>STATISTICAL ANALYSIS - Percentage</strong>
                </div>
                <div class="card-block">
                    <table class="table table-bordered">
                        <tr>
                            <td rowspan="2">
                                SPECIMEN
                            </td>
                            <td colspan="2">
                                PANEL 1
                            </td>
                            <!-- <td></td> -->
                            <td colspan="2">
                                PANEL 2
                            </td>
                            <!-- <td></td> -->
                            <td colspan="2">
                                PANEL 3
                            </td>
                            <!-- <td></td> -->
                        </tr>
                        <tr>
                            <!-- <td></td> -->
                            <td>
                                CD3
                            </td>
                            <td>
                                CD4
                            </td>
                            <td>
                                CD3
                            </td>
                            <td>
                                CD4
                            </td>
                            <td>
                                CD3
                            </td>
                            <td>
                                CD4
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Reported
                            </td>
                            <td>
                                <input type="text" class="page-signup-form-control form-control" placeholder="" name = "percentage_panel1_rep_cd3">
                            </td>
                            <td>
                                <input type="text" class="page-signup-form-control form-control" placeholder="" name = "percentage_panel1_rep_cd4">
                            </td>
                            <td>
                                <input type="text" class="page-signup-form-control form-control" placeholder="" name = "percentage_panel2_rep_cd3">
                            </td>
                            <td>
                                <input type="text" class="page-signup-form-control form-control" placeholder="" name = "percentage_panel2_rep_cd4">
                            </td>
                            <td>
                                <input type="text" class="page-signup-form-control form-control" placeholder="" name = "percentage_panel3_rep_cd3">
                            </td>
                            <td>
                                <input type="text" class="page-signup-form-control form-control" placeholder="" name = "percentage_panel3_rep_cd4">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Mean
                            </td>
                            <td>
                                <input type="text" class="page-signup-form-control form-control" placeholder="" name = "percentage_panel1_mean_cd3">
                            </td>
                            <td>
                                <input type="text" class="page-signup-form-control form-control" placeholder="" name = "percentage_panel1_mean_cd4">
                            </td>
                            <td>
                                <input type="text" class="page-signup-form-control form-control" placeholder="" name = "percentage_panel2_mean_cd3">
                            </td>
                            <td>
                                <input type="text" class="page-signup-form-control form-control" placeholder="" name = "percentage_panel2_mean_cd4">
                            </td>
                            <td>
                                <input type="text" class="page-signup-form-control form-control" placeholder="" name = "percentage_panel3_mean_cd3">
                            </td>
                            <td>
                                <input type="text" class="page-signup-form-control form-control" placeholder="" name = "percentage_panel3_mean_cd4">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Residual
                            </td>
                            <td>
                                <input type="text" class="page-signup-form-control form-control" placeholder="" name = "percentage_panel1_res_cd3">
                            </td>
                            <td>
                                <input type="text" class="page-signup-form-control form-control" placeholder="" name = "percentage_panel1_res_cd4">
                            </td>
                            <td>
                                <input type="text" class="page-signup-form-control form-control" placeholder="" name = "percentage_panel2_res_cd3">
                            </td>
                            <td>
                                <input type="text" class="page-signup-form-control form-control" placeholder="" name = "percentage_panel2_res_cd4">
                            </td>
                            <td>
                                <input type="text" class="page-signup-form-control form-control" placeholder="" name = "percentage_panel3_res_cd3">
                            </td>
                            <td>
                                <input type="text" class="page-signup-form-control form-control" placeholder="" name = "percentage_panel3_res_cd4">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                SD
                            </td>
                            <td>
                                <input type="text" class="page-signup-form-control form-control" placeholder="" name = "percentage_panel1_sd_cd3">
                            </td>
                            <td>
                                <input type="text" class="page-signup-form-control form-control" placeholder="" name = "percentage_panel1_sd_cd4">
                            </td>
                            <td>
                                <input type="text" class="page-signup-form-control form-control" placeholder="" name = "percentage_panel2_sd_cd3">
                            </td>
                            <td>
                                <input type="text" class="page-signup-form-control form-control" placeholder="" name = "percentage_panel2_sd_cd4">
                            </td>
                            <td>
                                <input type="text" class="page-signup-form-control form-control" placeholder="" name = "percentage_panel3_sd_cd3">
                            </td>
                            <td>
                                <input type="text" class="page-signup-form-control form-control" placeholder="" name = "percentage_panel3_sd_cd4">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                SDI
                            </td>
                            <td>
                                <input type="text" class="page-signup-form-control form-control" placeholder="" name = "percentage_panel1_sdi_cd3">
                            </td>
                            <td>
                                <input type="text" class="page-signup-form-control form-control" placeholder="" name = "percentage_panel1_sdi_cd4">
                            </td>
                            <td>
                                <input type="text" class="page-signup-form-control form-control" placeholder="" name = "percentage_panel2_sdi_cd3">
                            </td>
                            <td>
                                <input type="text" class="page-signup-form-control form-control" placeholder="" name = "percentage_panel2_sdi_cd4">
                            </td>
                            <td>
                                <input type="text" class="page-signup-form-control form-control" placeholder="" name = "percentage_panel3_sdi_cd3">
                            </td>
                            <td>
                                <input type="text" class="page-signup-form-control form-control" placeholder="" name = "percentage_panel3_sdi_cd4">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Performance
                            </td>
                            <td>
                                <input type="text" class="page-signup-form-control form-control" placeholder="" name = "percentage_panel1_per_cd3">
                            </td>
                            <td>
                                <input type="text" class="page-signup-form-control form-control" placeholder="" name = "percentage_panel1_per_cd4">
                            </td>
                            <td>
                                <input type="text" class="page-signup-form-control form-control" placeholder="" name = "percentage_panel2_per_cd3">
                            </td>
                            <td>
                                <input type="text" class="page-signup-form-control form-control" placeholder="" name = "percentage_panel2_per_cd4">
                            </td>
                            <td>
                                <input type="text" class="page-signup-form-control form-control" placeholder="" name = "percentage_panel3_per_cd3">
                            </td>
                            <td>
                                <input type="text" class="page-signup-form-control form-control" placeholder="" name = "percentage_panel3_per_cd4">
                            </td>
                        </tr>
                        <tr>
                            <td rowspan="2">
                                Key: 
                            </td>
                            <td colspan="3">
                                <strong>Residual</strong> = Reported Value-Mean Value
                            </td>
                            <td colspan="3">
                                <strong>SDI</strong> (Standard Deviation Index) = Residual / SD
                            </td>
                        </tr>
                        <tr>
                            <!-- <td></td> -->
                            <td colspan="3">
                                <strong style="font-size: 20px">&#9786;</strong> = Within Range
                            </td>
                            <td colspan="3">
                                <strong style="font-size: 20px">&#x2639;</strong> = Out of Range
                            </td>
                        </tr>
                    </table>
                </div>   
            </div>
        </div>
    </div>



    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <strong>Performance History</strong>
                </div>
                <div class="card-block">
                    <div class="animated fadeIn">

                        <!-- <div class="card-columns"> -->
                            <div class="card col-sm-6">
                                <div class="card-header col-sm-12">
                                    Absolute Count - CD3
                                    <div class="card-actions">
                                        <a href="http://www.chartjs.org/">
                                            <small class="text-muted">docs</small>
                                        </a>
                                    </div>
                                </div>
                                <div class="card-block">
                                    <div class="chart-wrapper">
                                        <canvas id="canvas-1"></canvas>
                                    </div>
                                </div>
                            </div>
                        <!-- </div> -->

                        <!-- <div class="card-columns"> -->
                            <div class="card col-sm-6">
                                <div class="card-header col-sm-12">
                                    Percentage - CD3
                                    <div class="card-actions">
                                        <a href="http://www.chartjs.org/">
                                            <small class="text-muted">docs</small>
                                        </a>
                                    </div>
                                </div>
                                <div class="card-block">
                                    <div class="chart-wrapper">
                                        <canvas id="canvas-1"></canvas>
                                    </div>
                                </div>
                            </div>
                        <!-- </div> -->

                        <!-- <div class="card-columns"> -->
                            <div class="card col-sm-6">
                                <div class="card-header col-sm-12">
                                    Absolute Count - CD4
                                    <div class="card-actions">
                                        <a href="http://www.chartjs.org/">
                                            <small class="text-muted">docs</small>
                                        </a>
                                    </div>
                                </div>
                                <div class="card-block">
                                    <div class="chart-wrapper">
                                        <canvas id="canvas-1"></canvas>
                                    </div>
                                </div>
                            </div>
                        <!-- </div> -->

                        <!-- <div class="card-columns"> -->
                            <div class="card col-sm-6">
                                <div class="card-header col-sm-12">
                                    Percentage - CD4
                                    <div class="card-actions">
                                        <a href="http://www.chartjs.org/">
                                            <small class="text-muted">docs</small>
                                        </a>
                                    </div>
                                </div>
                                <div class="card-block">
                                    <div class="chart-wrapper">
                                        <canvas id="canvas-1"></canvas>
                                    </div>
                                </div>
                            </div>
                        <!-- </div> -->

                    </div>
                </div>   
            </div>
        </div>
    </div>







                  <button type="submit" class="btn btn-block btn-lg btn-primary m-t-3">Save as Draft</button>
                  <button type="submit" class="btn btn-block btn-lg btn-success m-t-3">Mark as Complete</button>
                </form>
            </div>
        </div>
    </div>

            </div>
        </div>
    </div>
</div>
