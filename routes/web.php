<?php
use App\Http\Controllers\CalculatorController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;

Route::get('/dashboard', [CalculatorController::class, 'showDashboard'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    Route::middleware(['admin'])->group(function () {
        Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');

        // Show form to create a new category
        Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');
        
        // Store a newly created category
        Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
        
        // Show form to edit a category
        Route::get('/categories/{category}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
        
        // Update an existing category
        Route::put('/categories/{category}', [CategoryController::class, 'update'])->name('categories.update');
        Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');
        
        Route::get('/items', [ItemController::class, 'index'])->name('items.index');

        // Show form to create a new item
        Route::get('/items/create', [ItemController::class, 'create'])->name('items.create');
        
        // Store a newly created item
        Route::post('/items', [ItemController::class, 'store'])->name('items.store');
        
        // Show form to edit an item
        Route::get('/items/{id}/edit', [ItemController::class, 'edit'])->name('items.edit');
        
        // Update an existing item
        Route::put('/items/{id}', [ItemController::class, 'update'])->name('items.update');
        
        // Delete an item
        Route::delete('/items/{id}', [ItemController::class, 'destroy'])->name('items.destroy');
    });
    
    Route::get('/calculator', [CalculatorController::class, 'showForm'])->name('calculator.form');
    Route::post('/calculator/calculate', [CalculatorController::class, 'calculate'])->name('calculator.calculate');
    Route::get('/calculator/results', [CalculatorController::class, 'results'])->name('calculator.results');
    Route::post('/calculator/get-items', [CalculatorController::class, 'getItems'])->name('calculator.getItems');

    // Goals routes
    Route::get('/goals', [CalculatorController::class, 'index'])->name('goals.index');
    Route::post('/goals', [CalculatorController::class, 'createGoal'])->name('goals.create');
    Route::post('/goals/{id}/update', [CalculatorController::class, 'updateCurrentCO2'])->name('goals.update');
    
    Route::get('/reduce-carbon', [CategoryController::class, 'reduceCarbon'])->name('reduce.carbon');
});

Route::get('/', function () {
    return view('home');
});

require __DIR__.'/auth.php';

