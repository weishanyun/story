<?php
/**
 * Note: 数据管理
 * User: Liu
 * Date: 2017/1/23
 */
namespace App\Http\Controllers\Admin;

use DB;
use Illuminate\Http\Request;

class DatabaseController extends BaseController
{
    /**
     * 显示所有表信息
     * @return mixed
     */
    public function getIndex()
    {
        $sql = 'SHOW TABLE STATUS FROM ' .  config('database.connections.mysql.database');
        $lists = DB::select($sql);
        $data = [
            'lists' => $lists
        ];
        return admin_view('database.index' , $data);
    }

    /**
     * 获取当前表字段信息
     * @param Request $request
     * @return array
     */
    public function getFields(Request $request)
    {
        $sql = 'SHOW FULL COLUMNS FROM `' . $request->table . '`';
        $lists = DB::select($sql);
        return $lists;
    }

    /**
     * 修复表
     * @return int
     */
    public function getRepair(Request $request)
    {
        $table = $request->table;
        $sql = 'REPAIR TABLE `'.$table.'`';
        $result = DB::query($sql);
        return $result ? 1 : 0;
    }

    /**
     * 优化表
     * @return int
     */
    public function getOptimize(Request $request)
    {
        $table = $request->table;
        $sql = 'OPTIMIZE TABLE `'.$table.'`';
        $result = DB::query($sql);
        return $result ? 1 : 0;
    }
}