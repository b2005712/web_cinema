<?php

namespace App\Http\Controllers;

use App\Models\Combo;
use App\Models\Food;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ComboController extends Controller
{

    public function combo()
    {
        $foods = Food::all();
        $combos = Combo::orderBy('id', 'DESC')->paginate(10);
        return view('admin.web.combo', [
            'combos' => $combos,
            'foods' => $foods
        ]);
    }

    public function postCreate(Request $request)
    {
//        dd($request->food[0]);
        $request->validate([
            'name' => 'required'
        ], [
            'name.required' => 'Name is required',
        ]);
        if ($request->hasFile('Image')) {
            $file = $request->file('Image');
            $fileName = $file->getClientOriginalName();
            $combo = new Combo(
                [
                    'name' => $request->name,
                    'image' => $fileName,
                    'price' => $request->price,
                    'created_at' => Carbon::today(),
                ]
            );
        }else{
            return redirect('admin/combo')->with('warning','Vui lòng nhập hình ảnh');
        }
        $combo->save();

        for ($i = 0; $i < count($request->food); $i++) {
            $food = Food::find($request->food[$i]);
            $combo->foods()->attach($food, ['quantity' => $request->quantity[$i]]);
        }

        return redirect('admin/combo')->with('success', 'Add Combo Successfully!');
    }

    public function postEdit(Request $request, $id)
    {
        $combo = Combo::find($id);
        $request->validate([
            'name' => 'required'
        ], [
            'name.required' => "Please enter Combo's name"
        ]);

        if ($request->hasFile('Image')) {
            $file = $request->file('Image');
            $fileName = $file->getClientOriginalName();
            $combo->image = $fileName;
        }
        $combo->name = $request->name;
        $combo->price = $request->price;

        $combo->foods()->detach();
        for ($i = 0; $i < count($request->food); $i++) {
            $food = Food::find($request->food[$i]);
            $combo->foods()->attach($food, ['quantity' => $request->quantity[$i]]);
        }

        $combo->save();
        return redirect('admin/combo')->with('success', 'Updated Successfully!');
    }

    public function delete($id)
    {
        $combo = Combo::find($id);
        $combo->delete();
        return response()->status(200);
    }

    public function status(Request $request)
    {
        $combo = Combo::find($request->combo_id);
        $combo['status'] = $request->active;
        $combo->save();
        return response('success', 200);
    }
}
