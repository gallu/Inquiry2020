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
        /*
        if (null !== $admin_account_obj->lock_datetime) {
            // lock_datetimeが「今よりも未来」なら
            if (time() < strtotime($admin_account_obj->lock_datetime)) {
                XXX 管理者にmail
                return null;
            }
            // else
            // XXX lock_datetimeを一端削除する(nullを入れておく)
        }
        */

        // passwordのチェック
//var_dump($pass, $admin_account_obj->password);
        if (false === password_verify($pass, $admin_account_obj->password)) {
            // NG
            // XXX error_num をインクリメント
            /*
            if (error_numが一定以上) {
                lock_datetime に「ロック時間」を設定
                error_num をクリア
                XXX 管理者にmail (& frontユーザにmail)
            }
            */
            return null;
        }
        // 認証OK
        // XXX error_num をクリア
        return $admin_account_obj;
    }
}











