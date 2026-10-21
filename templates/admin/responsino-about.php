<?php
/**
 * About Responsino Page Template
 */
defined('ABSPATH') || die('No direct script access allowed!');
?>
<div id="poststuff">
    <div id="post-body" class="metabox-holder columns-2">
        <div id="postbox-container-1" class="postbox-container">
            <?php do_meta_boxes('responsino-about', 'side', null); ?>
        </div>
        <div id="postbox-container-2" class="postbox-container">
            <?php do_meta_boxes('responsino-about', 'normal', null); ?>
            <?php do_meta_boxes('responsino-about', 'advanced', null); ?>
        </div>
    </div>
    <br class="clear" />
</div>
