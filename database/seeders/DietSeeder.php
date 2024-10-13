<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class DietSeeder extends Seeder
{
    public function run()
    {
        // Assuming you have at least one user in the database
        $userId = User::first()->id;

        DB::table('diets')->insert([
            // Weight Loss Diets
            [
                'goal' => 'weight_loss',
                'variation' => '2kg/month',
                'breakfast' => '4 Egg Whites (2 Whole), Sprouts (1 Cup), Green Veggie (100g)',
                'lunch' => 'Grilled Chicken (150g), Lentils(Dal) (1/2 Cup), Rice (50g)',
                'dinner' => 'Egg Curry (2 Whole), Tofu or Paneer (100g), Salad (1 Cup)',
            ],
            [
                'goal' => 'weight_loss',
                'variation' => '4kg/month',
                'breakfast' => '3 Egg White (1 Whole),Sprouts (1 Cup)',
                'lunch' => 'Grilled Chicken (120gm), Lentils(Dal) (1/2 Cup), Salad (1 Cup)',
                'dinner' => 'Egg Omlette (2 Egg), Paneer (100gm), Salad (1 Cup)',
            ],
            [
                'goal' => 'weight_loss',
                'variation' => '8kg/month',
                'breakfast' => '2 Whole Egg, Chicken (50gm)',
                'lunch' => 'Grilled Chicken (100gm)',
                'dinner' => 'Chicken (120gm) , 1 Egg ',
            ],

            // Weight Gain Diets
            [
                'goal' => 'weight_gain',
                'variation' => '0.25kg muscle gain/month',
                'breakfast' => '2 boiled eggs, 1 cup oatmeal with milk and banana, 5-6 almonds',
                'lunch' => '1 cup rice, 1 bowl dal, 1 serving chicken curry, 1 cup green vegetables (like spinach or peas)',
                'dinner' => '2 chapatis, 1 bowl paneer curry, 1 cup salad (cucumber, tomato, onion)',
            ],
            [
                'goal' => 'weight_gain',
                'variation' => '0.5kg muscle gain/month',
                'breakfast' => '3 boiled eggs, 1 cup poha with peanuts and vegetables, 1 glass milk',
                'lunch' => '1.5 cups rice, 1 bowl dal, 2 boiled eggs or 1 serving fish, 1 cup green vegetables',
                'dinner' => '2 chapatis, 1 bowl chicken curry, 1 cup curd, 1 cup salad',
            ],
            [
                'goal' => 'weight_gain',
                'variation' => '1kg muscle gain/month',
                'breakfast' => '4 boiled eggs, 1 cup upma with vegetables, 1 glass milk with 1 banana',
                'lunch' => '2 cups rice, 1 bowl dal, 1 serving chicken curry, 1 cup green vegetables, 1 boiled egg',
                'dinner' => '3 chapatis, 1 bowl paneer or tofu curry, 1 cup curd, 1 cup salad',
            ],

            // Maintenance Diet
            [
                'goal' => 'maintenance',
                'variation' => '1800 calories',
                'breakfast' => '2 boiled eggs, 1 cup oats with milk and chopped apple or banana, 5-6 almonds',
                'lunch' => '1 cup rice, 1 bowl dal, 1 serving chicken curry or paneer, 1 cup green vegetables (like spinach, peas), 1 cup salad',
                'dinner' => '2 chapatis, 1 bowl vegetable curry (like mixed veg or aloo gobhi), 1 cup curd, 1 cup salad (cucumber, tomato)',
            ]

        ]);
    }
}
