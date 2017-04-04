<style>
    a.btn{
        color: #FFF !important;
    }
</style>

<div class = "row">
    <div class="col-md-12">
        <div class = "card">
        <div class="card-header col-4">
                <i class = "icon-user"></i>
                &nbsp;
                Equipment Edit
            </div>
            <div class = "card-block">
            <?= @form_open_multipart('Equipments/editEquipment', ["class" =>  "form-horizontal", 'id'  =>  'equipmentEditForm']); ?>
         
                    <div class = "row">
                        <div class = "col-md-7">
                                <div class = "form-group row">
                                    
                                    <div class = "col-md-9">
                                        <input  type = "hidden" name = "equipmentuuid" class = "form-control" value = "<?= @$equipment_uuid; ?>" required/>
                                    </div>
                                </div>

                                <div class = "form-group row">
                                    <label class = "col-md-3 form-control-label">Equipment Name :</label>
                                    <div class = "col-md-9">
                                        <input type = "text" name = "equipmentname" class = "form-control" value = "<?= @$equipment_name; ?>" required/>
                                    </div>
                                </div>

                                <div class = "form-group row">
                                    <label class = "col-md-3 form-control-label">Kit Name :</label>
                                    <div class = "col-md-9">
                                        <input type = "text" name = "equipmentname" class = "form-control" value = "<?= @$kit_name; ?>" required/>
                                    </div>
                                </div>

                                <div class = "form-group row">
                                    <label class = "col-md-3 form-control-label">Lysis Method :</label>
                                    <div class = "col-md-9">
                                        <input type = "text" name = "equipmentname" class = "form-control" value = "<?= @$lysis_method; ?>" required/>
                                    </div>
                                </div>

                                <div class = "form-group row">
                                    <label class = "col-md-3 form-control-label">Absolute Count Beads :</label>
                                    <div class = "col-md-9">
                                        <input type = "text" name = "equipmentname" class = "form-control" value = "<?= @$absolute_count_beads; ?>" required/>
                                    </div>
                                </div>

                                <div class = "form-group row">
                                    <label class = "col-md-3 form-control-label">Analytes Absolute :</label>
                                    <div class = "col-md-9">
                                        <input type = "text" name = "equipmentname" class = "form-control" value = "<?= @$analytes_absolute; ?>" required/>
                                    </div>
                                </div>

                                <div class = "form-group row">
                                    <label class = "col-md-3 form-control-label">CD3 :</label>
                                    <div class = "col-md-9">
                                        <input type = "text" name = "equipmentname" class = "form-control" value = "<?= @$analytes_absolute_cd3; ?>" required/>
                                    </div>
                                </div>

                                <div class = "form-group row">
                                    <label class = "col-md-3 form-control-label">CD4 :</label>
                                    <div class = "col-md-9">
                                        <input type = "text" name = "equipmentname" class = "form-control" value = "<?= @$analytes_absolute_cd4; ?>" required/>
                                    </div>
                                </div>

                                <div class = "form-group row">
                                    <label class = "col-md-3 form-control-label">Analytes Percent :</label>
                                    <div class = "col-md-9">
                                        <input type = "text" name = "equipmentname" class = "form-control" value = "<?= @$analytes_percent; ?>" required/>
                                    </div>
                                </div>

                                <div class = "form-group row">
                                    <label class = "col-md-3 form-control-label">CD3 :</label>
                                    <div class = "col-md-9">
                                        <input type = "text" name = "equipmentname" class = "form-control" value = "<?= @$analytes_percent_cd3; ?>" required/>
                                    </div>
                                </div>

                                <div class = "form-group row">
                                    <label class = "col-md-3 form-control-label">CD4 :</label>
                                    <div class = "col-md-9">
                                        <input type = "text" name = "equipmentname" class = "form-control" value = "<?= @$analytes_percent_cd4; ?>" required/>
                                    </div>
                                </div>

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