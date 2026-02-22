<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Project;
use App\Models\Column;
use App\Models\Task;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $user = User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('admin@123'),
        ]);

        $project = Project::create([
            'name' => 'Projeto Trello Clone',
            'description' => 'Projeto de teste Laravel 11',
            'user_id' => $user->id
        ]);

        $columns = collect([
            'Backlog',
            'Em Progresso',
            'Concluído'
        ])->map(function ($name, $index) use ($project) {
            return Column::create([
                'name' => $name,
                'project_id' => $project->id,
                'position' => $index
            ]);
        });

        // Tasks fake
        foreach ($columns as $column) {
            for ($i = 0; $i < 5; $i++) {
                Task::create([
                    'name' => "Task {$i} - {$column->name}",
                    'description' => 'Descrição de teste',
                    'columns_id' => $column->id,
                    'position' => $i,
                    'created_by' => $user->id
                ]);
            }
        }
    }
}
