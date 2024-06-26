<?php

namespace Hostinger\EasyOnboarding\Admin\Onboarding;

use Hostinger\EasyOnboarding\Helper;
use Hostinger\EasyOnboarding\Settings;
use Hostinger\EasyOnboarding\Admin\Actions as Admin_Actions;
use WP_Post;

defined( 'ABSPATH' ) || exit;

class AutocompleteSteps {
	private array $completed_steps;
	private Helper $helper;

	public function __construct() {
		$this->helper          = new Helper();
		$this->completed_steps = get_option( 'hostinger_onboarding_steps', array() );
		add_action( 'customize_save', array( $this, 'logo_upload' ) );
		add_action( 'wp_handle_upload', array( $this, 'image_upload' ) );
		add_action( 'post_updated', array( $this, 'post_content_change' ), 10, 3 );
		add_action( 'customize_save', array( $this, 'edit_site_title' ) );
		add_action( 'publish_page', array( $this, 'new_page_creation' ), 10, 3 );
		add_action( 'publish_product', array( $this, 'new_product_creation' ), 10, 3 );
		add_action( 'publish_post', array( $this, 'new_post_creation' ), 10, 3 );
		add_action( 'updated_option', array( $this, 'check_option_change' ), 10, 3 );

		if ( $this->helper->is_hostinger_admin_page() ) {
			add_action( 'admin_init', array( $this, 'domain_is_connected' ) );
		}
	}

	private function add_completed_step( string $action ): void {
		$this->completed_steps[] = array(
			'action' => $action,
			'date'   => gmdate( 'Y-m-d H:i:s' ),
		);
	}

	private function is_step_completed( array $completed_steps, string $step_name ): array {
		$step_completed = array_filter(
			$completed_steps,
			function ( $item ) use ( $step_name ) {
				return isset( $item['action'] ) && $item['action'] === $step_name;
			}
		);

		return $step_completed;
	}

	public function domain_is_connected(): void {
		$action = Admin_Actions::DOMAIN_IS_CONNECTED;

		if ( $this->is_step_completed( $this->completed_steps, $action ) ) {
			return;
		}

		if ( ! $this->helper->is_free_subdomain() && ! $this->helper->is_preview_domain() ) {
			if ( ! did_action( 'hostinger_domain_connected' ) ) {
				$this->add_completed_step( $action );
				Settings::update_setting( 'onboarding_steps', $this->completed_steps );
				do_action( 'hostinger_domain_connected' );
			}
		}
	}

	public function logo_upload( \WP_Customize_Manager $data ): void {
		$action = Admin_Actions::LOGO_UPLOAD;

		$logo_updated = array_filter(
			$data->changeset_data(),
			function ( $key ) {
				return strpos( $key, 'custom_logo' ) !== false;
			},
			ARRAY_FILTER_USE_KEY
		);

		$has_logo     = reset( $logo_updated )['value'] ?? false;
		$cookie_value = isset( $_COOKIE[ $action ] ) ? sanitize_text_field( wp_unslash( $_COOKIE[ $action ] ) ) : '';

		if ( $this->is_step_completed( $this->completed_steps, $action ) || $logo_updated && ! $has_logo ) {
			return;
		}

		if ( $logo_updated && $cookie_value === $action ) {
			$this->add_completed_step( $action );
			Settings::update_setting( 'onboarding_steps', $this->completed_steps );
		}
	}

	public function image_upload( array $data ): array {
		$action       = Admin_Actions::IMAGE_UPLOAD;
		$file_type    = $data['type'] ?? '';
		$cookie_value = isset( $_COOKIE[ $action ] ) ? sanitize_text_field( wp_unslash( $_COOKIE[ $action ] ) ) : '';

		if ( $this->is_step_completed( $this->completed_steps, $action ) || strpos( $file_type, 'image' ) !== 0 ) {
			return $data;
		}

		if ( $cookie_value === $action ) {
			$this->add_completed_step( $action );
			Settings::update_setting( 'onboarding_steps', $this->completed_steps );
		}

		return $data;
	}

	public function post_content_change( int $post_id, WP_Post $post_after, WP_Post $post_before ) {
		$action         = Admin_Actions::EDIT_DESCRIPTION;
		$post_date      = get_the_date( 'Y-m-d H:i:s', $post_id );
		$modified_date  = get_the_modified_date( 'Y-m-d H:i:s', $post_id );
		$post_type      = get_post_type( $post_id );
		$cookie_value   = isset( $_COOKIE[ $action ] ) ? sanitize_text_field( wp_unslash( $_COOKIE[ $action ] ) ) : '';
		$content_before = $post_before->post_content;
		$content_after  = $post_after->post_content;

		if ( $this->is_step_completed( $this->completed_steps, $action ) || $post_date === $modified_date ) {
			return;
		}

		if ( wp_is_post_revision( $post_id ) || wp_is_post_autosave( $post_id ) ) {
			return;
		}

		if ( $post_type === 'post' && $content_before !== $content_after && $cookie_value === $action ) {
			$this->add_completed_step( $action );
			Settings::update_setting( 'onboarding_steps', $this->completed_steps );
		}
	}

	public function edit_site_title( \WP_Customize_Manager $data ): void {
		$action        = Admin_Actions::EDIT_SITE_TITLE;
		$changed_title = $data->changeset_data()['blogname']['value'] ?? '';
		$cookie_value  = isset( $_COOKIE[ $action ] ) ? sanitize_text_field( wp_unslash( $_COOKIE[ $action ] ) ) : '';

		if ( $this->is_step_completed( $this->completed_steps, $action ) ) {
			return;
		}

		if ( $cookie_value === $action && $changed_title !== '' && get_bloginfo( 'name' ) !== $changed_title ) {
			$this->add_completed_step( $action );
			Settings::update_setting( 'onboarding_steps', $this->completed_steps );
		}
	}

	public function new_post_item_creation( int $post_id, bool $update, string $action ): void {
		$cookie_value = isset( $_COOKIE[ $action ] ) ? sanitize_text_field( wp_unslash( $_COOKIE[ $action ] ) ) : '';

		if ( $this->is_step_completed( $this->completed_steps, $action ) || wp_is_post_revision( $post_id ) || wp_is_post_autosave( $post_id ) ) {
			return;
		}

		if ( $update && $cookie_value === $action ) {
			$this->add_completed_step( $action );
			Settings::update_setting( 'onboarding_steps', $this->completed_steps );
		}
	}

	public function new_page_creation( int $post_id, WP_Post $post, bool $update ): void {
		$this->new_post_item_creation( $post_id, $update, Admin_Actions::ADD_PAGE );
	}

	public function new_product_creation( int $post_id, WP_Post $post, bool $update ): void {
		$this->new_post_item_creation( $post_id, $update, Admin_Actions::ADD_PRODUCT );
	}

	public function new_post_creation( int $post_id, WP_Post $post, bool $update ): void {
		$this->new_post_item_creation( $post_id, $update, Admin_Actions::ADD_POST );
	}

	public function check_option_change( string $option_name, $old_value, $new_value ): void {
		$action       = Admin_Actions::EDIT_SITE_TITLE;
		$cookie_value = isset( $_COOKIE[ $action ] ) ? sanitize_text_field( wp_unslash( $_COOKIE[ $action ] ) ) : '';

		if ( $this->is_step_completed( $this->completed_steps, $action ) ) {
			return;
		}

		if ( $cookie_value === $action && $new_value !== '' && $option_name === Settings::SITE_TITLE_OPTION && $old_value !== $new_value ) {
			$this->add_completed_step( $action );
			Settings::update_setting( 'onboarding_steps', $this->completed_steps );
		}
	}
}
