<?php

namespace App\Traites;

trait helperTrait
{

    public function getCategoryById($id)
    {
        $category = Category::IsExist($id)->first();
        if(!$category)
            return redirect()->back()->with('error','هذا القسم غير موجود');

    }

    public function returnSuccessMessage($msg = "", $errNum = "S000")
    {
        return [
            'status' => true,
            'errNum' => $errNum,
            'message' => $msg
        ];
    }

}
