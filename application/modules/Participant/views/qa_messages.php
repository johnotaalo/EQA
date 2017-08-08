<div class="row">
    <a href = "<?= @base_url('Participant/PTRound/Round/'.$pt_uuid);?>"> <button class = "btn btn-primary btn-sm"><i class = "fa fa-arrow-left"></i>  Back to Data Submission</button></a>
</div>




<div class='container-fluid pt-2'>
    <div class='animated fadeIn'>
        <div class='row'>
            <div class='col-sm-12'>
                <div class='card'>
                    <div class='card-header'>
                        <strong> Messages from the QA / Supervisor</strong>
                            </div>
                            <div class='card-block'>
                            <div class='row'>
<div><?= @$message_view?> </div>

							</div>
							</div>
				</div>
			</div>
		</div>
	</div>
</div>