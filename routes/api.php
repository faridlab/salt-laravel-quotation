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


    // API: PROPOSAL ITEMS
    // TODO: this should use nesting route
    Route::get("quotations/items", [ItemsController::class, 'index'])->middleware(['auth:api']); // get entire collection
    Route::post("quotations/items", [ItemsController::class, 'store'])->middleware(['auth:api']); // create new collection

    Route::get("quotations/items/trash", [ItemsController::class, 'trash'])->middleware(['auth:api']); // trash of collection

    Route::post("quotations/items/import", [ItemsController::class, 'import'])->middleware(['auth:api']); // import collection from external
    Route::post("quotations/items/export", [ItemsController::class, 'export'])->middleware(['auth:api']); // export entire collection
    Route::get("quotations/items/report", [ItemsController::class, 'report'])->middleware(['auth:api']); // report collection

    Route::get("quotations/items/{id}/trashed", [ItemsController::class, 'trashed'])->where('id', '[a-zA-Z0-9-]+')->middleware(['auth:api']); // get collection by ID from trash

    // RESTORE data by ID (id), selected IDs (selected), and All data (all)
    Route::post("quotations/items/{id}/restore", [ItemsController::class, 'restore'])->where('id', '[a-zA-Z0-9-]+')->middleware(['auth:api']); // restore collection by ID

    // DELETE data by ID (id), selected IDs (selected), and All data (all)
    Route::delete("quotations/items/{id}/delete", [ItemsController::class, 'delete'])->where('id', '[a-zA-Z0-9-]+')->middleware(['auth:api']); // hard delete collection by ID

    Route::get("quotations/items/{id}", [ItemsController::class, 'show'])->where('id', '[a-zA-Z0-9-]+')->middleware(['auth:api']); // get collection by ID
    Route::put("quotations/items/{id}", [ItemsController::class, 'update'])->where('id', '[a-zA-Z0-9-]+')->middleware(['auth:api']); // update collection by ID
    Route::patch("quotations/items/{id}", [ItemsController::class, 'patch'])->where('id', '[a-zA-Z0-9-]+')->middleware(['auth:api']); // patch collection by ID
    // DESTROY data by ID (id), selected IDs (selected), and All data (all)
    Route::delete("quotations/items/{id}", [ItemsController::class, 'destroy'])->where('id', '[a-zA-Z0-9-]+')->middleware(['auth:api']); // soft delete a collection by ID


    // API: PROPOSAL SECTIONS
    // TODO: this should use nesting route
    Route::get("quotations/sections", [SectionsController::class, 'index'])->middleware(['auth:api']); // get entire collection
    Route::post("quotations/sections", [SectionsController::class, 'store'])->middleware(['auth:api']); // create new collection

    Route::get("quotations/sections/trash", [SectionsController::class, 'trash'])->middleware(['auth:api']); // trash of collection

    Route::post("quotations/sections/import", [SectionsController::class, 'import'])->middleware(['auth:api']); // import collection from external
    Route::post("quotations/sections/export", [SectionsController::class, 'export'])->middleware(['auth:api']); // export entire collection
    Route::get("quotations/sections/report", [SectionsController::class, 'report'])->middleware(['auth:api']); // report collection

    Route::get("quotations/sections/{id}/trashed", [SectionsController::class, 'trashed'])->where('id', '[a-zA-Z0-9-]+')->middleware(['auth:api']); // get collection by ID from trash

    // RESTORE data by ID (id), selected IDs (selected), and All data (all)
    Route::post("quotations/sections/{id}/restore", [SectionsController::class, 'restore'])->where('id', '[a-zA-Z0-9-]+')->middleware(['auth:api']); // restore collection by ID

    // DELETE data by ID (id), selected IDs (selected), and All data (all)
    Route::delete("quotations/sections/{id}/delete", [SectionsController::class, 'delete'])->where('id', '[a-zA-Z0-9-]+')->middleware(['auth:api']); // hard delete collection by ID

    Route::get("quotations/sections/{id}", [SectionsController::class, 'show'])->where('id', '[a-zA-Z0-9-]+')->middleware(['auth:api']); // get collection by ID
    Route::put("quotations/sections/{id}", [SectionsController::class, 'update'])->where('id', '[a-zA-Z0-9-]+')->middleware(['auth:api']); // update collection by ID
    Route::patch("quotations/sections/{id}", [SectionsController::class, 'patch'])->where('id', '[a-zA-Z0-9-]+')->middleware(['auth:api']); // patch collection by ID
    // DESTROY data by ID (id), selected IDs (selected), and All data (all)
    Route::delete("quotations/sections/{id}", [SectionsController::class, 'destroy'])->where('id', '[a-zA-Z0-9-]+')->middleware(['auth:api']); // soft delete a collection by ID

});
