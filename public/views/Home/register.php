<div id="heading">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="heading-content">
                    <h2>Register</h2>
                    <span>Home / <a href="/register">Register</a></span>
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
                    <h2>Create a new account</h2>
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
                                    <form action="/register" method="post" class="send-message">
                                        <div class="row">
                                        <div class="email col-md-12 mb-4">
                                                <label for="user_name">User name</label>
                                                <input type="text" name="user_name" id="user_name" value="<?=old_value('user_name')?>" placeholder="User Name" required/>
                                                <span class="form_field_error text-danger"><?php echo getErrorMessage('user_name')?></span>
                                            </div>
                                            <div class="email col-md-12 mb-4">
                                                <label for="email">Email</label>
                                                <input type="text" name="email" id="email" value="<?=old_value('email')?>" placeholder="Email" required/>
                                                <span class="form_field_error text-danger"><?php echo getErrorMessage('email')?></span><br>
                                            </div>
                                            <div class="password col-md-6">
                                                <label for="password">Password</label>
                                                <input type="password" name="password" id="password" value="<?=old_value('password')?>" placeholder="Password" required/>
                                                <span class="form_field_error text-danger"><?php echo getErrorMessage('password')?></span>
                                                <span class="text-small text-info">Must be at least 6 characters long</span><br>
                                            </div>
                                            <div class="confirm_password col-md-6">
                                                <label for="confirm_password">Confirm Password</label>
                                                <input type="password" name="confirm_password" id="confirm_password" value="<?=old_value('confirm_password')?>" placeholder="Confirm Password" required/>
                                                <span class="form_field_error text-danger"><?php echo getErrorMessage('confirm_password')?></span>
                                                <br>
                                                <span class="text-small text-info">Must be same as password</span>
                                            </div>
                                        </div>
                                        <div class="send mt-1">                                            
                                            <button type="submit" class="mt-1">Register</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="col-md-4 mt-1">
                                <div class="info" style="margin-top: 24px">
                                    <p>If you already have an account. Please <a href="/login">login</a></p>
                                </div>
                            </div>     
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>