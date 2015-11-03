<?php namespace Rafie\SitepointDemo\Controllers;

use BackendMenu;
use Backend\Classes\Controller;

/**
 * Teams Back-end Controller
 */
class Teams extends Controller
{
    public $implement = [
        'Backend.Behaviors.FormController',
        'Backend.Behaviors.ListController'
    ];

    public $formConfig = 'config_form.yaml';
    public $listConfig = 'config_list.yaml';

    public function __construct()
    {
        parent::__construct();

        BackendMenu::setContext('Rafie.SitepointDemo', 'sitepointdemo', 'teams');
    }

    public function create_onSave()
    {
        $inputs = post('Team');

        // save team
        $teamModel = new \Rafie\SitepointDemo\Models\Team;
        $teamModel->name = $inputs['name'];
        $teamModel->save();

        // update users team_id
        \Backend\Models\User::whereIn('id', $inputs['users'])
                            ->update(['team_id' => $teamModel->id]);

        \Flash::success("Team saved successfully");
        
        return $this->makeRedirect('update', $teamModel);
    }

    public function update_onSave($recordId)
    {
        $inputs = post('Team');

        // update team
        $teamModel = \Rafie\SitepointDemo\Models\Team::findOrFail($recordId);
        $teamModel->name = $inputs['name'];
        $teamModel->save();

        \Backend\Models\User::where('team_id', $teamModel->id)
                            ->update(['team_id' => 0]);

        // update users team_id
        \Backend\Models\User::whereIn('id', $inputs['users'])
                            ->update(['team_id' => $teamModel->id]);

        \Flash::success("Team updated successfully");
    }

    public function update_onDelete($recordId)
    {
        $teamModel = \Rafie\SitepointDemo\Models\Team::findOrFail($recordId);
        \Backend\Models\User::where('team_id', $teamModel->id)
                            ->update(['team_id' => 0]);
        $teamModel->delete();
        \Flash::success("Team deleted successfully");

        return $this->makeRedirect('delete', $teamModel);
    }
}