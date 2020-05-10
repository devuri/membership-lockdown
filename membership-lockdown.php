<?php
/**
 * Plugin Name: Membership Lock
 * Plugin URI:  https://switchwebdev.com/wordpress-plugins/
 * Description: Membership Lock down lets you easily lock all post content including attached images, video, docs, and everything else.
 * Author:      SwitchWebdev.com
 * Author URI:  https://switchwebdev.com
 * Version:     2.0.1
 * License:     GPLv2
 * License URI: https://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain: sw-membership-lockdown
 *
 * Requires PHP: 5.6+
 * Tested up to PHP: 7.3
 *
 * Copyright 2020 Uriel Wilson, support@switchwebdev.com
 * License: GNU General Public License
 * GPLv2 Full license details in license.txt
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <https://www.gnu.org/licenses/>.
 * ----------------------------------------------------------------------------
 * @category  	Plugin
 * @copyright 	Copyright © 2020 Uriel Wilson.
 * @package   	MembershipLockdown
 * @author    	Uriel Wilson
 * @link      	https://switchwebdev.com
 *  ----------------------------------------------------------------------------
 */

  # deny direct access
    if ( ! defined( 'WPINC' ) ) {
      die;
    }

  # plugin directory
	  define("SWMLD_VERSION", '1.7.6');

  # plugin directory
    define("SWMLD_DIR", dirname(__FILE__));

  # plugin url
    define("SWMLD_URL", plugins_url( "/",__FILE__ ));
#  -----------------------------------------------------------------------------

//Activate
register_activation_hook( __FILE__, 'membershiplockdown_activation' );
function membershiplockdown_activation() {

  // add option
  $lockdown_status = 0;
  update_option('mlockdown_status', $lockdown_status);
}
/**
 *  Main Class
 *
 * Activate lockdonw based on given mlockdown_status
 *
 * @since 1.0
 */
final class Si_Member_Lockdown {

  public function __construct() {
    if (self::lockdown()) {
      add_action( 'init', array( $this, 'membershiplock'), 10 );
    }
    add_action( 'admin_enqueue_scripts', array( $this, 'si_lockdown_styles'), 10 );
  }

  /**
   * si_lockdown_styles
   * @return
   */
  public function si_lockdown_styles() {
      wp_enqueue_style( 'lockdown-style', plugin_dir_url( __FILE__ ) . 'includes/admin/css/slockdown.css', array(), SWMLD_VERSION, 'all' );
  }

  /**
   * Redirect to the Login Page
   *
   * all data will be locked behind authentication
   * REST API data will not be available.
   * TODO add a message to the rest API
   * @since 1.0
   */
  public function membershiplock() {
    if ( ! is_user_logged_in() ){
          if ($GLOBALS['pagenow'] === 'wp-login.php') {
            } else {
            wp_safe_redirect( wp_login_url() );
            exit;
          }
      }
  }

  /**
   * get the lockdown status
   * @return boolean
   */
  public static function lockdown(){
    $lockdown = get_option( 'mlockdown_status' );
    return $lockdown;
  }

  /**
   * Get the Lockdown status ON/OFF
   * @return string
   */
  public static function status(){
    if (self::lockdown()) {
      return 'Status: <span style="
        text-align: center;
        border: solid 2px #02af07;
        color: #02af07;
        width: 100px;
        font-weight: 600;
        text-transform: capitalize;
        padding-left: 8px;
        padding-right: 8px;" class="lockdown status-on">enabled</span>';
    } else {
      return 'Status: <span style="
        text-align: center;
        border: solid 2px #af0202;
        color: #af0202;
        width: 100px;
        font-weight: 600;
        text-transform: capitalize;
        padding-left: 8px;
        padding-right: 8px;" class="lockdown status-on">disabled</span>';
    }
  }
}
#  ----------------------------------------------------------------------------
  New Si_Member_Lockdown();


    require_once SWMLD_DIR . '/vendor/wp-admin-page/AdminPage.php';
    require_once SWMLD_DIR . '/vendor/wp-admin-page/Form/FormHelper.php';

  // Menu Item
  require_once plugin_dir_path( __FILE__ ). 'src/Admin/MembershipLockAdmin.php';
