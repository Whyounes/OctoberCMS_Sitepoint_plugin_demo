<?php namespace Rafie\SitepointDemo\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class CreateTeamsTable extends Migration
{

    public function up()
    {
        Schema::create('rafie_sitepointDemo_teams', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('name', 100);
            $table->timestamps();
        });

        if(!Schema::hasColumn('backend_users', 'team_id'))
        {
            Schema::table('backend_users', function($table)
            {
                $table->integer('team_id')->unsigned();
            });
        }
    }

    public function down()
    {
        Schema::dropIfExists('rafie_sitepointDemo_teams');

        if(Schema::hasColumn('backend_users', 'team_id'))
        {
            Schema::table('backend_users', function($table)
            {
                $table->dropColumn('team_id');
            });
        }
    }
}
