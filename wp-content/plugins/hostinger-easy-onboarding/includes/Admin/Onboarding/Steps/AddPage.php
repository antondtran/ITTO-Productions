<?php

namespace Hostinger\EasyOnboarding\Admin\Onboarding\Steps;

use Hostinger\EasyOnboarding\Settings;

defined( 'ABSPATH' ) || exit;

class AddPage extends OnboardingStep {
	public function get_title(): string {
		$website_type = Settings::get_setting( 'survey.website.type' );

		switch ( $website_type ) {
			case Settings::WEBSITE_TYPE_BUSINESS:
				return __( 'Create a page describing your services', 'hostinger-easy-onboarding' );
			case Settings::WEBSITE_TYPE_PORTFOLIO:
				return __( 'Upload your portfolio projects', 'hostinger-easy-onboarding' );
			default:
				return __( 'Add a new page', 'hostinger-easy-onboarding' );
		}
	}

	public function get_body(): array {
		$website_type = Settings::get_setting( 'survey.website.type' );

		switch ( $website_type ) {
			case Settings::WEBSITE_TYPE_BUSINESS:
				return array(
					array(
						'title'       => __( 'Give a page a short title such as “Our Services”', 'hostinger-easy-onboarding' ),
						'description' => __( 'Come up with a clear and concise name for the page that accurately reflects the services you provide.', 'hostinger-easy-onboarding' ),
					),
					array(
						'title'       => __( 'Add the content and images that represent your services', 'hostinger-easy-onboarding' ),
						'description' => __( 'Write a brief introduction to your business, provide an overview of your services with descriptions and benefits, and use relevant images to support your content. Keep it simple and straightforward.', 'hostinger-easy-onboarding' ),
					),
					array(
						'title'       => __( 'Finalize the page', 'hostinger-easy-onboarding' ),
						'description' => __( 'Make the page easy to read and navigate by using headings and bullet points. Include a clear call-to-action (CTA) to encourage visitors to take the next step for example, to contact you via email or contact form.', 'hostinger-easy-onboarding' ),
					),
				);
			case Settings::WEBSITE_TYPE_PORTFOLIO:
				return array(
					array(
						'title'       => __( 'Create a new page called “My projects”', 'hostinger-easy-onboarding' ),
						'description' => __( 'Give your page a name (e.g. "My Portfolio"), then click the "+" button in the editor to add a new block.', 'hostinger-easy-onboarding' ),
					),
					array(
						'title'       => __( 'Add a gallery block', 'hostinger-easy-onboarding' ),
						'description' => __( 'In the block menu, search for "Gallery" and select the Gallery block. Upload the images you want to showcase in your portfolio, then adjust the layout and add captions if needed.', 'hostinger-easy-onboarding' ),
					),
					array(
						'title'       => __( 'Publish your page', 'hostinger-easy-onboarding' ),
						'description' => __( 'Once you\'re happy with your portfolio post, click the "Publish" button to make it live on your website. You can add a link to your main navigation menu or other relevant posts to make it easy for visitors to find.', 'hostinger-easy-onboarding' ),
					),
				);
			default:
				return array(
					array(
						'title'       => __( 'Add a new page', 'hostinger-easy-onboarding' ),
						'description' => __( 'In the left sidebar, find the Pages menu and click on Add New button. You will see the WordPress page editor. Each paragraph, image, or video in the WordPress editor is presented as a “block” of content.', 'hostinger-easy-onboarding' ),
					),
					array(
						'title'       => __( 'Add a title', 'hostinger-easy-onboarding' ),
						'description' => __( 'Add the title of the page, for example, About. Click the Add Title text to open the text box where you will add your title. The title of your page should be descriptive of the information the page will have.', 'hostinger-easy-onboarding' ),
					),
					array(
						'title'       => __( 'Add content', 'hostinger-easy-onboarding' ),
						'description' => __( 'Content can be anything you wish, for example, text, images, videos, tables, and lots more. Click on a plus sign and choose any block you want to add to the page.', 'hostinger-easy-onboarding' ),
					),
					array(
						'title'       => __( 'Publish the page', 'hostinger-easy-onboarding' ),
						'description' => __( 'Before publishing, you can preview your created page by clicking on the Preview button. If you are happy with the result, click the Publish button.', 'hostinger-easy-onboarding' ),
					),
				);
		}
	}

	public function step_identifier(): string {
		return 'add_page';
	}

	public function get_redirect_link(): string {
		return admin_url( 'post-new.php?post_type=page' );
	}

	public function button_text(): string {
		return __( 'Take me there', 'hostinger-easy-onboarding' );
	}
}
