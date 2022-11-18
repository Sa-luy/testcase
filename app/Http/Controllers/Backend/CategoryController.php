<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Request;
use LDAP\Result;
use RealRashid\SweetAlert\Facades\Alert;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $categories = Category::latest('id', 'desc')->paginate(10);
        // dd($categories);

        return view('backend.category.index')->with('categories', $categories);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCategoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCategoryRequest $request)
    {
        //kjhgfds
        try {
            DB::beginTransaction();
            $data = collect($request->all())->except('_token');
            $category = Category::firstOrCreate($data->all());
            $category->save();
            DB::commit();
            Alert::success('Success Title', 'Success Message');

            return redirect()->route('categories.index');
        } catch (\Exception $e) {
            Log::error(
                'error',
                $e->getMessage() . 'line______' . $e->getLine()
            );
            DB::rollBack();
            abort(404);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        // $category = Category::find($id);
        return view('backend.category.show')->with('category', $category);
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $category = Category::find($id);

        return view('backend.category.edit')->with('category', $category);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCategoryRequest  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCategoryRequest $request, $id)
    {
        try {
            $category = Category::find($id);
            DB::beginTransaction();
            $data = collect($request->all())->except('_token', '_method');
            $category->update($data->all());
            DB::commit();

            return redirect()->route('categories.index');
        } catch (\Exception $e) {
            Log::error(
                'errors' . $e->getMessage() . ' getLine' . $e->getLine()
            );
            DB::rollBack();
            abort(403);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data=[];
        try{
            DB::beginTransaction();
        $category = Category::find($id);
        $category->delete();
        $data['statusCode'] = 200;
        $data['message'] = 'Delete Successfully';
        DB::commit();

        return response()->json($data,200);
    } catch (\Exception $e) {
        Log::error(
            'errors' . $e->getMessage() . ' getLine' . $e->getLine()
        );
        DB::rollBack();
        abort(403);
    }
    }
}
