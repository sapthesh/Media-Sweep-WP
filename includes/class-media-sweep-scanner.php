<?php

if ( ! defined( 'WPINC' ) ) {
	die;
}

class Media_Sweep_Scanner {

	/**
	 * Handle AJAX scan request.
	 */
	public function ajax_scan() {
		check_ajax_referer( 'media-sweep-scan-nonce', 'nonce' );

		// Get all attachments
		$attachments = get_posts( array(
			'post_type'      => 'attachment',
			'posts_per_page' => -1,
			'post_status'    => 'any',
		) );

		$results = array();
		foreach ( $attachments as $attachment ) {
			$file_url = wp_get_attachment_url( $attachment->ID );
			$usage    = $this->find_usage( $file_url );
			$results[] = array(
				'id'    => $attachment->ID,
				'title' => get_the_title( $attachment->ID ),
				'url'   => $file_url,
				'usage' => $usage,
			);
		}

		require_once 'class-media-sweep-report-table.php';
		$report_table = new Media_Sweep_Report_Table();
		$report_table->prepare_items( $results );

		ob_start();
		$report_table->display();
		$table_html = ob_get_clean();

		wp_send_json_success( array( 'table' => $table_html ) );
	}

	/**
	 * Find where a media file is used.
	 */
	private function find_usage( $file_url ) {
		global $wpdb;

		$file_name = basename( $file_url );

		// Check in post content
		$post_content_count = $wpdb->get_var( $wpdb->prepare(
			"SELECT COUNT(*) FROM {$wpdb->posts} WHERE post_content LIKE %s AND post_type NOT IN ('attachment', 'revision')",
			'%' . $wpdb->esc_like( $file_name ) . '%'
		) );

		if ( $post_content_count > 0 ) {
			return __( 'Used in Post Content', 'media-sweep' );
		}

		// Check in post meta
		$post_meta_count = $wpdb->get_var( $wpdb->prepare(
			"SELECT COUNT(*) FROM {$wpdb->postmeta} WHERE meta_value LIKE %s",
			'%' . $wpdb->esc_like( $file_name ) . '%'
		) );

		if ( $post_meta_count > 0 ) {
			return __( 'Used in Custom Meta', 'media-sweep' );
		}

		// Check in options
		$options_count = $wpdb->get_var( $wpdb->prepare(
			"SELECT COUNT(*) FROM {$wpdb->options} WHERE option_value LIKE %s",
			'%' . $wpdb->esc_like( $file_name ) . '%'
		) );

		if ( $options_count > 0 ) {
			return __( 'Used in Options', 'media-sweep' );
		}
		
		// Note: A full theme file scan is resource-intensive and best handled in a more advanced version.
		
		return __( 'Potential Orphan', 'media-sweep' );
	}
}
