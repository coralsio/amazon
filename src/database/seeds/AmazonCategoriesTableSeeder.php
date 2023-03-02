<?php

namespace Corals\Modules\Amazon\database\seeds;

use Illuminate\Database\Seeder;

class AmazonCategoriesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {

        \DB::table('amazon_categories')->delete();

        \DB::table('amazon_categories')->insert(array(
            0 =>
                array(
                    'id' => 9300,
                    'name' => 'Apparel',
                    'status' => 'active',
                    'properties' => NULL,
                    'created_by' => NULL,
                    'updated_by' => NULL,
                    'deleted_at' => NULL,
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            1 =>
                array(
                    'id' => 9301,
                    'name' => 'Appliances',
                    'status' => 'active',
                    'properties' => NULL,
                    'created_by' => NULL,
                    'updated_by' => NULL,
                    'deleted_at' => NULL,
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            2 =>
                array(
                    'id' => 9302,
                    'name' => 'Automotive',
                    'status' => 'active',
                    'properties' => NULL,
                    'created_by' => NULL,
                    'updated_by' => NULL,
                    'deleted_at' => NULL,
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            3 =>
                array(
                    'id' => 9303,
                    'name' => 'Baby',
                    'status' => 'active',
                    'properties' => NULL,
                    'created_by' => NULL,
                    'updated_by' => NULL,
                    'deleted_at' => NULL,
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            4 =>
                array(
                    'id' => 9304,
                    'name' => 'Beauty',
                    'status' => 'active',
                    'properties' => NULL,
                    'created_by' => NULL,
                    'updated_by' => NULL,
                    'deleted_at' => NULL,
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            5 =>
                array(
                    'id' => 9305,
                    'name' => 'Books',
                    'status' => 'active',
                    'properties' => NULL,
                    'created_by' => NULL,
                    'updated_by' => NULL,
                    'deleted_at' => NULL,
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            6 =>
                array(
                    'id' => 9306,
                    'name' => 'Computers',
                    'status' => 'active',
                    'properties' => NULL,
                    'created_by' => NULL,
                    'updated_by' => NULL,
                    'deleted_at' => NULL,
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            7 =>
                array(
                    'id' => 9307,
                    'name' => 'DigitalMusic',
                    'status' => 'active',
                    'properties' => NULL,
                    'created_by' => NULL,
                    'updated_by' => NULL,
                    'deleted_at' => NULL,
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            8 =>
                array(
                    'id' => 9308,
                    'name' => 'Electronics',
                    'status' => 'active',
                    'properties' => NULL,
                    'created_by' => NULL,
                    'updated_by' => NULL,
                    'deleted_at' => NULL,
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            9 =>
                array(
                    'id' => 9309,
                    'name' => 'EverythingElse',
                    'status' => 'active',
                    'properties' => NULL,
                    'created_by' => NULL,
                    'updated_by' => NULL,
                    'deleted_at' => NULL,
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            10 =>
                array(
                    'id' => 9310,
                    'name' => 'Fashion',
                    'status' => 'active',
                    'properties' => NULL,
                    'created_by' => NULL,
                    'updated_by' => NULL,
                    'deleted_at' => NULL,
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            11 =>
                array(
                    'id' => 9311,
                    'name' => 'ForeignBooks',
                    'status' => 'active',
                    'properties' => NULL,
                    'created_by' => NULL,
                    'updated_by' => NULL,
                    'deleted_at' => NULL,
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            12 =>
                array(
                    'id' => 9312,
                    'name' => 'GardenAndOutdoor',
                    'status' => 'active',
                    'properties' => NULL,
                    'created_by' => NULL,
                    'updated_by' => NULL,
                    'deleted_at' => NULL,
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            13 =>
                array(
                    'id' => 9313,
                    'name' => 'GiftCards',
                    'status' => 'active',
                    'properties' => NULL,
                    'created_by' => NULL,
                    'updated_by' => NULL,
                    'deleted_at' => NULL,
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            14 =>
                array(
                    'id' => 9314,
                    'name' => 'GroceryAndGourmetFood',
                    'status' => 'active',
                    'properties' => NULL,
                    'created_by' => NULL,
                    'updated_by' => NULL,
                    'deleted_at' => NULL,
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            15 =>
                array(
                    'id' => 9315,
                    'name' => 'Handmade',
                    'status' => 'active',
                    'properties' => NULL,
                    'created_by' => NULL,
                    'updated_by' => NULL,
                    'deleted_at' => NULL,
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            16 =>
                array(
                    'id' => 9316,
                    'name' => 'HealthPersonalCare',
                    'status' => 'active',
                    'properties' => NULL,
                    'created_by' => NULL,
                    'updated_by' => NULL,
                    'deleted_at' => NULL,
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            17 =>
                array(
                    'id' => 9317,
                    'name' => 'HomeAndKitchen',
                    'status' => 'active',
                    'properties' => NULL,
                    'created_by' => NULL,
                    'updated_by' => NULL,
                    'deleted_at' => NULL,
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            18 =>
                array(
                    'id' => 9318,
                    'name' => 'Industrial',
                    'status' => 'active',
                    'properties' => NULL,
                    'created_by' => NULL,
                    'updated_by' => NULL,
                    'deleted_at' => NULL,
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            19 =>
                array(
                    'id' => 9319,
                    'name' => 'Jewelry',
                    'status' => 'active',
                    'properties' => NULL,
                    'created_by' => NULL,
                    'updated_by' => NULL,
                    'deleted_at' => NULL,
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            20 =>
                array(
                    'id' => 9320,
                    'name' => 'KindleStore',
                    'status' => 'active',
                    'properties' => NULL,
                    'created_by' => NULL,
                    'updated_by' => NULL,
                    'deleted_at' => NULL,
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            21 =>
                array(
                    'id' => 9321,
                    'name' => 'Lighting',
                    'status' => 'active',
                    'properties' => NULL,
                    'created_by' => NULL,
                    'updated_by' => NULL,
                    'deleted_at' => NULL,
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            22 =>
                array(
                    'id' => 9322,
                    'name' => 'Luggage',
                    'status' => 'active',
                    'properties' => NULL,
                    'created_by' => NULL,
                    'updated_by' => NULL,
                    'deleted_at' => NULL,
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            23 =>
                array(
                    'id' => 9323,
                    'name' => 'MobileApps',
                    'status' => 'active',
                    'properties' => NULL,
                    'created_by' => NULL,
                    'updated_by' => NULL,
                    'deleted_at' => NULL,
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            24 =>
                array(
                    'id' => 9324,
                    'name' => 'MoviesAndTV',
                    'status' => 'active',
                    'properties' => NULL,
                    'created_by' => NULL,
                    'updated_by' => NULL,
                    'deleted_at' => NULL,
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            25 =>
                array(
                    'id' => 9325,
                    'name' => 'Music',
                    'status' => 'active',
                    'properties' => NULL,
                    'created_by' => NULL,
                    'updated_by' => NULL,
                    'deleted_at' => NULL,
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            26 =>
                array(
                    'id' => 9326,
                    'name' => 'MusicalInstruments',
                    'status' => 'active',
                    'properties' => NULL,
                    'created_by' => NULL,
                    'updated_by' => NULL,
                    'deleted_at' => NULL,
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            27 =>
                array(
                    'id' => 9327,
                    'name' => 'OfficeProducts',
                    'status' => 'active',
                    'properties' => NULL,
                    'created_by' => NULL,
                    'updated_by' => NULL,
                    'deleted_at' => NULL,
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            28 =>
                array(
                    'id' => 9328,
                    'name' => 'PetSupplies',
                    'status' => 'active',
                    'properties' => NULL,
                    'created_by' => NULL,
                    'updated_by' => NULL,
                    'deleted_at' => NULL,
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            29 =>
                array(
                    'id' => 9329,
                    'name' => 'Shoes',
                    'status' => 'active',
                    'properties' => NULL,
                    'created_by' => NULL,
                    'updated_by' => NULL,
                    'deleted_at' => NULL,
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            30 =>
                array(
                    'id' => 9330,
                    'name' => 'Software',
                    'status' => 'active',
                    'properties' => NULL,
                    'created_by' => NULL,
                    'updated_by' => NULL,
                    'deleted_at' => NULL,
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            31 =>
                array(
                    'id' => 9331,
                    'name' => 'SportsAndOutdoors',
                    'status' => 'active',
                    'properties' => NULL,
                    'created_by' => NULL,
                    'updated_by' => NULL,
                    'deleted_at' => NULL,
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            32 =>
                array(
                    'id' => 9332,
                    'name' => 'ToolsAndHomeImprovement',
                    'status' => 'active',
                    'properties' => NULL,
                    'created_by' => NULL,
                    'updated_by' => NULL,
                    'deleted_at' => NULL,
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            33 =>
                array(
                    'id' => 9333,
                    'name' => 'ToysAndGames',
                    'status' => 'active',
                    'properties' => NULL,
                    'created_by' => NULL,
                    'updated_by' => NULL,
                    'deleted_at' => NULL,
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            34 =>
                array(
                    'id' => 9334,
                    'name' => 'VideoGames',
                    'status' => 'active',
                    'properties' => NULL,
                    'created_by' => NULL,
                    'updated_by' => NULL,
                    'deleted_at' => NULL,
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            35 =>
                array(
                    'id' => 9335,
                    'name' => 'Watches',
                    'status' => 'active',
                    'properties' => NULL,
                    'created_by' => NULL,
                    'updated_by' => NULL,
                    'deleted_at' => NULL,
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
        ));

    }
}
