<form method = "post" action="<?php echo base_url('');?>" class="p-a-4" id="page-signin-form">

    <div class = "form-group">
        <label class = "control-label">Equipment Name</label>
        <input type = "text" name = "equipmentname" class = "form-control"/>
    </div>

    <div class = "form-group">
        <label class = "control-label">Kit Names</label>
        <input type = "text" name = "kitnames" class = "form-control"/>
    </div>

    <div class = "form-group">
        <label class = "control-label">Lysis Method</label>
        <input type = "text" name = "lysis" class = "form-control"/>
        <span class="help-block text-info">Leave empty if none</span>
    </div>

    <div class = "form-group">
        <label class = "control-label">Absolute Count beads</label>
        <input type = "text" name = "acb" class = "form-control"/>
        <span class="help-block text-info">Leave empty if none</span>
    </div>

</form>