<?php

namespace Database\Factories;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    protected static ?string $password;

    public function definition(): array
    {
        return [
            'login' => fake()->unique()->userName(),
            'password' => static::$password ??= Hash::make('password'),
            'role_id' => fn () => Role::query()->firstOrCreate(['name' => 'user'])->id,
            'remember_token' => Str::random(10),
        ];
    }
}
