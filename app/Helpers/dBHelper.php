<?php
	/**
	 * Created by PhpStorm.
	 * User: geka
	 * Date: 5/13/2019
	 * Time: 1:00 PM
	 */

	namespace App\Helpers;
	use DB;
	use Illuminate\Support\Facades\Request;

	class dBHelper
	{

		public static function updateDataByQuery()
		{
			//DB::update('update users set username = ? , status = ? where user_id = ?', [$username , $status , 1]);
		}

		/**
		 *
		 * This function  upload  single image.
		 */

		public static function do_upload( $request,$InputName)
		{
			if ($request->file($InputName)) {
				$image = $request->file($InputName);
				$new_name = rand().time(). '.' . $image->getClientOriginalExtension();
				$image->move(public_path("upload"), $new_name);
				return $new_name;
			}

		}

		public static function multipleUpload($request,$InputName)
		{
			$images=array();
			if ($request->hasFile($InputName)) {
				$image = $request->file($InputName);
				foreach($image as $file){
					$new_name = rand().time() . '.' . $file->getClientOriginalExtension();
					$destinationPath = public_path("upload");
					$file->move($destinationPath, $new_name);
					$images[]=$new_name;
				}
				return $images;
			}

		}





	}
