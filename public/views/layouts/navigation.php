<header>
    <div id="top-header">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="home-account">
                        <a href="/">Home</a>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="cart-info">
                        <?php if(!isLogin()){ ?>
                            <a href="/login">Login</a> | <a href="/register">Register</a>                        
                        <?php } else { ?>
                             <?=userEmail()?> | <a href="/logout">Logout</a>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="main-header">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <div class="logo">
                        <a href="#"><img src="../views/assets/images/logo.png" title="Grill Template" alt="Grill Website Template"></a>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="main-menu">
                        <ul>
                            <li><a href="/">Home</a></li>
                            <li><a href="/about">About</a></li>
                            <?php if(sizeof(getCategories())):
                                foreach(getCategories() as $categories) : ?>
                                <li><a href="/tutorials/<?=$categories['slug']?>"><?=$categories['title']?></a></li>
                            <?php endforeach?>
                            <?php endif?>                            
                            <li><a href="/contact">Contact</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="search-box">
                        <!-- <form name="search_form" method="get" class="search_form">
                            <input id="search" type="text" />
                            <input type="submit" id="search-button" />
                        </form> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>