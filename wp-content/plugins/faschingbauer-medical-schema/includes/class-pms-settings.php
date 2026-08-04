<?php
if (!defined('ABSPATH')) exit;

class PMS_Settings {
    public static function init() {
        add_action('admin_menu', [__CLASS__, 'menu']);
        add_action('admin_init', [__CLASS__, 'register']);
    }

    public static function menu() {
        add_options_page(
            'Medical Schema',
            'Medical Schema',
            'manage_options',
            'pms-settings',
            [__CLASS__, 'render']
        );
    }

    public static function register() {
        register_setting('pms_settings_group', 'pms_options');

        add_settings_section('pms_main', 'Modules', function () {
            echo '<p>Enable/disable schema modules.</p>';
        }, 'pms-settings');

        self::add_checkbox('sitewide', 'Site-wide: Praxis + Arzt');
        self::add_checkbox('home', 'Homepage Schema');
        self::add_checkbox('beschwerde', 'Beschwerden (Symptome) Schema');
        self::add_checkbox('behandlung', 'Behandlungen Schema');
    }

    private static function add_checkbox($key, $label) {
        add_settings_field(
            "pms_$key",
            esc_html($label),
            function () use ($key) {
                $opt = get_option('pms_options', []);
                $checked = !empty($opt[$key]) ? 'checked' : '';
                echo "<input type='checkbox' name='pms_options[$key]' value='1' $checked />";
            },
            'pms-settings',
            'pms_main'
        );
    }

    public static function render() {
        ?>
        <div class="wrap">
            <h1>Medical Schema Settings</h1>
            <form method="post" action="options.php">
                <?php
                settings_fields('pms_settings_group');
                do_settings_sections('pms-settings');
                submit_button();
                ?>
            </form>
        </div>
        <?php
    }
}