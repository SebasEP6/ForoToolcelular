<?php

namespace Foro\Http\Controllers;

use Illuminate\Http\Request;

use Foro\Http\Requests;
use Foro\Http\Controllers\Controller;

use Foro\Ad;

class AdminController extends Controller
{
    public function market()
    {
    	$ads = Ad::get();

    	return view('admin.market', compact('ads'));
    }

    public function postMarket(Request $request)
    {
    	$items = [
    		'name'  => $request->name,
            'link_path' => $request->link_path,
    		'image' => $request->file('logo')
    	];

        $rules = [
        	'name'  => 'required',
        	'image' => 'required|mimes:jpg,jpeg,png,gif'
        ];

        $validate = \Validator::make($items, $rules);

        if ($validate->fails())
        {
            return redirect()->back()->withErrors($validate)->withInput();
        }

        $name = $items['image']->getClientOriginalName();
        \Storage::disk('local')->put($name,  \File::get($items['image']));

    	$ad = new Ad();
    	$ad->text = $items['name'];
    	$ad->path = 'uploads/'.$name;
        $ad->link_path = $items['link_path'];
    	$ad->save();

    	return redirect()->back();
    }

    public function delete($i)
    {
    	$ad = Ad::findOrFail($i);

    	unlink(public_path().'/'.$ad->path);

    	$ad->delete();

    	return redirect()->back();
    }
}