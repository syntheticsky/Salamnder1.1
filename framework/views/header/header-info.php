<?php if ( Salamander::getData( 'header_number' ) ) : ?>
<a href="tel:<?php echo Salamander::getData( 'header_number' ); ?>"><?php echo Salamander::getData( 'header_number' );?></a>
<?php endif; ?>
<?php if( Salamander::getData( 'header_number' ) && Salamander::getData( 'header_email' ) ) : ?>
<span class="delimiter"> | </span>
<?php endif; ?>
<?php if ( Salamander::getData( 'header_email' ) ) : ?>
<a href="mailto:<?php echo Salamander::getData( 'header_email' ); ?>"><?php echo Salamander::getData( 'header_email' ); ?></a>
<?php endif; ?>
