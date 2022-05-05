<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\QualificationController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\UserAnnouncementController;
use App\Http\Controllers\UserQualificationController;
use App\Models\Announcement;
use App\Models\Project;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    //return view('dashboard');
    $announcements = Announcement::get();
    $projects = Project::get();
    $userAnnouncements = DB::table("announcement_user")->where("announcement_user.user_id",Auth()->user()->id)
            ->pluck('announcement_user.announcement_id','announcement_user.announcement_id')
            ->all();
    return view('announcement/index', compact('announcements','projects','userAnnouncements'));
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

 
Route::group(['middleware' => ['auth']], function() {
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
    Route::resource('announcements', AnnouncementController::class);
    Route::resource('projects', ProjectController::class);
    Route::resource('qualifications', QualificationController::class);
    Route::resource('notifications', NotificationController::class);
    Route::POST('announcements.search',[AnnouncementController::class,'search'])->name('announcements.search');

    Route::resource('userQualifications', UserQualificationController::class);
    Route::resource('userAnnouncements', UserAnnouncementController::class);
});

