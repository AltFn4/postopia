<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = new Role;
        $user->name = 'User';
        $user->canEdit = false;
        $user->canDelete = false;
        $user->save();

        $mod = new Role;
        $mod->name = 'Moderator';
        $mod->canEdit = true;
        $mod->canDelete = true;
        $mod->save();
    }
}
