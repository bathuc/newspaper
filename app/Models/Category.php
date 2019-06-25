<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'category';
    public $timestamps = false;

    public static function getLevel()
    {
        // default level is 2
        $level = !empty(env('CATEGORY_LEVEL'))? env('CATEGORY_LEVEL') : 2;
        return $level;
    }

    /*
     * $fetchAll: get all category, include category has been set to disable
     */
    public static function getChildList($id, $level=3, $tryTime=1, $fetchAll=false)
    {
        // menu 3 level
        if($tryTime == $level){
            return null;
        }

        $childList = [];
        $categoryList = null;

        if($fetchAll) {
            $categoryList = self::where('parent_id',$id)
                ->orderby('order')
                ->get()->toArray();
        }
        else{
            $categoryList = self::where('parent_id',$id)
                ->where('active_flg', 1)
                ->orderby('order')
                ->get()->toArray();
        }

        if(empty($categoryList)){
            return null;
        }

        foreach ($categoryList as $item) {
            $custom = $item;
            $custom['child'] = self::getChildList($item['id'],$level, $tryTime + 1, $fetchAll);
            $childList[] = $custom;
        }

        return $childList;
    }

    /*
     * $fetchAll: get all category, include category has been set to disable
     */
    public static function getCategoryList($fetchAll=false)
    {
        $result = [];
        $level =  self::getLevel();
        if($fetchAll) {
            $topCategory = self::where('parent_id',0)
                ->orderby('order')
                ->get()->toArray();
        }
        else{
            $topCategory = self::where('parent_id',0)
                ->where('active_flg', 1)
                ->orderby('order')
                ->get()->toArray();
        }

        foreach ($topCategory as $item) {
            $custom = $item;
            $custom['child'] = self::getChildList($item['id'], $level, null, $fetchAll);
            $result[] = $custom;
        }
        return $result;
    }

    public static function getSpace($time)
    {
        $space = '';
        for($i=0; $i<$time;$i++) {
            $space .= '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
            $space .= '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
        }
        return $space;
    }

    public static function getChildView(&$result, $categoryList, $tryTime=1)
    {
        if(empty($categoryList)) {
            return;
        }
        foreach ($categoryList as $category){
            $custom = $category;
            $custom['name_view'] = self::getSpace($tryTime) . $category['name'];
            $custom['level'] = $tryTime;
            unset($custom['child']);
            $result[] = $custom;
            self::getChildView($result,$category['child'], $tryTime + 1);
        }
    }

    /*
     * $fetchAll: get all category, include category has been set to disable
     */
    public static function getCategoryView($fetchAll=false)
    {
        $result = [];
        $category = self::getCategoryList($fetchAll);
        self::getChildView($result,$category);

        return $result;
    }

    public static function swapOrder($fromId, $toId)
    {
        $fromCategory = Category::find($fromId);
        $toCategory = Category::find($toId);

        $fromOrder = $fromCategory->order;
        $toOrder = $toCategory->order;

        // swap here
        $fromCategory->order = $toOrder;
        $fromCategory->save();

        $toCategory->order = $fromOrder;
        $toCategory->save();
    }

    public function posts()
    {
        // user_id là khóa ngoại của bảng Phone
        return $this->hasOne('App\Models\Post', 'category_id');
    }
}
