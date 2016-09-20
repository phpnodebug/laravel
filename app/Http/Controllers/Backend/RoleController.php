<?php

namespace App\Http\Controllers\Backend;

use App\Facades\RoleRepository;
use App\Http\Requests\Backend\RoleCreateForm;
use App\Http\Requests\Backend\RoleForm;
use App\Http\Requests\Backend\RoleUpdateForm;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pageSize = config('repository.pageSize');
        $data['info'] = RoleRepository::paginate(config('repository.pageSize'));
        $data['total'] = $data['info']->total();
        $data['pageCurrent'] = 1;
        $data['pageSize'] = $pageSize;
        return view('backend.role.index', compact("data"));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function search(Request $request)
    {
        $data=RoleRepository::searchInfo($request);
        $search=$request->input('search');
        return view("backend.role.index",compact('data','search'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.role.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $roleCreateForm =new RoleCreateForm();
        $this->checkForm($roleCreateForm,$request);
        try {
            if (RoleRepository::create($request->all())) {
                $this->ajaxReturn(['message'=>'角色添加成功','statusCode'=>200,'closeCurrent'=>true,'tabid'=>'roleslist']);
            }
        }
        catch (\Exception $e) {
            $this->ajaxReturn(['message'=>$e->getMessage(),'statusCode'=>300]);
        }
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
        $data = RoleRepository::find($id)->toArray();
        return view('backend.role.edit', compact('data'));
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
        $roleUpdateForm =new RoleUpdateForm();
        $this->checkForm($roleUpdateForm,$request);
        try{

           /* if($post = RoleRepository::firstByWhere([['name','=',$request->input('name')]])->count()){
                dd($post);
                $this->ajaxReturn(['message'=>'角色标识已存在！','statusCode'=>300]);
            }*/
            $role = RoleRepository::find($id);
            if($role->update($request->all())){
               $this->ajaxReturn(['message'=>'角色编辑成功','statusCode'=>200,'closeCurrent'=>true,'tabid'=>'roleslist']);
            }
        }catch (\Exception $e){
            $this->ajaxReturn(['message'=>$e->getMessage(),'statusCode'=>300]);
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        dd($id);
    }
}
