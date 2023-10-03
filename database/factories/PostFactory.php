<?php

namespace Database\Factories;

use App\Models\Project;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => $this->faker->text(20),
            'content' => $this->faker->text(200),
            'priority' => random_int(1,3),
            'project_id' => Project::get()->random(),
            'user_id' => User::get()->random(),
            'role_id' => Role::get()->random(),
        ];
    }
}
