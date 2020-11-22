<?php

use App\Http\Livewire\DataExport as LivewireDataExport;
use App\Http\Livewire\HomePage;
use App\Http\Livewire\LocationDetail;
use App\Http\Livewire\LocationList;
use App\Http\Livewire\OrganizationCreate;
use App\Http\Livewire\OrganizationCreateExternal;
use App\Http\Livewire\OrganizationDelete;
use App\Http\Livewire\OrganizationDetail;
use App\Http\Livewire\OrganizationEdit;
use App\Http\Livewire\OrganizationEditExternal;
use App\Http\Livewire\OrganizationList;
use App\Http\Livewire\OrganizationRequestCreateLink;
use App\Http\Livewire\OrganizationRequestEditLink;
use App\Http\Livewire\OrganizationTypeDetail;
use App\Http\Livewire\OrganizationTypeList;
use App\Http\Livewire\OrganizationTypeManage;
use App\Http\Livewire\SectorDetail;
use App\Http\Livewire\SectorList;
use App\Http\Livewire\SectorManage;
use App\Http\Livewire\UserCreate;
use App\Http\Livewire\UserDelete;
use App\Http\Livewire\UserDetail;
use App\Http\Livewire\UserEdit;
use App\Http\Livewire\UserList;
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
Route::get('/organizations/_create', OrganizationCreate::class)
    ->name('organizations.create')
    ->middleware(['verified', 'can:create,App\Models\Organization']);
Route::get('/organizations/requestCreateLink', OrganizationRequestCreateLink::class)
    ->name('organizations.requestCreateLink');
Route::get('/organizations/_createExternal/{email}', OrganizationCreateExternal::class)
    ->name('organizations.createExternal')
    ->middleware(['signed']);
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

Route::get('/types', OrganizationTypeList::class)
    ->name('types.index');
Route::get('/types/_manage', OrganizationTypeManage::class)
    ->name('types.manage');
Route::get('/types/{type}', OrganizationTypeDetail::class)
    ->name('types.show');

Route::get('/sectors', SectorList::class)
    ->name('sectors.index');
Route::get('/sectors/_manage', SectorManage::class)
    ->name('sectors.manage');
Route::get('/sectors/{sector}', SectorDetail::class)
    ->name('sectors.show');

Route::get('/locations', LocationList::class)
    ->name('locations.index');
Route::get('/locations/{location}', LocationDetail::class)
    ->name('locations.show');

Route::get('/user', UserProfile::class)
    ->name('user-profile-information')
    ->middleware('auth');
Route::get('/user/delete', UserProfileDelete::class)
    ->name('user-profile-delete')
    ->middleware(['auth', 'password.confirm']);

Route::get('/export', LivewireDataExport::class)
    ->name('export');

Route::get('/users', UserList::class)
    ->name('users.index')
    ->middleware('auth');
Route::get('/users/_create', UserCreate::class)
    ->name('users.create')
    ->middleware('auth');
Route::get('/users/{user}', UserDetail::class)
    ->name('users.show')
    ->middleware('auth');
Route::get('/users/{user}/edit', UserEdit::class)
    ->name('users.edit')
    ->middleware('auth');
Route::get('/users/{user}/delete', UserDelete::class)
    ->name('users.delete')
    ->middleware('auth');
