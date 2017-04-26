<style>
    a{
        cursor: pointer;
    }
    #round-navigation ul.nav li.active, #round-navigation ul.nav li:hover a{
        background: gainsboro;
    }
</style>
<a href = "<?= @base_url('PTRounds/'); ?>"> <button class = "btn btn-primary btn-sm"><i class = "fa fa-arrow-left"></i>  Back to PT Rounds</button></a><br /><br />


<?php if($this->session->flashdata('error')){?>
    <div class="alert alert-danger alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <?= @$this->session->flashdata('error'); ?>
    </div>
<?php }elseif($this->session->flashdata('success')){ ?>
    <div class="alert alert-success alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <?= @$this->session->flashdata('success'); ?>
    </div>
<?php } ?>
<div emailapp="" class="emailApp">
    <nav id = "round-navigation">
        <ul class="nav">
           <?= @$submenu; ?>
        </ul>
    </nav>

    <main id = "page-holder">
        <?= @form_open('PTRounds/add/' . $step . '/' . $uuid, ['id'   =>  'rounds-form']); ?>
            <div style = "width: 100%; min-height: 500px;overflow-y:auto;">
                <?= @$this->load->view($page, $pageData); ?>
            </div>
            <div class = "form-group">
                <button style = "margin-top: " class = "btn btn-primary">Save & Continue</button>
            </div>
        </form>
    </main>

</div>