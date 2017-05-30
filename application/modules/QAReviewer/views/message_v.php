<form method="POST" action="<?= @base_url('QAReviewer/PTRound/sendMessage/'); ?><?php echo $round_uuid; ?>/<?php echo $participant_uuid; ?>" class="p-a-4" id="messageForm">

<div class="row">
    <div class="col-sm-12">

        <div class="card">
            <div class="card-header">
                <strong>Send Message</strong>
            </div>
            <div class="card-block">

                  <!-- <h4 class="m-t-0 m-b-4 text-xs-center font-weight-semibold">PARTICIPANT DETAILS</h4> -->

                  <fieldset class="page-signup-form-group form-group form-group-lg">
                   <div class = "form-group">
                        <label class = "control-label col-md-3">Subject</label>
                        <div class="col-md-9">
                            <input type = "text" name = "subject" class = "form-control" placeholder="Enter Subject Here" required/>
                        </div>
                    </div>
                  </fieldset>

                  <fieldset class="page-signup-form-group form-group form-group-lg">
                    <div class = "form-group">
                        <label class = "control-label col-md-3">Message</label>
                        <div class="col-md-9">
                            <textarea id="message" name="message" rows="8" maxlength="500" class="form-control" placeholder="Enter Message Here" required></textarea>
                        </div>
                    </div>
                  </fieldset>

                  <button type="submit" class="btn btn-block btn-lg btn-primary m-t-3">Send</button>

                </div>   
            </div>
        </div>
    </div>

</form>