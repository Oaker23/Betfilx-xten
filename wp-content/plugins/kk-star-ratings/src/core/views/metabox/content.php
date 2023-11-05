<?php
    if (! defined('KK_STAR_RATINGS')) {
        http_response_code(404);
        exit();
    }

    $reset = $get('reset');
    $status = $get('status_default');
?>

<div class="components-base-control__field">
    <div style="margin-top: 1rem;">
        <label class="components-base-control__label" style="margin-top: .5rem; margin-bottom: .25rem;">
            <input type="checkbox" name="<?php echo esc_attr($reset[0]); ?>" value="1" <?php echo checked($reset[1], '1', false); ?>>
            <?php echo esc_html_x('Reset Ratings', 'label', 'kk-star-ratings'); ?>
        </label>
    </div>
</div>

<div class="components-base-control__field" style="margin-top: 1rem">
    <label class="components-base-control__label" style="margin-top: .75rem; margin-bottom: .25rem;">
        <strong><?php echo esc_html_x('Auto Embed', 'label', 'kk-star-ratings'); ?></strong>
    </label>

    <div style="margin-top: 1rem;">
        <label class="components-base-control__label" style="margin-top: .5rem; margin-bottom: .25rem;">
            <input type="radio" name="<?php echo esc_attr($status[0]); ?>" value="" <?php echo checked($status[1], '', false); ?>>
            <?php echo esc_html_x('Global', 'label', 'kk-star-ratings'); ?>
        </label>
        <label class="components-base-control__label" style="margin-top: .5rem; margin-bottom: .25rem; margin-left: .5rem;">
            <input type="radio" name="<?php echo esc_attr($status[0]); ?>" value="enable" <?php echo checked($status[1], 'enable', false); ?>>
            <?php echo esc_html_x('Enable', 'label', 'kk-star-ratings'); ?>
        </label>
        <label class="components-base-control__label" style="margin-top: .5rem; margin-bottom: .25rem; margin-left: .5rem;">
            <input type="radio" name="<?php echo esc_attr($status[0]); ?>" value="disable" <?php echo checked($status[1], 'disable', false); ?>>
            <?php echo esc_html_x('Disable', 'label', 'kk-star-ratings'); ?>
        </label>
    </div>
</div>
