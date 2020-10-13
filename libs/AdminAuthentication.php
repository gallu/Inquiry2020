<?php // AdminAuthentication.php

require_once(BASEPATH . '/libs/AdminAccountsModel.php');

class AdminAuthentication {
    //
    public static function login($id, $pass) {
        // 簡単にvalidate
        if ( ('' === $id)||('' === $pass) ) {
            return null;
        }
        // 情報を取得
        $admin_account_obj = AdminAccountsModel::find($id);
//var_dump($admin_account_obj);
        if (null === $admin_account_obj) {
            // NG
            return null;
        }
        // passwordのチェック
        if ($pass !== $admin_account_obj->password) {
            // NG
            // XXX ログインロック
            return null;
        }
        // 認証OK
        return $admin_account_obj;
    }
}