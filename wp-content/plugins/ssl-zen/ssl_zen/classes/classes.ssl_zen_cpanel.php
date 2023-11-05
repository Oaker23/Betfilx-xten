<?php

if(!class_exists('SSLZenCPanel')) {
    /**
     * Class to handle CPanel interactions & detection
     */
    class SSLZenCPanel {

        /**
         * Function to check the current site cPanel availability.
         *
         * @static
         * @since 3.2.5
         * @return bool
         */
        public static function detect_cpanel()
        {
            $stored_status = get_option('ssl_zen_cpanel_detected');
            if($stored_status !== false) {
                return $stored_status == 'enabled';
            }
            $host = ssl_zen_helper::get_host();

            // Add local check functions if it isn't stored
            if(!function_exists('array_every')) {
                function array_every(callable $callback, array $arr)
                {
                    foreach ($arr as $element) {
                        if (!$callback($element)) {
                            return FALSE;
                        }
                    }
                    return TRUE;
                }
            }

            // Check if the value is true or not
            if(!function_exists('is_true')) {
                function is_true($value)
                {
                    return !!$value;
                }
            }

            $status = false;
            $response = [
                'status' => $status,
                'responses' => [],
                'data' => []
            ];
            try {
                // Special cPanel check
                $path = explode('/', $_SERVER['DOCUMENT_ROOT']);
                $cpanel_directory = sprintf('/%s/%s/.cpanel', $path[1], $path[2]);
                $status = is_dir($cpanel_directory);
            } catch(\Exception $e) {}

            // Fallback check
            if(!$status) {
                // Try different cPanel endpoints, which should be accessible
                if($host) {
                    // Check the SSL variant of cpanel dashboard
                    $urls = [
                        "https://$host:2083",
                        "http://$host:2082",
                        // This may result in false-positives, if the website redirects back to a 200 Ok page
                        "http://$host/cpanel"
                    ];
                    $statuses = [];
                    $responses = [];
                    foreach ($urls as $url) {
                        try {
                            $remote_response = wp_remote_get($url, [
                                'headers' => [
                                    'Connection' => 'close'
                                ],
                                'sslverify' => false
                            ]);
                            $responses[] = $remote_response;
                            if (is_wp_error($remote_response) || $remote_response['response']['code'] > 200) {
                                $statuses[] = false;
                            } else {
                                $statuses[] = true;
                            }
                        } catch(\Exception $e) {
                            $statuses[] = false;
                        }
                    }
                    // Check all statuses
                    $response['status'] = array_every('is_true', $statuses);
                    $response['data'] = $statuses;
                    $response['responses'] = $responses;
                }
                $status = $response['status'];
            }

            // Check if the site is on Hostgator
            $has_ns_records = checkdnsrr($host, 'NS');
            if($has_ns_records) {
                $records = dns_get_record($host, DNS_NS);
                $is_nameserver_hostgator = array_every(function ($record) {
                    return stripos($record['target'], '.hostgator.') !== false;
                }, $records);
                // If the website is on Hostgator, we didn't detect cpanel
                if($is_nameserver_hostgator) {
                    $status = false;
                }
            }

            // Update cpanel detected status
            update_option('ssl_zen_cpanel_detected', $status ? 'enabled' : 'disabled');
            return $status;
        }
    }
}