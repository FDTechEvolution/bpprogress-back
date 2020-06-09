<div class="row justify-content-center">
    <div class="col-md-8 col-lg-6 col-xl-5">
        <div class="card">

            <div class="card-body p-4">

                <div class="text-center w-75 m-auto">

                    <span><?=$this->Html->image('logo/logo-light.png',['height'=>'55'])?></span>

                    <p class="text-muted mb-4 mt-3">Enter your email address and password to access admin panel.</p>
                </div>
                <?=$this->Form->create('login')?>
                

                    <div class="form-group mb-3">
                        <label for="mobile">Mobile</label>
                        <input class="form-control" type="number" id="mobile" required="" name="mobile">
                    </div>

                    <div class="form-group mb-3">
                        <label for="password">Password</label>
                        <input class="form-control" type="password" required="" id="password" name="password" placeholder="Enter your password">
                    </div>

                    <div class="form-group mb-0 text-center">
                        <button class="btn btn-primary btn-block" type="submit"> Log In </button>
                    </div>

                <?=$this->Form->end()?>



            </div> <!-- end card-body -->
        </div>
        <!-- end card -->

        <div class="row mt-3">
            <div class="col-12 text-center">
                <p> <a href="pages-recoverpw.html" class="text-muted ml-1">Forgot your password?</a></p>

            </div> <!-- end col -->
        </div>
        <!-- end row -->

    </div> <!-- end col -->
</div>
<!-- end row -->