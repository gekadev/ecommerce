<?php

/**
 * get folder name
 *
 * display folder name to help in diriction of admin theme panel.
 *
 *
 */

// start define constants
define('PAGINATION_COUNT',15);

 function fileName()
{
    return app()->getLocale() == 'ar'?'-rtl':'';

}
function getFolder()
{
    return app()->getLocale() == 'ar'?'ar':'en';

}

function UploadImage($request,$InputName)
{
    if ($request->file($InputName)) {
        $image = $request->file($InputName);
        $new_name = rand().time(). '.' . $image->getClientOriginalExtension();
        $image->move(public_path("upload"), $new_name);
        return $new_name;
    }
}




