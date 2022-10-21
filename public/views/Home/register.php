<section class="bg-light">
    <div class="container py-4">
        <div class="row align-items-center justify-content-between">
            <div class="contact-header col-lg-4">
                <h1 class="h2 pb-3 text-primary">Create an account</h1>
                <h3 class="h4 regular-400">If you have already an account, <a href="/login">login</a></h3>
            </div>
            <div class="contact-img col-lg-5 align-items-end col-md-4">
                <img src="../views/assets/img/banner-img-01.svg">
            </div>
        </div>
    </div>
</section>
<!-- Start Contact -->
<section class="container py-5">
    <!-- Start Contact Form -->
    <div class="col-lg-8 ">
    <?php if(sizeof($errors)>0){?>
        <div class="bg-light mb-4 py-2 px-4">
            <?php foreach($errors as $key=>$error)
            {
                if(is_array($error)){
                    foreach($error as $message){
                        echo '<span class="text-danger">'.$message.'</span><br>';
                    }
                }else{
                    echo '<span class="text-danger">'.$error.'</span><br>';
                }
            } ?>
        </div>
        <?php }?>
    <h6 class="regular-400">Please enter every <span class="text-danger">*</span> field</h6>
        <form class="contact-form row" method="post" action="/register" role="form">
        <div class="col-lg-12 mb-4">
                <div class="form-floating">
                    <input type="text" class="form-control form-control-lg light-300" value="" id="floatingusername" name="input_username" placeholder="Email">
                    <label for="floatingusername light-300">User Name
                        <span class="text-danger">*</span>
                    </label>
                </div>
            </div>
            <div class="col-lg-12 mb-4">
                <div class="form-floating">
                    <input type="text" class="form-control form-control-lg light-300" id="floatingemail" name="input_email" placeholder="Email">
                    <label for="floatingemail light-300">Email<span class="text-danger">*</span></label>
                </div>
            </div>
            <!-- End Input Email -->
            <div class="col-lg-12 mb-4">
                <div class="form-floating">
                <input type="password" class="form-control form-control-lg light-300" id="floatingpassword" name="input_password" placeholder="Password">
                    <label for="floatingpassword light-300">Password<span class="text-danger">*</span></label>
                </div>
            </div>            
            <!-- End Input password -->
            <div class="col-lg-12 mb-4">
                <div class="form-floating">
                <input type="password" class="form-control form-control-lg light-300" id="floatingconfirmpassword" name="input_confirm_password" placeholder="Confirm_Password">
                    <label for="floatingconfirmpassword light-300">Confirm Password<span class="text-danger">*</span></label>
                </div>
            </div>
            <div class="col-md-12 col-12 m-auto text-end">
                <button type="submit" class="btn btn-secondary rounded-pill px-md-5 px-4 py-2 radius-0 text-light light-300">Register</button>
            </div>
        </form>
    </div>
    <!-- End Contact Form -->
</section>