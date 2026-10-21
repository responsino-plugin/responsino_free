<?php
if (!defined('ABSPATH')) {
	exit;
}

$responsinoFinalProNoticeHeadline = (!empty($responsinoProNoticeHeadline) ? $responsinoProNoticeHeadline : __('admin.builder.pro.headline', 'responsino'));
$responsinoFinalProNoticeIntro = (!empty($responsinoProNoticeIntro) ? $responsinoProNoticeIntro : __('admin.builder.pro.intro', 'responsino'));
$responsinoFinalProNoticeAdvantages = $responsinoProNoticeAdvantages ?? [
	esc_html__('admin.builder.pro.advantage.1', 'responsino'),
	esc_html__('admin.builder.pro.advantage.2', 'responsino'),
	esc_html__('admin.builder.pro.advantage.3', 'responsino')
];

?>

<!-- PRO / Freemius Upgrade Modal -->
<div id="responsino-modal-pro-upgrade" class="responsino-form-builder responsino-modal-overlay responsino-modal-overlay-active" role="dialog" aria-modal="true" aria-labelledby="responsino-pro-title">
	<div class="responsino-modal-box" style="max-width: 500px;">
		<div class="responsino-modal-header" style="background-color: var(--responsino-primary-light); border-bottom: 1px solid var(--responsino-border); padding: 16px 24px; border-top-left-radius: 12px; border-top-right-radius: 12px;">
			<h3 class="responsino-modal-title" id="responsino-pro-title" style="color: var(--responsino-primary); font-weight: 700;">
				<i class="fas fa-crown" style="color: var(--responsino-warning);"></i> <?php esc_html_e('admin.builder.pro.title', 'responsino'); ?>
			</h3>
		</div>
		<div class="responsino-modal-body" style="padding: 24px;">
			<div style="text-align: center; margin-bottom: 24px;">
				<div style="font-size: 48px; margin-bottom: 12px; color: var(--responsino-warning);">
					<i class="fas fa-gem"></i>
				</div>
				<h4 style="font-size: 18px; font-weight: 700; color: var(--responsino-text); margin-bottom: 8px;"><?php echo esc_html($responsinoFinalProNoticeHeadline) ?></h4>
				<p style="color: var(--responsino-text-secondary); font-size: 13.5px; line-height: 1.5; margin: 0;">
					<?php echo wp_kses($responsinoFinalProNoticeIntro, ['strong' => []]) ?>
				</p>
			</div>

			<div style="background-color: var(--responsino-bg); border: 1px solid var(--responsino-border); border-radius: 8px; padding: 16px; margin-bottom: 4px;">
				<h5 style="font-weight: 700; font-size: 13px; color: var(--responsino-text); margin-bottom: 12px; margin-top: 0; text-transform: uppercase; letter-spacing: 0.05em;"><?php esc_html_e('admin.builder.pro.advantages_title', 'responsino'); ?></h5>
				<ul style="list-style: none; display: flex; flex-direction: column; gap: 10px; font-size: 13px; padding-left: 0; margin: 0;">
					<?php foreach ($responsinoFinalProNoticeAdvantages as $responsinoProAdvantage) : ?>
						<li style="display: flex; align-items: flex-start; gap: 8px; color: var(--responsino-text);">
							<i class="fas fa-check-circle" style="color: var(--responsino-success); margin-top: 2px;"></i>
							<span><?php echo esc_html($responsinoProAdvantage) ?></span>
						</li>
					<?php endforeach; ?>
				</ul>
			</div>
		</div>
		<div class="responsino-modal-footer" style="padding: 16px 24px; border-top: 1px solid var(--responsino-border); display: flex; justify-content: center; gap: 12px; background-color: var(--responsino-bg); border-bottom-left-radius: 12px; border-bottom-right-radius: 12px;">
			<a href="<?php echo esc_url('https://responsino.de') ?>" target="_blank" class="responsino-btn" id="responsino-btn-pro-upgrade-cta" style="background-color: var(--responsino-primary); color: white; font-weight: 600; padding: 8px 20px; border-radius: 6px; text-decoration: none; display: inline-flex; align-items: center; gap: 8px; border: 1px solid var(--responsino-primary); box-shadow: var(--responsino-shadow-md); transition: all 0.2s; height: auto;">
				<i class="fas fa-shopping-cart"></i> <?php esc_html_e('admin.builder.pro.cta_text', 'responsino'); ?>
			</a>
		</div>
	</div>
</div>