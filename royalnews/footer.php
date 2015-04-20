<?php global $wlm_shortname; ?>

			<!-- // content footer start // -->
			<footer>
				<div class="content-footer">
					<div class="content-footer-a">
						<div class="content-footer-l">
							<?php if(!function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer Column 1')) : ?>
							<?php endif; ?>
						</div>
						<div class="content-footer-c">
						  <?php if(!function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer Column 2')) : ?>
						  <?php endif; ?>
						</div>
						<div class="content-footer-r">
						  <?php if(!function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer Column 3')) : ?>
						  <?php endif; ?>
						</div>
						<div class="clear"></div> 
					</div>
				</div>
				
				<div class="content-footer-d">
					<div class="footer-copy-l"><?php echo stripslashes(get_option($wlm_shortname."_footer_left")); ?></div>
					<div class="footer-copy-r"><?php echo stripslashes(get_option($wlm_shortname."_footer_right")); ?></div>
					<div class="clear"></div>
				</div>
			</footer>
			<!-- \\ content footer end \\ -->
					
		</div>
		  
		<!-- // right-coll start // -->
		<?php include(TEMPLATEPATH . '/rightcol.php'); ?>
		<div class="clear"></div>
      
    </div>
  </div>
  
  <br class="clear" />
  
</div>
<!-- ///center col/// -->

</div>
<!-- /conteiner1 -->

  <br class="clear none" />
  
</div>
<!-- /main-cont -->

<?php echo stripslashes(get_option($wlm_shortname."_tracking_code")); ?>

<?php wp_footer(); ?>

</body>
</html>