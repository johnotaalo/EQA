<div class="page-signup-modal modal">
    <div class="modal-dialog">
      <div class="modal-content">

        <div class="text-xs-center bg-primary p-y-4">
          <a class="px-demo-brand px-demo-brand-lg" href="<?= @base_url(); ?>"><span class="px-demo-logo bg-primary m-t-0"><span class="px-demo-logo-1"></span><span class="px-demo-logo-2"></span><span class="px-demo-logo-3"></span><span class="px-demo-logo-4"></span><span class="px-demo-logo-5"></span><span class="px-demo-logo-6"></span><span class="px-demo-logo-7"></span><span class="px-demo-logo-8"></span><span class="px-demo-logo-9"></span></span><span class="font-size-18 line-height-1"><strong>EQA</strong></span></span></a>
          <div class="font-size-15 m-t-1 line-height-1">External.Quality.Assurance</div>
        </div>

        <form method="POST" action="<?= @base_url('Participant/register'); ?>" class="p-a-4" id="registrationForm">
        <!-- <?= @form_open_multipart('Participant/register', ["class" =>  "p-a-4", 'id'  =>  'registrationForm']); ?> -->

          <?php if($this->session->flashdata('success')){ ?>
                <div class = 'alert alert-success'>
                    <?= @$this->session->flashdata('success'); ?>
                </div>
          <?php }elseif($this->session->flashdata('error')){ ?>
                <div class = 'alert alert-danger'>
                    <?= @$this->session->flashdata('error'); ?>
                </div>
          <?php } ?>

          <h4 class="m-t-0 m-b-4 text-xs-center font-weight-semibold">Participant Registration</h4>

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
            <input type="email" class="page-signup-form-control form-control" placeholder="Email" name = "email_address">
          </fieldset>

          <fieldset class="page-signup-form-group form-group form-group-lg">
            <div class="page-signup-icon text-muted"><i class="ion-android-call"></i></div>
            <input type="text" class="page-signup-form-control form-control" placeholder="Phone Number" name = "phonenumber">
          </fieldset>

          <fieldset class="page-signup-form-group form-group form-group-lg">
            <div class="page-signup-icon text-muted"><i class="fa fa-group"></i></div>
            <select name = "sex" class="page-signup-form-control form-control">
              <option value="">Sex</option>
              <option value="Male">Male</option>
              <option value="Female">Female</option>
            </select>
          </fieldset>

          <fieldset class="page-signup-form-group form-group form-group-lg">
            <div class="page-signup-icon text-muted"><i class="fa fa-user-plus"></i></div>
            <select name = "age" class="page-signup-form-control form-control">
              <option value="">Age</option>
              <option value="18 - 25">18 - 25</option>
              <option value="26 - 29">26 - 29</option>
              <option value="30 - 35">30 - 35</option>
              <option value="36 - 40">36 - 40</option>
              <option value="over 40">over 40</option>
            </select>
          </fieldset>

          <fieldset class="page-signup-form-group form-group form-group-lg">
            <div class="page-signup-icon text-muted"><i class="fa fa-institution"></i></div>
            <select name = "education" class="page-signup-form-control form-control">
              <option value="">Highest Level of Education</option>
              <option value="Certificate">Certificate</option>
              <option value="Diploma">Diploma</option>
              <option value="Higher Diploma">Higher Diploma</option>
              <option value="Masters">Masters</option>
              <option value="PhD">PhD</option>
              <option value="Post PhD">Post PhD</option>
            </select>
          </fieldset>

          <fieldset class="page-signup-form-group form-group form-group-lg">
            <div class="page-signup-icon text-muted"><i class="fa fa-hospital-o"></i></div>
            <select name = "experience" class="page-signup-form-control form-control">
              <option value="">Years of Experience in Flow Cytometry</option>
              <option value="six_months_less">Less than 6 Months</option>
              <option value="one_year_less">6 Months to Less than a year</option>
              <option value="one_year">1 Year</option>
              <option value="two_years">2 Years</option>
              <option value="three_years">3 Years</option>
              <option value="fours_years">4 Years</option>
              <option value="over_fours_years">Over 4 Years</option>
            </select>
          </fieldset>

          <fieldset class="page-signup-form-group form-group form-group-lg">
            <div class="page-signup-icon text-muted"><i class="fa fa-male"></i></div>
            <select name = "usertype" class="page-signup-form-control form-control">
              <option value="">Select user type</option>
              <option value="participant">Participant</option>
              <option value="qareviewer">QA Reviewer / Supervisor</option>
            </select>
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
            <span class="help-block">* Select multiple equipments if more <span class="text-danger">(Kindly confirm, if not sure...)</span></span>
          </fieldset>

          <fieldset class = "page-signup-form-group form-group form-group-lg">
            <div class="page-signup-icon text-muted"><i class="ion-lock-combination"></i></div>
            <input class="page-signup-form-control form-control" type="password" placeholder="Choose a Password" id="password" name = "password" />
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

          <button type="submit" class="btn btn-block btn-lg btn-primary m-t-3">Register</button>
        </form>
      </div>

      <div class="text-xs-center m-t-2 font-weight-bold font-size-14" id="px-demo-signin-link">
        Already have an account? <a href="<?= @base_url('Auth/signIn'); ?>"><u>Log In</u></a>
      </div>
      <div class="text-xs-center m-t-2 font-weight-bold font-size-14" id="px-demo-signup-link"><a href="<?= @base_url('Home'); ?>" class=""><u>Home</u></a>
      </div>
    </div>
  </div>