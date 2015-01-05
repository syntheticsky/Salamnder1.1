<div class="person">
<?php if( $picture ): ?>
	<img class="person-img" src="<?php print $picture; ?>" alt="<?php print $name; ?>" />
<?php endif; ?>
<?php if( $name || $title || $facebook_link || $twitter_link || $linkedin_link || $content ) : ?>
	<div class="person-desc">
		<div class="person-author clearfix">
			<div class="person-author-wrapper">
				<span class="person-name"><?php print $name; ?></span>
				<span class="person-title"><?php print $title; ?></span>
			</div>
		<?php if( $facebook_link ) : ?>
			<div class="social-icon">
				<a href="<?php print $facebook_link; ?>" target="<?php print $link_target; ?>" class="facebook">Facebook</a>
				<div class="popup">
					<div class="holder">
						<p>Facebook</p>
					</div>
				</div>
			</div>
		<?php endif; ?>
		<?php if( $twitter_link ) : ?>
			<div class="social-icon">
				<a href="<?php print $twitter_link; ?>" target="<?php print $link_target; ?>" class="twitter">Twitter</a>
				<div class="popup">
					<div class="holder">
						<p>Twitter</p>
					</div>
				</div>
			</div>
		<?php endif; ?>
		<?php if( $linkedin_link ) : ?>
			<div class="social-icon">
				<a href="<?php print $linkedin_link; ?>" target="<?php print $link_target; ?>" class="linkedin">LinkedIn</a>
				<div class="popup">
					<div class="holder">
						<p>LinkedIn</p>
					</div>
				</div>
			</div>
		<?php endif; ?>
		<?php if( $dribbble_link ) : ?>
			<div class="social-icon"><a href="<?php print $dribbble_link; ?>" target="<?php print $link_target; ?>" class="dribbble">Dribbble</a>
				<div class="popup">
					<div class="holder">
						<p>Dribbble</p>
					</div>
				</div>
			</div>
		<?php endif; ?>
			<div class="clearfix"></div>
		</div>
		<div class="person-content">
			<?php print $content; ?>
		</div>
	</div>
<?php endif; ?>
</div>
