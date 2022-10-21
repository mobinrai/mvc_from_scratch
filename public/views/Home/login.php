<section class="bg-light">
    <div class="container py-4">
        <div class="row align-items-center justify-content-between">
            <div class="contact-header col-lg-4">
                <h1 class="h2 pb-3 text-primary">Login</h1>
                <h3 class="h4 regular-400">Register, if you dont have an account</h3>
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
    <h6 class="regular-400">Enter your email and password</h6>
        <form class="contact-form row" method="post" action="/submit_contact" role="form">
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
            <div class="col-md-12 col-12 m-auto text-start">
                <span>Forget Password <a href="/forget-password">click here</a></span>
            </div>
            <div class="col-md-12 col-12 m-auto text-end">
                <button type="submit" class="btn btn-secondary rounded-pill px-md-5 px-4 py-2 radius-0 text-light light-300">Login</button>
            </div>
        </form>
    </div>
    <!-- End Contact Form -->
</section>