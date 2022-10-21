<div class="container-fluid">
    <div id="about" class="row about-section">
        <div class="col-lg-4 about-card">
            <h3 class="font-weight-light">Who am I ?</h3>
            <span class="line mb-5"></span>
            <h5 class="mb-3">
                A Web Developer
            </h5>
            <p class="mt-20">
                I love Coding,learn new technology, travelling, watching football and playing computer games.
            </p>
            <button class="btn btn-outline-danger"><i class="icon-down-circled2 "></i>Download My CV</button>
        </div>
        <div class="col-lg-4 about-card">
            <h3 class="font-weight-light">Personal Info</h3>
            <span class="line mb-5"></span>
            <ul class="mt40 info list-unstyled">
                <?php foreach($personal_details as $key=>$data){?>
                    <li><span><?= $key ?></span> : <?=$data?></li>
                <?php } ?>
            </ul>
            <ul class="social-icons pt-3">                
                <?php foreach($social_links as $name=>$links) { ?>
                    <li class="social-item">
                    <a class="social-link" href="<?=$links?>">
                        <i class="<?=$name?>" aria-hidden="true"></i>
                    </a>
                </li>
                <?php  } ?>
            </ul>  
        </div>
        <div class="col-lg-4 about-card">
            <h3 class="font-weight-light">My Expertise</h3>
            <span class="line mb-5"></span>
            <div class="row">
                <div class="col-1 text-danger pt-1"><i class="ti-widget icon-lg"></i></div>
                <div class="col-10 ml-auto mr-3">
                    <h6>UX Design</h6>
                    <p class="subtitle">I love working with Html,Css and JS</p>
                    <hr>
                </div>
            </div>
            <div class="row">
                <div class="col-1 text-danger pt-1"><i class="ti-paint-bucket icon-lg"></i></div>
                <div class="col-10 ml-auto mr-3">
                    <h6>Web Development</h6>
                    <p class="subtitle"></p>
                    <hr>
                </div>
            </div>
        </div>
    </div>
</div>