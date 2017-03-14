<?php
    $colspan = "4";
?>

<div class = "row">
    <div class="col-md-12">
        <div class = "card">
            <div class="card-header col-4">
                <i class = "icon-user"></i>
                &nbsp;
                <?= @$pagetitle; ?>
                <div class = "pull-right">
                    <button class = "btn btn-primary btn-sm" id = "btn-create-user" onClick = "window.location='<?= @base_url("PTRounds/create"); ?>'"><i class = "icon-plus"></i> New PT Round</button>
                </div>
            </div>
            <div class = "card-block">
                <div class = "table-responsive">
                    <table class = "table table-outline mb-0 hidden-sm-down">
                        <thead class = "thead-default">
                            <th colspan = "<?= @$colspan; ?>"><center>Ongoing Round</center></th>
                        </thead>
                        <thead id = "title">
                            <th>Round ID</th>
                            <th>Created</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan = "<?= @$colspan; ?>"><center>There are no ongoing rounds</center></td>
                            </tr>
                        </tbody>
                        <thead class = "thead-default">
                            <th colspan = "<?= @$colspan; ?>"><center>Previous and Future Rounds</center></th>
                        </thead>
                        <thead>
                            <th>Round ID</th>
                            <th>Created</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan = "<?= @$colspan; ?>"><center>There are no previous or future rounds</center></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>