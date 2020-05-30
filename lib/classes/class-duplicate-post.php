<?php

if( !defined( 'ABSPATH' ) ): exit(); endif;

if( !class_exists( 'TDC_Duplicate_Post' ) ):

	class TDC_Duplicate_Post {

		function __construct() {
			add_filter( 'postmeta_form_keys', [ $this, 'postmeta_form_keys' ], 10, 2 );
			add_action( 'admin_action_duplicate_post_as_draft', [ $this, 'duplicate_post_as_draft' ] );
			add_filter( 'post_row_actions', [ $this, 'duplicate_post_link' ], 10, 2 );
			add_filter( 'page_row_actions', [ $this, 'duplicate_post_link' ], 10, 2 );
		}

		/**
		 * @param array|null $keys
		 * @param WP_Post $post
		 *
		 * @return array|null
		 */
		function postmeta_form_keys( $keys, $post ) {

			return [];

		}

		/*
		 * Function for post/page duplication. Dups appear as drafts. User is redirected to the edit screen
		 */
		function duplicate_post_as_draft(){
			global $wpdb;
			if (! ( isset( $_GET['post']) || isset( $_POST['post'])  || ( isset($_REQUEST['action']) && 'duplicate_post_as_draft' == $_REQUEST['action'] ) ) ) {
				wp_die('No post to duplicate has been supplied!');
			}

			/*
			 * Nonce verification
			 */
			if ( !isset( $_GET['duplicate_nonce'] ) || !wp_verify_nonce( $_GET['duplicate_nonce'], basename( __FILE__ ) ) )
				return;

			/*
			 * get the original post/page id
			 */
			$post_id = (isset($_GET['post']) ? absint( $_GET['post'] ) : absint( $_POST['post'] ) );
			/*
			 * and all the original post/page data then
			 */
			$post = get_post( $post_id );

			/*
			 * set the current user as the new post/page author
			 * if you don't want current user to be the new post author,
			 * then change next couple of lines to this: $new_post_author = $post->post_author;
			 */
			$current_user = wp_get_current_user();
			$new_post_author = $current_user->ID;

			/*
			 * if post/page data exists, create the post/page duplicate
			 */
			if (isset( $post ) && $post != null):

				/*
				 * new post/page data array
				 */
				$args = array(
					'comment_status' => $post->comment_status,
					'ping_status'    => $post->ping_status,
					'post_author'    => $new_post_author,
					'post_content'   => $post->post_content,
					'post_excerpt'   => $post->post_excerpt,
					'post_name'      => $post->post_name,
					'post_parent'    => $post->post_parent,
					'post_password'  => $post->post_password,
					'post_status'    => 'draft',
					'post_title'     => $post->post_title . ' Clone',
					'post_type'      => $post->post_type,
					'to_ping'        => $post->to_ping,
					'menu_order'     => $post->menu_order
				);

				/*
				 * insert the post/page by wp_insert_post() function
				 */
				$new_post_id = wp_insert_post( $args );

				/*
				 * get all current post/page terms ad set them to the new post draft
				 */
				$taxonomies = get_object_taxonomies($post->post_type); // returns array of taxonomy names for post/page type, ex array("category", "post_tag");
				foreach ($taxonomies as $taxonomy):
					$post_terms = wp_get_object_terms($post_id, $taxonomy, array('fields' => 'slugs'));
					wp_set_object_terms($new_post_id, $post_terms, $taxonomy, false);
				endforeach;

				/*
				 * duplicate all post/page meta just in two SQL queries
				 */
				$post_meta_infos = $wpdb->get_results("SELECT meta_key, meta_value FROM $wpdb->postmeta WHERE post_id=$post_id");
				if (count($post_meta_infos)!=0):
					$sql_query = "INSERT INTO $wpdb->postmeta (post_id, meta_key, meta_value) ";
					foreach ($post_meta_infos as $meta_info):
						$meta_key = $meta_info->meta_key;
						if( $meta_key == '_wp_old_slug' ) continue;
						$meta_value = addslashes($meta_info->meta_value);
						$sql_query_sel[]= "SELECT $new_post_id, '$meta_key', '$meta_value'";
					endforeach;
					$sql_query .= implode(" UNION ALL ", $sql_query_sel);
					$wpdb->query($sql_query);
				endif;


				/*
				 * finally, redirect to the edit post/page screen for the new draft
				 */
				wp_redirect( admin_url( 'post.php?action=edit&post=' . $new_post_id ) );
				exit;
			else:
				wp_die('Post creation failed, could not find original post: ' . $post_id);
			endif;
		}

		/*
		 * Add the duplicate link to action list for post_row_actions & page_row_actions
		 *
		 * @param array|null $actions
		 * @param WP_Post $post
		 *
		 * @return array|null duplicate post link
		 */
		function duplicate_post_link( $actions, $post ) {
			$actions['duplicate'] = '<a href="' . wp_nonce_url('admin.php?action=duplicate_post_as_draft&post=' . $post->ID, basename(__FILE__), 'duplicate_nonce' ) . '" title="Duplicate this item" rel="permalink">Duplicate</a>';
			return $actions;
		}

	}

	new TDC_Duplicate_Post();

endif;
