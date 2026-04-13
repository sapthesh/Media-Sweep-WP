<?php

if ( ! class_exists( 'WP_List_Table' ) ) {
	require_once ABSPATH . 'wp-admin/includes/class-wp-list-table.php';
}

class Media_Sweep_Report_Table extends WP_List_Table {

	public function __construct() {
		parent::__construct( array(
			'singular' => __( 'Media File', 'media-sweep' ),
			'plural'   => __( 'Media Files', 'media-sweep' ),
			'ajax'     => false,
		) );
	}

	public function prepare_items( $data = array() ) {
		$this->_column_headers = array( $this->get_columns(), array(), $this->get_sortable_columns() );
		$this->items = $data;
	}

	public function get_columns() {
		return array(
			'cb'    => '<input type="checkbox" />',
			'title' => __( 'File', 'media-sweep' ),
			'usage' => __( 'Usage Category', 'media-sweep' ),
		);
	}

	public function column_default( $item, $column_name ) {
		switch ( $column_name ) {
			case 'usage':
				return esc_html( $item[ $column_name ] );
			default:
				return print_r( $item, true );
		}
	}

	public function column_cb( $item ) {
		return sprintf(
			'<input type="checkbox" name="bulk-delete[]" value="%s" />', $item['id']
		);
	}

	public function column_title( $item ) {
		$title = '<strong><a href="' . esc_url( get_edit_post_link( $item['id'] ) ) . '">' . esc_html( $item['title'] ) . '</a></strong>';
		$title .= '<br><small>' . esc_html( $item['url'] ) . '</small>';
		return $title;
	}
}
