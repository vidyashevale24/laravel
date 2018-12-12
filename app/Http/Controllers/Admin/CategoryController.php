<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Category;
use View;
use Auth;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $module_name = "";
    protected $model = "";
    protected $route_path = "category";
    protected $view_path = "admin.category";
    public function __construct(){
        // parent::__construct();
        $this->module_name = "Category";
        $this->model = new Category;
        View::share('module_name',$this->module_name);
        View::share('route_path',$this->route_path);
    }
 
    public function index(Request $request)
    {
        $where = array();
        $search = $request->all();
        if( $request->has('search') ){
            $search = $request->get('user_search');
            $where[] = [
                'field' => 'name',
                'value' => '%'.$search.'%',
                'operation' => 'LIKE',
            ];
        }
        $items = $this->model->getAll($where);
        
        return view($this->view_path.'.index',compact('items'))
            ->with('i', ($request->input('page', 1) - 1) * env('PER_PAGE'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view($this->view_path.'.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'slug' => 'required',
            'description' => 'required',
        ]);
        $inder_data = $request->except(['_token','submit']);
        $inder_data['user_id'] = Auth::user()->id; 
        $this->model->create($inder_data);
        return redirect()->route($this->route_path.'.index')
                        ->with('success',$this->module_name.' created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       $item = $this->model->find($id);
        return view($this->view_path.'.edit',compact('item'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'slug' => 'required',
            'description' => 'required',
        ]);
        
        $inder_data = $request->except(['_token','_method','submit']);
        $inder_data['user_id'] = Auth::user()->id;
        $this->model->find($id)->update($inder_data);
        return redirect()->route($this->route_path.'.index')
                        ->with('success',$this->module_name.' updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->model->find($id)->delete();
        return redirect()->route($this->route_path.'.index')
                        ->with('success',$this->module_name.' deleted successfully');
   
    }
}
