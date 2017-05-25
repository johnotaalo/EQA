<style>
    a.btn{
        color: #FFF !important;
    }
</style>
<div class = "row">
    <div class="col-md-12">
    <a href = "<?= @base_url('Dashboard/'); ?>"> <button class = "btn btn-primary btn-sm"><i class = "fa fa-arrow-left"></i>  Back to Dashboard</button></a><br /><br />
        <div class = "card">
            <div class="card-header col-4">
                <i class = "icon-user"></i>
                &nbsp;
                My Account
            </div>
            <div class = "card-block">
            <?= @form_open_multipart('Users/Account/editAccount', ["class" =>  "form-horizontal", 'id'  =>  'editForm']); ?>
            <?php if($this->session->flashdata('success')){ ?>
                <div class = 'alert alert-success'>
                    <?= @$this->session->flashdata('success'); ?>
                </div>
            <?php }elseif($this->session->flashdata('error')){ ?>
                <div class = 'alert alert-danger'>
                    <?= @$this->session->flashdata('error'); ?>
                </div>
            <?php } ?>
                    <div class = "row">
                        <div class = "col-md-7">
                                <div class = "form-group row">
                                    <label class = "col-md-3 form-control-label">First Name</label>
                                    <div class = "col-md-9">
                                        <input type = "text" name = "firstname" class = "form-control" value = "<?= @$user->firstname; ?>" required/>
                                    </div>
                                </div>

                                <div class = "form-group row">
                                    <label class = "col-md-3 form-control-label">Surname</label>
                                    <div class = "col-md-9">
                                        <input type = "text" name = "lastname" class = "form-control" value = "<?= @$user->lastname; ?>" required/>
                                    </div>
                                </div>

                                <div class = "form-group row">
                                    <label class = "col-md-3 form-control-label">Email Address</label>
                                    <div class = "col-md-9">
                                        <input type = "email" name = "email_address" class = "form-control" value = "<?= @$user->email_address; ?>" required/>
                                    </div>
                                </div>

                                <div class = "form-group row">
                                    <label class = "col-md-3 form-control-label">Phone Number</label>
                                    <div class = "col-md-9">
                                        <input type = "text" name = "phonenumber" class = "form-control" value = "<?= @$user->phone; ?>" required/>
                                    </div>
                                </div>

                                
                                <div class = "form-group row">
                                    <label class = "col-md-3 form-control-label">Old Password</label>
                                    <div class = "col-md-9">
                                        <input type = "password" name = "old_password" class = "form-control"/>
                                        <span class="help-block">To change your password, enter the old password here</span>
                                    </div>
                                </div>

                                
                                <div class = "form-group row">
                                    <label class = "col-md-3 form-control-label">New Password</label>
                                    <div class = "col-md-9">
                                        <input type = "password" id = "new_password" name = "new_password" class = "form-control" disabled = "true"/>
                                    </div>
                                </div>

                                
                                <div class = "form-group row">
                                    <label class = "col-md-3 form-control-label">Confirm New Password</label>
                                    <div class = "col-md-9">
                                        <input type = "password" name = "confirm_new_password" class = "form-control" disabled = "true"/>
                                    </div>
                                </div>
                        </div>
                        <div class = "col-md-5">
                            <div style = "margin-bottom: 10px;">
                                <img id = 'avatarImg' src = "<?php if(isset($user->avatar)){ echo $user->avatar; }else{ echo 'https://www.kirkleescollege.ac.uk/wp-content/uploads/2015/09/default-avatar.png'; }?>" style = "width: 300px;height:300px;"/>
                            </div>
                            <input type = "file" name = "userAvatar" id = "userAvatar" style = "display: none;"/>
                            <a class = "btn btn-primary" id = "uploadImage"><i class = "icon-cloud-upload"></i> Upload Image</a>
                            <a class = "btn btn-danger"><i class = "icon-close"></i> Cancel</a>
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