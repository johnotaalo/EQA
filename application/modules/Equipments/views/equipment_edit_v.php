<style>
    a.btn{
        color: #FFF !important;
    }
</style>



<div class = "row">
    <div class="col-md-12">
    
    <a href = "<?= @base_url('Equipments/equipmentlist/'); ?>"> <button class = "btn btn-primary btn-sm"><i class = "fa fa-arrow-left"></i>  Back to Equipments</button></a><br /><br />
        <div class = "card">
        <div class="card-header col-4">
                <i class = "icon-user"></i>
                &nbsp;
                Equipment Edit
            </div>
            <div class = "card-block">
            <?= @form_open_multipart('Equipments/editEquipment', ["class" =>  "form-horizontal", 'id'  =>  'equipmentEditForm']); ?>
         
                    <div class = "row">
                        <div class = "col-md-6">
                                <div class = "form-group row">
                                    
                                    <div class = "col-md-9">
                                        <input  type = "hidden" name = "equipmentuuid" class = "form-control" value = "<?= @$equipment_uuid; ?>" required/>
                                    </div>
                                </div>

                                <div class = "form-group row">
                                    <label class = "col-md-3 form-control-label">Equipment Name</label>
                                    <div class = "col-md-9">
                                        <input type = "text" name = "equipmentname" class = "form-control" value = "<?= @$equipment_name; ?>" required/>
                                    </div>
                                </div>

                                <div class = "form-group row">
                                    <label class = "col-md-3 form-control-label">Kit Name</label>
                                    <div class = "col-md-9">
                                        <input type = "text" name = "kitname" class = "form-control" value = "<?= @$kit_name; ?>" required/>
                                    </div>
                                </div>

                                <div class = "form-group row">
                                    <label class = "col-md-3 form-control-label">Lysis Method</label>
                                    <div class = "col-md-9">
                                        <input type = "text" name = "lysismethod" class = "form-control" value = "<?= @$lysis_method; ?>" required/>
                                    </div>
                                </div>

                                <div class = "form-group row">
                                    <label class = "col-md-3 form-control-label">Absolute Count Beads</label>
                                    <div class = "col-md-9">
                                        <input type = "text" name = "acb" class = "form-control" value = "<?= @$absolute_count_beads; ?>" required/>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="absolute">Analytes Absolute</label>
                                    <div class="col-md-3">
                                        <select id="absolute" name="absolute" class="form-control input-sm" size="1">
                                        <?php if($analytes_absolute == 1){ ?>
                                            <option selected value="1">Yes</option>
                                            <option value="0">No</option>
                                        <?php }else if($analytes_absolute == 0){ ?>
                                            <option selected value="0">No</option>
                                            <option value="1">Yes</option>
                                        <?php } ?>
                                        </select>
                                    </div>

                                    <label for="absolute_cd3" class = "col-md-3 form-control-label">CD3</label>
                                    <div class="checkbox">
                                        <label >
                                        <?php if($analytes_absolute_cd3 == 1){ ?>
                                            <input type="checkbox" id="absolute_cd3" name="absolute_cd3" value="1" checked>
                                       <?php }else if($analytes_absolute_cd3 == 0){ ?>
                                            <input type="checkbox" id="absolute_cd3" name="absolute_cd3" value="1">
                                       <?php } ?>
                                            
                                    </div>

                                    <label for="absolute_cd4" class = "col-md-3 form-control-label">CD4</label>
                                    <div class="checkbox">
                                        <label >
                                        <?php if($analytes_absolute_cd4 == 1){ ?>
                                            <input type="checkbox" id="absolute_cd4" name="absolute_cd4" value="1" checked>
                                       <?php }else if($analytes_absolute_cd4 == 0){ ?>
                                            <input type="checkbox" id="absolute_cd4" name="absolute_cd4" value="1">
                                       <?php } ?>
                                            
                                    </div>


                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="percent">Analytes Percent</label>
                                    <div class="col-md-3">
                                        <select id="percent" name="percent" class="form-control input-sm" size="1">
                                        <?php if($analytes_percent == 1){ ?>
                                            <option selected value="1">Yes</option>
                                            <option value="0">No</option>
                                        <?php }else if($analytes_percent == 0){ ?>
                                            <option selected value="0">No</option>
                                            <option value="1">Yes</option>
                                        <?php } ?>
                                        </select>
                                    </div>

                                    <label for="percent_cd3" class = "col-md-3 form-control-label">CD3</label>
                                    <div class="checkbox">
                                        <label >
                                        <?php if($analytes_percent_cd3 == 1){ ?>
                                            <input type="checkbox" id="percent_cd3" name="percent_cd3" value="1" checked>
                                       <?php }else if($analytes_percent_cd3 == 0){ ?>
                                            <input type="checkbox" id="percent_cd3" name="percent_cd3" value="1">
                                       <?php } ?>
                                            
                                    </div>

                                    <label for="percent_cd4" class = "col-md-3 form-control-label">CD4</label>
                                    <div class="checkbox">
                                        <label >
                                        <?php if($analytes_percent_cd4 == 1){ ?>
                                            <input type="checkbox" id="percent_cd4" name="percent_cd4" value="1" checked>
                                       <?php }else if($analytes_percent_cd4 == 0){ ?>
                                            <input type="checkbox" id="percent_cd4" name="percent_cd4" value="1">
                                       <?php } ?>
                                            
                                    </div>
                                </div>
                        </div>

                        <div class = "col-md-6">
                            <div class="row">
                                <div class = "form-group row">
                                    <label class = "col-md-6 form-control-label"><strong>Flourochromes</strong></label>
                                    <div class="col-md-6">
                                      <a class = "btn btn-success btn-sm" id = "add-edit-flouro"><i class = "icon-plus"></i> Add flourochrome
                                      </a>
                                    </div>
                                </div>

                                <div id = "flouro-chromes" class = "col-md-12">
                                    <?= @$flourochromes; ?>
                                </div>
                        
                            </div>
                    <div class = "row">
                        <div style = "margin-top: 10px;">
                            <button id = "saveChanges" class = "btn btn-primary btn-block" type = "submit">
                                <i class = "icon-pencil"></i> Save Changes
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>