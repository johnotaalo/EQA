<form method="POST" action="<?= @base_url('FAQ/create'); ?>" class="p-a-4" id="faq-form">

<div class="row">
    <div class="col-md-12">
    <a href = "<?= @base_url('FAQ/faqlist'); ?>"> <button class = "btn btn-primary btn-sm"><i class = "fa fa-arrow-left"></i>  Back to FAQs</button></a><br /><br />

        <div class="card">
            <div class="card-header">
                <strong>NEW FAQ</strong>
            </div>
            <div class="card-block">

                  <!-- <h4 class="m-t-0 m-b-4 text-xs-center font-weight-semibold">PARTICIPANT DETAILS</h4> -->

                  <fieldset class="page-signup-form-group form-group form-group-lg">
                   <div class = "form-group">
                        <label class = "control-label col-md-3">Title</label>
                        <div class="col-md-9">
                            <input type = "text" name = "title" class = "form-control"/>
                        </div>
                    </div>
                  </fieldset>

                  <fieldset class="page-signup-form-group form-group form-group-lg">
                    <div class = "form-group">
                        <label class = "control-label col-md-3">Question</label>
                        <div class="col-md-9">
                            <textarea type = "text" maxvalue="500" name = "question" class = "form-control"></textarea>
                        </div>
                    </div>
                  </fieldset>

                  <fieldset class="page-signup-form-group form-group form-group-lg">
                    <div class = "form-group">
                        <label class = "control-label col-md-3">Answer</label>
                        <div class="col-md-9">
                            <textarea type = "text" maxvalue="500" name = "answer" class = "form-control"></textarea>
                        </div>
                    </div>
                  </fieldset>

                  <button type="submit" class="btn btn-block btn-lg btn-primary m-t-3">Save</button>

                </div>   
            </div>
        </div>
    </div>

</form>