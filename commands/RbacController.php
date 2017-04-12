<?php

namespace app\commands;

use Yii;
use yii\console\Controller;
use \app\rbac\UserGroupRule;

class RbacController extends Controller {

    public function actionInit() {
        $authManager = \Yii::$app->authManager;

        // Создадим роли
        $guest = $authManager->createRole('guest');
        $member = $authManager->createRole('member');
        $manager = $authManager->createRole('manager');
        $admin = $authManager->createRole('admin');

        // Создидим простые, основанные на action{$NAME} разрешения
        $login = $authManager->createPermission('login');
        $logout = $authManager->createPermission('logout');
        $error = $authManager->createPermission('error');
        $signUp = $authManager->createPermission('sign-up');
        $index = $authManager->createPermission('index');
        $view = $authManager->createPermission('view');
        $update = $authManager->createPermission('update');
        $delete = $authManager->createPermission('delete');

        // Добавим разрешения в Yii::$app->authManager
        $authManager->add($login);
        $authManager->add($logout);
        $authManager->add($error);
        $authManager->add($signUp);
        $authManager->add($index);
        $authManager->add($view);
        $authManager->add($update);
        $authManager->add($delete);


        // Добавим правила, основанные на UserExt->group === $user->group
        $userGroupRule = new UserGroupRule();
        $authManager->add($userGroupRule);

        // Добавим правила "UserGroupRule" к ролям
        $guest->ruleName = $userGroupRule->name;
        $member->ruleName = $userGroupRule->name;
        $manager->ruleName = $userGroupRule->name;
        $admin->ruleName = $userGroupRule->name;

        // Добавим роли в Yii::$app->authManager
        $authManager->add($guest);
        $authManager->add($member);
        $authManager->add($manager);
        $authManager->add($admin);

        // Add permission-per-role in Yii::$app->authManager
        // Guest
//        $authManager->addChild($guest, $login);
//        $authManager->addChild($guest, $logout);
//        $authManager->addChild($guest, $error);
//        $authManager->addChild($guest, $signUp);
//        $authManager->addChild($guest, $view);
//
//        // Member
//        $authManager->addChild($member, $update);
//        $authManager->addChild($member, $guest);
//        $authManager->addChild($member, $index);
//
//        // Manager
//        $authManager->addChild($manager, $update);
//        $authManager->addChild($manager, $guest);
//
//        // Admin
//        $authManager->addChild($admin, $delete);
//        $authManager->addChild($admin, $manager);
//        $authManager->addChild($admin, $member);
    }

}
