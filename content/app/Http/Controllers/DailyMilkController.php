<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator,Redirect,Response;
use App\daily_milk;

class DailyMilkController extends Controller
{

    /**

     * Create a new controller instance.

     *

     * @return void

     */

    public function DailyMilker(Request $request) {
        $request->validate([
            'cow_id' => 'required|numeric|min:1',
            'milk_volume' => 'required|numeric|min:1'
        ]);
             
        $data = $request->all();
        $data['milk_datetime'] = 'NOW()';
        
        $check = daily_milk::insert($data);
  
        $arr = array('msg' => 'Something goes to wrong. Please try again later', 'status' => false);
        
        if ($check) { 
            $arr = array('msg' => 'Successfully submit form using ajax', 'status' => true);
        }

        return Response()->json($arr);
    }
}
