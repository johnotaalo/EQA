<div class="form-group">
    <label class = "control-label">Round ID</label>
    <input class = "form-control" value = "<?= @$round_no; ?>" disabled/>
</div>
<div class="form-group">
    <label class = "control-label">Blood Unit Lab ID</label>
    <div class = "input-group">
        <span class = "input-group-addon"><?= @$lab_prefix; ?></span>
        <input class = "form-control" name = "blood_unit_lab_id" type = "text"/>
    </div>
</div>
<div class = "row">
    <div class = "col-md-4">
        <div class="form-group">
            <label class = "control-label">Number of Testers</label>
            <input class = "form-control" name = "no_testers" type = "number" min = "1" value = "1"/>
        </div>
    </div>
    <div class = "col-md-4">
        <div class="form-group">
            <label class = "control-label">Number of Labs</label>
            <input class = "form-control" name = "no_labs" type = "number" min = "1" value = "1"/>
        </div>
    </div>
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
            
        </tbody>
    </table>
    <a class = 'btn btn-sm btn-success' id = 'add-sample'>Add Sample</a>
</div>