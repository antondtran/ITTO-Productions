<?php

namespace Hostinger\EasyOnboarding\Admin\Onboarding\Steps;

defined( 'ABSPATH' ) || exit;

class AddLogo extends OnboardingStep {
	public function get_title(): string {
		return __( 'Upload your logo', 'hostinger-easy-onboarding' );
	}

	public function get_body(): array {
		return array(
			array(
				'title'       => __( 'Create a logo', 'hostinger-easy-onboarding' ),
				'description' => __( 'Adding a logo is a great way to personalize a website or add branding information. You can use your existing logo or create a new one using the <a href="https://logo.hostinger.com/?ref=wordpress-onboarding" target="_blank">AI Logo Maker</a>.', 'hostinger-easy-onboarding' ),
			),
			array(
				'title'       => __( 'Go to the Customize page', 'hostinger-easy-onboarding' ),
				'description' => __( 'In the left sidebar, click Appearance to expand the menu. In the Appearance section, click Customize. The Customize page will open. ', 'hostinger-easy-onboarding' ),
			),
			array(
				'title'       => __( 'Upload your logo', 'hostinger-easy-onboarding' ),
				'description' => __( 'In the left sidebar, click Site Identity, then click on the Select Site Icon button. Here, you can upload your brand logo. ', 'hostinger-easy-onboarding' ),
			),
		);
	}

	public function step_identifier(): string {
		return 'logo_upload';
	}

	public function get_redirect_link(): string {
		return admin_url( 'customize.php' );
	}

	public function button_text(): string {
		return __( 'Take me there', 'hostinger-easy-onboarding' );
	}
}
