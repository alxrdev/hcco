<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              rodriguesalex793@gmail.com
 * @since             1.0.0
 * @package           Hcco
 *
 * @wordpress-plugin
 * Plugin Name:       Holos Cadastro de Currículo Online
 * Plugin URI:        rodriguesalex793@gmail.com
 * Description:       Plguin que permite o cadastro de curriculos e pagamento via Mercado Pago e PicPay.
 * Version:           1.0.0
 * Author:            Alex Rodrigues Moreira
 * Author URI:        rodriguesalex793@gmail.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       hcco
 * Domain Path:       /languages
 */

defined( 'ABSPATH' ) || exit;

if ( version_compare( PHP_VERSION, '7.1.0', '<' ) ) {
	return;
}

/**
 * Define plugin paths.
 */
define( 'HCCO_PATH', plugin_dir_path( __FILE__ ) );
define( 'HCCO_URL', plugin_dir_url( __FILE__ ) );

/**
 * Autoload packages.
 */
require_once HCCO_PATH . 'vendor/autoload.php';

/**
 * Code that runs when plugin is activated
 */
function activate_hcco() {
	Holos\Hcco\Config\Hcco_Config::activate();
}

/**
 * Code that runs when plugin is deactivated
 */
function deactive_hcco() {
	Holos\Hcco\Config\Hcco_Config::deactivate();
}

register_activation_hook( __FILE__, 'activate_hcco' );
register_deactivation_hook( __FILE__, 'deactivate_hcco' );

/**
 * Use the plugin start classes.
 */
use Holos\Hcco\Hcco_Loader;
use Holos\Hcco\Hcco_Main;

/**
 * Start the plugin.
 */
$app = new Hcco_Main( new Hcco_Loader() );
$app->run();
