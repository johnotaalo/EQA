<div class = "card-block">
    <?php if($this->session->flashdata('success')){ ?>
        <div class = 'alert alert-success'>
            <?= @$this->session->flashdata('success'); ?>
        </div>
    <?php }elseif($this->session->flashdata('error')){ ?>
        <div class = 'alert alert-danger'>
            <?= @$this->session->flashdata('error'); ?>
        </div>
    <?php } ?>
</div>
        

            
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
                    
                    <a href = "<?= @base_url('Equipments/newEquipmentView'); ?>"><button class = "btn btn-primary btn-sm" id = "btn-create-equipment"><i class = "icon-plus"></i> Create Equipment</button></a><br /><br />

                <?php 
                        }else{
                ?>
                    <a href = "<?= @base_url('Equipments/equipmentlist'); ?>"> <button class = "btn btn-primary btn-sm"><i class = "fa fa-arrow-left"></i>  Back to Equipments</button></a><br /><br />
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