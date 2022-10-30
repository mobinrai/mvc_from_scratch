<section class="bg-light">
    <div class="container py-4">
        <div class="row align-items-center justify-content-between">
            <div class="contact-header col-lg-4">
                <h2 class=""><span class="text-danger">My</span> Resume</h2>
                <h3 class="h4 regular-400">Working Experience, Education and Skills</h3>
                <p class="light-300">
                    Know about my working experience, skills, languages and education...
                </p>
            </div>
            <div class="contact-img col-lg-5 align-items-end col-md-4">
                <img src="../views/assets/imgs/blog2.jpg" alt="Image not found" class="img-fluid img-thumbnail">
            </div>
        </div>
    </div>
</section>
<!--Resume Section-->
<section class="section" id="resume">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-lg-4">
                <div class="card">
                    <div class="card-header">
                        <div class="mt-2">
                            <h4>My Working Experience</h4>
                            <span class="line"></span>  
                        </div>
                    </div>
                    <div class="card-body">                        
                        <h6 class="title text-danger">Feb, 2020 - Nov, 2020</h6>
                        <P>Python Developer</P>
                        <P class="subtitle">
                            Worked as Python developer.
                        </P>
                        <hr>
                        <h6 class="title text-danger">May, 2017 - Feb, 2020</h6>
                        <P>PHP Developer</P>
                            <P class="subtitle">
                                Worked as a php, node.js Developer in Dotmark ltd.
                            </P>
                        <hr>
                        </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="card">
                    <div class="card-header">
                        <div class="mt-2">
                            <h4>Education</h4>
                            <span class="line"></span>  
                        </div>
                    </div>
                    <div class="card-body">
                        <h6 class="title text-danger">2017 - Present</h6>
                        <P>B.E Computer Engineering</P>
                        <P class="subtitle">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Error corrupti recusandae obcaecati odit repellat ducimus cum, minus tempora aperiam at.</P>
                        <hr>
                        <h6 class="title text-danger">2016 - 2017</h6>
                        <P>Diploma in Computer Engineering</P>
                        <P class="subtitle">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eos, id officiis quas placeat quia voluptas dolorum rem animi nostrum quae.aliquid repudiandae saepe!.</P>
                        <hr>
                        <h6 class="title text-danger">2015 - 2016</h6>
                        <P>High School Degree</P>
                        <P class="subtitle">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nostrum recusandae, cupiditate ullam dolor ratione repellendus.aliquid repudiandae saepe!.</P>
                        
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header">
                        <div class="pull-left">
                            <h4 class="mt-2">Skills</h4>
                            <span class="line"></span>  
                        </div>
                    </div>
                    <div class="card-body pb-2">
                        <?php foreach($skills as $key=>$value) {?>
                            <h6><?=$key?></h6>
                            <div class="progress mb-3">
                                <div class="progress-bar bg-danger" role="progressbar" style="width:<?=$value?>" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        <?php }?>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <div class="pull-left">
                            <h4 class="mt-2">Languages</h4>
                            <span class="line"></span>  
                        </div>
                    </div>
                    <div class="card-body pb-2">
                    <?php foreach($languages as $key=>$value) {?>
                            <h6><?=$key?></h6>
                            <div class="progress mb-3">
                                <div class="progress-bar bg-danger" role="progressbar" style="width:<?=$value?>" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        <?php }?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
