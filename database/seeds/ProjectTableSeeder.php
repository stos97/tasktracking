<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Project;

/**
 * Class ProjectTableSeeder
 */
class ProjectTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::inRandomOrder()->limit(2)->get();

        $projects = factory(Project::class, 10)
            ->make()
            ->each(function (Project $project, $index) use ($users) {
                $project->user_id = $users[$index % 2]->id;
            })
            ->toArray();

        Project::insert($projects);
    }
}
