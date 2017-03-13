<div class="page-signup-modal modal">
    <div class="modal-dialog">
      <div class="modal-content">

        <div class="text-xs-center bg-primary p-y-4">
          <a class="px-demo-brand px-demo-brand-lg" href="<?= @base_url(); ?>"><span class="px-demo-logo bg-primary m-t-0"><span class="px-demo-logo-1"></span><span class="px-demo-logo-2"></span><span class="px-demo-logo-3"></span><span class="px-demo-logo-4"></span><span class="px-demo-logo-5"></span><span class="px-demo-logo-6"></span><span class="px-demo-logo-7"></span><span class="px-demo-logo-8"></span><span class="px-demo-logo-9"></span></span><span class="font-size-18 line-height-1"><strong>EQA</strong></span></span></a>
          <div class="font-size-15 m-t-1 line-height-1">External.Quality.Assurance</div>
        </div>

        <form method="POST" action="<?= @base_url('Participant/register'); ?>" class="p-a-4">
          <h4 class="m-t-0 m-b-4 text-xs-center font-weight-semibold">Join us Today</h4>

          <fieldset class="page-signup-form-group form-group form-group-lg">
            <div class="page-signup-icon text-muted"><i class="ion-information-circled"></i></div>
            <input type="text" class="page-signup-form-control form-control" placeholder="Surname" name = "surname">
          </fieldset>

          <fieldset class="page-signup-form-group form-group form-group-lg">
            <div class="page-signup-icon text-muted"><i class="ion-information-circled"></i></div>
            <input type="text" class="page-signup-form-control form-control" placeholder="First Name" name = "firstname">
          </fieldset>

          <fieldset class="page-signup-form-group form-group form-group-lg">
            <div class="page-signup-icon text-muted"><i class="ion-at"></i></div>
            <input type="email" class="page-signup-form-control form-control" placeholder="Email" name = "participantEmail">
          </fieldset>

          <fieldset class="page-signup-form-group form-group form-group-lg">
            <div class="page-signup-icon text-muted"><i class="ion-android-call"></i></div>
            <input type="text" class="page-signup-form-control form-control" placeholder="Phone Number" name = "phonenumber">
          </fieldset>

          <fieldset class="page-signup-form-group form-group form-group-lg">
            <div class="page-signup-icon text-muted"><i class="fa fa-hospital-o"></i></div>
            <select name = "facility" class="page-signup-form-control form-control">
              <option value="">Pick your facility</option>
            </select>
          </fieldset>

          <fieldset class="page-signup-form-group form-group form-group-lg">
            <div class="page-signup-icon text-muted"><i class="ion-wrench"></i></div>
            <select id = "equipment" name = "equipment[]" class="page-signup-form-control form-control" multiple>
            </select>
          </fieldset>

          <fieldset class = "page-signup-form-group form-group form-group-lg">
            <div class="page-signup-icon text-muted"><i class="ion-lock-combination"></i></div>
            <input class="page-signup-form-control form-control" type="password" placeholder="Choose a Password" name = "password" />
          </fieldset>

          <fieldset class = "page-signup-form-group form-group form-group-lg">
            <div class="page-signup-icon text-muted"><i class="ion-lock-combination"></i></div>
            <input class="page-signup-form-control form-control" type="password" placeholder="Confirm your Password" name = "confirm_password" />
          </fieldset>

         <!--  <label class="custom-control custom-checkbox">
            <input type="checkbox" class="custom-control-input">
            <span class="custom-control-indicator"></span>
            I agree with the <a href="#" target="_blank">Terms and Conditions</a>
          </label> -->

          <button type="submit" class="btn btn-block btn-lg btn-primary m-t-3">Sign Up</button>
        </form>
      </div>

      <div class="text-xs-center m-t-2 font-weight-bold font-size-14" id="px-demo-signin-link">
        Already have an account? <a href="<?= @base_url('Auth/signIn'); ?>"><u>Sign In</u></a>
      </div>
    </div>
  </div>