<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Catelogue;
use Illuminate\Http\Request;
use App\Http\Requests\StoreCatelogueRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class CatelogueController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    const PATH_VIEW='admin.catelogues.';
    const PATH_UPLOAD='catelogues';
    public function index()
    {
        $data=Catelogue::query()
        ->latest('id')
        ->paginate(5);
        // dd($data);
        return view(self::PATH_VIEW.__FUNCTION__,compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view(self::PATH_VIEW.__FUNCTION__);
    }
    /**
     * Store a newly created resource in storage.s
     */
    public function store(StoreCatelogueRequest $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'cover' => ['required','image','mimes:jpeg,png,jpg,gif','max:2048'],
        ], [
            'cover.required'=> 'Tệp là bắt buộc',
            'cover.image'=> 'Tệp bắt buộc là hình ảnh',
            'cover.mimes'=> 'Hình ảnh là các tệp loại:jpeg,png,jpg,gif',
            'cover.max'=> 'Kích thước ảnh không vượt quá 2048 kylobytes',
        ]);

        $data = $request->except('cover');
        $data['is_active'] = ($request->is_active == 'on') ? 1 : 0;

        if ($request->hasFile('cover')) {
            $data['cover'] = Storage::put(self::PATH_UPLOAD, $request->file('cover'));
        }

        $res = Catelogue::query()->create($data);

        if ($res) {
            return view('admin.catelogues.create', compact('errors'))->with('success', 'Thêm danh mục thành công'); // Added success message
        } else {
            return view('admin.catelogues.create', compact('errors'))->with('error', 'Sản phẩm không thêm thành công'); // Added error message
        }
    }
    

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data=Catelogue::query()->findOrFail($id);
        // dd($catelogue);
        return view(self::PATH_VIEW.__FUNCTION__,compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $catelogue=Catelogue::query()->findOrFail($id);
        // dd($catelogue);
        return view(self::PATH_VIEW.__FUNCTION__,compact('catelogue'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $model=Catelogue::query()->findOrFail($id);
        $data=$request->except('cover');
        $data['is_active']=($request->is_active=='on'?1:0);
        // dd($data['is_active']); 
        if($request->hasFile('cover')){
            $data['cover']=Storage::put(self::PATH_UPLOAD,$request->file('cover'));
        }
        $currentCover=$model->cover;
        $check=$model->update($data);
        if($currentCover&&$request->hasFile('cover')&&Storage::exists($currentCover)){
            Storage::delete($currentCover);
        }
        if($check){
        $data=Catelogue::query()
        ->latest('id')
        ->paginate(5);
        // dd($data);
        return view(self::PATH_VIEW.'index',compact('data'));
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $model=Catelogue::query()->findOrFail($id);
        $model->delete();
        return redirect()->route('admin.catelogues.index');
    }
    // view
    public function trash(){
        $datas=Catelogue::onlyTrashed()->get();
        // dd($datas)->toArray();
        return view(self::PATH_VIEW.__FUNCTION__,compact('datas'));
    }
    public function forceDelete($id){
        $catelogue=Catelogue::onlyTrashed()->findOrFail($id);
        $catelogue->forceDelete();
        return redirect()->route('admin.catelogues.trash');
    }
    public function restore($id){
        $catelogue=Catelogue::onlyTrashed()->findOrFail($id);
        $catelogue->restore();
        return redirect()->route('admin.catelogues.index');
    }
}
