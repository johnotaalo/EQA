<div class="page-signin-modal modal">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="box m-a-0">
          <div class="box-row">

            <div class="box-cell col-md-5 bg-primary p-a-4 leftside">
              <div class="text-xs-center text-md-left">
                <a class="px-demo-brand px-demo-brand-lg" href="<?= @base_url(); ?>"><span class="px-demo-logo bg-primary m-t-0"><span class="px-demo-logo-1"></span><span class="px-demo-logo-2"></span><span class="px-demo-logo-3"></span><span class="px-demo-logo-4"></span><span class="px-demo-logo-5"></span><span class="px-demo-logo-6"></span><span class="px-demo-logo-7"></span><span class="px-demo-logo-8"></span><span class="px-demo-logo-9"></span></span><span class="font-size-18 line-height-1"><strong>EQA</strong></span></a>
                <div class="font-size-15 m-t-1 line-height-1">External Quality Assurance</div>
              </div>
              <?php if($this->session->flashdata('error')){?>
                <style type="text/css">
                  .leftside{
                    background: red !important;
                  }
                </style>
                <p>Notice</p>
                <p><?= @$this->session->flashdata('error'); ?></p>
              <?php } ?>
            </div>

            <div class="box-cell col-md-7">

              <!-- Sign In form -->
            <!-- <?= @form_open('Auth/authenticate'); ?> -->
              <form method = "post" action="<?php echo base_url('Auth/authenticate');?>" class="p-a-4" id="page-signin-form">
                <h4 class="m-t-0 m-b-4 text-xs-center font-weight-semibold">Sign In to your Account</h4>

                <fieldset class="page-signin-form-group form-group form-group-lg">
                  <div class="page-signin-icon text-muted"><i class="ion-person"></i></div>
                  <input type="text" class="page-signin-form-control form-control" placeholder="Username or Email" name="username">
                </fieldset>

                <fieldset class="page-signin-form-group form-group form-group-lg">
                  <div class="page-signin-icon text-muted"><i class="ion-asterisk"></i></div>
                  <input type="password" class="page-signin-form-control form-control" placeholder="Password" name="password">
                </fieldset>

                <div class="clearfix">
                  <label class="custom-control custom-checkbox pull-xs-left">
                    <input type="checkbox" class="custom-control-input">
                    <span class="custom-control-indicator"></span>
                    Remember me
                  </label>
                  <a href="#" class="font-size-12 text-muted pull-xs-right" id="page-signin-forgot-link">Forgot your password?</a>
                </div>

                <button type="submit" class="btn btn-block btn-lg btn-primary m-t-3">Log In</button>
              </form>

              <!-- <div class="p-y-3 p-x-4 b-t-1 bg-white darken" id="page-signin-social">
                <a href="index.html" class="btn btn-block btn-lg btn-info font-size-13"><span class="btn-label-icon left fa fa-twitter"></span>Sign In with <strong>Twitter</strong></a>
              </div> -->

              <!-- / Sign In form -->

              <!-- Reset form -->

              <form action="https://mighty-ravine-84144.herokuapp.com/html/static/index.html" class="p-a-4" id="page-signin-forgot-form">
                <h4 class="m-t-0 m-b-4 text-xs-center font-weight-semibold">Password reset</h4>

                <fieldset class="page-signin-form-group form-group form-group-lg">
                  <div class="page-signin-icon text-muted"><i class="ion-at"></i></div>
                  <input type="email" class="page-signin-form-control form-control" placeholder="Your Email">
                </fieldset>

                <button type="submit" class="btn btn-block btn-lg btn-primary m-t-3">Send password reset link</button>
                <div class="m-t-2 text-muted">
                  <a href="#" id="page-signin-forgot-back">&larr; Back</a>
                </div>
              </form>

              <!-- / Reset form -->

            </div>
          </div>
        </div>
      </div>

      <div class="text-xs-center m-t-2 font-weight-bold font-size-14" id="px-demo-signup-link">
        Not a member? <a href="<?= @base_url('Auth/signup'); ?>" class=""><u>Register now</u></a>
      </div>
      <div class="text-xs-center m-t-2 font-weight-bold font-size-14" id="px-demo-signup-link"><a href="<?= @base_url('Home'); ?>" class=""><u>Home</u></a>
      </div>
    </div>
  </div>