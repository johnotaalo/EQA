<style>
    a.btn{
        color: #FFF !important;
    }
</style>



<div class = "row">
    <div class="col-md-12">
    
    <a href = "<?= @base_url('FAQ/faqlist/'); ?>"> <button class = "btn btn-primary btn-sm"><i class = "fa fa-arrow-left"></i>  Back to FAQ List</button></a><br /><br />
        <div class = "card">
        <div class="card-header col-4">
                <i class = "icon-user"></i>
                &nbsp;
                FAQ Edit
            </div>
            <div class = "card-block">
            <?= @form_open_multipart('FAQ/editFAQ', ["class" =>  "form-horizontal", 'id'  =>  'faqEditForm']); ?>
         
                    <div class = "row">
                        <div class = "col-md-12">
                                <div class = "form-group row">
                                    
                                    <div class = "col-md-9">
                                        <input  type = "hidden" name = "faqid" class = "form-control" value = "<?= @$faqid; ?>" required/>
                                    </div>
                                </div>

                                <div class = "form-group row">
                                    <label class = "col-md-3 form-control-label">Title</label>
                                    <div class = "col-md-9">
                                        <input type = "text" name = "title" class = "form-control" value = "<?= @$title; ?>" required/>
                                    </div>
                                </div>

                                <div class = "form-group row">
                                    <label class = "col-md-3 form-control-label">Question</label>
                                    <div class = "col-md-9">
                                        <!-- <input type = "text" name = "question" class = "form-control" value = "<?= @$question; ?>" required/> -->
                                        <textarea required type = "text" maxvalue="500" name = "question" class = "form-control"><?= @$question; ?></textarea>
                                    </div>
                                </div>

                                <div class = "form-group row">
                                    <label class = "col-md-3 form-control-label">Answer</label>
                                    <div class = "col-md-9">
                                        <!-- <input type = "text" name = "answer" class = "form-control" value = "<?= @$answer; ?>" required/> -->
                                        <textarea required type = "text" maxvalue="500" name = "answer" class = "form-control"><?= @$answer; ?></textarea>
                                    </div>
                                </div>



                        </div>

                        
                    </div>

                        <div class = "col-md-6">
                            <div class = "row">
                                <div style = "margin-top: 10px;">
                                    <button id = "saveChanges" class = "btn btn-primary btn-block" type = "submit">
                                        <i class = "icon-pencil"></i> Save Changes
                                    </button>
                                </div>
                            </div>
                        </div>
                </form>
            </div>
        </div>
    </div>
</div>