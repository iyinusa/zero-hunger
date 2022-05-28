<section class="page-banner">
    <div class="container">
		<div class="breadcumb-wrapper">
            <ul class="list-inline link-list">
                <li><a href="<?php echo base_url(); ?>">Home</a></li>
                <li><a href="<?php echo base_url('causes'); ?>">Causes</a></li>
                <li><?php echo $cause_name; ?></li>
            </ul>
        </div>
    </div>
</section>

<section class="single-cause">
	<div class="container">
		<figure class="image-box">
			<img src="<?php echo base_url(); ?>assets/images/causes/s1.jpg" alt="" />
		</figure>
		<div class="content-box">
			<div class="icon-box">
				<img src="<?php echo base_url(); ?>assets/images/causes/1.png" alt="" />
			</div>
			<div class="title">
				<h2><?php echo $cause_name; ?></h2>
			</div>
			<div class="text">
				<p><?php echo $cause_details; ?></p>
			</div>
            <h2>Our Plan</h2>
			<div class="text">
				<p><?php echo $cause_plan; ?></p>
			</div>
			<div class="progress-levels">
				<div class="progress-box">
					<div class="inner">
						<div class="bar">
							<div class="bar-innner">
								<div class="bar-fill" data-percent="10">
									<sapan class="percent">0%</sapan>
							   </div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="donate-price"><b>&#8358;0 </b>&nbsp; Raised of  <span> <?php echo $cause_amt; ?> </span> Goal</div>
			
			<div class="donate-amount">
				<div class="title">
					<h5><i class="fa fa-arrow-circle-right"></i>Enter an amount to Donate</h5>
				</div>
				<div class="default-form-area">
					<?php echo form_open('causes/donate', array('id'=>'bb_ajax_form', 'class'=>'default-form style-three')); ?>
						<div class="row clearfix">
							<div class="col-md-12 col-sm-12 col-xs-12">
								<div class="form-group style-three">
									<input type="hidden" name="cause_type" value="<?php echo $cause_name; ?>" />
                                    <input type="text" name="amount" class="form-control" placeholder="&#8358;10000" required>
								</div>
							</div>
                            
                            <div id="bb_ajax_msg"></div>
                            
							<div class="col-md-12 col-sm-12 col-xs-12">
								<div class="form-group style-three">
									<button class="thm-btn" type="submit">Donate now</button>
								</div>
							</div>   

						</div>
					<?php echo form_close(); ?>
				</div>
			</div>
		</div>
	</div>
</section>