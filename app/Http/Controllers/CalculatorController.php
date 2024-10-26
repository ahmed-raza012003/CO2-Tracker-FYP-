<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Item;
use App\Models\Goal;
use App\Models\CalculatorResult;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class CalculatorController extends Controller
{
    // Show form with categories and items
    public function showForm()
    {
        $categories = Category::all();
        $items = Item::all();
       
        // Fetch last 5 results along with the difference
        $recentResults = CalculatorResult::where('user_id', Auth::id())
            ->latest()
            ->take(5)
            ->get();
    
        // Calculate the difference for recent results
        foreach ($recentResults as $result) {
            $result->difference = $result->total_co2 - ($recentResults->last()->total_co2 ?? 0);
        }
    
        return view('calculator', compact('categories', 'items', 'recentResults'));
    }
    
    // Handle the calculation of CO2 consumption
    public function calculate(Request $request)
    {
        // Validate the input
        $request->validate([
            'categories' => 'required|array',
            'items' => 'required|array|min:1', // Ensure at least one item is selected
        ]);
    
        // Log request data
    
        $selectedCategoryIds = $request->input('categories');
        $selectedItemIds = $request->input('items');
    
        // Check selected categories and items
    
        $items = Item::whereIn('id', $selectedItemIds)->get();
        $totalCO2 = $items->sum('co2_value');
    
        // Fetch last CO2 result
        $lastResult = CalculatorResult::where('user_id', Auth::id())->latest()->first();
        $lastCO2 = $lastResult ? $lastResult->total_co2 : 0;
    
        // Calculate the difference
        $difference = $totalCO2 - $lastCO2;
        $reducedCO2 = $difference < 0 ? abs($difference) : null;
    
        // Save calculator result
        try {
            CalculatorResult::create([
                'user_id' => Auth::id(),
                'selected_categories' => json_encode($selectedCategoryIds),
                'selected_items' => json_encode($selectedItemIds),
                'total_co2' => $totalCO2,
                'difference' => $difference,
                'reduced_co2' => $reducedCO2,
                'calculation_date' => now(),
            ]);
        } catch (\Exception $e) {
            return redirect()->route('calculator.form')->with('error', 'Could not save calculation. Please try again. ' . $e->getMessage());
        }
    
        // Flash result message
        return redirect()->route('calculator.form')->with('success', 'Calculation saved successfully!');
    }
    
    
    
    
    
    
    

    // Get items based on selected categories (for dynamic dropdowns)
    public function getItems(Request $request)
    {
        $categories = $request->input('categories', []);
        $items = Item::whereIn('category_id', $categories)->get();
        return response()->json(['items' => $items]);
    }

    // Fetch latest results and goals for real-time updates
    public function results()
    {
        $userId = Auth::id();
        $latestResult = CalculatorResult::where('user_id', $userId)->latest()->first();
        $totalCO2 = CalculatorResult::where('user_id', $userId)->sum('total_co2');

        // Fetch goals and calculate their status
        $goals = Goal::where('user_id', $userId)->get();
        $completedGoals = $goals->where('status', 'Achieved')->count();
        $inProgressGoals = $goals->where('status', 'In Progress')->count();
        $notAchievedGoals = $goals->where('status', 'Reduce it')->count();

        // Calculate total reductions (if any)
        $totalReductions = CalculatorResult::where('user_id', $userId)->sum('reduced_co2');

        return response()->json([
            'latestResult' => $latestResult,
            'totalCO2' => $totalCO2,
            'completedGoals' => $completedGoals,
            'inProgressGoals' => $inProgressGoals,
            'notAchievedGoals' => $notAchievedGoals,
            'totalReductions' => $totalReductions,
        ]);
    }

    // Show dashboard with goals and CO2 consumption results
  // Show dashboard with goals and CO2 consumption results
public function index()
{
    $goals = Goal::where('user_id', Auth::id())->get();
    $latestResult = CalculatorResult::where('user_id', Auth::id())->latest()->first();

    // Update goal statuses based on the latest CO2 result
    foreach ($goals as $goal) {
        if ($latestResult) {
            if ($goal->status !== 'Achieved') { // Only update if not already achieved
                if ($latestResult->total_co2 < $goal->target_co2) {
                    $goal->status = 'In Progress';
                } elseif ($latestResult->total_co2 == $goal->target_co2) {
                    $goal->status = 'Achieved';
                    $goal->achieved_at = now(); // Record achievement date
                } else {
                    $goal->status = 'Reduce it';
                }
            }
        } else {
            $goal->status = 'No data';
        }
        $goal->save();
    }

    // Counts for dashboard charts
    $completedGoals = $goals->where('status', 'Achieved')->count();
    $inProgressGoals = $goals->where('status', 'In Progress')->count();
    $notAchievedGoals = $goals->where('status', 'Reduce it')->count();

    return view('goals', compact('goals', 'latestResult', 'completedGoals', 'inProgressGoals', 'notAchievedGoals'));
}

// Private function to update the goal's status
private function updateGoalsStatus($goals, $latestResult)
{
    foreach ($goals as $goal) {
        // Prevent changing the status back to 'In Progress' if already 'Achieved'
        if ($goal->status !== 'Achieved') {
            if ($latestResult->total_co2 <= $goal->target_co2) {
                if (!$goal->achieved) {
                    $goal->status = 'Achieved';
                    $goal->achieved_at = now(); // Mark achievement date
                }
            } else {
                $goal->status = 'Reduce it'; // Set to 'Reduce it' if not achieved
            }
            $goal->save();
        }
    }
}


    // Create a new goal
    public function createGoal(Request $request)
    {
        $request->validate([
            'goal' => 'required|string|max:255',
            'target_co2' => 'required|integer',
        ]);

        Goal::create([
            'user_id' => Auth::id(),
            'goal' => $request->goal,
            'target_co2' => $request->target_co2,
            'status' => 'In Progress',
            'achieved_at' => null,
        ]);

        return redirect()->route('goals.index')->with('success', 'Goal created successfully!');
    }

    // Private function to update the goal's status
   
    public function showDashboard()
    {
        $userId = Auth::id();
        $totalCO2 = CalculatorResult::where('user_id', $userId)->sum('total_co2');
        $completedGoals = Goal::where('user_id', $userId)->where('status', 'Achieved')->count();
        $totalReductions = CalculatorResult::where('user_id', $userId)->sum('reduced_co2');
    
        // Fetch all results for the user
        $results = CalculatorResult::where('user_id', $userId)->orderBy('created_at', 'desc')->get();
        
        // Fetch the last 5 results for consumption
        $lastFiveResults = $results->take(5);
    
        // Pass variables to the view
        return view('dashboard', compact('totalCO2', 'completedGoals', 'totalReductions', 'results', 'lastFiveResults'));
    }
    
    
    
    
}
