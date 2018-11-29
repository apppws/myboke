<?php

namespace app\controller;

use think\Controller;
use think\Request;
use app\model\Sorts;

class Sort extends Controller
{
    protected $middleware = ['Check'];
    /**
     * 显示分类列表
     *
     * @return \think\Response
     */
    public function index()
    {
        $data['sorts'] = Sorts::select();
        return view('',$data);
    }

    /**
     * 保存新建的分类
     *
     * @param  \think\Request  $req
     * @return \think\Response
     */
    public function save(Request $req, Sorts $sort)
    {
        $data = $req->param();
        $req = $sort->save($data);
        if($req){
           return $this->success('添加成功'); 
        }
        return $this->error('添加失败');
    }

    /**
     * 保存更新的分类
     *
     * @param  \think\Request  $req
     * @param  int  $id
     * @return \think\Response
     */
    public function update(Request $req, $id)
    {
        $sort = Sorts::get($id);
        $sort->sort_name = $req->sort_name;
        if($sort->save()){
            return $this->success('修改成功');
        }
        return $this->error('修改失败');
    }

    /**
     * 删除指定分类
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function delete($id)
    {
        $sort = Sorts::get($id);
        if($sort->delete()){
            return $this->success('删除成功');
        }
        return $this->error('删除失败');
    }
}
