<?php 
ob_start();
?>
    <section class="header">
    <!-- header left start -->
    <div class="header-left">
        <div class="user">
            <h3>Masud Rana</h3>
            <img src="image/user.png" alt="image">
            <p>Hi, My name is Masud Rana. I'm a WordPress Developer. Welcome to my Personal Website</p>
            <ul>
                <li><a href="#"><i class="fa-brands fa-facebook"></i></a></li>
                <li><a href="https://github.com/pro-masud"><i class="fa-brands fa-github"></i></a></li>
                <li><a href="#"><i class="fa-brands fa-linkedin"></i></a></li>
                <li><a href="#"><i class="fa-brands fa-twitter"></i></a></li>
                <li><a href="#"><i class="fa-brands fa-stack-overflow"></i></a></li>
                <li><a href="https://codepen.io/pro-masudbd"><i class="fa-brands fa-codepen"></i></a></li>
            </ul>
        </div>
        <hr>
        <div class="user-menu">
            <ul class="nav nav-pills mb-3 border-bottom border-2" id="pills-tab" role="tablist">
                <li class="active">
                    <a class="fw-semibold active position-relative" id="about-me-tab" data-bs-toggle="pill" data-bs-target="#about-me"  role="tab" aria-controls="about-me" aria-selected="true">
                        <i class="fa-solid fa-user"></i> About Me
                    </a>
                </li>
                <li>
                    <a class="fw-semibold position-relative" id="portfolio-tab" data-bs-toggle="pill" data-bs-target="#portfolio"  role="tab" aria-controls="portfolio" aria-selected="false">
                        <i class="fa-solid fa-address-card"></i> Portfolio
                    </a>
                </li>
                <li>
                    <a class="fw-semibold position-relative" id="resume-tab" data-bs-toggle="pill" data-bs-target="#resume"  role="tab" aria-controls="resume" aria-selected="false">
                        <i class="fa-solid fa-file"></i>  Resume
                    </a>
                </li>
                <li>
                    <a class="fw-semibold position-relative" id="service-tab" data-bs-toggle="pill" data-bs-target="#service"  role="tab" aria-controls="service" aria-selected="false">
                        <i class="fa-solid fa-briefcase"></i> Service & Pricing
                    </a>
                </li>
                <li>
                    <a class="fw-semibold position-relative" id="blog-tab" data-bs-toggle="pill" data-bs-target="#blog"  role="tab" aria-controls="blog" aria-selected="false">
                        <i class="fa-solid fa-blog"></i> Blog
                    </a>
                </li>
                <li>
                    <a class="fw-semibold position-relative" id="contact-tab" data-bs-toggle="pill" data-bs-target="#contact"  role="tab" aria-controls="contact" aria-selected="false">
                        <i class="fa-solid fa-inbox"></i> Contact
                    </a>
                </li>
                <li>
                    <a class="fw-semibold position-relative" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile"  role="tab" aria-controls="pills-profile" aria-selected="false">
                        <i class="fa-solid fa-users-gear"></i> More Pages 
                        <i class="more-right fa-solid fa-caret-down"></i>
                    </a>
                </li>
            </ul>
        </div>
        <button><i class="fa-solid fa-paper-plane"></i> Here Me</button>
        <hr>
        <div class="user-option">
            <h5>Dark Mode</h5>
            <div class="dark-mode">
                <input type="checkbox" class="checkbox" id="checkbox">
                <label for="checkbox" class="checkbox-label">
                    <i class="fas fa-moon"></i>
                    <i class="fas fa-sun"></i>
                    <span class="ball"></span>
                </label>
            </div>
        </div>
    </div>
    <!-- header left end -->
    <!-- header right start -->
    <div class="header-right">
        <div class="about-us">
            <div class="user-info order-md-2 order-lg-1">
                <h1>Masud Rana</h1>
                <h4><span class="word">WordPress Developer</span></h4>
                <p>A results-oriented WordPress Developer with a passion for crafting innovative websites that prioritize user
                    experience and functionality. Dedicated to delivering high-quality solutions that exceed expectations while
                    staying abreast of the latest technologies. Committed to contributing effectively to project success and
                    pursuing continual personal growth in the field.</p>
                <div class="user-btn nav nav-pills" id="pills-tab" role="tablist">
                    <a class="fw-semibold position-relative" id="portfolio-tab" data-bs-toggle="pill" data-bs-target="#portfolio"  role="tab" aria-controls="portfolio" aria-selected="false"><i class="fa-solid fa-circle-right"></i>View Portfolio</a>
                    <a class="fw-semibold position-relative" id="resume-tab" data-bs-toggle="pill" data-bs-target="#resume"  role="tab" aria-controls="resume" aria-selected="false" src="#"><i class="fa-solid fa-file"></i>View Resume</a>
                </div>
                <div class="mobile-menu">
                    <ul class="nav nav-pills mb-3 border-2" id="pills-tab" role="tablist">
                        <li class="active"><a class=" fw-semibold active position-relative" id="about-me-tab" data-bs-toggle="pill" data-bs-target="#about-me"  role="tab" aria-controls="about-me" aria-selected="true"><i class="fa-solid fa-user"></i></a></li>
                        <li><a class="fw-semibold position-relative" id="portfolio-tab" data-bs-toggle="pill" data-bs-target="#portfolio"  role="tab" aria-controls="portfolio" aria-selected="false"><i class="fa-solid fa-address-card"></i></a></li>
                        <li><a class="fw-semibold position-relative" id="service-tab" data-bs-toggle="pill" data-bs-target="#service"  role="tab" aria-controls="service" aria-selected="false"><i class="fa-solid fa-briefcase"></i></a></li>
                        <li><a class="fw-semibold position-relative" id="resume-tab" data-bs-toggle="pill" data-bs-target="#resume"  role="tab" aria-controls="resume" aria-selected="false"><i class="fa-solid fa-file"></i></a></li>
                        <li><a class="fw-semibold position-relative" id="blog-tab" data-bs-toggle="pill" data-bs-target="#blog"  role="tab" aria-controls="blog" aria-selected="false"><i class="fa-solid fa-blog"></i></a></li>
                        <li><a class="fw-semibold position-relative" id="contact-tab" data-bs-toggle="pill" data-bs-target="#contact"  role="tab" aria-controls="contact" aria-selected="false"><i class="fa-solid fa-inbox"></i></a></li>
                    </ul>
                </div>
            </div>
            <div class="user-photo order-first order-sm-last order-md-1 order-lg-2 ">
                <img src="image/user.png" alt="image">
            </div>
        </div>
        <hr>
        <div class="port-content">
            <div class="tab-content p-2 text-danger" id="pills-tabContent">
                <div class="tab-pane fade show active about" id="about-me" role="tabpanel" aria-labelledby="about-me-tab">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-4 col-md-6">
                                <div class="fre-img-logo">
                                    <img src="./image/logo/html.png" alt="html">
                                    <img src="./image/logo/css.png" alt="css">
                                    <img src="./image/logo/1280px-Sass_Logo_Color.svg.png" alt="scss">
                                </div>
                                <h5>HTML, CSS & SCSS</h5>
                                <p>HTML and CSS are fundamental web technologies. HTML structures content, while CSS styles and designs it. Together, they create visually appealing and functional websites.</p>
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <div class="fre-img-logo">
                                    <img src="./image/logo/js.png" alt="html">
                                    <img src="./image/logo/react-js.png" alt="css">
                                    <img src="./image/logo/jquery.png" alt="jquery">
                                    <img src="./image/logo/bootstrap-stack.png" alt="jquery">
                                    <img src="./image/logo/tl.png" alt="jquery">
                                </div>
                                <h5>JavaScript, jquery, Bootstrap</h5>
                                <p>Proficient in JavaScript (ES6), jQuery, and Bootstrap, crafting dynamic and responsive web experiences with smooth functionality and sleek design.</p>
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <div class="fre-img-logo">
                                    <img src="./image/logo/photoshop.png" alt="photoshop">
                                    <img src="./image/logo/xd.png" alt="photoshop">
                                    <img src="./image/logo/figma.png" alt="photoshop">
                                </div>
                                <h5>PSD, XD, Figma</h5>
                                <p>Expert in converting PSD, XD, and Figma designs into pixel-perfect WordPress websites, ensuring seamless integration and high fidelity.</p>
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <div class="fre-img-logo">
                                    <img src="./image/logo/PHP-logo.svg.png" alt="jquery">
                                    <img src="./image/logo/Wordpress_Blue_logo.png" alt="css">
                                    <img src="./image/logo/node.png" alt="nodejs">
                                    
                                </div>
                                <h5>WordPress, PHP, MySQli</h5>
                                <p>Skilled in WordPress, PHP, and MySQLi, building robust and scalable websites with efficient data management and seamless user experiences.</p>
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <div class="fre-img-logo">
                                    <img src="./image/logo/express.png" alt="express">
                                    <img src="./image/logo/mongodb-logo-D13D67C930-seeklogo.com.png" alt="db">
                                    <img src="./image/logo/mysqli.png" alt="jquery">
                                </div>
                                <h5>Xampp, Local, Git, GitHub</h5>
                                <p>XAMPP is a web development solution, Local provides local WordPress environments, Git is a version control system, and GitHub is a platform for hosting Git repositories.</p>
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <div class="fre-img-logo">
                                    <img src="./image/logo/github.png" alt="express">
                                    <img src="./image/logo/git.png" alt="express">
                                    <img src="./image/logo/npm.png" alt="nodejs">
                                </div>
                                <h5>Asana, Postman</h5>
                                <p>Asana: Collaborative task management tool for teams, streamlining workflows and communication. Postman: API development platform simplifying API development and collaboration for developers.</p>
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <div class="fre-img-logo">
                                    <img src="./image/logo/xpmmp.png" alt="xpmmp">
                                    <img src="./image/logo/local-lightning-icon.png" alt="local">
                                    <img src="./image/logo/asana.png" alt="xpmmp">
                                    <img src="./image/logo/postman.png" alt="xpmmp">
                                </div>
                                <h5>Asana, Postman</h5>
                                <p>Asana: Collaborative task management tool for teams, streamlining workflows and communication. Postman: API development platform simplifying API development and collaboration for developers.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade protfolio" id="portfolio" role="tabpanel" aria-labelledby="portfolio-tab">
                    <h2>WordPress Theme Themeforest</h2>
                    <div class="row">
                        <div class="col-lg-4 col-md-6">
                            <div class="protfolio-warp">
                                <div class="prot-img">
                                    <a href="https://preview.themeforest.net/item/xpovio-digital-agency-creative-portfolio-template/full_screen_preview/46924644?_ga=2.175294692.770709241.1731230611-631706038.1730652542&_gac=1.221286762.1731318637.Cj0KCQiA88a5BhDPARIsAFj595iRgSiPdsH98y5qE-P1ZW6IpdMwU6QsVD1LatbSHPLnLcbddNkBhVEaAgtbEALw_wcB"><img src="./image/theme/xpovio.png" alt="xpovio"></a>
                                </div>
                                <div class="prot-content">
                                    <h5><a href="https://preview.themeforest.net/item/xpovio-digital-agency-creative-portfolio-template/full_screen_preview/46924644?_ga=2.175294692.770709241.1731230611-631706038.1730652542&_gac=1.221286762.1731318637.Cj0KCQiA88a5BhDPARIsAFj595iRgSiPdsH98y5qE-P1ZW6IpdMwU6QsVD1LatbSHPLnLcbddNkBhVEaAgtbEALw_wcB">Xpovio Theme</a></h5>
                                    <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Aperiam temporibus voluptates quas officiis, consequuntur nesciunt.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="protfolio-warp">
                                <div class="prot-img">
                                    <a href="https://preview.themeforest.net/item/mistri-factory-industrial-wordpress-theme/full_screen_preview/51177669?_ga=2.241936708.770709241.1731230611-631706038.1730652542&_gac=1.183014740.1731318580.Cj0KCQiA88a5BhDPARIsAFj595iRgSiPdsH98y5qE-P1ZW6IpdMwU6QsVD1LatbSHPLnLcbddNkBhVEaAgtbEALw_wcB">
                                        <img src="./image/theme/mistri.png" alt="mistri">
                                    </a>
                                </div>
                                <div class="prot-content">
                                    <h5><a href="https://preview.themeforest.net/item/mistri-factory-industrial-wordpress-theme/full_screen_preview/51177669?_ga=2.241936708.770709241.1731230611-631706038.1730652542&_gac=1.183014740.1731318580.Cj0KCQiA88a5BhDPARIsAFj595iRgSiPdsH98y5qE-P1ZW6IpdMwU6QsVD1LatbSHPLnLcbddNkBhVEaAgtbEALw_wcB">Mistri Theme</a></h5>
                                    <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Aperiam temporibus voluptates quas officiis, consequuntur nesciunt.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="protfolio-warp">
                                <div class="prot-img">
                                    <a href="https://preview.themeforest.net/item/webgen-creative-agency-portfolio-html-template/full_screen_preview/52927502?_ga=2.229827674.770709241.1731230611-631706038.1730652542&_gac=1.58752735.1731318637.Cj0KCQiA88a5BhDPARIsAFj595iRgSiPdsH98y5qE-P1ZW6IpdMwU6QsVD1LatbSHPLnLcbddNkBhVEaAgtbEALw_wcB">
                                        <img src="./image/theme/webgen.png" alt="webgen">
                                    </a>
                                </div>
                                <div class="prot-content">
                                    <h5><a href="https://preview.themeforest.net/item/webgen-creative-agency-portfolio-html-template/full_screen_preview/52927502?_ga=2.229827674.770709241.1731230611-631706038.1730652542&_gac=1.58752735.1731318637.Cj0KCQiA88a5BhDPARIsAFj595iRgSiPdsH98y5qE-P1ZW6IpdMwU6QsVD1LatbSHPLnLcbddNkBhVEaAgtbEALw_wcB">Webgen Theme</a></h5>
                                    <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Aperiam temporibus voluptates quas officiis, consequuntur nesciunt.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="protfolio-warp">
                                <div class="prot-img">
                                    <a href="https://bracketweb.com/firdipwp">
                                        <img src="./image/theme/firdip-theme.png" alt="firdip">
                                    </a>
                                </div>
                                <div class="prot-content">
                                    <h5><a href="https://bracketweb.com/firdipwp">Firdip Theme</a></h5>
                                    <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Aperiam temporibus voluptates quas officiis, consequuntur nesciunt.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="protfolio-warp">
                                <div class="prot-img">
                                    <a href="https://bracketweb.com/walloxwp">
                                        <img src="./image/theme/wallox-theme.png" alt="wallox">
                                    </a>
                                </div>
                                <div class="prot-content">
                                    <h5><a href="https://bracketweb.com/walloxwp">Wallox Theme</a></h5>
                                    <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Aperiam temporibus voluptates quas officiis, consequuntur nesciunt.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="protfolio-warp">
                                <div class="prot-img">
                                    <a href="https://bracketweb.com/walloxwp">
                                        <img src="./image/theme/karoons-theme.png" alt="karoons">
                                    </a>
                                </div>
                                <div class="prot-content">
                                    <h5><a href="https://bracketweb.com/walloxwp">karoons Theme</a></h5>
                                    <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Aperiam temporibus voluptates quas officiis, consequuntur nesciunt.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <h2>WordPress Theme & Plugin Client Projects</h2>
                    <div class="row">
                        <div class="col-lg-4 col-md-6">
                            <div class="protfolio-warp">
                                <div class="prot-img">
                                    <a href="https://hab.org.bd/">
                                        <img src="https://raw.githubusercontent.com/pro-masud/human-appeal-theme/main/screenshot.png" alt="xpovio">
                                    </a>
                                </div>
                                <div class="prot-content">
                                    <h5><a href="https://hab.org.bd/">Human Appeal Theme</a></h5>
                                    <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Aperiam temporibus voluptates quas officiis, consequuntur nesciunt.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="protfolio-warp">
                                <div class="prot-img">
                                    <a href="https://github.com/dev-alamin/book-review">
                                        <img src="./image/theme/images.png" alt="xpovio">
                                    </a>
                                </div>
                                <div class="prot-content">
                                    <h5><a href="https://github.com/dev-alamin/book-review">Book Review Plugin</a></h5>
                                    <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Aperiam temporibus voluptates quas officiis, consequuntur nesciunt.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="protfolio-warp">
                                <div class="prot-img">
                                    <a href="https://hab.org.bd/">
                                        <img src="./image/theme/images.png" alt="xpovio">
                                    </a>
                                </div>
                                <div class="prot-content">
                                    <h5><a href="https://github.com/dev-alamin/elementor-food-menu">Elementor Food Menu Plugin</a></h5>
                                    <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Aperiam temporibus voluptates quas officiis, consequuntur nesciunt.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <h2>PSD, XD & Figma To HTML Teamplets</h2>
                    <div class="row">
                        <div class="col-lg-4 col-md-6">
                            <div class="protfolio-warp">
                                <div class="prot-img">
                                    <a href="https://github.com/dev-alamin/elementor-food-menu">
                                        <img src="./image/theme/images.png" alt="xpovio">
                                    </a>
                                </div>
                                <div class="prot-content">
                                    <h5><a href="https://github.com/dev-alamin/elementor-food-menu">Elementor Food Menu Plugin</a></h5>
                                    <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Aperiam temporibus voluptates quas officiis, consequuntur nesciunt.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="service" role="tabpanel" aria-labelledby="service-tab">
                    <h2>Service</h2>
                    <p>Please check our more design @ <a target="_blank" href="https://codepen.io/Gaurav-Rana-the-reactor">Codepen</a></p>
                </div>
                <div class="tab-pane fade resume" id="resume" role="tabpanel" aria-labelledby="resume-tab">
                    <h2>Resume</h2>
                    <iframe src="./image/files/me.pdf" frameborder="0"></iframe>
                    <p>Please check our more design @ <a target="_blank" href="https://codepen.io/Gaurav-Rana-the-reactor">Codepen</a></p>
                </div>
                <div class="tab-pane fade blog" id="blog" role="tabpanel" aria-labelledby="blog-tab">
                    <div class="row">
                        <div class="col-lg-4 col-md-6  blog">
                            <div class="blog-img">
                                <img src="./image/blog/Blogger-Logo.png" alt="image">
                            </div>
                            <div class="blog-content">
                                <h3>This is a Title</h3>
                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quam vero aspernatur enim architecto laudantium ratione, corporis a molestiae voluptatibus accusamus.</p>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 blog">
                            <div class="blog-img">
                                <img src="./image/blog/Blogger-Logo.png" alt="image">
                            </div>
                            <div class="blog-content">
                                <h3>This is a Title</h3>
                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quam vero aspernatur enim architecto laudantium ratione, corporis a molestiae voluptatibus accusamus.</p>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 blog">
                            <div class="blog-img">
                                <img src="./image/blog/Blogger-Logo.png" alt="image">
                            </div>
                            <div class="blog-content">
                                <h3>This is a Title</h3>
                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quam vero aspernatur enim architecto laudantium ratione, corporis a molestiae voluptatibus accusamus.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade contact" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                    <div class="row align-items-center">
                        <div class="col-lg-6 col-md-6 order-sm-2 order-lg-1">
                            <div class="contact-form">
                                <h2>Contact Form</h2>
                                <form action="#">
                                    <div class="user-f-name">
                                        <div class="user-f">
                                            <label for="#">First Name</label>
                                            <input type="text">
                                        </div>

                                        <div class="user-l">
                                            <label for="#">Last Name</label>
                                            <input type="text">
                                        </div>
                                    </div>

                                    <label for="#">Email</label>
                                    <input type="text">

                                    <label for="#">Cell</label>
                                    <input type="text">

                                    <label for="#">Message</label>
                                    <Textarea></Textarea>

                                    <button>Submit Now</button>
                                </form>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 order-first order-sm-last order-sm-1 order-lg-2">
                            <div class="contact-details">
                                <div class="meet-up-top">
                                    <h2>Meet Me</h2>
                                    <div class="ct-address">
                                        <a href="#"><i class="fa-solid fa-address-card"></i> +8801797562295</a>
                                        <a href="#"><i class="fa-solid fa-address-card"></i> promasud@gmail.com</a>
                                        <a href="#"><i class="fa-solid fa-address-card"></i> Mirput-10, Dhaka, Bangladesh</a>
                                    </div>
                                </div>
                                <div class="meet-up-buttom">
                                    <h2>Pitch Us</h2>
                                    <p><span>Hello !</span></p>
                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ullam amet omnis quis rem!</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>   
    <!-- header right start -->
</section>
<?php
return ob_get_clean();