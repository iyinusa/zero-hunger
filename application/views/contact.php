<section class="page-banner">
    <div class="container">
		<div class="title">
            <h1>Contact <span>Us</span></h1>
        </div>
        <div class="text">
			<p>Reach out to us</p>
		</div>
    </div>
</section>

<section class="contact_details">
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-sm-6 col-xs-12">
                <div class="item center">
                    <div class="icon_box">
                        <span class="fa fa-object-ungroup"></span>
                    </div>
                    <h4>Drop Us A Line</h4>
                    <div class="text">
                        <p>For enquiry, support, donation, etc... email us.</p>
						<h5><?php echo app_email; ?></h5>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-6 col-xs-12">
                <div class="item center">
                    <div class="icon_box">
                        <span class="fa fa-phone"></span>
                    </div>
                    <h4>Ring Us</h4>
                    <div class="text">
                        <p>Feel like speaking with someone to know about us</p>
						<h5>+234 802 706 5112</h5>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-6 col-xs-12">
                <div class="item center">
                    <div class="icon_box">
                        <span class="fa fa-map-marker"></span>
                    </div>
                    <h4>Visit Our Office</h4>
                    <div class="text">
                        <p>Lagos, Nigeria</p>
						<h5>+234 802 706 5112</h5>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>

<section class="contact_us">
    <div class="container"> 
		<div class="section-title text-center">
			<h2>Leave us a message</h2>
		</div>
		<div class="default-form-area">
			<?php echo form_open('contact/send_email', array('id'=>'bb_ajax_form', 'class'=>'default-form')); ?>
				<div class="row clearfix">
					<div class="col-md-6 col-sm-6 col-xs-12">
						<div class="form-group">
							<input type="text" name="form_name" class="form-control" value="" placeholder="Your Name" required>
						</div>
					</div>
					<div class="col-md-6 col-sm-6 col-xs-12">
						<div class="form-group">
							<input type="email" name="form_email" class="form-control required email" value="" placeholder="Your Mail" required>
						</div>
					</div>
					<div class="col-md-6 col-sm-6 col-xs-12">
						<div class="form-group">
							<input type="text" name="form_phone" class="form-control" value="" placeholder="Phone">
						</div>
					</div>
					<div class="col-md-6 col-sm-6 col-xs-12">
						<div class="form-group">
							<input type="text" name="form_subject" class="form-control" value="" placeholder="Subject" required="required">
						</div>
					</div>
					<div class="col-md-12 col-sm-12 col-xs-12">
						<div class="form-group">
							<textarea name="form_message" class="form-control textarea required" placeholder="Your Message...."></textarea>
						</div>
					</div>   
					
                    <div id="bb_ajax_msg"></div>
                    
                    <div class="col-md-12 col-sm-12 col-xs-12">
						<div class="form-group">
							<button class="thm-btn" type="submit">Send Message</button>
						</div>
					</div>   

				</div>
			<?php echo form_close(); ?>
		</div>
    </div>
</section>