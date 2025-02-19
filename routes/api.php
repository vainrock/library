<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\LibrarianAuthController;

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:api');

Route::middleware('auth:api')->group(function() {
    // Просмотр доступных книг
    Route::get('books', [BookController::class, 'index']);
    // Взятие книги (передаем, например, id книги)
    Route::post('borrow', [BookController::class, 'borrow']);
    // Сдача книги (передаем id записи о взятой книге или id книги)
    Route::post('return', [BookController::class, 'returnBook']);
});

Route::post('librarian/login', [LibrarianAuthController::class, 'login']);
Route::post('librarian/logout', [LibrarianAuthController::class, 'logout'])->middleware('auth:librarian');

Route::middleware('auth:librarian')->group(function() {
    // Создание книги
    Route::post('books', [BookController::class, 'store']);
    // Просмотр книги (детали)
    Route::get('books/{book}', [BookController::class, 'show']);
    // Изменение книги
    Route::put('books/{book}', [BookController::class, 'update']);
    // Удаление книги
    Route::delete('books/{book}', [BookController::class, 'destroy']);
});
