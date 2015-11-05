<?php namespace Rafie\SitepointDemo\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class CreateProjectsTable extends Migration
{

    public function up()
    {
        Schema::create('rafie_sitepointDemo_projects', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('name', 100);
            $table->text('description');
            $table->datetime('ends_at');
            $table->integer('team_id')->unsigned();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('rafie_sitepointDemo_projects');
    }

}
