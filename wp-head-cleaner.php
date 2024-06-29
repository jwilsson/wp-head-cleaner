<?php
/**
 * Plugin Name: wp_head() cleaner
 * Plugin URI: https://wordpress.org/plugins/wp-head-cleaner/
 * Description: Remove unused tags from wp_head() output.
 * Version: 2.0.6
 * Author: Jonathan Wilsson
 * Author URI: http://jwilsson.com/
 * Text Domain: wp-head-cleaner
 * Domain Path: /languages
 */

if ( ! defined( 'ABSPATH' ) ) {
    die( 'No direct access allowed!' );
}

class WP_Head_Cleaner {
    const OPTION_GROUP = 'wp_head_cleaner_options';
    const OPTION_NAME = 'wp_head_cleaner_hooks';
    const OPTION_SLUG = 'wp_head_cleaner';

    private $options = array();
    private $hooks = array();

    public function __construct() {
        add_action( 'admin_init', array( $this, 'admin_init' ) );
        add_action( 'admin_menu', array( $this, 'admin_menu' ) );
        add_action( 'init', array( $this, 'init' ) );

        add_filter( 'plugin_action_links_' . plugin_basename( __FILE__ ), array( $this, 'plugin_action_links' ) );
    }

    public function setup_hooks() {
        $this->hooks = array(
            array(
                'title' => __( 'Really Simple Discovery', 'wp-head-cleaner' ),
                'description' => __( 'Don\'t print tags for the XML-RPC discover mechanism.', 'wp-head-cleaner' ),
                'action' => 'rsd_link',
                'hook' => 'wp_head',
                'priority' => 10,
                'args' => 1,
            ),
            array(
                'title' => __( 'Windows Live Writer', 'wp-head-cleaner' ),
                'description' => __( 'Don\'t print tags used by Windows Live Writer.', 'wp-head-cleaner' ),
                'action' => 'wlwmanifest_link',
                'hook' => 'wp_head',
                'priority' => 10,
                'args' => 1,
            ),
            array(
                'title' => __( 'WordPress generator meta tag', 'wp-head-cleaner' ),
                'description' => __( 'Don\'t print the WordPress version.', 'wp-head-cleaner' ),
                'action' => 'wp_generator',
                'hook' => 'wp_head',
                'priority' => 10,
                'args' => 1,
            ),
            array(
                'title' => __( 'Post Relational Links - Start', 'wp-head-cleaner' ),
                'description' => __( 'Don\'t print relational link for the first post.', 'wp-head-cleaner' ),
                'action' => 'start_post_rel_link',
                'hook' => 'wp_head',
                'priority' => 10,
                'args' => 1,
            ),
            array(
                'title' => __( 'Post Relational Links - Index', 'wp-head-cleaner' ),
                'description' => __( 'Don\'t print relational link for the site index.', 'wp-head-cleaner' ),
                'action' => 'index_rel_link',
                'hook' => 'wp_head',
                'priority' => 10,
                'args' => 1,
            ),
            array(
                'title' => __( 'Post Relational Links - Previous and Next', 'wp-head-cleaner' ),
                'description' => __( 'Don\'t print relational links for the posts adjacent to the current post.', 'wp-head-cleaner' ),
                'action' => 'adjacent_posts_rel_link_wp_head',
                'hook' => 'wp_head',
                'priority' => 10,
                'args' => 0,
            ),
            array(
                'title' => __( 'Post shortlinks', 'wp-head-cleaner' ),
                'description' => __( 'Don\'t print post short links.', 'wp-head-cleaner' ),
                'action' => 'wp_shortlink_wp_head',
                'hook' => 'wp_head',
                'priority' => 10,
                'args' => 0,
            ),
            array(
                'title' => __( 'Canonical links', 'wp-head-cleaner' ),
                'description' => __( 'Don\'t print post canonical link.', 'wp-head-cleaner' ),
                'action' => 'rel_canonical',
                'hook' => 'wp_head',
                'priority' => 10,
                'args' => 0,
            ),
            array(
                'title' => __( 'Post and Comment Feed', 'wp-head-cleaner' ),
                'description' => __( 'Don\'t print links for the posts and comments feeds.', 'wp-head-cleaner' ),
                'action' => 'feed_links',
                'hook' => 'wp_head',
                'priority' => 2,
                'args' => 1,
            ),
            array(
                'title' => __( 'Other feeds, for example category feeds', 'wp-head-cleaner' ),
                'description' => __( 'Don\'t print links to other feeds, for example categories.', 'wp-head-cleaner' ),
                'action' => 'feed_links_extra',
                'hook' => 'wp_head',
                'priority' => 3,
                'args' => 1,
            ),
            array(
                'title' => __( 'Emoji scripts', 'wp-head-cleaner' ),
                'description' => __( 'Don\'t print scripts for emoji support.', 'wp-head-cleaner' ),
                'action' => 'print_emoji_detection_script',
                'hook' => 'wp_head',
                'priority' => 7,
                'args' => 1,
            ),
            array(
                'title' => __( 'Emoji styles', 'wp-head-cleaner' ),
                'description' => __( 'Don\'t print styles for emoji support.', 'wp-head-cleaner' ),
                'action' => 'print_emoji_styles',
                'hook' => 'wp_print_styles',
                'priority' => 10,
                'args' => 1,
            ),
            array(
                'title' => __( 'REST API', 'wp-head-cleaner' ),
                'description' => __( 'Don\'t print REST API endpoint tags.', 'wp-head-cleaner' ),
                'action' => 'rest_output_link_wp_head',
                'hook' => 'wp_head',
                'priority' => 10,
                'args' => 0,
            ),
            array(
                'title' => __( 'oEmbed tags', 'wp-head-cleaner' ),
                'description' => __( 'Don\'t print tags for the oEmbed discover mechanism.', 'wp-head-cleaner' ),
                'action' => 'wp_oembed_add_discovery_links',
                'hook' => 'wp_head',
                'priority' => 10,
                'args' => 1,
            ),
            array(
                'title' => __( 'oEmbed scripts', 'wp-head-cleaner' ),
                'description' => __( 'Don\'t print scripts for the oEmbed discover mechanism.', 'wp-head-cleaner' ),
                'action' => 'wp_oembed_add_host_js',
                'hook' => 'wp_head',
                'priority' => 10,
                'args' => 1,
            ),
            array(
                'title' => __( 'Resource hints', 'wp-head-cleaner' ),
                'description' => __( 'Don\'t print tags for browser pre-fetching, pre-rendering, and pre-connecting hints.', 'wp-head-cleaner' ),
                'action' => 'wp_resource_hints',
                'hook' => 'wp_head',
                'priority' => 2,
                'args' => 1,
            ),
            array(
                'title' => __( 'Robots image preview', 'wp-head-cleaner' ),
                'description' => __( 'Don\'t print tags for web robots image preview directive.', 'wp-head-cleaner' ),
                'action' => 'wp_robots_max_image_preview_large',
                'hook' => 'wp_robots',
                'priority' => 10,
                'args' => 1,
            ),
        );
    }

    public function admin_init() {
        global $pagenow;

        // Don't do anything unless it's the correct page
        if ( 'options.php' !== $pagenow && 'options-general.php' !== $pagenow ) {
            return;
        }

        register_setting( self::OPTION_GROUP, self::OPTION_NAME );
        add_settings_section( 'default', '', array( $this, 'render_section' ), self::OPTION_SLUG );

        foreach ( $this->hooks as $hook ) {
            $action = $hook['action'];
            $index = array_search( $action, $this->options );
            $value = false !== $index ? $this->options[ $index ] : '';
            $args = array(
                'name' => $action,
                'value' => (boolean) $value,
                'label_for' => $action,
                'description' => $hook['description'],
                'option_name' => self::OPTION_NAME,
            );

            add_settings_field(
                $action,
                $hook['title'],
                array( $this, 'render_field' ),
                self::OPTION_SLUG,
                'default',
                $args,
            );
        }
    }

    public function admin_menu() {
        add_options_page(
            __( 'Options for wp_head() cleaner', 'wp-head-cleaner' ),
            __( 'wp_head() cleaner', 'wp-head-cleaner' ),
            'manage_options',
            self::OPTION_SLUG,
            array( $this, 'render_page' ),
        );
    }

    public function init() {
        load_plugin_textdomain( 'wp-head-cleaner', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );

        $this->options = (array) get_option( self::OPTION_NAME );
        $this->setup_hooks();

        foreach ( $this->hooks as $hook ) {
            $action = $hook['action'];

            // Bail if the tag shouldn't be removed
            if ( ! in_array( $action, $this->options ) ) {
                continue;
            }

            remove_action( $hook['hook'], $action, $hook['priority'], $hook['args'] );
        }
    }

    public function plugin_action_links( $links ) {
        $settings_link = esc_url( get_admin_url( null, 'options-general.php?page=' . self::OPTION_SLUG ) );

        $links[] = sprintf( '<a href="%s">%s</a>', $settings_link, __( 'Settings', 'wp-head-cleaner' ) );
        $links[] = '<a href="https://github.com/jwilsson/wp-head-cleaner" target="_blank">GitHub</a>';

        return $links;
    }

    public function render_page() {
        global $title;

        if ( ! current_user_can( 'manage_options' ) ) {
            wp_die( 'Cheatin\' Uh?' );
        }
?>
    <div class="wrap">
        <h1><?php echo esc_html( $title ); ?></h1>

        <form action="options.php" method="post">
            <?php
            settings_fields( self::OPTION_GROUP );
            do_settings_sections( self::OPTION_SLUG );
            submit_button();
            ?>
        </form>
    </div>
<?php
    }

    public function render_section() {
        echo '<p>' . esc_html__( 'Check the tags you wish to remove.', 'wp-head-cleaner' ) . '</p>';
    }

    public function render_field( $args ) {
        printf(
            '<input type="checkbox" name="%s[]" id="%s" value="%s" %s> <label for="%s"><i>%s</i></label>',
            esc_attr( $args['option_name'] ),
            esc_attr( $args['label_for'] ),
            esc_attr( $args['name'] ),
            checked( $args['value'], true, false ),
            esc_attr( $args['label_for'] ),
            esc_html( $args['description'] ),
        );
    }
}

new WP_Head_Cleaner();
