<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DietController extends Controller
{
    public function calculateDiet(Request $request)
    {
        // Validate user input
        $validated = $request->validate([
            'height' => 'required|numeric',
            'weight' => 'required|numeric',
            'age' => 'required|numeric',
            'gender' => 'required|string',
            'goal' => 'required|string'
        ]);

        $height = $validated['height'];
        $weight = $validated['weight'];
        $age = $validated['age'];
        $gender = $validated['gender'];
        $goal = $validated['goal'];

        // Calculate Basal Metabolic Rate (BMR)
        if ($gender == 'male') {
            $bmr = 88.362 + (13.397 * $weight) + (4.799 * $height) - (5.677 * $age);
        } else {
            $bmr = 447.593 + (9.247 * $weight) + (3.098 * $height) - (4.330 * $age);
        }

        // Calculate calorie needs based on goal
        switch ($goal) {
            case 'weight_loss':
                $calories = $bmr - 500; // 500 calorie deficit
                break;
            case 'weight_gain':
                $calories = $bmr + 500; // 500 calorie surplus
                break;
            default:
                $calories = $bmr; // Maintenance
                break;
        }

        // Example diet plan
        $dietPlan = $this->generateDietPlan($calories);

        return response()->json([
            'bmr' => $bmr,
            'calories_needed' => $calories,
            'diet_plan' => $dietPlan
        ]);
    }

    private function generateDietPlan($calories)
    {
        // This is a simple static diet plan generation.
        // You can make it dynamic based on the calories needed.

        if ($calories < 1500) {
            return [
                'breakfast' => 'Oatmeal with nuts and fruits',
                'lunch' => 'Grilled chicken with steamed vegetables',
                'dinner' => 'Salad with lean protein (tofu/chicken)',
                'snacks' => 'Nuts, seeds, and yogurt'
            ];
        } elseif ($calories < 2500) {
            return [
                'breakfast' => 'Eggs and whole-grain toast',
                'lunch' => 'Chicken breast, brown rice, and veggies',
                'dinner' => 'Salmon with quinoa and veggies',
                'snacks' => 'Protein shake, fruits, and nuts'
            ];
        } else {
            return [
                'breakfast' => 'Eggs, avocado toast, and smoothie',
                'lunch' => 'Grilled steak with sweet potatoes',
                'dinner' => 'Whole wheat pasta with lean ground beef',
                'snacks' => 'Greek yogurt, almonds, and protein bars'
            ];
        }
    }
}
