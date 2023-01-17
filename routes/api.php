<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use SaltQuotation\Controllers\CategoriesController;
use SaltQuotation\Controllers\QuotationsController;
use SaltQuotation\Controllers\ItemsController;
use SaltQuotation\Controllers\SectionsController;
use SaltQuotation\Controllers\SectionItemsController;
use SaltQuotation\Controllers\ItemizesController;

$version = config('app.API_VERSION', 'v1');

Route::middleware(['api'])
    ->prefix("api/{$version}")
    ->group(function () {

    // API: CATEGORIES
    Route::get("quotations/categories", [CategoriesController::class, 'index'])->middleware(['auth:api']); // get entire collection
    Route::post("quotations/categories", [CategoriesController::class, 'store'])->middleware(['auth:api']); // create new collection

    Route::get("quotations/categories/trash", [CategoriesController::class, 'trash'])->middleware(['auth:api']); // trash of collection

    Route::post("quotations/categories/import", [CategoriesController::class, 'import'])->middleware(['auth:api']); // import collection from external
    Route::post("quotations/categories/export", [CategoriesController::class, 'export'])->middleware(['auth:api']); // export entire collection
    Route::get("quotations/categories/report", [CategoriesController::class, 'report'])->middleware(['auth:api']); // report collection

    Route::get("quotations/categories/{id}/trashed", [CategoriesController::class, 'trashed'])->where('id', '[a-zA-Z0-9-]+')->middleware(['auth:api']); // get collection by ID from trash

    // RESTORE data by ID (id), selected IDs (selected), and All data (all)
    Route::post("quotations/categories/{id}/restore", [CategoriesController::class, 'restore'])->where('id', '[a-zA-Z0-9-]+')->middleware(['auth:api']); // restore collection by ID

    // DELETE data by ID (id), selected IDs (selected), and All data (all)
    Route::delete("quotations/categories/{id}/delete", [CategoriesController::class, 'delete'])->where('id', '[a-zA-Z0-9-]+')->middleware(['auth:api']); // hard delete collection by ID

    Route::get("quotations/categories/{id}", [CategoriesController::class, 'show'])->where('id', '[a-zA-Z0-9-]+')->middleware(['auth:api']); // get collection by ID
    Route::put("quotations/categories/{id}", [CategoriesController::class, 'update'])->where('id', '[a-zA-Z0-9-]+')->middleware(['auth:api']); // update collection by ID
    Route::patch("quotations/categories/{id}", [CategoriesController::class, 'patch'])->where('id', '[a-zA-Z0-9-]+')->middleware(['auth:api']); // patch collection by ID
    // DESTROY data by ID (id), selected IDs (selected), and All data (all)
    Route::delete("quotations/categories/{id}", [CategoriesController::class, 'destroy'])->where('id', '[a-zA-Z0-9-]+')->middleware(['auth:api']); // soft delete a collection by ID

});
