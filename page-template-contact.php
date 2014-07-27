<?php
/*
Template Name: Contact
*/
?>
<?php 
$emailTo = 'bha100710@gmail.com';
$nameError = '';
$emailError = '';
$commentError = '';
$sumError = '';

if(isset($_POST['submitted'])) {
		if(trim($_POST['contactName']) === '') {
			$nameError = 'Please enter your name.';
			$hasError = true;
		} else {
			$name = trim($_POST['contactName']);
		}
		
		if(trim($_POST['email']) === '')  {
			$emailError = 'Please enter your email address.';
			$hasError = true;
		} else if (!eregi("^[A-Z0-9._%-]+@[A-Z0-9._%-]+\.[A-Z]{2,4}$", trim($_POST['email']))) {
			$emailError = 'You entered an invalid email address.';
			$hasError = true;
		} else {
			$email = trim($_POST['email']);
		}
			
		if(trim($_POST['comments']) === '') {
			$commentError = 'Please enter a message.';
			$hasError = true;
		} else {
			if(function_exists('stripslashes')) {
				$comments = stripslashes(trim($_POST['comments']));
			} else {
				$comments = trim($_POST['comments']);
			}
		}
		
		if(trim($_POST['sum']) === '' || trim($_POST['sum']) != '11' ){
			$sumError = "Please enter correct captcha answer for 7 + 4";
			$hasError = true;
		}
			
		if(!isset($hasError)) {
			if (!isset($emailTo) || ($emailTo == '') ){
				$emailTo = get_option('admin_email');
			}
			$subject = '[Contact Form] From '.$name;
			$body = "Name: $name \n\nEmail: $email \n\nComments: $comments";
			$headers = 'From: '.$name.' <'.$emailTo.'>' . "\r\n" . 'Reply-To: ' . $emailTo;
			
			mail($emailTo, $subject, $body, $headers);
			$emailSent = true;
		}
	
} ?>

<?php get_header(); ?>
	<div id="primary" <?php generate_content_class();?>>
		<div class="inside-article">  
		<?php do_action( 'generate_before_content'); ?>		
				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
					
					<div <?php post_class() ?> id="post-<?php the_ID(); ?>">
                    
						<header class="entry-header"><h1 class="entry-title" itemprop="headline"><?php the_title(); ?></h1>
						</header>
						<?php do_action( 'generate_after_entry_header'); ?>
						<div class="entry-content" itemprop="text">
							<div class="contact-form clearfix">
                        
							<?php if(isset($emailSent) && $emailSent == true) { ?>

                                <div class="thanks">
                                    <p><?php _e('Thanks, your email was sent successfully.', 'framework') ?></p>
                                </div>
            
                            <?php } else { ?>
            
                                <?php the_content(); ?>
                    
                                <?php if(isset($hasError) || isset($captchaError)) { ?>
                                    <p class="error"><?php _e('Sorry, an error occured.', 'framework') ?><p>
                                <?php } ?>
                
                                <form action="<?php the_permalink(); ?>" id="contactForm" method="post">
                                    <ul class="contactform">
                                        <li><label for="contactName"><?php _e('Name:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;', 'framework') ?></label>
                                            <input type="text" name="contactName" id="contactName" value="<?php if(isset($_POST['contactName'])) echo $_POST['contactName'];?>" class="required requiredField" />
                                            <?php if($nameError != '') { ?>
                                                <span class="error"><?php echo $nameError; ?></span> 
                                            <?php } ?>
                                        </li>
                            
                                        <li><label for="email"><?php _e('Email:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;', 'framework') ?></label>
                                            <input type="text" name="email" id="email" value="<?php if(isset($_POST['email']))  echo $_POST['email'];?>" class="required requiredField email" />
                                            <?php if($emailError != '') { ?>
                                                <span class="error"><?php echo $emailError; ?></span>
                                            <?php } ?>
                                        </li>
                            
                                        <li class="textarea"><label for="commentsText"><?php _e('Message:<br>', 'framework') ?></label>
                                            <textarea name="comments" id="commentsText" rows="20" cols="30" class="required requiredField"><?php if(isset($_POST['comments'])) { if(function_exists('stripslashes')) { echo stripslashes($_POST['comments']); } else { echo $_POST['comments']; } } ?></textarea>
                                            <?php if($commentError != '') { ?>
                                                <span class="error"><?php echo $commentError; ?></span> 
                                            <?php } ?>
                                        </li>
                                        
                                        <li><label for="sum"><?php _e('7 + 4:', 'framework') ?></label>
                                            <input type="text" name="sum" id="sum" value="<?php if(isset($_POST['sum'])) echo $_POST['sum'];?>" class="required requiredField" />
                                            <?php if($sumError != '') { ?>
                                                <br/><span class="error"><?php echo $sumError; ?></span> 
                                            <?php } ?>
                                        </li>
                            
                                        <li class="buttons">
                                            <input type="hidden" name="submitted" id="submitted" value="true" />
                                            <label></label><button class="button-message" type="submit"><?php _e('Send Email', 'framework') ?></button>
                                        </li>
                                    </ul>
                                </form>
                            <?php } ?>
                        
							</div>
						</div>
					</div>
	
					<?php endwhile; else: ?>
	
					<div id="post-0" <?php post_class() ?>>
					
						<h1 class="entry-title"><?php _e('Error 404 - Not Found', 'framework') ?></h1>
					
						<div class="entry-content">
							<p><?php _e("Sorry, but you are looking for something that isn't here.", "framework") ?></p>
							<?php get_search_form(); ?>
						</div>
					</div>
	
				<?php endif; ?>
		</div>
	</div><!-- #primary -->

<?php 
do_action('generate_sidebars');
get_footer();