<?= @form_open('Equipments/create', ['id'    =>  "createEquipment"]); ?>
    <!-- <div class = "form-group">
        <label class = "control-label">ID : <strong> <?= @$new_id_entry; ?></strong></label>
    </div> -->

    <div class = "form-group">
        <label class = "control-label">Equipment Name</label>
        <input type = "text" name = "equipmentname" class = "form-control"/>
    </div>

    <div class = "form-group">
        <label class = "control-label">Kit Names</label>
        <input type = "text" name = "kitnames" class = "form-control"/>
        <span class="help-block text-danger">Add a comma ( , ) to seperate multiple kit names</span>
    </div>

</form>