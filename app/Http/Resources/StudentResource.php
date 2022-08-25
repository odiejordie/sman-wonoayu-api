<?php

namespace App\Http\Resources;

use App\Models\Book;
use Illuminate\Http\Resources\Json\JsonResource;

class StudentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            "id" => $this->id,
            "receipt_number" => $this->receipt_number,
            "student_number" => $this->student_number,
            "name" => $this->name,
            "class" => $this->class,
            "borrow_date" => date("Y-m-d", strtotime($this->borrow_date)),
            "return_date" => date("Y-m-d", strtotime($this->return_date)),
            "borrow_status" => $this->borrow_status,
            "books_id" => $this->books($this->booksId),
        ];
    }

    public function books($bookId)
    {
        $books = Book::whereIn("id", $bookId->pluck("book_id"))->get();
        return BookResource::collection($books);
    }
}
