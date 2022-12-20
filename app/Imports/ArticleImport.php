<?php

namespace App\Imports;

use App\Models\Article;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ArticleImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Article([
            'atl_title'     => $row['atl_title'],
            'atl_slug'    => Str::slug($row['atl_title']),
            'atl_type'     => $row['atl_type'],
            'atl_topic'     => $row['atl_topic'],
            'atl_photo'     => $row['atl_photo'],
            'atl_descript'  => $row['atl_descript'],
            'atl_content'     => $row['atl_content'],
        ]);
    }
}
