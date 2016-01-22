<?php namespace Rafie\SitepointDemo\Models;

use Model;

/**
 * Team Model
 */
class Team extends Model
{

    /**
     * @var string The database table used by the model.
     */
    public $table = 'rafie_sitepointDemo_teams';

    /**
     * @var array Guarded fields
     */
    protected $guarded = ['*'];

    /**
     * @var array Fillable fields
     */
    protected $fillable = [];

    /**
     * @var array Relations
     */
    public $hasOne = [];
    public $hasMany = [
        'projects'  => '\Rafie\SitepointDemo\Projects',
        'users'      => '\Backend\Models\User'
    ];
    public $belongsTo = [];
    public $belongsToMany = [];
    public $morphTo = [];
    public $morphOne = [];
    public $morphMany = [];
    public $attachOne = [];
    public $attachMany = [];

    public function getUsersOptions()
    {
        return \Backend\Models\User::lists('login', 'id');
    }
}