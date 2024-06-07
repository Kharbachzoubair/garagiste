<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AppointmentController;
use App\Http\Controllers\Admin\ClientController;
use App\Http\Controllers\Admin\InvoiceController;
use App\Http\Controllers\Admin\RepairController;
use App\Http\Controllers\Admin\SparePartController;
use App\Http\Controllers\Admin\VehicleController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Client\ClientAppointmentController;
use App\Http\Controllers\Client\ClientController as ClientClientController;
use App\Http\Controllers\Client\ClientInvoiceController;
use App\Http\Controllers\Client\ClientRepairController;
use App\Http\Controllers\Client\ClientSparePartController;
use App\Http\Controllers\Client\ClientVehicleController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\Mechanic\MechanicAppointmentController;
use App\Http\Controllers\Mechanic\MechanicController;
use App\Http\Controllers\Mechanic\MechanicRepairController;
use App\Http\Controllers\Mechanic\MechanicSparePartController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;

// Default route for the homepage
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Routes for sending email and managing password reset
Route::get('/send-email', [MailController::class, 'sendEmail']);
Route::get('/forgot-password', [PasswordResetLinkController::class, 'create'])
    ->middleware('guest')
    ->name('password.request');
Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])
    ->middleware('guest')
    ->name('password.email');
Route::get('/reset-password/{token}', [NewPasswordController::class, 'create'])
    ->middleware('guest')
    ->name('password.reset');
Route::post('/reset-password', [NewPasswordController::class, 'store'])
    ->middleware('guest')
    ->name('password.update');

// Routes for managing user profile
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


// Client routes
Route::middleware(['auth', 'role:client'])->prefix('client')->group(function () {
    // Dashboard
    Route::get('/dashboard', [ClientClientController::class, 'index'])->name('client.dashboard');

    // Appointments
    Route::get('/appointments/create', [ClientAppointmentController::class, 'create'])->name('client.appointments.create');
    Route::post('/appointments', [ClientAppointmentController::class, 'store'])->name('client.appointments.store');
    Route::get('/appointments', [ClientAppointmentController::class, 'index'])->name('client.appointments.index');
    Route::get('/appointments/{appointment}/edit', [ClientAppointmentController::class, 'edit'])->name('client.appointments.edit');
    Route::put('/appointments/{appointment}', [ClientAppointmentController::class, 'update'])->name('client.appointments.update');
    Route::get('/appointments/{appointment}/confirm-delete', [ClientAppointmentController::class, 'confirmDelete'])->name('client.appointments.confirm-delete');
    Route::delete('/appointments/{appointment}', [ClientAppointmentController::class, 'destroy'])->name('client.appointments.destroy');

    // Invoices
    Route::get('/invoices', [ClientInvoiceController::class, 'index'])->name('client.invoices.index');
    Route::get('/invoices/{id}', [ClientInvoiceController::class, 'show'])->name('client.invoices.show');

    // Repairs
    Route::get('/repairs/history', [ClientRepairController::class, 'index'])->name('client.repairs.history');

    // Vehicles
    Route::get('/vehicles/{vehicle}/confirm-delete', [ClientVehicleController::class, 'confirmDelete'])->name('client.vehicles.confirm-delete');
    Route::get('/vehicles', [ClientVehicleController::class, 'index'])->name('client.vehicles.index');
    Route::get('/vehicles/create', [ClientVehicleController::class, 'create'])->name('client.vehicles.create');
    Route::post('/vehicles', [ClientVehicleController::class, 'store'])->name('client.vehicles.store');
    Route::get('/vehicles/{vehicle}/edit', [ClientVehicleController::class, 'edit'])->name('client.vehicles.edit');
    Route::put('/vehicles/{vehicle}', [ClientVehicleController::class, 'update'])->name('client.vehicles.update');
    Route::post('/vehicles/{vehicle}/condition', [ClientVehicleController::class, 'documentCondition'])->name('client.vehicles.condition');
    Route::delete('/vehicles/{vehicle}', [ClientVehicleController::class, 'destroy'])->name('client.vehicles.destroy');
});
Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    // Dashboard
    Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');});
// Admin routes
Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    // Dashboard
    

    Route::get('/clients', [ClientController::class, 'index'])->name('admin.clients.index');
    Route::get('/clients/create', [ClientController::class, 'create'])->name('admin.clients.create');
    Route::post('/clients', [ClientController::class, 'store'])->name('admin.clients.store');
    Route::get('/clients/{client}', [ClientController::class, 'show'])->name('admin.clients.show');
    Route::get('/clients/{client}/edit', [ClientController::class, 'edit'])->name('admin.clients.edit');
    Route::put('/clients/{client}', [ClientController::class, 'update'])->name('admin.clients.update');
    Route::delete('/clients/{client}', [ClientController::class, 'destroy'])->name('admin.clients.destroy');
    // Vehicles
    Route::get('/vehicles', [VehicleController::class, 'index'])->name('admin.vehicles.index');
    Route::get('/vehicles/create', [VehicleController::class, 'create'])->name('admin.vehicles.create');
    Route::post('/vehicles', [VehicleController::class, 'store'])->name('admin.vehicles.store');
    Route::get('admin/vehicles/{id}/repairs', [VehicleController::class, 'showRepairs'])->name('admin.vehicles.repairs');


    Route::get('/vehicles/{id}/edit', [VehicleController::class, 'edit'])->name('admin.vehicles.edit');
    Route::put('/vehicles/{id}', [VehicleController::class, 'update'])->name('admin.vehicles.update');
    Route::delete('/vehicles/{id}', [VehicleController::class, 'destroy'])->name('admin.vehicles.destroy');


    Route::get('/spare-parts', [SparePartController::class, 'index'])->name('admin.spare_parts.index');
    Route::get('/spare-parts/create/{repair_id}', [SparePartController::class, 'create'])
    ->name('admin.spare_parts.create');
 Route::post('/spare-parts', [SparePartController::class, 'store'])->name('admin.spare_parts.store');
   Route::get('/spare-parts/{spare_part}/edit', [SparePartController::class, 'edit'])->name('admin.spare_parts.edit');
    Route::put('/spare-parts/{spare_part}', [SparePartController::class, 'update'])->name('admin.spare_parts.update');
    Route::delete('/spare-parts/{spare_part}', [SparePartController::class, 'destroy'])->name('admin.spare_parts.destroy');
// routes/web.php
Route::delete('/spare-parts/{spare_part}', [SparePartController::class, 'destroy'])->name('admin.spare_parts.destroy');
Route::get('invoices', [InvoiceController::class, 'index'])->name('admin.invoices.index');
Route::get('invoices/create', [InvoiceController::class, 'create'])->name('admin.invoices.create');
Route::post('invoices', [InvoiceController::class, 'store'])->name('admin.invoices.store');
Route::get('invoices/{invoice}/edit', [InvoiceController::class, 'edit'])->name('admin.invoices.edit');
Route::put('invoices/{invoice}', [InvoiceController::class, 'update'])->name('admin.invoices.update');
Route::delete('invoices/{invoice}', [InvoiceController::class, 'destroy'])->name('admin.invoices.destroy');
Route::get('invoices/{invoice}', [InvoiceController::class, 'show'])->name('admin.invoices.show');
Route::post('invoices/{invoice}/approve', [InvoiceController::class, 'approve'])->name('admin.invoices.approve');
Route::get('invoices/report', [InvoiceController::class, 'report'])->name('admin.invoices.report');
Route::get('invoices/export/csv', [InvoiceController::class, 'exportCSV'])->name('admin.invoices.export.csv');
Route::post('invoices/import', [InvoiceController::class, 'import'])->name('admin.invoices.import');
Route::get('invoices/import', function () {
    return view('admin.invoices.import');
})->name('admin.invoices.import.view');
    // Appointments
    Route::get('/appointments', [AppointmentController::class, 'index'])->name('admin.appointments.index');
Route::get('/appointments/create', [AppointmentController::class, 'create'])->name('admin.appointments.create');
Route::post('/appointments', [AppointmentController::class, 'store'])->name('admin.appointments.store');
Route::get('/appointments/{appointment}/edit', [AppointmentController::class, 'edit'])->name('admin.appointments.edit');
Route::put('/appointments/{appointment}', [AppointmentController::class, 'update'])->name('admin.appointments.update');
Route::delete('/appointments/{appointment}', [AppointmentController::class, 'destroy'])->name('admin.appointments.destroy');
Route::put('/appointments/{appointment}/accept', [AppointmentController::class, 'accept'])->name('admin.appointments.accept');
Route::put('/appointments/{appointment}/refuse', [AppointmentController::class, 'refuse'])->name('admin.appointments.refuse');

Route::get('/repairs', [RepairController::class, 'index'])->name('admin.repairs.index');
Route::get('/repairs/create', [RepairController::class, 'create'])->name('admin.repairs.create');
Route::post('/repairs', [RepairController::class, 'store'])->name('admin.repairs.store');
Route::get('/repairs/{repair}', [RepairController::class, 'show'])->name('admin.repairs.show');
Route::get('/repairs/{repair}/edit', [RepairController::class, 'edit'])->name('admin.repairs.edit');
Route::put('/repairs/{repair}', [RepairController::class, 'update'])->name('admin.repairs.update');
Route::delete('/repairs/{repair}', [RepairController::class, 'destroy'])->name('admin.repairs.destroy');

});

// Mechanic routes
Route::middleware(['auth', 'role:mechanic'])->prefix('mechanic')->group(function () {
    // Dashboard
    Route::get('/dashboard', [MechanicController::class, 'index'])->name('mechanic.dashboard');

    // Mechanic Appointments
    Route::get('/appointments', [MechanicAppointmentController::class, 'index'])->name('mechanic.appointments.index');
    Route::patch('mechanic/appointments/{appointment}/accept', [MechanicAppointmentController::class, 'accept'])->name('mechanic.appointments.accept');
    Route::patch('mechanic/appointments/{appointment}/refuse', [MechanicAppointmentController::class, 'refuse'])->name('mechanic.appointments.refuse');

    Route::get('/repairs', [MechanicRepairController::class, 'index'])->name('mechanic.repairs.index');
    Route::get('/repairs/create', [MechanicRepairController::class, 'create'])->name('mechanic.repairs.create');
    Route::post('/repairs', [MechanicRepairController::class, 'store'])->name('mechanic.repairs.store');
    Route::get('/repairs/{repair}/edit', [MechanicRepairController::class, 'edit'])->name('mechanic.repairs.edit');
    Route::put('/repairs/{repair}', [MechanicRepairController::class, 'update'])->name('mechanic.repairs.update');
    Route::delete('/repairs/{repair}', [MechanicRepairController::class, 'destroy'])->name('mechanic.repairs.destroy');
  Route::patch('/repairs/{repair}/status', [MechanicRepairController::class, 'updateStatus'])->name('mechanic.repairs.updateStatus');
 // Routes for spare parts
 Route::get('/spare_parts', [MechanicSparePartController::class, 'index'])->name('mechanic.spare_parts.index');
 Route::get('/spare_parts/create', [MechanicSparePartController::class, 'create'])->name('mechanic.spare_parts.create');
 Route::post('/spare_parts', [MechanicSparePartController::class, 'store'])->name('mechanic.spare_parts.store');
 Route::get('/spare_parts/{sparePart}/edit', [MechanicSparePartController::class, 'edit'])->name('mechanic.spare_parts.edit');
 Route::put('/spare_parts/{sparePart}', [MechanicSparePartController::class, 'update'])->name('mechanic.spare_parts.update');
 Route::delete('/spare_parts/{sparePart}', [MechanicSparePartController::class, 'destroy'])->name('mechanic.spare_parts.destroy');
});

// Include authentication routes
require __DIR__ . '/auth.php';

Auth::routes();
