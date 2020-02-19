<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(ElptsCountriesTableSeeder::class);
        $this->call(ElptsDocsFieldsTableSeeder::class);
        $this->call(ElptsDocsFieldsRolesRightsTableSeeder::class);
        $this->call(ElptsDocsFieldsStatusesTableSeeder::class);
        $this->call(ElptsDoctypesTableSeeder::class);
        $this->call(ElptsJunksTableSeeder::class);
        $this->call(ElptsOkopfsTableSeeder::class);
        $this->call(ElptsOperationsTableSeeder::class);
        $this->call(ElptsOwnersTableSeeder::class);
        $this->call(ElptsPaysTableSeeder::class);
        $this->call(ElptsRightsTableSeeder::class);
        $this->call(ElptsRolesTableSeeder::class);
        $this->call(ElptsSettingsTableSeeder::class);
        $this->call(ElptsStatusesTableSeeder::class);
        $this->call(ElptsTemplatesFieldsTableSeeder::class);
        $this->call(ElptsUsersTableSeeder::class);
		$this->call(ElptsTemplatesFieldsAdd1Seeder::class);
		$this->call(ElptsTemplatesFieldsAdd2Seeder::class);
		$this->call(ElptsTemplatesFieldsAdd3Seeder::class);
		$this->call(ElptsTemplatesFieldsAdd4Seeder::class);
		$this->call(ElptsTemplatesFieldsAdd5Seeder::class);
		$this->call(ElptsDocsFieldsAdd1Seeder::class);
		$this->call(ElptsDocsFieldsAdd2Seeder::class);
    }
}
