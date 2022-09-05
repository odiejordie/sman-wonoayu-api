<?php

namespace App\Imports;

use App\Models\Book;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class BookImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        if ($row["judul"]) {
            return Book::updateOrCreate(
                ["collection_code" => $row["no_induk"]],
                [
                    "collection_title" => $row["judul"],
                    "author" => $row["pengarang"],
                    "publisher" => $row["penerbit"],
                    "stock" => 1,
                ]
            );
        }
    }
}
