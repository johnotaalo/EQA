<div class="form-group">
    <label class = "control-label">Round ID</label>
    <input class = "form-control" value = "<?= @$round_no; ?>" disabled/>
</div>

<div class="form-group">
    <label class = "control-label">Blood Unit Lab ID</label>
    <div class = "input-group">
        <span class = "input-group-addon"><?= @$lab_prefix; ?></span>
        <input class = "form-control" name = "blood_unit_lab_id" type = "text" value = "<?php if(isset($lab_id)){ echo $lab_id; } ?>"/>
    </div>
</div>

<div class="form-group">
    <label class="control-label">Round Duration</label>
    <input type="text" name="round_duration" class="form-control" value = "<?php if(isset($round_duration)){echo $round_duration;}?>"/>
</div>
