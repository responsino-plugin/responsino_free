<?php
if (!defined('ABSPATH')) {
	exit;
}
?>

<section class="responsino-builder-view responsino-config-screen-layout" id="responsino-view-targeting" aria-label="<?php esc_attr_e('admin.builder.targeting.title', 'responsino'); ?>">

	<div class="responsino-builder-section-col">
		<!-- Header -->
		<div class="responsino-builder-section-header">
			<h3 class="responsino-builder-section-title"><i class="fas fa-bullseye"></i> <?php esc_html_e('admin.builder.targeting.header', 'responsino'); ?></h3>
		</div>

		<div class="responsino-builder-section">
			<div style="background-color: #f1f5f9; padding: 12px 16px; border-radius: 6px; font-size: 11.5px; color: var(--responsino-text-secondary); line-height: 1.45; margin-bottom: 20px;">
				<?php esc_html_e('admin.builder.targeting.description', 'responsino'); ?>
			</div>

			<!-- Segmented Display Type Sub-Tabs inside Targeting -->
			<div id="responsino-targeting-tabs-container" class="responsino-targeting-tabs" style="display: flex; gap: 8px; margin-bottom: 24px; border-bottom: 2px solid var(--responsino-border); padding-bottom: 12px; overflow-x: auto;">
				<!-- Dynamisch erzeugt basierend auf Hauptanzeigetyp -->
			</div>

			<!-- Targeting Inputs Form Container acting on current sub-tab -->
			<div id="responsino-targeting-condition-builder-container"></div>
		</div>
	</div>
</section>
