<?php



namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    function testDashboard_component_renders_correctly_with_stats()
    {

        $data = Bookmark::select('bookmark.*')
            ->addSelect(DB::raw('(
                SELECT GROUP_CONCAT(authors.name SEPARATOR ", ")
                FROM book_authors
                JOIN authors ON authors.id = book_authors.author_id
                WHERE book_authors.book_id = bookmark.book_id
            ) as authors'))
            ->when($this->search, function ($query) {
                $search = '%' . $this->search . '%';
                $query->whereHas('book', function ($query) use ($search) {
                    $query->where('title', 'like', $search);
                })
                    ->orWhereRaw('(SELECT GROUP_CONCAT(authors.name SEPARATOR ", ")
                                    FROM book_authors
                                    JOIN authors ON authors.id = book_authors.author_id
                                    WHERE book_authors.book_id = bookmark.book_id) like ?', [$search]);
            })
            ->orderBy('created_at', 'desc')
            ->where('user_id', $this->user->id)
            ->paginate(30);


        $this->assertIsObject($data);
    }
}
