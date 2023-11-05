<?php

if(!function_exists('ssl_zen_exclusive_option')) {
    function ssl_zen_exclusive_option()
    {
        ?>
        <div class="row ssl-zen-exclusive-container mb-4">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title m-0">
                            <img src="<?php echo esc_url(SSL_ZEN_URL); ?>img/info-circle-outlined.svg">
                            Exclusive "Done For You" Option (Limited Spots)
                            <div class="price premium">
                                <a class="primary" target="_blank" href="https://bit.ly/3jrsQt1">Select Plan</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        Looking for a 100% "Done For You" solution where one of our Professional Tech Experts installs the SSL certificate for you?
                    </div>
                </div>
            </div>
        </div>
        <?php
    }
}

if(!function_exists('ssl_zen_stackpath_pricing')) {
    /**
     * Function to show pricing plans for stackpath
     *
     * @since 2.0
     */
    function ssl_zen_stackpath_pricing()
    {
        ?>
        <form name="form-pricing" id="form-pricing" action="" method="post">
            <?php wp_nonce_field('ssl_zen_pricing', 'ssl_zen_pricing_nonce'); ?>
            <div class="ssl-zen-steps-container p-0 border-0">
                <div class="d-md-flex justify-content-between ssl-zen-pricing-header-banner mb-4">
                    <div>
                        <h1 class="mb-4">The complete SSL certificate <br>
                            solution for WordPress.</h1>
                        <p>Subscribe to our premium plan and <br>
                            save hundreds of dollars in SSL certificate
                            fees.</p>
                    </div>
                    <div></div>
                </div>
                <?php ssl_zen_exclusive_option(); ?>
                <div class="row ssl-zen-pricing-container ">
                    <div class="col-md-12">
                        <table class="table table-bordered table-responsive-lg">
                            <tbody>
                            <tr>
                                <td class="empty"></td>
                                <td class="amount premium">
                                    <div>
                                        <h3>Premium</h3>
                                        <span>$49</span>
                                        <span class="perioud">/ year</span>
                                    </div>
                                </td>
                                <td class="amount free">
                                    <div>
                                        <h3>Free</h3>
                                        <span class="d-block">$0</span>
                                    </div>
                                </td>
                            </tr>
                            <tr class="grey">
                                <td><?php _e('Content Delivery Network', 'ssl-zen') ?></td>
                                <td><?php _e('Automatic', 'ssl-zen') ?></td>
                                <td><?php _e('Manual', 'ssl-zen') ?></td>
                            </tr>
                            <tr>
                                <td><?php _e('SSL Certificate Installation', 'ssl-zen') ?></td>
                                <td><?php _e('Automatic', 'ssl-zen') ?></td>
                                <td><?php _e('Manual', 'ssl-zen') ?></td>
                            </tr>
                            <tr class="grey">
                                <td><?php _e('SSL Certificate Renewal', 'ssl-zen') ?></td>
                                <td><?php _e('Automatic Renewal', 'ssl-zen') ?></td>
                                <td>
                                    <div class="d-flex align-items-center pricing-notice">
                                        <?php _e('Manual', 'ssl-zen') ?>
                                        <span class="pricing-notice mt-1">( <?php _e('You have to renew your SSL certificate every 90 days', 'ssl-zen') ?>
                                            )</span>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td><?php _e('Website Security', 'ssl-zen') ?></td>
                                <td><?php _e('Yes', 'ssl-zen') ?></td>
                                <td><?php _e('No', 'ssl-zen') ?></td>
                            </tr>
                            <tr class="grey">
                                <td><?php _e('Support', 'ssl-zen') ?></td>
                                <td><?php _e('Priority Email Support', 'ssl-zen') ?></td>
                                <td><?php _e('Basic', 'ssl-zen') ?></td>
                            </tr>
                            <tr>
                                <td class="empty"></td>
                                <td class="price premium">
                                    <a href="<?php echo add_query_arg(array('checkout' => 'true', 'plan_id' => 10884, 'plan_name' => 'cdn', 'billing_cycle' => 'annual', 'pricing_id' => 11089, 'currency' => 'usd'), sz_fs()->get_upgrade_url()); ?>"
                                       class="primary"><?php _e('Select plan', 'ssl-zen') ?></a>
                                </td>
                                <td class="price free">
                                    <a href="#"
                                       class="primary"><?php _e('Select plan', 'ssl-zen') ?></a>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </form>
        <?php
    }
}

if(!function_exists('ssl_zen_cpanel_pricing')) {
    /**
     * Function to show pricing plans for cpanel
     *
     * @since 2.0
     */
    function ssl_zen_cpanel_pricing()
    {
        if (!SSLZenCPanel::detect_cpanel()) {
            stackpath_pricing();
            return;
        }
        ?>
        <form name="form-pricing" id="form-pricing" action="" method="post">
            <?php wp_nonce_field('ssl_zen_pricing', 'ssl_zen_pricing_nonce'); ?>
            <div class="ssl-zen-steps-container p-0 border-0">
                <div class="d-md-flex justify-content-between ssl-zen-pricing-header-banner mb-4">
                    <div>
                        <h1 class="mb-4">The complete SSL certificate <br>
                            solution for WordPress.</h1>
                        <p>Subscribe to our premium plan and <br>
                            save hundreds of dollars in SSL certificate
                            fees.</p>
                    </div>
                    <div></div>
                </div>
                <?php ssl_zen_exclusive_option(); ?>
                <div class="row ssl-zen-pricing-container ">
                    <div class="col-md-12">
                        <table class="table table-bordered table-responsive-lg">
                            <tbody>
                            <tr>
                                <td class="empty"></td>
                                <td class="amount premium">
                                    <div>
                                        <h3>Premium</h3>
                                        <span>$29</span>
                                        <span class="perioud">/ year</span>
                                    </div>
                                </td>
                                <td class="amount free">
                                    <div>
                                        <h3>Free</h3>
                                        <span class="d-block">$0</span>
                                    </div>
                                </td>
                            </tr>
                            <tr class="grey">
                                <td><?php _e('Verify Domain Ownership', 'ssl-zen') ?></td>
                                <td><?php _e('Automatic', 'ssl-zen') ?></td>
                                <td><?php _e('Manual', 'ssl-zen') ?></td>
                            </tr>
                            <tr>
                                <td><?php _e('SSL Certificate Installation', 'ssl-zen') ?></td>
                                <td><?php _e('Automatic', 'ssl-zen') ?></td>
                                <td><?php _e('Manual', 'ssl-zen') ?></td>
                            </tr>
                            <tr class="grey">
                                <td><?php _e('SSL Certificate Renewal', 'ssl-zen') ?></td>
                                <td><?php _e('Automatic Renewal', 'ssl-zen') ?></td>
                                <td>
                                    <div class="d-flex align-items-center pricing-notice">
                                        <?php _e('Manual', 'ssl-zen') ?>
                                        <span class="pricing-notice mt-1">( <?php _e('You have to renew your SSL certificate every 90 days', 'ssl-zen') ?>
                                            )</span>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td><?php _e('Support', 'ssl-zen') ?></td>
                                <td><?php _e('Priority Email Support', 'ssl-zen') ?></td>
                                <td><?php _e('Basic', 'ssl-zen') ?></td>
                            </tr>
                            <tr class="grey">
                                <td><?php _e('Time Required', 'ssl-zen') ?></td>
                                <td>60 <?php _e('seconds', 'ssl-zen') ?></td>
                                <td>60 <?php echo esc_html(__('minutes', 'ssl-zen') . '/' . __('year', 'ssl-zen')); ?></td>
                            </tr>
                            <tr>
                                <td class="empty"></td>
                                <td class="price premium">
                                    <a href="<?php echo add_query_arg(array('checkout' => 'true', 'plan_id' => 7397, 'plan_name' => 'pro', 'billing_cycle' => 'annual', 'pricing_id' => 7115, 'currency' => 'usd'), sz_fs()->get_upgrade_url()); ?>"
                                       class="primary"><?php _e('Select plan', 'ssl-zen') ?></a>
                                </td>
                                <td class="price free">
                                    <a href="#"
                                       class="primary"><?php _e('Select plan', 'ssl-zen') ?></a>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </form>
        <?php
    }
}

if(!function_exists('ssl_zen_pricing')) {
    /**
     * Method for choosing between pricing plans
     *
     * @since 3.2.5
     */
    function ssl_zen_pricing()
    {
        $show_cpanel_pricing = SSLZenCPanel::detect_cpanel();
        if ($show_cpanel_pricing) {
            ssl_zen_cpanel_pricing();
        } else {
            ssl_zen_stackpath_pricing();
        }
    }
}