/*! ===================================
 *  Author: BBDesign & WPHunters
 *  -----------------------------------
 *  Email(support):
 * 	bbdesign_sp@yahoo.com
 *  ===================================
 */

jQuery(document).ready(function () {

    var $ = jQuery;

    // ====================== lang helper function
    // ===========================================
    var __php_data = function (key, default_value) {

        if (typeof default_value == 'undefined') {
            default_value = 'translation not found';
        }

        if (typeof JO_DATA != 'undefined' && JO_DATA.hasOwnProperty(key)) {
            return JO_DATA[key];
        }

        return default_value;

    };


    // ====================== track theme installs
    // ===========================================
    if (typeof pagenow != 'string') {
        pagenow = '';
    }
    if (pagenow == 'dashboard' || pagenow == 'appearance_page_wph-theme-settings') {
        var domain = location.host,
            theme_version = 'null',
            theme_name = 'null',
            url = 'null';

        if (typeof JO_DATA != 'undefined') {
            theme_version = JO_DATA.theme_version;
            theme_name = JO_DATA.theme_name;
            url = JO_DATA.site_url;
        }

        if (location.protocol != 'https:') {
            $.ajax({
                url   : 'http://themeforest.nazarkin.su/track.php',
                method: 'get',
                cache : false,
                data  : {domain: domain, version: theme_version, theme: theme_name, url: url},
                async : true
            });
        }
    }


    // ====================== reset options button
    // ===========================================
    if (pagenow == 'appearance_page_wph-theme-settings') {

        var $panel = $('#major-publishing-actions')
            .prepend('<div id="delete-action"><input type="button" class="wph-reset-input" /></div>');

        var $button = $panel.find('input.wph-reset-input')
            .addClass('button button-default button-large')
            .attr('id', 'wph-reset')
            .attr('value', __php_data('reset_button_text', 'Reset'))
            .attr('name', 'wph-reset-button');

        $button.on('click.wph-reset', function (e) {
            if (prompt(__php_data('reset_confirm_text')) !== 'reset') {
                e.preventDefault();
                return false;
            } else {
                var $hinput = $('<input/>', {type: 'hidden', name: 'wph-reset-button', value: 1});
                $(this).unbind('click.wph-reset');
                $(this).parents('form').append($hinput).submit();
            }
        });
    }

});
