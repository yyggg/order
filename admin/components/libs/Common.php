<?php

namespace app\components\libs;

use yii\web\UploadedFile;
use yii\helpers\BaseFileHelper;

class Common
{
	public static function uploadFile($name)
	{

		$uploadedFile = UploadedFile::getInstanceByName($name);

		if($uploadedFile === null || $uploadedFile->hasError)
		{
			return null;
		}

		$ymd = date("Ymd");

		$save_path = \Yii::getAlias('@upPath') . '/' . $ymd . "/";

		if(! file_exists($save_path))
		{
			BaseFileHelper::createDirectory($save_path);
		}

		$file_name = $uploadedFile->getBaseName();
		$file_ext = $uploadedFile->getExtension();

		// 新文件名
		$new_file_name = date("YmdHis") . '_' . rand(10000, 99999) . '.' . $file_ext;

		$uploadedFile->saveAs($save_path . $new_file_name);

		return ['path' => $ymd . '/' . $new_file_name, 'name' => $file_name, 'new_name' => $new_file_name, 'ext' => $file_ext];
	}

}
