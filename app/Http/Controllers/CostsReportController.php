<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CostsReportController extends Controller
{
    public function import()
    {
        return view('costs-reports.import');
    }

    public function status()
    {
        return view('costs-reports.status');
    }

    public function report()
    {
        return view('costs-reports.report');
    }
}
