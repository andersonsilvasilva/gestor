<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\BookImport;
use Exception;
use Maatwebsite\Excel\Facades\Excel;

class BookController extends Controller
{
    public function index()
    {
        return view('books.create');
    }
    public function store(Request $request)
    {
        $file = $request->file;
        if($file) {
            try
            {

                Excel::import(new BookImport, time(). '.xlsx');
            }
            catch(Exception $ex)
            {
                dd($ex);
            }
        }
    }
}
