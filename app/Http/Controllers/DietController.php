<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Diet;

class DietController extends Controller
{
    public function calculateDiet(Request $request)
    {
        // Validate user input
        $validated = $request->validate([
            'age' => 'required|numeric|min:10|max:100',
            'height' => 'required|numeric|min:100|max:250',
            'weight' => 'required|numeric|min:30|max:300',
            'goal' => 'required|string|max:255',
            'gender' => 'required|string',
        ], [
            'age.required' => 'Please provide your age.',
            'age.numeric' => 'Age must be a number.',
            'age.min' => 'Age must be at least 10 years.',
            'age.max' => 'Age should not exceed 100 years.',
            'height.required' => 'Height is required.',
            'height.numeric' => 'Height must be a valid number.',
            'height.min' => 'Height should be at least 100 cm.',
            'height.max' => 'Height should not exceed 250 cm.',
            'weight.required' => 'Weight is required.',
            'weight.numeric' => 'Weight must be a valid number.',
            'weight.min' => 'Weight should be at least 30 kg.',
            'weight.max' => 'Weight should not exceed 300 kg.',
            'goal.required' => 'Goal is required for the diet plan.'
        ]);

        // Extract data
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
        $bmr = ceil($bmr); // Round up to the nearest whole number

        // Classify BMR into Underweight, Fit, or Obese
        if ($bmr < 1200) {
            $classification = "Underweight";
        } elseif ($bmr >= 1200 && $bmr < 1800) {
            $classification = "Fit";
        } else {
            $classification = "Obese";
        }

        // Adjust calorie needs based on the goal
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

        // Fetch diet plan from the database based on the goal
        $dietPlan = $this->fetchDietPlan($goal, $calories);

        // Return response with BMR, classification, and dynamic diet plan
        return response()->json([
            'bmr' => $bmr . " (" . $classification . ")", // Include classification with BMR
            'calories_needed' => $calories,
            'diet_plan' => $dietPlan
        ]);
    }

    /**
     * Fetch diet plan based on goal and calories.
     */
    private function fetchDietPlan($goal, $calories)
    {
        // Match diet plans from the database based on goal
        switch ($goal) {
            case 'weight_loss':
                if ($calories < 1500) {
                    return Diet::where('goal', 'weight_loss')->where('variation', '2kg/month')->first();
                } elseif ($calories < 2000) {
                    return Diet::where('goal', 'weight_loss')->where('variation', '4kg/month')->first();
                } else {
                    return Diet::where('goal', 'weight_loss')->where('variation', '8kg/month')->first();
                }

            case 'weight_gain':
                if ($calories < 2500) {
                    return Diet::where('goal', 'weight_gain')->where('variation', '0.25kg muscle gain/month')->first();
                } elseif ($calories < 3000) {
                    return Diet::where('goal', 'weight_gain')->where('variation', '0.5kg muscle gain/month')->first();
                } else {
                    return Diet::where('goal', 'weight_gain')->where('variation', '1kg muscle gain/month')->first();
                }

            case 'maintenance':
            default:
                return Diet::where('goal', 'maintenance')->first();
        }
    }
}
