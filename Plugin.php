<?php namespace Rafie\SitepointDemo;

use System\Classes\PluginBase;

/**
 * sitepoint_demo Plugin Information File
 */
class Plugin extends PluginBase
{

    /**
     * Returns information about this plugin.
     *
     * @return array
     */
    public function pluginDetails()
    {
        return [
            'name'        => 'Project management',
            'description' => 'Manage your teams and projects.',
            'author'      => 'RAFIE Younes',
            'icon'        => 'icon-leaf'
        ];
    }

    public function registerPermissions()
    {
        return [
            'rafie.sitepointDemo.manage_teams' => [
                'label' => 'Manage Teams',
                'tab' => 'SitepointDemo'
            ],
            'rafie.sitepointDemo.manage_projects' => [
                'label' => 'Manage Projects',
                'tab' => 'SitepointDemo'
            ]
        ];
    }

    public function boot()
    {
        \Backend\Models\User::extend(function($model){
            $model->belongsTo['team'] = ['Rafie\SitepointDemo\Models\Team'];
        });

        \Backend\Controllers\Users::extendListColumns(function ($list) {
            $list->addColumns([
                'team' => [
                    'label' => 'Team',
                    'relation' => 'team',
                    'select' => 'name'
                ]
            ]);
        });
    }

    /**
     * Registers any form widgets implemented in this plugin.
     */
    public function registerFormWidgets()
    {
        return [
            'Rafie\SitepointDemo\FormWidgets\UniqueValue' => [
                'label' => 'Unique Value',
                'code' => 'uniquevalue'
            ],
        ];
    }
}
