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
                                    <label class = "col-md-3 form-control-label">Equipment ID :<strong> <?= @$equipment_id; ?> </strong></label>
                                    <div class = "col-md-9">
                                        <input  type = "hidden" name = "equipmentid" class = "form-control" value = "<?= @$equipment_id; ?>" required/>
                                    </div>
                                </div>

                                <div class = "form-group row">
                                    <label class = "col-md-3 form-control-label">Equipment Name :</label>
                                    <div class = "col-md-9">
                                        <input type = "text" name = "equipmentname" class = "form-control" value = "<?= @$equipment_name; ?>" required/>
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