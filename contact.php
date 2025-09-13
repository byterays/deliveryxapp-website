<?php include "layout/header.php" ?>

<!-- subheader begin -->
<section id="subheader" class="page-contact no-bottom" data-stellar-background-ratio="0.5">
    <div class="overlay">
        <div class="container">
            <div class="row">
                <div class="col-md-12">

                    <h1>Contact Us
                        <span>Get In Touch With Us</span>
                    </h1>
                    <div class="small-border wow flipInY" data-wow-delay=".8s" data-wow-duration=".8s"></div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- subheader close -->



<!-- content begin -->
<div id="content">
    <div class="container">
        <div class="row no-gutter">
            <div class="col-md-6">
                <div id="map">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d437.99762072600726!2d77.32713859892785!3d28.570334279207206!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2snp!4v1698648191230!5m2!1sen!2snp"
                        width="100%" height="480" style="border:0;" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"></iframe>

                </div>
            </div>

            <div class="col-md-6">
                <div id="contact-form-wrapper">
                    <div class="contact_form_holder">
                        <form id="contact" class="row" name="form1" method="post" action="#">


                            <input type="hidden" id="is_human" name="is_human" />
                            <input type="text" class="form-control" name="name" id="name" placeholder="Your name" />
                            <div id="error_name" class="error">Please fill in your name</div>

                            <input type="text" class="form-control" name="phone" id="phone"
                                placeholder="Contact Number" />
                            <div id="error_phone" class="error">Please provide your contact number</div>

                            <input type="text" class="form-control" name="email" id="email" placeholder="Your email" />
                            <div id="error_email" class="error">Please provide your valid email</div>


                            <textarea cols="10" rows="8" name="message" id="message" class="form-control"
                                placeholder="Your message"></textarea>
                            <div id="error_message" class="error">Please type your message</div>

                            <div id="mail_result" class="success"></div>
                            

                            <p id="btnsubmit">
                                <input type="submit" id="send" value="Send" class="btn btn-custom" />
                            </p>



                        </form>
                    </div>
                </div>
            </div>


        </div>

        
    </div>
</div>
<!-- content close -->

<?php include "layout/footer.php" ?>