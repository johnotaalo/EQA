<div class="page-signup-modal modal">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="text-xs-center bg-primary p-y-4">
                <a class="px-demo-brand px-demo-brand-lg" href="<?= @base_url(); ?>"><span class="px-demo-logo bg-primary m-t-0"><span class="px-demo-logo-1"></span><span class="px-demo-logo-2"></span><span class="px-demo-logo-3"></span><span class="px-demo-logo-4"></span><span class="px-demo-logo-5"></span><span class="px-demo-logo-6"></span><span class="px-demo-logo-7"></span><span class="px-demo-logo-8"></span><span class="px-demo-logo-9"></span></span><span class="font-size-18 line-height-1"><strong>EQA</strong></span></span></a>
                <div class="font-size-15 m-t-1 line-height-1">External.Quality.Assurance</div>
            </div>

            <?= @form_open('Auth/usercomplete/' . $uuid, ["class" => "p-a-4", "id"  =>  "userCompleteForm"]); ?>
                <fieldset class = "page-signup-form-group form-group form-group-lg">
                    <div class="page-signup-icon text-muted"><i class="ion-lock-combination"></i></div>
                    <input class="page-signup-form-control form-control" type="text" placeholder="Choose a Username" name = "username" />
                </fieldset>

                <fieldset class = "page-signup-form-group form-group form-group-lg">
                    <div class="page-signup-icon text-muted"><i class="ion-lock-combination"></i></div>
                    <input class="page-signup-form-control form-control" type="password" placeholder="Choose a Password" name = "password" />
                </fieldset>

                <fieldset class = "page-signup-form-group form-group form-group-lg">
                    <div class="page-signup-icon text-muted"><i class="ion-lock-combination"></i></div>
                    <input class="page-signup-form-control form-control" type="password" placeholder="Confirm your Password" name = "confirm_password" />
                </fieldset>

                <button class = "btn btn-block btn-lg btn-primary m-t-3">Save Password</button>
            </form>
        </div>
    </div>
</div>