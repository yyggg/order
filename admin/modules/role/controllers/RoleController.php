<?php

namespace app\modules\role\controllers;

use Yii;
use app\modules\role\models\AuthItem;
use app\components\CommonController;
use yii\helpers\ArrayHelper;
use yii\web\NotFoundHttpException;

/**
 * PresscentreController implements the CRUD actions for Presscentre model.
 */
class RoleController extends CommonController
{
    public function actionIndex()
    {
        $manager = Yii::$app->getAuthManager();
        $model = $manager->getRoles();

        return $this->render("/index", [
            "model" => $model
        ]);
    }

    public function actionCreate()
    {
        $model = new AuthItem();

        if($model->load(Yii::$app->request->post()) && $model->save())
        {
            Yii::$app->session->setFlash('success', ['delay'=>3000,'message'=>'保存成功！']);
            return $this->redirect(['index']);
        }
        //print_r($model->getErrors());die;
        return $this->render("/create", [
            "model" => $model
        ]);
    }
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if($model->load(Yii::$app->request->post()) && $model->save())
        {
            Yii::$app->session->setFlash('success', ['delay'=>3000,'message'=>'保存成功！']);
        }

        return $this->render("/update", [
            "model" => $model
        ]);
    }

    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        if($model->delete())
        {
            Yii::$app->session->setFlash('success', ['delay'=>3000,'message'=>'操作成功！']);
        }
        else
        {
            Yii::$app->session->setFlash('error', ['delay'=>3000,'message'=>'操作失败！']);
        }
        return $this->redirect(['index']);
    }


    /**
     * 1.获取所有模块配置的权限(前台模块...怎么办?)
     */
    public function actionPermissions($id)
    {
        $authManager = \Yii::$app->getAuthManager();

        if (\Yii::$app->getRequest()->getIsPost())
        {
            $oldPermissions = ArrayHelper::getColumn($authManager->getChildren($id), "name");

            $postPermissions = array_keys(\Yii::$app->getRequest()->post("Permissions",[]));

            $newChildren = array_diff($postPermissions, $oldPermissions);
            $delChildren = array_diff($oldPermissions,$postPermissions);

            $parent = $authManager->getRole($id);

            //@hass-todo 这里最好是用sql使用批量删除和添加..但是为了兼容phpmanager

            foreach ($delChildren  as $name)
            {
                $authManager->removeChild($parent, $authManager->createPermission($name));
            }

            foreach ($newChildren  as $name)
            {
                $authManager->addChild($parent, $authManager->createPermission($name));
            }

            Yii::$app->session->setFlash('success', ['delay'=>3000,'message'=>'操作成功！']);
        }

        $allPermissions = [];
        $permissions = $authManager->getPermissions();
        $groupPermissions = $authManager->getChildren($id);
        //echo "<pre>";
        //print_r($permissions);
        //print_r($groupPermissions);die;
        foreach ($permissions as $k => $v)
        {
            $arr = explode('/', $k);
            $allPermissions[$arr[0]][] = $v;
        }
        //print_r($groupPermissions);
        //echo "<pre>";
        //print_r($allPermissions);die;
        return $this->render("/permissions",[
            'role' => $authManager->getRole($id),
            'allPermissions' => $allPermissions,
            'groupPermissions' => $groupPermissions,
        ]);
    }

    protected function findModel($id)
    {
        if (($model = AuthItem::find()->where(['name' => $id])->one()) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('请求页面不存在.');
        }
    }

}
