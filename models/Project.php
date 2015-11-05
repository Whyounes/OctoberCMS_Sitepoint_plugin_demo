<?php namespace Rafie\SitepointDemo\Models;

use Model;

/**
 * Project Model
 */
class Project extends Model
{

    /**
     * @var string The database table used by the model.
     */
    public $table = 'rafie_sitepointDemo_projects';

    /**
     * @var array Guarded fields
     */
    protected $guarded = ['*'];

    /**
     * @var array Fillable fields
     */
    protected $fillable = [];

    protected $dates = ['ends_at'];

    /**
     * @var array Relations
     */
    public $hasOne = [];
    public $hasMany = [];
    public $belongsTo = [
        'team' => '\Rafie\SitepointDemo\Models\Team'
    ];
    public $belongsToMany = [];
    public $morphTo = [];
    public $morphOne = [];
    public $morphMany = [];
    public $attachOne = [];
    public $attachMany = [];

    public function getTeamIdOptions()
    {
        $teams = \Rafie\SitepointDemo\Models\Team::all(['id', 'name']);
        $teamsOptions = [];

        $teams->each(function($team) use (&$teamsOptions) {
            $teamsOptions[$team->id] = $team->name;
        });

        return $teamsOptions;
    }
}