<form method="POST" action="<?= @base_url(''); ?>" class="p-a-4" id="participant-report">

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
                        <!-- <input type="text" class="page-signup-form-control form-control" placeholder="Facility Code" name = "facilitycode"> -->
                        <h5><?= @$user->facility_code; ?></h5>
                    </div>
                  </fieldset>

                  <fieldset class="page-signup-form-group form-group form-group-lg">
                    <label class="col-md-3 form-control-label">Facility Name</label>
                    <div class="col-md-9">
                        <h5><?= @$user->facility_name; ?></h5>
                    </div>
                  </fieldset>

                  <fieldset class="page-signup-form-group form-group form-group-lg">
                    <label class="col-md-3 form-control-label">Analyst Name</label>
                    <div class="col-md-9">
                        <h5><?= @$user->firstname . ' ' . $user->lastname; ?></h5>
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
                                <input type="radio" id="analytes1" name="analytes" value="Lymphocyte Absolute Count">&nbsp;Lymphocyte Absolute Count&nbsp;&nbsp;&nbsp;&nbsp;
                            </label>
                            <label class="radio-inline" for="analytes2">
                                <input type="radio" id="analytes2" name="analytes" value="Lymphocyte Percentages">&nbsp;Lymphocyte Percentages&nbsp;&nbsp;
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
                                    <th style="text-align: center;">Antibody</th>
                                    <th style="text-align: center;">FL1</th>
                                    <th style="text-align: center;">Antibody</th>
                                    <th style="text-align: center;">FL2</th>
                                    <th style="text-align: center;">Antibody</th>
                                    <th style="text-align: center;">FL3</th>
                                    <th style="text-align: center;">Antibody</th>
                                    <th style="text-align: center;">FL4</th>
                                </thead>
                            </tr>
                            <tr>
                                <td style="text-align: center;">CD3</td>
                                <td>
                                    <input type="text" class="page-signup-form-control form-control" placeholder="FL1" name = "fl1">
                                </td>
                                <td style="text-align: center;">CD4</td>
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
                                <th style="text-align: center;">PANEL</th>
                                <th style="text-align: center;">ABSOLUTE COUNT (cells/&mu;l)</th>
                                <th style="text-align: center;">PERCENTAGES (%)</th>
                            </thead>
                        </tr>
                        <tr>
                            <th style="text-align: center;">
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
                            <th style="text-align: center;">
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
                            <th style="text-align: center;">
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
                            <th style="text-align: center;" rowspan="2">
                                SPECIMEN
                            </th>
                            <th style="text-align: center;" colspan="2">
                                PANEL 1
                            </th>
                            <!-- <td></td> -->
                            <th style="text-align: center;" colspan="2">
                                PANEL 2
                            </th>
                            <!-- <td></td> -->
                            <th style="text-align: center;" colspan="2">
                                PANEL 3
                            </th>
                            <!-- <td></td> -->
                        </tr>
                        <tr>
                            <!-- <td></td> -->
                            <th style="text-align: center;">
                                CD3
                            </th>
                            <th style="text-align: center;">
                                CD4
                            </th>
                            <th style="text-align: center;">
                                CD3
                            </th>
                            <th style="text-align: center;">
                                CD4
                            </th>
                            <th style="text-align: center;">
                                CD3
                            </th>
                            <th style="text-align: center;">
                                CD4
                            </th>
                        </tr>
                        <tr>
                            <th style="text-align: center;">
                                Reported
                            </th>
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
                            <th style="text-align: center;">
                                Mean
                            </th>
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
                            <th style="text-align: center;">
                                Residual
                            </th>
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
                            <th style="text-align: center;">
                                SD
                            </th>
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
                            <th style="text-align: center;">
                                SDI
                            </th>
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
                            <th style="text-align: center;">
                                Performance
                            </th>
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
                            <th style="text-align: center;" rowspan="2">
                                Key: 
                            </th>
                            <td style="text-align: center;" colspan="3">
                                <strong>Residual</strong> = Reported Value-Mean Value
                            </td>
                            <td style="text-align: center;" colspan="3">
                                <strong>SDI</strong> (Standard Deviation Index) = Residual / SD
                            </td>
                        </tr>
                        <tr>
                            <!-- <td></td> -->
                            <td style="text-align: center;" colspan="3">
                                <strong style="font-size: 20px">&#9786;</strong> = Within Range
                            </td>
                            <td style="text-align: center;" colspan="3">
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
                            <th style="text-align: center;" rowspan="2">
                                SPECIMEN
                            </th>
                            <th style="text-align: center;" colspan="2">
                                PANEL 1
                            </th>
                            <!-- <td></td> -->
                            <th style="text-align: center;" colspan="2">
                                PANEL 2
                            </th>
                            <!-- <td></td> -->
                            <th style="text-align: center;" colspan="2">
                                PANEL 3
                            </th>
                            <!-- <td></td> -->
                        </tr>
                        <tr>
                            <!-- <td></td> -->
                            <th style="text-align: center;">
                                CD3
                            </th>
                            <th style="text-align: center;">
                                CD4
                            </th>
                            <th style="text-align: center;">
                                CD3
                            </th>
                            <th style="text-align: center;">
                                CD4
                            </th>
                            <th style="text-align: center;">
                                CD3
                            </th>
                            <th style="text-align: center;">
                                CD4
                            </th>
                        </tr>
                        <tr>
                            <th style="text-align: center;">
                                Reported
                            </th>
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
                            <th style="text-align: center;">
                                Mean
                            </th>
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
                            <th style="text-align: center;">
                                Residual
                            </th>
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
                            <th style="text-align: center;">
                                SD
                            </th>
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
                            <th style="text-align: center;">
                                SDI
                            </th>
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
                            <th style="text-align: center;">
                                Performance
                            </th>
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
                            <th style="text-align: center;" rowspan="2">
                                Key: 
                            </th>
                            <td style="text-align: center;" colspan="3">
                                <strong>Residual</strong> = Reported Value-Mean Value
                            </td>
                            <td style="text-align: center;" colspan="3">
                                <strong>SDI</strong> (Standard Deviation Index) = Residual / SD
                            </td>
                        </tr>
                        <tr>
                            <!-- <td></td> -->
                            <td style="text-align: center;" colspan="3">
                                <strong style="font-size: 20px">&#9786;</strong> = Within Range
                            </td>
                            <td style="text-align: center;" colspan="3">
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
                                    <strong>Absolute Count - CD3</strong>
                                    <div class="card-actions">
                                        <a href="#">
                                            <small class="text-muted">download</small>
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
                                    <strong>Percentage - CD3</strong>
                                    <div class="card-actions">
                                        <a href="#">
                                            <small class="text-muted">download</small>
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
                                    <strong>Absolute Count - CD4</strong>
                                    <div class="card-actions">
                                        <a href="#">
                                            <small class="text-muted">download</small>
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
                                    <strong>Percentage - CD4</strong>
                                    <div class="card-actions">
                                        <a href="#">
                                            <small class="text-muted">download</small>
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