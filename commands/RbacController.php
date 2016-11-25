<?php

namespace app\commands;

use Yii;
use yii\console\Controller;

class RbacController
    extends Controller
{
    public function actionInit()
    {
        $auth = Yii::$app->authManager;

        // Create roles
        $cook = $auth->createRole('cook');     $cook->description = 'Cook';     $auth->add($cook);
        $waiter = $auth->createRole('waiter'); $waiter->description = 'Waiter'; $auth->add($waiter);
        $admin = $auth->createRole('admin');   $admin->description = 'Admin';   $auth->add($admin);

        // Create permissions
        $cooking = $auth->createPermission('cooking');   $auth->add($cooking);
        $serving = $auth->createPermission('serving');   $auth->add($serving);
        // $anything = $auth->createPermission('anything'); $auth->add($anything);

        // Users
        $auth->addChild($cook, $cooking);
        $auth->addChild($waiter, $serving);

        // Admin
        $auth->addChild($admin, $cook);
        $auth->addChild($admin, $waiter);
        // $auth->addChild($admin, $anything);
    }
}
