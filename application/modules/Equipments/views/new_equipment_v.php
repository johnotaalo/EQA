<?= @form_open('Equipments/create', ['id'    =>  "createEquipment"]); ?>
    <div class = "form-group">
        <label class = "control-label">ID : <strong> <?= @$new_id_entry; ?></strong></label>
        <!-- <input type = "text" disabled="" class = "form-control"/> -->
    </div>

    <div class = "form-group">
        <label class = "control-label">Equipment Name</label>
        <input type = "text" name = "equipmentname" class = "form-control"/>
    </div>

</form>