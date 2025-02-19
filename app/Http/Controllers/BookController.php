<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Books;
use App\Http\Resources\BookResource;

class BookController extends Controller
{
    // Просмотр всех доступных книг (для пользователей)
    public function index()
    {
        $books = Books::all();
        return BookResource::collection($books);
    }

    // Создание книги (для библиотекарей)
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'    => 'required|string|max:255',
            'author'   => 'required|string|max:255',
            'quantity' => 'required|integer|min:1',
        ]);

        $books = Books::create($validated);
        return new BookResource($books);
    }

    // Просмотр деталей книги
    public function show(Books $books)
    {
        return new BookResource($books);
    }

    // Изменение данных книги
    public function update(Request $request, Books $books)
    {
        $validated = $request->validate([
            'title'    => 'sometimes|required|string|max:255',
            'author'   => 'sometimes|required|string|max:255',
            'quantity' => 'sometimes|required|integer|min:1',
        ]);

        $books->update($validated);
        return new BookResource($books);
    }

    // Удаление книги
    public function destroy(Books $books)
    {
        $books->delete();
        return response()->json(['message' => 'Книга удалена']);
    }

    // Пользователь берет книгу (пример реализации)
    public function borrow(Request $request)
    {
        // Здесь реализуйте логику проверки наличия книги, уменьшения количества и создания записи в таблице borrowed_books
        // Не забудьте добавить валидацию входящих данных, например, 'book_id' должен присутствовать
    }

    // Пользователь возвращает книгу (пример реализации)
    public function returnBook(Request $request)
    {
        // Реализуйте логику возврата книги, увеличение количества и удаление/обновление записи в borrowed_books
    }
}
