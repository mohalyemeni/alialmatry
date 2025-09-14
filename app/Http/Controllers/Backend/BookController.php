<?php

namespace App\Http\Controllers\Backend;

use App\Models\Book;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use App\Http\Requests\Backend\BookRequest;

class BookController extends Controller
{
    protected $imageManager;

    public function __construct()
    {
        $this->imageManager = new ImageManager(new Driver());
    }

    public function index(Request $request)
    {
        if (!auth()->user()->ability('admin', 'manage_books,show_books')) {
            return redirect('admin/index');
        }

        $books = Book::when($request->keyword, fn($q) => $q->where('title', 'like', '%'.$request->keyword.'%'))
            ->when($request->status !== null, fn($q) => $q->where('status', $request->status))
            ->orderBy($request->sort_by ?? 'created_at', $request->order_by ?? 'desc')
            ->paginate($request->limit_by ?? 10);

        return view('backend.books.index', compact('books'));
    }

    public function create()
    {
        if (!auth()->user()->ability('admin', 'create_book')) {
            return redirect('admin/index');
        }
        return view('backend.books.create');
    }

    public function store(BookRequest $request)
    {
        if (!auth()->user()->ability('admin', 'create_book')) {
            return redirect('admin/index');
        }

        $book = new Book();
        $book->title = $request->title;
        $book->slug = Str::slug($request->title);
        $book->description = $request->description;
        $book->status = $request->status;

        if ($request->hasFile('img')) {
            $image = $request->file('img');
            $imageName = 'book_' . time() . '.' . $image->getClientOriginalExtension();
            $imagePath = public_path('assets/books/images/' . $imageName);
            $this->imageManager->read($image->getRealPath())->scale(width: 800)->save($imagePath, 90);
            $book->img = $imageName;
        }

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = 'file_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('assets/books/files'), $fileName);
            $book->file = $fileName;
        }

        $book->save();

        return redirect()->route('admin.books.index')->with([
            'message' => 'تم اضافة الكتاب/المؤلف بنجاح',
            'alert-type' => 'success',
        ]);
    }

    public function edit($id)
    {
        if (!auth()->user()->ability('admin', 'update_book')) {
            return redirect('admin/index');
        }

        $book = Book::findOrFail($id);
        return view('backend.books.edit', compact('book'));
    }

    public function update(BookRequest $request, $id)
    {
        if (!auth()->user()->ability('admin', 'update_book')) {
            return redirect('admin/index');
        }

        $book = Book::findOrFail($id);
        $book->title = $request->title;
        $book->slug = Str::slug($request->title);
        $book->description = $request->description;
        $book->status = $request->status;

        if ($request->hasFile('img')) {
            $oldImagePath = public_path('assets/books/images/' . $book->img);
            if (File::exists($oldImagePath)) File::delete($oldImagePath);
            $image = $request->file('img');
            $imageName = 'book_' . time() . '.' . $image->getClientOriginalExtension();
            $imagePath = public_path('assets/books/images/' . $imageName);
            $this->imageManager->read($image->getRealPath())->scale(width: 800)->save($imagePath, 90);
            $book->img = $imageName;
        }

        if ($request->hasFile('file')) {
            $oldFilePath = public_path('assets/books/files/' . $book->file);
            if (File::exists($oldFilePath)) File::delete($oldFilePath);
            $file = $request->file('file');
            $fileName = 'file_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('assets/books/files'), $fileName);
            $book->file = $fileName;
        }

        $book->save();

        return redirect()->route('admin.books.index')->with([
            'message' => 'تم تحديث الكتاب/المؤلف بنجاح',
            'alert-type' => 'success',
        ]);
    }

    public function destroy($id)
    {
        if (!auth()->user()->ability('admin', 'delete_book')) {
            return redirect('admin/index');
        }

        $book = Book::findOrFail($id);

        if ($book->img && File::exists(public_path('assets/books/images/' . $book->img))) {
            File::delete(public_path('assets/books/images/' . $book->img));
        }

        if ($book->file && File::exists(public_path('assets/books/files/' . $book->file))) {
            File::delete(public_path('assets/books/files/' . $book->file));
        }

        $book->delete();

        return redirect()->route('admin.books.index')->with('success', 'تم حذف الكتاب/المؤلف بنجاح');
    }

    public function remove_image(Request $request)
    {
        if (!auth()->user()->ability('admin', 'delete_book')) {
            return response()->json(['status' => false, 'message' => 'ليس لديك صلاحية']);
        }

        $book = Book::findOrFail($request->id);
        $imagePath = public_path('assets/books/images/' . $book->img);
        if (File::exists($imagePath)) {
            File::delete($imagePath);
            $book->img = null;
            $book->save();
        }

        return response()->json(['status' => true, 'message' => 'تم حذف الصورة']);
    }

    public function remove_file(Request $request)
    {
        if (!auth()->user()->ability('admin', 'delete_book')) {
            return response()->json(['status' => false, 'message' => 'ليس لديك صلاحية']);
        }

        $book = Book::findOrFail($request->id);
        $filePath = public_path('assets/books/files/' . $book->file);
        if (File::exists($filePath)) {
            File::delete($filePath);
            $book->file = null;
            $book->save();
        }

        return response()->json(['status' => true, 'message' => 'تم حذف الملف']);
    }

    public function toggleStatus(Request $request)
    {
        if ($request->ajax()) {
            $request->validate([
                'book_id' => 'required|integer|exists:books,id',
            ]);

            $book = Book::findOrFail($request->book_id);
            $book->status = !$book->status;
            $book->save();

            return response()->json([
                'status' => $book->status,
                'book_id' => $book->id,
            ]);
        }

        return response()->json(['error' => 'Invalid request'], 400);
    }
}