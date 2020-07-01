<?php

if( !defined( 'ABSPATH' ) ): exit(); endif;

if( !class_exists( 'TDC_Reusable_Blocks_Menu' ) ):

	class TDC_Reusable_Blocks_Menu {

		function __construct() {
			add_action( 'admin_menu', [ $this, 'add_reusable_blocks_menu' ] );
		}

		/**
		 * Register reusable blocks menu.
		 */
		public function add_reusable_blocks_menu() {
			add_menu_page(
				__( 'Reusable Blocks', 'hfw' ),
				'Reusable Blocks',
				'edit_posts',
				'edit.php?post_type=wp_block',
				'',
				'data:image/svg+xml;base64,'.base64_encode('<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20"><path fill="black" d="M5 7v3l-2 1.5V5h11V3l4 3.01L14 9V7H5zm10 6v-3l2-1.5V15H6v2l-4-3.01L6 11v2h9z"></path></svg>'),
				80
			);
		}

	}

	new TDC_Reusable_Blocks_Menu();

endif;



