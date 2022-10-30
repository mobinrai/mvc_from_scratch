<div id="heading">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="heading-content">
                    <h2>Login</h2>
                    <span>Home / <a href="/login">Login</a></span>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="product-post">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="heading-section">
                    <h2>Enter your email and password</h2>
                    <img src="../views/assets/images/under-heading.png" alt="">
                </div>
            </div>
        </div>
        <div id="contact-us">
            <div class="container">
                <div class="row">
                    <div class="product-item col-md-12">
                        <div class="row">
                            <div class="col-md-8">  
                                <div class="message-form">
                                    <form action="/login" method="post" class="send-message">
                                        <div class="row">
                                            <div class="email col-md-6">
                                                <label for="email">Email</label>
                                                <input type="text" name="email" id="email" value="<?=old_value('email')?>" placeholder="Email" required/>
                                                <span class="form_field_error text-danger"><?php echo getErrorMessage('email')?></span>
                                            </div>
                                            <div class="password col-md-6">
                                                <label for="password">Password</label>
                                                <input type="password" name="password" id="password" value="<?=old_value('password')?>" placeholder="Password" required/>
                                                <span class="form_field_error text-danger"><?php echo getErrorMessage('password')?></span>
                                            </div>
                                        </div>
                                        <div class="send mt-1">
                                            <span class="text-small">Forgot your password <a href="/">click here</a></span>
                                            <br>
                                            <button type="submit" class="mt-1">Login</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="col-md-4 mt-1">
                                <div class="info" style="margin-top: 24px">
                                    <p>If you don't have an account. Please create an new account.<a href="/register">Register</a></p>
                                </div>
                            </div>     
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>