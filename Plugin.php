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
}
