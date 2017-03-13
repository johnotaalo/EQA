<style type="text/css">
	.alert {
		padding: 15px;
		margin-bottom: 20px;
		border: 1px solid transparent;
		border-radius: 4px;
	}
	.alert-success {
		color: #3c763d !important;
		background-color: #dff0d8;
		border-color: #d6e9c6;
	}

	.alert-success strong{
		color: #3c763d !important;
	}

	.well {
		min-height: 20px;
		padding: 19px;
		margin-bottom: 20px;
		background-color: #f5f5f5;
		border: 1px solid #e3e3e3;
		border-radius: 4px;
		-webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.05);
		box-shadow: inset 0 1px 1px rgba(0,0,0,.05);
	}

	.well-lg {
		padding: 24px;
		border-radius: 6px;
		font-size: 15px;
	}
</style>
<div class = "container" style="margin-top: 10px;">
	<div class = "alert alert-success">
		<strong>Success!</strong> You have successfully registered for the EQA Account! Please check your email <strong><?= @$email; ?> </strong> for your confirmation link.
	</div>

	<div class = "well well-lg">
		If you have not received your email, click on this link to resend the link <a href="btn btn-success btn-lg">RESEND LINK</a>
	</div>
</div>