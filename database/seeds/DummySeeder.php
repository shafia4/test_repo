<?php

use Illuminate\Database\Seeder;

use App\Role;
use App\Currency;
use App\assettype;

class DummySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->createRole();
        $this->createCurrency();
        $this->createAssetType();
    }

    private function createAssetType()
    {
        $datas = [
            ['name' => 'Type A'],
            ['name' => 'Type B'],
        ];
        foreach ($datas as $data) {
            assettype::updateOrCreate($data);
        }
    }

    private function createCurrency()
    {
        $datas = [
            [
                'leadcurrency' => 1,
                'name' => 'USD',
                'tolead' => 2
            ],
            [
                'leadcurrency' => 2,
                'name' => 'EUR',
                'tolead' => 1.5
            ]
        ];
        foreach ($datas as $data) {
            Currency::updateOrCreate($data);
        }
    }

    private function createRole()
    {
        // this is just sample dummy, used for testing
        $roles = [
            ['name' => 'owner'],
            ['name' => 'user'],
            ['name' => 'editor'],
            ['name' => 'admin'],
        ];

        foreach ($roles as $role) {
            Role::updateOrCreate($role);
        }
    }
}
