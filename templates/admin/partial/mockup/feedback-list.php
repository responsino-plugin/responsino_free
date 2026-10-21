<?php
/**
 * Static Responsino Pro feedback list preview.
 *
 * Demo only:
 * - no database access
 * - no real feedback data
 * - no functional actions
 */

if (!defined('ABSPATH')) {
	exit;
}

$responsinoMockFeedbacks = array(
	array( 120, 78, 'Overlay',         'Website Feedback',       '/blog/wordpress-feedback/',      'Unread',   '07.10.2026 17:08' ),
	array( 119, 77, 'Feedback Button', 'General Feedback',       '/products/',                     'Unread',   '07.10.2026 17:02' ),
	array( 118, 76, 'Shortcode',       'Article Feedback',       '/blog/wordpress-tips/',           'Read',     '07.10.2026 16:54' ),
	array( 117, 78, 'Overlay',         'Website Feedback',       '/pricing/',                      'Read',     '07.10.2026 16:41' ),
	array( 116, 75, 'Slide-In',        'Page Rating',            '/features/',                     'Unread',   '07.10.2026 15:32' ),
	array( 115, 77, 'Feedback Button', 'General Feedback',       '/contact/',                      'Archived', '07.10.2026 14:48' ),
	array( 114, 76, 'Shortcode',       'Article Feedback',       '/blog/create-forms/',             'Read',     '07.10.2026 13:27' ),
	array( 113, 74, 'Post-Content',    'Was this article helpful?', '/docs/getting-started/',       'Unread',   '07.10.2026 12:16' ),
	array( 112, 78, 'Overlay',         'Website Feedback',       '/about/',                        'Read',     '07.10.2026 11:43' ),
	array( 111, 75, 'Slide-In',        'Page Rating',            '/demo/',                         'Unread',   '07.10.2026 10:22' ),
	array( 110, 77, 'Feedback Button', 'General Feedback',       '/',                              'Read',     '06.10.2026 21:14' ),
	array( 109, 76, 'Shortcode',       'Article Feedback',       '/blog/customer-feedback/',       'Archived', '06.10.2026 19:47' ),
	array( 108, 74, 'Post-Content',    'Was this article helpful?', '/docs/form-builder/',          'Read',     '06.10.2026 18:31' ),
	array( 107, 78, 'Overlay',         'Website Feedback',       '/pricing/',                      'Unread',   '06.10.2026 17:09' ),
	array( 106, 75, 'Slide-In',        'Page Rating',            '/features/',                     'Read',     '06.10.2026 15:56' ),
	array( 105, 77, 'Feedback Button', 'General Feedback',       '/blog/',                         'Unread',   '06.10.2026 14:21' ),
	array( 104, 76, 'Shortcode',       'Article Feedback',       '/blog/user-feedback/',           'Read',     '06.10.2026 12:38' ),
	array( 103, 74, 'Pre-Content',     'Article Rating',         '/docs/installation/',            'Archived', '06.10.2026 11:14' ),
	array( 102, 78, 'Overlay',         'Website Feedback',       '/checkout/',                     'Unread',   '06.10.2026 10:03' ),
	array( 101, 77, 'Feedback Button', 'General Feedback',       '/support/',                      'Read',     '05.10.2026 18:42' ),
);
?>

<div class="responsino-pro-feedback-preview" aria-hidden="true">

	<div class="tablenav top">
		<div class="alignleft actions">

			<select disabled>
				<option><?php esc_html_e( 'Form', 'responsino' ); ?></option>
			</select>

			<select disabled>
				<option><?php esc_html_e( 'Display Type', 'responsino' ); ?></option>
			</select>

			<select disabled>
				<option><?php esc_html_e( 'Status', 'responsino' ); ?></option>
			</select>

			<select disabled>
				<option><?php esc_html_e( 'Date Range', 'responsino' ); ?></option>
			</select>

			<button type="button" class="button" disabled>
				<?php esc_html_e( 'Filter', 'responsino' ); ?>
			</button>

		</div>

		<div class="tablenav-pages one-page">
            <span class="displaying-num">
                <?php
				printf(
				/* translators: %d: Number of demo feedback entries. */
					esc_html__( '%d entries', 'responsino' ),
	                count( $responsinoMockFeedbacks )
				);
				?>
            </span>
		</div>

		<br class="clear">
	</div>

	<table class="wp-list-table widefat fixed striped table-view-list form_feedbacks">

		<thead>
			<tr>
				<th scope="col" class="manage-column column-id column-primary">
					<?php esc_html_e( 'ID', 'responsino' ); ?>
				</th>

				<th scope="col" class="manage-column column-form_id">
					<?php esc_html_e( 'Form ID', 'responsino' ); ?>
				</th>

				<th scope="col" class="manage-column column-form_type">
					<?php esc_html_e( 'Display Type', 'responsino' ); ?>
				</th>

				<th scope="col" class="manage-column column-form_name">
					<?php esc_html_e( 'Form Name', 'responsino' ); ?>
				</th>

				<th scope="col" class="manage-column column-page_url">
					<?php esc_html_e( 'Page URL', 'responsino' ); ?>
				</th>

				<th scope="col" class="manage-column column-status">
					<?php esc_html_e( 'Status', 'responsino' ); ?>
				</th>

				<th scope="col" class="manage-column column-created">
					<?php esc_html_e( 'Created', 'responsino' ); ?>
				</th>

				<th scope="col" class="manage-column column-updated">
					<?php esc_html_e( 'Updated', 'responsino' ); ?>
				</th>
			</tr>
		</thead>

		<tbody>
			<?php foreach ( $responsinoMockFeedbacks as $responsinoMockFeedback ) : ?>
				<?php
				list(
					$id,
					$responsinoFormId,
					$responsinoFormType,
					$responsinoFormName,
					$responsinoPageUrl,
					$responsinoStatus,
					$responsinoCreated
					) = $responsinoMockFeedback;

				$responsinoStatusClass = 'unread';

				if ( 'Read' === $responsinoStatus ) {
					$responsinoStatusClass = 'read';
				} elseif ( 'Archived' === $responsinoStatus ) {
					$responsinoStatusClass = 'archived';
				}
				?>

				<tr>
					<th
						class="id column-id column-primary"
						data-colname="<?php esc_attr_e( 'ID', 'responsino' ); ?>"
						scope="row"
					>
						<strong>
							#<?php echo esc_html( $id ); ?>
						</strong>

						<div class="row-actions">
                            <span class="view">
                                <?php esc_html_e( 'View', 'responsino' ); ?> |
                            </span>
							<span class="delete">
                                <?php esc_html_e( 'Delete', 'responsino' ); ?>
                            </span>
						</div>
					</th>

					<td
						class="form_id column-form_id"
						data-colname="<?php esc_attr_e( 'Form ID', 'responsino' ); ?>"
					>
						<?php echo esc_html( $responsinoFormId ); ?>
					</td>

					<td
						class="form_type column-form_type"
						data-colname="<?php esc_attr_e( 'Display Type', 'responsino' ); ?>"
					>
						<code style="font-size: 10px;">
							<?php echo esc_html( $responsinoFormType ); ?>
						</code>
					</td>

					<td
						class="form_name column-form_name"
						data-colname="<?php esc_attr_e( 'Form Name', 'responsino' ); ?>"
					>
						<?php echo esc_html( $responsinoFormName ); ?>
					</td>

					<td
						class="page_url column-page_url"
						data-colname="<?php esc_attr_e( 'Page URL', 'responsino' ); ?>"
					>
						<div
							class="responsino-text-muted"
							style="font-size:11px; max-width:250px; overflow:hidden; text-overflow:ellipsis; white-space:nowrap;"
						>
							<?php echo esc_html( $responsinoPageUrl ); ?>
						</div>
					</td>

					<td
						class="status column-status"
						data-colname="<?php esc_attr_e( 'Status', 'responsino' ); ?>"
					>
                        <span class="responsino-status-badge <?php echo esc_attr( $responsinoStatusClass ); ?>">
                            <?php echo esc_html( $responsinoStatus ); ?>
                        </span>
					</td>

					<td
						class="created column-created"
						data-colname="<?php esc_attr_e( 'Created', 'responsino' ); ?>"
					>
						<?php echo esc_html( $responsinoCreated ); ?>
					</td>

					<td
						class="updated column-updated"
						data-colname="<?php esc_attr_e( 'Updated', 'responsino' ); ?>"
					>
						<?php echo esc_html( $responsinoCreated ); ?>
					</td>
				</tr>

			<?php endforeach; ?>
		</tbody>

	</table>

	<div class="tablenav bottom">

		<div class="tablenav-pages one-page">

            <span class="displaying-num">
                <?php
				printf(
				/* translators: %d: Number of demo feedback entries. */
					esc_html__( '%d entries', 'responsino' ),
	                count( $responsinoMockFeedbacks )
				);
				?>
            </span>

			<span class="pagination-links">
                <span class="tablenav-pages-navspan button disabled">«</span>
                <span class="tablenav-pages-navspan button disabled">‹</span>

                <span class="paging-input">
                    <?php
					printf(
					/* translators: 1: Current page, 2: Total number of pages. */
						esc_html__( '%1$d of %2$d', 'responsino' ),
	                    1,
	                    1
					);
					?>
                </span>

                <span class="tablenav-pages-navspan button disabled">›</span>
                <span class="tablenav-pages-navspan button disabled">»</span>
            </span>

		</div>

		<br class="clear">
	</div>

</div>