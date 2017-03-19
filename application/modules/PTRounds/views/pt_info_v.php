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
<div class = "row">
    <div class = "col-md-4">
        <div class="form-group">
            <label class = "control-label">Number of Testers</label>
            <input class = "form-control" name = "no_testers" type = "number" min = "1" value = "<?php if(isset($no_testers)) { echo $no_testers; } else { echo "1"; }?>" <?php if(isset($no_testers)) {echo "disabled"; }?> />
        </div>
    </div>
    <div class = "col-md-4">
        <div class="form-group">
            <label class = "control-label">Number of Labs</label>
            <input class = "form-control" name = "no_labs" type = "number" min = "1" value = "<?php if(isset($no_labs)) { echo $no_labs; } else { echo "1"; }?>" <?php if(isset($no_labs)) {echo "disabled"; } ?>/>
        </div>
    </div>
</div>

<div class="form-group">
    <label class="control-label">Round Duration</label>
    <input type="text" name="round_duration" class="form-control" value = "<?php if(isset($round_duration)){echo $round_duration;}?>"/>
</div>
<div class = "form-group">
    <table id = "sample_table" class = "table table-bordered table-hover">
        <thead>
            <th>#</th>
            <th>Sample #</th>
            <th>Sample Name</th>
            <th>Remove</th>
        </thead>
        <tbody>
            <?php
                if(isset($samples_table)){
                    echo $samples_table;
                }
            ?>
        </tbody>
    </table>
    <a class = 'btn btn-sm btn-success' id = 'add-sample'>Add Sample</a>
</div>