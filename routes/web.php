<?php

use App\Http\Livewire\HomePage;
use App\Http\Livewire\OrganizationCreate;
use App\Http\Livewire\OrganizationDelete;
use App\Http\Livewire\OrganizationDetail;
use App\Http\Livewire\OrganizationEdit;
use App\Http\Livewire\OrganizationEditExternal;
use App\Http\Livewire\OrganizationList;
use App\Http\Livewire\OrganizationRequestEditLink;
use App\Http\Livewire\SectorDetail;
use App\Http\Livewire\SectorList;
use App\Http\Livewire\UserProfile;
use App\Http\Livewire\UserProfileDelete;
use Illuminate\Support\Facades\Route;

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

Route::get('/', HomePage::class)
    ->name('home');

Route::get('/organizations', OrganizationList::class)
    ->name('organizations.index');
Route::get('/organizations/create', OrganizationCreate::class)
    ->name('organizations.create')
    ->middleware(['verified', 'can:create,App\Models\Organization']);
Route::get('/organizations/{organization}', OrganizationDetail::class)
    ->name('organizations.show');
Route::get('/organizations/{organization}/edit', OrganizationEdit::class)
    ->name('organizations.edit')
    ->middleware(['verified']);
Route::get('/organizations/{organization}/delete', OrganizationDelete::class)
    ->name('organizations.delete')
    ->middleware(['verified']);
Route::get('/organizations/{organization}/requestEditLink', OrganizationRequestEditLink::class)
    ->name('organizations.requestEditLink');
Route::get('/organizations/{organization}/editExternal', OrganizationEditExternal::class)
    ->name('organizations.editExternal')
    ->middleware(['signed']);

Route::get('/sectors', SectorList::class)
    ->name('sectors.index');
Route::get('/sectors/{sector}', SectorDetail::class)
    ->name('sectors.show');

Route::get('/user', UserProfile::class)
    ->name('user-profile-information')
    ->middleware('auth');
Route::get('/user/delete', UserProfileDelete::class)
    ->name('user-profile-delete')
    ->middleware(['auth', 'password.confirm']);
