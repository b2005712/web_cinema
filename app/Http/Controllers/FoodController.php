<?php

namespace App\Http\Controllers;

use App\Models\Food;
use App\Models\Post;
use Illuminate\Http\Request;

class FoodController extends Controller
{
    public function food()
    {
        $food = Food::orderBy('id', 'DESC')->Paginate(10);
        return view('admin.web.food', ['food' => $food]);
    }

    public function postCreate(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ], [
            'name.required' => 'Name is required',
        ]);
        if ($request->hasFile('Image')) {
            $file = $request->file('Image');
            $fileName = $file->getClientOriginalName();
            $food = new Food(
                [
                    'name' => $request->name,
                    'image' => $fileName,
                    'price' => $request->price,
                ]
            );
        }else{
            return redirect('admin/food')->with('warning','Vui lòng nhập hình ảnh');
        }
        $food->save();
        return redirect('admin/food')->with('success', 'Thêm thức ăn thành công!');
    }

    public function postEdit(Request $request, $id)
    {
        $food = Food::find($id);

        $request->validate([
            'name' => 'required'
        ], [
            'name.required' => "Nhập tên thực phẩm"
        ]);

        if ($request->hasFile('Image')) {
            $file = $request->file('Image');
            $fileName = $file->getClientOriginalName();
            $request['image'] = $fileName;
        }
        $food->update($request->all());
        return redirect('admin/food')->with('success', 'Updated Successfully!');
    }

    public function delete($id)
    {
        $food = Food::find($id);
        $food->delete();
        return response()->json(['success' => 'Delete Successfully']);
    }
    public function status(Request $request){
        $food = Food::find($request->food_id);
        $food['status'] = $request->active;
        $food->save();
        return response('success',200);
    }
}
