<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UsersSeeder extends Seeder
{
    public function run()
    {
        $password = password_hash('admin123', PASSWORD_DEFAULT); // default password

        $data = [
            'name'     => 'Admin User',
            'email'    => 'admin@example.com',
            'password' => $password,
            'is_admin' => 1,
        ];

        $this->db->table('users')->insert($data);
    }
}
