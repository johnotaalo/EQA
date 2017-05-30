<script>
    $(document).ready(function(){
        $("#facilityTable").DataTable({
            serverSide: true,
            processing: true,
            ajax: {
                url: "<?= @base_url('Facilities/getTable/' . $type); ?>",
                type: "POST",
                error: function(){
                    alert("No data found in server");
                }
            }
        });
    });
</script>