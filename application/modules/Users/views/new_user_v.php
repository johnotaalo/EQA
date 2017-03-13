<?= @form_open('Users/create', ['id'    =>  "createUser"]); ?>
    <div class = "form-group">
        <label class = "control-label">First Name</label>
        <input type = "text" name = "firstname" class = "form-control"/>
    </div>

    <div class = "form-group">
        <label class = "control-label">Last Name</label>
        <input type = "text" name = "lastname" class = "form-control"/>
    </div>

    <div class = "form-group">
        <label class = "control-label">Email Address</label>
        <input type = "email" name = "email_address" class = "form-control"/>
    </div>

    <div class = "form-group">
        <label class = "control-label">Role</label>
        <input name = "role" type = "hidden" class = "form-control" id = "role-select"/>
    </div>
</form>