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

    public $requiredPermissions = ['rafie.sitepointDemo.manage_teams'];

    public function __construct()
    {
        parent::__construct();

        BackendMenu::setContext('Rafie.SitepointDemo', 'sitepointdemo', 'teams');
    }

    public function formExtendFields($form)
    {
        if( $form->getContext() === 'update')
        {
            $team = $form->model;
            $userField = $form->getField('users');
            $userField->value = $team->users->lists('id');
        }
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

    public function update_onSave($recordId, $context = null)
    {
        $inputs = post('Team');

        \Backend\Models\User::where('team_id', $recordId)
                            ->update(['team_id' => 0]);

        // update users team_id
        \Backend\Models\User::whereIn('id', $inputs['users'])
                            ->update(['team_id' => $recordId]);

        $this->asExtension('FormController')->update_onSave($recordId, $context);
    }

    public function formAfterDelete($model)
    {
        \Backend\Models\User::where('team_id', $model->id)
                            ->update(['team_id' => 0]);
    }
}