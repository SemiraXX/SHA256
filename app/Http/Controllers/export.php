<?php

namespace App\Http\Controllers;
use App\Exports\reportschecked;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;

class export extends Controller
{
    //
    public function exportreports() 
    {
        return Excel::download(new reportschecked, 'sample.xlsx');
    }
}
