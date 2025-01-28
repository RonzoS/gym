<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AssignUsersController;
use App\Http\Controllers\Admin\ManageUsersController;
use App\Http\Controllers\Admin\UserMeasurementsController;
use App\Http\Controllers\Admin\UserCalorieIntakeController;
use App\Http\Controllers\Admin\UserWorkoutsController;
use App\Http\Controllers\Admin\UserResultsController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MeasurementController;
use App\Http\Controllers\UserWorkoutController;
use App\Http\Controllers\ExerciseResultController;
use App\Http\Controllers\ExerciseController;
use App\Http\Controllers\SubscriptionController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

require __DIR__.'/auth.php';

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::middleware('auth')->group(function () {
    Route::get('user/workouts', [UserWorkoutController::class, 'index'])->name('user.workouts.index');
    Route::get('user/workouts/{id}', [UserWorkoutController::class, 'show'])->name('workouts.show');
    Route::get('user/workouts/{id}/edit', [UserWorkoutController::class, 'edit'])->name('workouts.edit');

    Route::get('/user/workouts/{id}/start', [UserWorkoutController::class, 'start'])->name('workouts.start');
    Route::put('/user/workouts/{id}/end', [UserWorkoutController::class, 'end'])->name('workouts.end');

    Route::get('workouts/{id}/download-pdf', [UserWorkoutController::class, 'downloadPdf'])->name('workouts.downloadPdf');

    Route::get('user/results', [ExerciseController::class, 'index'])->name('user.results.index');
    Route::get('user/results/{id}', [ExerciseController::class, 'show'])->name('results.show');
    Route::post('/results/store', [ExerciseResultController::class, 'store'])->name('results.store');
    Route::get('/results/{id}/edit', [ExerciseResultController::class, 'edit'])->name('results.edit');
    Route::put('/results/{id}', [ExerciseResultController::class, 'update'])->name('results.update');
    Route::delete('/results/{id}', [ExerciseResultController::class, 'destroy'])->name('results.destroy');

    Route::get('/user/account', [UserController::class, 'account'])->name('user.account');
    Route::put('/user/account', [UserController::class, 'updateAccount'])->name('user.account.update');

    Route::get('/user/measurements', [MeasurementController::class, 'index'])->name('user.measurements.index');
    Route::get('/user/measurements/create', [MeasurementController::class, 'create'])->name('user.measurements.create');
    Route::post('/user/measurements', [MeasurementController::class, 'store'])->name('user.measurements.store');
    Route::get('/user/measurements/{id}', [MeasurementController::class, 'show'])->name('measurements.show');
    Route::get('/user//measurements/{id}/edit', [MeasurementController::class, 'edit'])->name('measurements.edit');
    Route::put('/user/measurements/{id}', [MeasurementController::class, 'update'])->name('measurements.update');
    Route::delete('/user/measurements/{id}', [MeasurementController::class, 'destroy'])->name('measurements.destroy');

    Route::get('/user/dailycalorieintakes', [\App\Http\Controllers\DailyCalorieIntakeController::class, 'index'])->name('user.dailycalorieintakes');

    Route::post('/subscription/subscribe', [SubscriptionController::class, 'subscribe'])->name('subscription.subscribe');
    Route::post('/subscription/cancel', [SubscriptionController::class, 'cancel'])->name('subscription.cancel');
});

Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();

    Route::get('/assign-users', [\App\Http\Controllers\Admin\AssignUsersController::class, 'index'])->name('voyager.assign-users.index');
    Route::get('/assign-users/{id}/edit', [\App\Http\Controllers\Admin\AssignUsersController::class, 'edit'])->name('voyager.assign-users.edit');
    Route::put('/assign-users/{id}', [\App\Http\Controllers\Admin\AssignUsersController::class, 'update'])->name('voyager.assign-users.update');
    Route::delete('assign-users/{trainer}/{user}', [AssignUsersController::class, 'detach'])->name('voyager.assign-users.detach');

    Route::get('/manage-users', [ManageUsersController::class, 'index'])->name('voyager.manage-users.index');
    Route::get('/manage-users/{id}', [ManageUsersController::class, 'manage'])->name('voyager.manage-users.manage');

    Route::get('measurements/{user}', [UserMeasurementsController::class, 'index'])->name('voyager.measurements.index');
    Route::get('measurements/show/{measurement}', [UserMeasurementsController::class, 'show'])->name('voyager.measurements.show');

    Route::get('calorie-intake/{userId}/edit', [UserCalorieIntakeController::class, 'edit'])
        ->name('voyager.calorie-intake.edit');
    Route::put('calorie-intake/{userId}/edit', [UserCalorieIntakeController::class, 'update'])
        ->name('voyager.calorie-intake.update');

    Route::get('manage-users/{user}/workouts', [UserWorkoutsController::class, 'index'])
        ->name('voyager.user-workouts.index');
    Route::get('manage-users/{user}/workouts/create', [UserWorkoutsController::class, 'create'])
        ->name('voyager.user-workouts.create');
    Route::post('manage-users/{user}/workouts', [UserWorkoutsController::class, 'store'])
        ->name('voyager.user-workouts.store');
    Route::get('manage-users/{user}/workouts/{workout}/edit', [UserWorkoutsController::class, 'edit'])
        ->name('voyager.user-workouts.edit');
    Route::put('manage-users/{user}/workouts/{workout}', [UserWorkoutsController::class, 'update'])
        ->name('voyager.user-workouts.update');
    Route::delete('manage-users/{user}/workouts/{workout}', [UserWorkoutsController::class, 'destroy'])
        ->name('voyager.user-workouts.destroy');

    Route::get('manage-users/{user}/results', [UserResultsController::class, 'index'])
        ->name('voyager.user-results.index');
    Route::get('manage-users/{user}/results/{exercise}', [UserResultsController::class, 'show'])
        ->name('voyager.user-results.show');
})->middleware('auth');
