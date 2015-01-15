<div class="share-box" style="background-color:<?php print $bg_color; ?>;">
	<h4><?php print $tagline; ?></h4>
	<ul class="social-networks social-networks-<?php print $socialbox_icons_color; ?>">
<?php if (  Salamander::getData( 'sharing_facebook' ) ): ?>
		<li class="facebook">
			<a href="http://www.facebook.com/sharer.php?u=<?php print $link; ?>&amp;t=<?php print $title; ?>">
				Facebook
			</a>
			<div class="popup">
				<div class="holder">
					<p>Facebook</p>
				</div>
			</div>
		</li>
<?php endif;
			if( Salamander::getData( 'sharing_twitter' ) ): ?>
		<li class="twitter">
			<a href="http://twitter.com/home?status=<?php print $title; ?> <?php print $link; ?>">
				Twitter
			</a>
			<div class="popup">
				<div class="holder">
					<p>Twitter</p>
				</div>
			</div>
		</li>
<?php endif;
			if( Salamander::getData( 'sharing_linkedin' ) ): ?>
		<li class="linkedin">
			<a href="http://linkedin.com/shareArticle?mini=true&amp;url=<?php print $link; ?>&amp;title=<?php $title; ?>">
				LinkedIn
			</a>
			<div class="popup">
				<div class="holder">
					<p>LinkedIn</p>
				</div>
			</div>
		</li>
<?php	endif;
			if( Salamander::getData( 'sharing_reddit' ) ): ?>
		<li class="reddit">
			<a href="http://reddit.com/submit?url=<?php print $link; ?>&amp;title=<?php print $title; ?>">
				Reddit
			</a>
			<div class="popup">
				<div class="holder">
					<p>Reddit</p>
				</div>
			</div>
		</li>
<?php	endif;
			if( Salamander::getData( 'sharing_tumblr' ) ): ?>
		<li class="tumblr">
			<a href="http://www.tumblr.com/share/link?url=<?php print $link; ?>&amp;name=<?php print $title; ?>&amp;description=<?php print $description; ?>">
				Tumblr
			</a>
			<div class="popup">
				<div class="holder">
					<p>Tumblr</p>
				</div>
			</div>
		</li>
<?php	endif;
			if( Salamander::getData( 'sharing_google' ) ): ?>
		<li class="google">
			<a href="https://plus.google.com/share?url=<?php print $link; ?>" onclick="javascript:window.open(this.href,
\'\', \'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600\');return false;">
				Google +1
			</a>
			<div class="popup">
				<div class="holder">
					<p>Google +1</p>
				</div>
			</div>
		</li>
<?php	endif;
			if( Salamander::getData( 'sharing_pinterest' ) ): ?>
		<li class="pinterest">
			<a href="http://pinterest.com/pin/create/button/?url=<?php print $link; ?>&amp;description=<?php $title; ?>">
				Pinterest
			</a>
			<div class="popup">
				<div class="holder">
					<p>Pinterest</p>
				</div>
			</div>
		</li>
<?php	endif;
			if( Salamander::getData( 'sharing_email' ) ): ?>
		<li class="email">
			<a href="mailto:?subject=<?php print $title; ?>&amp;body=<?php print $link; ?>">
				Email
			</a>
			<div class="popup">
				<div class="holder">
					<p>Email</p>
				</div>
			</div>
		</li>
<?php	endif; ?>
	</ul>
</div>
