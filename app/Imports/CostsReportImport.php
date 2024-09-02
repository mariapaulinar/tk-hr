<?php

namespace App\Imports;

use App\Models\CostsReport;
use Maatwebsite\Excel\Concerns\ToModel;

class CostsReportImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new CostsReport([
            //
        ]);
    }
}
