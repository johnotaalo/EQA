<div class = "row">
	<div class = "col-md-12">
		<h3 class = "pull-left"><?= @$pageData['pt_details']->pt_round_no; ?></h3>
		<a style = 'color: white;' target="_blank" href = '<?= @base_url('PTRounds/calendar/'.$pageData['pt_details']->uuid); ?>' class = "btn btn-primary pull-right"><i class = 'icon-calendar'></i>&nbsp;View Calendar Item</a>
	</div>
</div>
<hr>
<?= @$calendar_form; ?>