<?php

namespace App\Exports;

use App\Models\reports;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;

class reportschecked implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        
 
        if(session()->has('datefrom') && session()->has('dateto'))
        {
            $reports = DB::table('tbl_reports')
            ->whereBetween('created_at', [session('datefrom'), session('dateto')])
            ->orderby('id', 'ASC')->get(); 
        }
        else
        {
            $reports = reports::orderby('id', 'ASC')->get();

        }

        return $reports;

    }
}
