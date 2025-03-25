<?php

namespace App\Livewire;

use App\Models\Author;
use App\Models\Book;
use App\Models\BookAuthors;
use App\Models\BookCategories;
use App\Models\Category;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Storage;

class AdminBookComp extends Component
{
    use WithPagination;
    use WithFileUploads;
    public $search;
    public $cover, $title, $deskripsi, $author, $publisher, $category_id, $realese_date, $stock, $status, $type;
    public $editId;
    public $showId;
    public $confirmDelete;
    // public $zoomImage;

    public $authorsShow = null;
    public $authorsData = null;
    public $authorsAdd = [];
    public $authorsDelete = [];
    public $authorsNew = [];

    public $categoriesShow = null;
    public $categoriesData = null;
    public $categoriesAdd = [];
    public $categoriesDelete = [];
    public $categoriesNew = [];
    public $image_baru;


    public function render()
    {
        $data = Book::when($this->search, function ($query) {
            $query->where('title', 'like', '%' . $this->search . '%')
                ->orWhere('deskripsi', 'like', '%' . $this->search . '%')
                ->orWhere('author', 'like', '%' . $this->search . '%')
                ->orWhere('publisher', 'like', '%' . $this->search . '%');
        })
            ->orderby('created_at', 'desc')
            ->paginate('10');


        return view('livewire.admin-book-comp', compact('data'))->extends('layouts.master-admin');
    }
    public function updatedSearch()
    {
        $this->resetPage();
    }


    public function addToDeleteAuthor($id)
    {
        if (!in_array($id, $this->authorsDelete)) {
            $this->authorsDelete[] = $id;
        }
    }
    public function removeToDeleteAuthor($id)
    {
        if (($key = array_search($id, $this->authorsDelete)) !== false) {
            unset($this->authorsDelete[$key]);
        }
    }

    public function addToDeleteCategory($id)
    {
        if (!in_array($id, $this->categoriesDelete)) {
            $this->categoriesDelete[] = $id;
        }
    }
    public function removeToDeleteCategory($id)
    {
        if (($key = array_search($id, $this->categoriesDelete)) !== false) {
            unset($this->categoriesDelete[$key]);
        }
    }


    public function store()
    {
        $this->validate([
            'title' => 'required',
            'deskripsi' => 'required',
            'publisher' => 'required',
            'realese_date' => 'date',
            'stock' => 'required|numeric',
            'status' => 'required',
            'type' => 'required',
        ]);

        $data = new Book();
        $data->title = $this->title;
        $data->deskripsi = $this->deskripsi;
        $data->publisher = $this->publisher;
        $data->realese_date = $this->realese_date;
        $data->stock = $this->stock;
        $data->status = $this->status;
        $data->type = $this->type;

        foreach ($this->authorsAdd as $authorIdNew) {
            if (ctype_digit($authorIdNew)) {

                $authorsData = new BookAuthors();
                $authorsData->book_id = $data->id;
                $authorsData->author_id = $authorIdNew;
                $authorsData->save();
            } else {
                $authorsDataCreate = new Author();
                $authorsDataCreate->name = $authorIdNew;
                $authorsDataCreate->save();

                $authorsData = new BookAuthors();
                $authorsData->book_id = $data->id;
                $authorsData->author_id = $authorsDataCreate->id;
                $authorsData->save();
            }
        }
        foreach ($this->authorsDelete as $authorIdDelete) {
            $authorsDelete = BookAuthors::where('book_id', $data->id)->where('author_id', $authorIdDelete)->first();
            $authorsDelete->delete();
        }

        //kategori
        foreach ($this->categoriesAdd as $categoryIdNew) {
            if (ctype_digit($categoryIdNew)) {

                $categoriesData = new BookCategories();
                $categoriesData->book_id = $data->id;
                $categoriesData->category_id = $categoryIdNew;
                $categoriesData->save();
            } else {
                $categoriesDataCreate = new Category();
                $categoriesDataCreate->name = $categoryIdNew;
                $categoriesDataCreate->save();

                $categoriesData = new BookCategories();
                $categoriesData->book_id = $data->id;
                $categoriesData->category_id = $categoriesDataCreate->id;
                $categoriesData->save();
            }
        }
        foreach ($this->categoriesDelete as $categoryIdDelete) {
            $categoriesDelete = BookCategories::where('book_id', $data->id)->where('category_id', $categoryIdDelete)->first();
            $categoriesDelete->delete();
        }


        $currentTimestamp = time();
        if ($this->image_baru != null) {
            $this->validate([
                'image_baru' => 'mimes:png,jpg,jpeg,webp|max:1096', // 1MB Max
            ]);

            $gambarLama = $data->cover;
            if ($gambarLama && Storage::disk('real_public')->exists('images/books/' . $gambarLama)) {
                Storage::disk('real_public')->delete('images/books/' . $gambarLama);
            }

            $fileNameimage = 'cover' . '_' . $currentTimestamp . '.' . $this->image_baru->getClientOriginalExtension();
            $filePath = $this->image_baru->storeAs(('images/books/'), $fileNameimage, 'real_public');
            $data->cover = $fileNameimage;
        }



        if ($data->save()) {
            $this->dispatch('close-modal');
            LivewireAlert::title('Data Berhasil Disimpan!')
                ->position('top-end')
                ->toast()
                ->success()
                ->show();
            $this->resetInput();
        } else {
            LivewireAlert::title('Data Gagal Disimpan!')
                ->position('top-end')
                ->toast()
                ->error()
                ->show();
        }
    }

    public function edit($id)
    {
        $this->showId = null;
        $this->editId = $id;
        $data = Book::find($id);
        $this->title = $data->title;
        $this->cover = $data->cover;
        $this->deskripsi = $data->deskripsi;
        $this->publisher = $data->publisher;
        $this->realese_date = $data->realese_date;
        $this->stock = $data->stock;
        $this->status = $data->status;
        $this->type = $data->type;

        $this->categoriesShow = BookCategories::where('book_id', $data->id)->get();
        $categoriesNotShow = $this->categoriesShow->pluck('category_id')->diff($this->categoriesDelete);
        $this->categoriesData = Category::whereNotIn('id', $categoriesNotShow)->get();


        $this->authorsShow = BookAuthors::where('book_id', $data->id)->get();
        $authorsNotShow = $this->authorsShow->pluck('author_id')->diff($this->authorsDelete);
        $this->authorsData = Author::whereNotIn('id', $authorsNotShow)->get();
    }
    public function show($id)
    {
        $this->editId = null;
        $this->showId = $id;
        $data = Book::find($id);
        $this->title = $data->title;
        $this->cover = $data->cover;
        $this->deskripsi = $data->deskripsi;
        $this->publisher = $data->publisher;
        $this->realese_date = $data->realese_date;
        $this->stock = $data->stock;
        $this->status = $data->status;
        $this->type = $data->type;

        $this->categoriesShow = BookCategories::where('book_id', $data->id)->get();
        $this->authorsShow = BookAuthors::where('book_id', $data->id)->get();
    }


    public function storeEdit()
    {
        $this->validate([
            'title' => 'required',
            'deskripsi' => 'required',
            'publisher' => 'required',
            'realese_date' => 'date',
            'stock' => 'required|numeric',
            'status' => 'required',
            'type' => 'required',
        ]);

        $id = $this->editId;
        $data = Book::find($id);
        $data->title = $this->title;
        $data->deskripsi = $this->deskripsi;
        $data->publisher = $this->publisher;
        $data->realese_date = $this->realese_date;
        $data->stock = $this->stock;
        $data->status = $this->status;
        $data->type = $this->type;

        foreach ($this->authorsAdd as $authorIdNew) {
            if (ctype_digit($authorIdNew)) {

                $authorsData = new BookAuthors();
                $authorsData->book_id = $id;
                $authorsData->author_id = $authorIdNew;
                $authorsData->save();
            } else {
                $authorsDataCreate = new Author();
                $authorsDataCreate->name = $authorIdNew;
                $authorsDataCreate->save();

                $authorsData = new BookAuthors();
                $authorsData->book_id = $id;
                $authorsData->author_id = $authorsDataCreate->id;
                $authorsData->save();
            }
        }
        foreach ($this->authorsDelete as $authorIdDelete) {
            $authorsDelete = BookAuthors::where('book_id', $id)->where('author_id', $authorIdDelete)->first();
            $authorsDelete->delete();
        }

        //kategori
        foreach ($this->categoriesAdd as $categoryIdNew) {
            if (ctype_digit($categoryIdNew)) {

                $categoriesData = new BookCategories();
                $categoriesData->book_id = $id;
                $categoriesData->category_id = $categoryIdNew;
                $categoriesData->save();
            } else {
                $categoriesDataCreate = new Category();
                $categoriesDataCreate->name = $categoryIdNew;
                $categoriesDataCreate->save();

                $categoriesData = new BookCategories();
                $categoriesData->book_id = $id;
                $categoriesData->category_id = $categoriesDataCreate->id;
                $categoriesData->save();
            }
        }
        foreach ($this->categoriesDelete as $categoryIdDelete) {
            $categoriesDelete = BookCategories::where('book_id', $id)->where('category_id', $categoryIdDelete)->first();
            $categoriesDelete->delete();
        }


        $currentTimestamp = time();
        if ($this->image_baru != null) {
            $this->validate([
                'image_baru' => 'mimes:png,jpg,jpeg,webp|max:1096', // 1MB Max
            ]);

            $gambarLama = $data->cover;
            if ($gambarLama && Storage::disk('real_public')->exists('images/books/' . $gambarLama)) {
                Storage::disk('real_public')->delete('images/books/' . $gambarLama);
            }

            $fileNameimage = 'cover' . '_' . $currentTimestamp . '.' . $this->image_baru->getClientOriginalExtension();
            $filePath = $this->image_baru->storeAs(('images/books/'), $fileNameimage, 'real_public');
            $data->cover = $fileNameimage;
        }

        if ($data->save()) {
            $this->dispatch('close-modal');
            LivewireAlert::title('Data Berhasil Diubah!')
                ->position('top-end')
                ->toast()
                ->success()
                ->show();
            $this->resetInput();
        } else {
            LivewireAlert::title('Data Gagal Diubah!')
                ->position('top-end')
                ->toast()
                ->error()
                ->show();
        }
    }
    public function resetInput()
    {
        $this->title = '';
        $this->deskripsi = '';
        $this->publisher = '';
        $this->realese_date = '';
        $this->stock = '';
        $this->type = '';
        $this->status = '';
        $this->editId = '';
        $this->showId = '';
        // $this->zoomImage = '';
        $this->authorsShow = null;
        $this->authorsAdd = [];
        $this->authorsDelete = [];
        $this->authorsNew = [];
        $this->categoriesShow = null;
        $this->categoriesAdd = [];
        $this->categoriesDelete = [];
        $this->categoriesNew = [];
        $this->image_baru = null;
    }
    public function delete($id)
    {
        $data = Book::where('id', $id)->first();
        if ($data->delete()) {
            LivewireAlert::title('Data berhasil dihapus!')
                ->position('top-end')
                ->toast()
                ->success()
                ->show();
        } else {
            LivewireAlert::title('Data gagal dihapus!')
                ->position('top-end')
                ->toast()
                ->error()
                ->show();
        }
    }
}
