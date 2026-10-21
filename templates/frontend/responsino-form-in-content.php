<?php
/**
 * Template for Form Shortcode
 */
if (!defined('ABSPATH')) exit;

$responsinoStyleAttribute = '';
if (!empty($inlineStyles)) {
	$responsinoStyleAttribute = implode('; ', $inlineStyles);
}

$responsinoWrapperClasses = ['responsino-feedback-plugin', 'responsino-feedback-type-placeholder', 'responsino-in-content-feedback-container', esc_attr('responsino-form-id-' . $formData['id'])];
if (!empty($customClasses)) :
	$responsinoWrapperClasses[] = esc_attr($customClasses);
endif;
?>
<div class="<?php echo esc_html(implode(' ', $responsinoWrapperClasses)) ?>" <?php echo !empty($responsinoStyleAttribute) ? 'style="' . esc_attr($responsinoStyleAttribute) . '"' : ''; ?> data-type="<?php echo esc_attr($formType) ?>" data-form-id="<?php echo esc_attr($formData['id']) ?>" data-form-updated="<?php echo esc_attr($formUpdated) ?>"></div>