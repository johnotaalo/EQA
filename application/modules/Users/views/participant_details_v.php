<a href = "<?= @base_url('Users/Participants/listing'); ?>"><i class = "fa fa-arrow-left"></i>  Back to Participants</a>
<div class = "row">
    <div class="col-md-12">
        <div class = "card">
            <div class="card-header col-4">
                <i class = "icon-user"></i>
                &nbsp;
                <?= @$participant->participant_fname . " " . $participant->participant_lname; ?>
            </div>
            <div class = "card-block">
                <div class = "row">
                    <div class = "col-md-4">
                        <img src = "<?= @$participant->avatar; ?>" style = "width: 100%;"/>
                    </div>
                    <div class="col-md-8">
                        <h3>Participant Details</h3>
                        <hr/>
                        <table class = "table table-hover">
                            <tr>
                                <th style = "width: 20%">Participant No:</th>
                                <td><?= @$participant->participant_id; ?></td>
                            </tr>
                            <tr>
                                <th>Name:</th>
                                <td><?= @$participant->participant_fname . " " . $participant->participant_lname; ?></td>
                            </tr>

                            <tr>
                                <th>Email:</th>
                                <td><?= @$participant->participant_email; ?></td>
                            </tr>

                            <tr>
                                <th>Phonenumber:</th>
                                <td><?= @$participant->participant_phonenumber; ?></td>
                            </tr>

                            <tr>
                                <th>Facility:</th>
                                <td><?= @$facility->facility_name; ?></td>
                            </tr>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>