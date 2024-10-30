<?php defined( 'ABSPATH' ) or die; ?>
<div class="wrap wrap-lupon-media-wpp">
<?php settings_errors(); ?>
<h1><?php _e( 'Lupon Media - Options', 'lupon-media-wpp' ); ?></h1>
	<form method="post" action="options.php">
		<?php settings_fields( LUPON_MEDIA_WPP_OPTSGROUP_NAME ); ?>
		<?php do_settings_sections( LUPON_MEDIA_WPP_OPTSGROUP_NAME ); ?>
		<table class="form-table">
			<tr class="lupon-media-wpp-tr">
				<th><?php _e( 'Ads.txt Content', 'lupon-media-wpp' ); ?></th>
				<td>
					<?php if ( $this->get_adstxt_content() === false ) : ?>
						<div><?php _e( 'ads.txt file cannot be created/updated. Use FTP', 'lupon-media-wpp' ); ?></div>
					<?php endif; ?>
					<textarea name="<?php echo LUPON_MEDIA_WPP_OPTIONS_NAME . "[adstxt_content]"; ?>" class="regular-text" rows="7"><?php echo esc_textarea( $this->get_adstxt_content() ); ?></textarea>
				</td>
			</tr>
			<tr class="lupon-media-wpp-tr">
				<th><?php _e( 'Header Content', 'lupon-media-wpp' ); ?></th>
				<td>
					<textarea name="<?php echo LUPON_MEDIA_WPP_OPTIONS_NAME . "[header_content]"; ?>" class="regular-text" rows="7"><?php echo esc_textarea( $this->get_option( 'header_content' ) ); ?></textarea>
				</td>
			</tr>
			<tr class="lupon-media-wpp-tr">
				<th><?php _e( 'Footer Content', 'lupon-media-wpp' ); ?></th>
				<td>
					<textarea name="<?php echo LUPON_MEDIA_WPP_OPTIONS_NAME . "[footer_content]"; ?>" class="regular-text" rows="7"><?php echo esc_textarea( $this->get_option( 'footer_content' ) ); ?></textarea>
				</td>
			</tr>
			<tr class="lupon-media-wpp-tr">
				<th><?php _e( 'Post Content', 'lupon-media-wpp' ); ?></th>
				<td>
					<nav class="nav-tab-wrapper">
						<a href="#" class="nav-tab nav-tab-active" data-index="1"><?php _e( 'After Paragraph #1', 'lupon-media-wpp' ); ?></a>
						<a href="#" class="nav-tab" data-index="2"><?php _e( 'After Paragraph #2', 'lupon-media-wpp' ); ?></a>
						<a href="#" class="nav-tab" data-index="3"><?php _e( 'After Paragraph #3', 'lupon-media-wpp' ); ?></a>
						<a href="#" class="nav-tab" data-index="4"><?php _e( 'After Paragraph #4', 'lupon-media-wpp' ); ?></a>
						<a href="#" class="nav-tab" data-index="5"><?php _e( 'After Paragraph #5', 'lupon-media-wpp' ); ?></a>
					</nav>
					<div class="tab-content-wrapper" style="margin-top: 20px">
						<div class="tab-content tab-content-1">
							<textarea name="<?php echo LUPON_MEDIA_WPP_OPTIONS_NAME . "[apc1]"; ?>" class="regular-text" rows="7"><?php echo esc_textarea( $this->get_option( 'apc1' ) ); ?></textarea>
						</div>
						<div class="tab-content tab-content-2" style="display: none">
							<textarea name="<?php echo LUPON_MEDIA_WPP_OPTIONS_NAME . "[apc2]"; ?>" class="regular-text" rows="7"><?php echo esc_textarea( $this->get_option( 'apc2' ) ); ?></textarea>
						</div>
						<div class="tab-content tab-content-3" style="display: none">
							<textarea name="<?php echo LUPON_MEDIA_WPP_OPTIONS_NAME . "[apc3]"; ?>" class="regular-text" rows="7"><?php echo esc_textarea( $this->get_option( 'apc3' ) ); ?></textarea>
						</div>
						<div class="tab-content tab-content-4" style="display: none">
							<textarea name="<?php echo LUPON_MEDIA_WPP_OPTIONS_NAME . "[apc4]"; ?>" class="regular-text" rows="7"><?php echo esc_textarea( $this->get_option( 'apc4' ) ); ?></textarea>
						</div>
						<div class="tab-content tab-content-5" style="display: none">
							<textarea name="<?php echo LUPON_MEDIA_WPP_OPTIONS_NAME . "[apc5]"; ?>" class="regular-text" rows="7"><?php echo esc_textarea( $this->get_option( 'apc5' ) ); ?></textarea>
						</div>
					</div>
				</td>
			</tr>
		</table>
		<?php submit_button(); ?>
	</form>
</div>