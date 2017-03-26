
		<div id="cbox-links" class="secondary-panel">
			<h2><?php _e( 'Quick Links', 'cbox' ); ?></h2>

			<div class="welcome-panel-column-container">

				<!-- SETTINGS -->
				<div class="welcome-panel-column">
					<h4><span class="icon16 icon-settings"></span> <?php _e( 'Settings', 'cbox' ); ?></h4>
					<p><?php _e( "Commons In A Box works by pulling together a number of independent WordPress and BuddyPress plugins. Customize your site by exploring the settings pages for these plugins below.", 'cbox' ); ?></p>
					<ul>

					<?php
						$cbox_plugins = CBox_Plugins::get_plugins();
						foreach ( CBox_Plugins::get_settings() as $plugin => $settings_url ) {
							echo '<li><a title="' . __( "Click here to view this plugin's settings page", 'cbox' ) . '" href="' . $settings_url .'">' . $plugin . '</a> - ' . $cbox_plugins[$plugin]['cbox_description'];

							if ( ! empty( $cbox_plugins[$plugin]['documentation_url'] ) )
								echo ' [<a title="' . __( "Click here for plugin documentation at commonsinabox.org", 'cbox' ) . '" href="' . esc_url( $cbox_plugins[$plugin]['documentation_url'] ) . '" target="_blank">' . __( 'Info...', 'cbox' ) . '</a>]';

							echo '</li>';
						}
					?>
					</ul>

					<div class="login postbox">
						<div class="message" style="text-align:center;">
							<strong><?php printf( __( '<a href="%s">Manage all your CBOX plugins here</a>', 'cbox' ), esc_url( network_admin_url( 'admin.php?page=cbox-plugins' ) ) ); ?></strong>
						</div>
					</div>
				</div>

				<!-- THEME -->
				<div class="welcome-panel-column welcome-panel-last">
					<h4><span class="icon16 icon-appearance"></span> <?php _e( 'Theme', 'cbox' ); ?></h4>
					<?php
						$theme = cbox_get_theme();
						$package_theme = cbox_get_package_prop( 'theme' );

						if ( $theme->errors() ) :
							echo '<p>';
							printf( __( '<a href="%1$s">Install the %2$s theme to get started</a>.', 'cbox' ), wp_nonce_url( network_admin_url( 'admin.php?page=cbox&amp;cbox-action=install-theme' ), 'cbox_install_theme' ), esc_attr( $package_theme['name'] ) );
							echo '</p>';
						else:

							// current theme is not the CBOX default theme
							if ( $theme->get_template() != $package_theme['directory_name'] ) {
								$is_bp_compatible = cbox_is_theme_bp_compatible();

							?>
								<p><?php printf( __( 'Your current theme is %s.', 'cbox' ), '<strong>' . $theme->display( 'Name' ) . '</strong>' ); ?></p>

								<?php
									if ( ! $is_bp_compatible ) {
										echo '<p>';
										_e( 'It looks like this theme is not compatible with BuddyPress.', 'cbox' );
										echo '</p>';
									}
								?>

								<p><?php _e( 'Did you know that <strong>CBOX</strong> comes with a cool theme? Check it out below!', 'cbox' ); ?></p>

								<a rel="leanModal" title="<?php _e( 'View a larger screenshot of the CBOX theme', 'cbox' ); ?>" href="#cbox-theme-screenshot"><img width="200" src="<?php echo cbox()->plugin_url( 'admin/images/screenshot_cbox_theme.png' ); ?>" alt="" /></a>

								<div class="login postbox">
									<div class="message" style="text-align:center;">
										<strong><?php printf( __( '<a href="%1$s">Like the %2$s theme? Install it!</a>', 'cbox' ), wp_nonce_url( network_admin_url( 'admin.php?page=cbox&amp;cbox-action=install-theme' ), 'cbox_install_theme' ), esc_attr( $package_theme['name'] ) ); ?></strong>
									</div>
								</div>

								<!-- hidden modal window -->
								<div id="cbox-theme-screenshot" style="display:none;">
									<img src="<?php echo cbox()->plugin_url( 'admin/images/screenshot_cbox_theme.png' ); ?>" alt="" />
								</div>
								<!-- #cbox-theme-screenshot -->

								<script type="text/javascript">jQuery("a[rel*=leanModal]").leanModal();</script>

								<?php
									if ( ! $is_bp_compatible ) {
										echo '<p>';
										printf( __( "You can also make your theme compatible with the <a href='%s'>BuddyPress Template Pack</a>.", 'buddypress' ), network_admin_url( 'plugin-install.php?type=term&tab=search&s=%22bp-template-pack%22' ) );
										echo '</p>';
									}
								?>

							<?php
							// current theme is the CBOX default theme
							} else {
								// check for upgrades
								//$is_upgrade = CBox_Theme_Specs::get_upgrades( $theme );
							?>

								<?php if ( $theme->get_stylesheet() != $package_theme['directory_name'] ) : ?>
									<p><?php printf( __( 'You\'re using a child theme of the <strong>%1$s</strong> theme.', 'cbox' ), esc_attr( $package_theme['name'] ) ); ?></p>
								<?php else : ?>
									<p><?php printf( __( 'You\'re using the <strong>%1$s</strong> theme.', 'cbox' ), esc_attr( $package_theme['name'] ) ); ?></p>
								<?php endif; ?>

								<?php /* HIDE THIS FOR NOW ?>
								<?php if ( $is_upgrade ) : ?>
									<div class="login postbox">
										<div id="login_error" class="message">
											<?php _e( 'Update available.', 'cbox' ); ?> <strong><a href="<?php echo wp_nonce_url( network_admin_url( 'admin.php?page=cbox&amp;cbox-action=upgrade-theme&amp;cbox-themes=' . $is_upgrade ), 'cbox_upgrade_theme' ); ?>"><?php _e( 'Update now!', 'cbox' ); ?></a></strong>
										</div>
									</div>
								<?php endif; ?>
								<?php */ ?>

								<div class="login postbox">
									<div class="message">
										<strong><?php printf( __( '<a href="%1$s">Configure the %2$s theme here</a>', 'cbox' ), esc_url( get_admin_url( bp_get_root_blog_id(), $package_theme['admin_settings'] ) ), esc_attr( $package_theme['name'] ) ); ?></strong>
									</div>
								</div>

							<?php
							}

						endif;
					?>
				</div>

			</div><!-- .welcome-panel-column-container -->

		</div><!-- .welcome-panel -->