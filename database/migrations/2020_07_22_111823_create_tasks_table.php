<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateTasksTable
 */
class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('title', 20);
            $table->string('description', 100);
            $table->unsignedBigInteger('checklist_id');
            $table->unsignedBigInteger('project_id');

            $table->timestamps();

            $table->foreign('checklist_id')
                ->references('id')->on('checklists')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('project_id')
                ->references('id')->on('projects')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tasks');
    }
}
