<?php

if ( ! defined( 'WPINC' ) ) {
	die;
}

class Media_Sweep_Admin {

	/**
	 * Add plugin page to the admin menu.
	 */
	public function add_plugin_page() {
		add_media_page(
			__( 'Media Sweep', 'media-sweep' ),
			__( 'Media Sweep', 'media-sweep' ),
			'manage_options',
			'media-sweep',
			array( $this, 'create_admin_page' )
		);
	}

	/**
	 * Create the admin page.
	 */
	public function create_admin_page() {
		?>
		<div class="wrap">
			<h1><?php echo esc_html__( 'Media Sweep', 'media-sweep' ); ?></h1>
			<p><?php echo esc_html__( 'This tool scans your WordPress installation to find media files that may be orphaned.', 'media-sweep' ); ?></p>

			<div id="media-sweep-scan-controls">
				<button id="media-sweep-start-scan" class="button button-primary"><?php echo esc_html__( 'Start Scan', 'media-sweep' ); ?></button>
				<div id="media-sweep-scan-progress" style="display:none;">
					<p><?php echo esc_html__( 'Scanning...', 'media-sweep' ); ?></p>
					<div class="spinner is-active" style="float:none;"></div>
				</div>
			</div>

			<div id="media-sweep-scan-results">
				<!-- Results will be loaded here via AJAX -->
			</div>
		</div>
		<?php
	}

	/**
	 * Enqueue scripts and styles.
	 */
	public function enqueue_scripts( $hook ) {
		if ( 'media_page_media-sweep' !== $hook ) {
			return;
		}

		wp_enqueue_style( 'media-sweep-admin-css', plugin_dir_url( __FILE__ ) . '../assets/css/admin.css', array(), MEDIA_SWEEP_VERSION );
		wp_enqueue_script( 'media-sweep-admin-js', plugin_dir_url( __FILE__ ) . '../assets/js/admin.js', array( 'jquery' ), MEDIA_SWEEP_VERSION, true );
		wp_localize_script( 'media-sweep-admin-js', 'media_sweep_ajax', array(
			'ajax_url' => admin_url( 'admin-ajax.php' ),
			'nonce'    => wp_create_nonce( 'media-sweep-scan-nonce' ),
		) );
	}
}
