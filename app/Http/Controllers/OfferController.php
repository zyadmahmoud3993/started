<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use Illuminate\Http\Request;

class OfferController extends Controller
{
    public function store(Request $request){
        $rq = $request->validate([
            'name'=>'required|unique:offers',
            'price'=>'required',
            'details'=>'required'
        ],
    [
        'name.required'=>__('message.name.required')
    ]);
        $inserted = Offer::create(
            
                $rq
            );
            return redirect()->back()->with(['message' => 'تم اضافة العرض بنجاح']);
 
    }

    public function create(){
        return view('offers.create');
    }
}
