<?php namespace Mcore\DatalistWidget;

use Backend;
use System\Classes\PluginBase;


/**
 * Plugin Information File
 *
 * @link https://docs.octobercms.com/3.x/extend/system/plugins.html
 */
class Plugin extends PluginBase
{
    /**
     * pluginDetails about this plugin.
     */
    public function pluginDetails()
    {
        return [
            'name' => 'Datalist Form Widget',
            'description' => 'Simple datalist form widget',
            'author' => 'Mcore',
            'icon' => 'icon-components'
        ];
    }

    /**
     * register method, called when the plugin is first registered.
     */
    public function register()
    {
        //
    }

    /**
     * boot method, called right before the request route.
     */
    public function boot()
    {

    }


    public function registerFormWidgets()
    {
        return [
            'Mcore\DatalistWidget\FormWidgets\Datalist' => [
                'label' => 'Datalist',
                'code'  => 'datalist'
            ],
        ];
    }

    

    /**
     * registerPermissions used by the backend.
     */
    public function registerPermissions()
    {
        return [];
    }

    /**
     * registerNavigation used by the backend.
     */
    public function registerNavigation()
    {
        return [];
    }
}
