<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use SheetDB\SheetDB;

class SheetdbController extends Controller
{
    //
    public function get() 
    {
        $sheetdb = new SheetDB('maehecn1zbopc');
        //dd($sheetdb->get());

        //$jsonSheetdb = json_encode($sheetdb->get());
        //echo $jsonSheetdb;
        $search = $sheetdb->search(['size'=>'17']);
        $searchResult = json_encode($search);
        echo $searchResult;
    }
}
