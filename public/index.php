<?php
/**
 * Inline Games - Telegram Bot (@inlinexgamesbot)
 *
 * (c) 2016-2022 Jack'lul <skybotsdeveloper@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Bot\BotCore;

/**
 * Handle webhook request only when it's a POST request
 */
error_reporting(E_ALL & ~E_DEPRECATED & ~E_USER_DEPRECATED);
ini_set('display_errors', '0');

if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once __DIR__ . '/../vendor/autoload.php';

    try {
        $app = new BotCore();
        $app->run(true);
    } catch (\Throwable $e) {
        // Prevent Telegram from retrying
    }
} elseif (isset($_SERVER['GAE_VERSION']) && $_SERVER['PATH_INFO'] === '/admin') {
    require_once __DIR__.'/../vendor/autoload.php';

    $app = new BotCore();
    $app->run();
} else {
    header("Location: https://github.com/SkyBotsDeveloper/inlinexgamesbot");    // Redirect non-POST requests to Github repository
}
