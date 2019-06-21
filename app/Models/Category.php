<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'category';
    public $timestamps = false;

    public static function getChildList($id, $level=3, $tryTime=1)
    {
        // menu 3 level
        if($tryTime == $level){
            return null;
        }

        $childList = [];
        $categoryList = self::where('parent_id',$id)->get()->toArray();
        if(empty($categoryList)){
            return null;
        }

        foreach ($categoryList as $item) {
            $custom = $item;
            $custom['child'] = self::getChildList($item['id'],$level, $tryTime + 1);
            $childList[] = $custom;
        }

        return $childList;
    }

    public static function getCategoryList($level=3)
    {
        $result = [];
        $topCategory = self::where('parent_id',0)->get()->toArray();
        foreach ($topCategory as $item) {
            $custom = $item;
            $custom['child'] = self::getChildList($item['id'], $level);
            $result[] = $custom;
        }
        return $result;
    }

    public static function getSpace($time)
    {
        $space = '';
        for($i=1; $i<$time;$i++) {
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

    public static function getCategoryView($level=3)
    {
        $result = [];
        $category = self::getCategoryList($level);
        self::getChildView($result,$category);

        return $result;
    }

    public function posts()
    {
        // user_id là khóa ngoại của bảng Phone
        return $this->hasOne('App\Models\Post', 'category_id');
    }
}
