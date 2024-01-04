<?php

namespace App\Imports;

use App\Models\Size;


use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class SizesImport implements ToModel, WithHeadingRow
{
    public $lang = [
        ['name' => 'english', 'code' => 'en'],
        ['name' => 'arabic', 'code' => 'ar'],
    ];

    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        $size = new Size();
        $size->save();

        foreach ($this->lang as $lang) {
            $size->translateOrNew($lang['code'])->name = $row['name_' . $lang['code']];
        }

        $size->save();
    }
}
