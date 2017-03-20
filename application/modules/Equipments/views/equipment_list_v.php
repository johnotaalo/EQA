
        

            
<div class = "row">
    <div class="col-md-12">
        <div class = "card">
            <div class="card-header col-4">
                <i class = "icon-wrench"></i>
                &nbsp;
                <?php if($equipmentview) { ?>

                    Equipment List

                <?php }else{ ?>

                    Facilities per Equipment List

                <?php } ?>
                <div class = "pull-right">
                <?php 
                    if($equipmentview)
                        {
                ?>
                    
                    <button class = "btn btn-primary btn-sm" id = "btn-create-equipment"><i class = "icon-plus"></i> Create Equipment</button>

                <?php 
                        }else{
                ?>
                    <a href = "<?= @base_url('Equipments/equipmentlist'); ?>"> <button class = "btn btn-primary btn-sm"><i class = "fa fa-arrow-left"></i>  Back to Equipments</button></a>
                <?php 
                        }
                ?>
                </div>
            </div>
            <div class = "card-block">
                <?= @$table_view; ?>
            </div>
        </div>
    </div>
</div>