<?php // AdminAuthentication.php

require_once(BASEPATH . '/libs/AdminAccountsModel.php');

class AdminAuthentication {
    //
    protected const LOCK_NUM = 5; // ロックに至る回数(この回数、連続でパスワードエラーならロック)
    protected const LOCK_TIME = 30; // ロック時間(秒)

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

        // lock時間の確認
        if (null !== $admin_account_obj->lock_datetime) {
            // lock_datetimeが「今よりも未来」なら
            if (time() < strtotime($admin_account_obj->lock_datetime)) {
                // XXX 管理者にmail
                return null;
            }
            // else
            // lock_datetimeを一端削除する(nullを入れておく)
            $admin_account_obj->lock_datetime = null;
            $admin_account_obj->update();
        }

        // passwordのチェック
//var_dump($pass, $admin_account_obj->password);
        if (false === password_verify($pass, $admin_account_obj->password)) {
            // NG
            // error_num をインクリメント
            $admin_account_obj->error_num += 1;

            // ロック判定
            if ($admin_account_obj->error_num >= self::LOCK_NUM) {
                // lock_datetime に「ロック時間」を設定
                $admin_account_obj->lock_datetime = date('Y-m-d H:i:s', time() + self::LOCK_TIME);
                // error_num をクリア
                $admin_account_obj->error_num = 0;
                // XXX 管理者にmail (& frontユーザにmail)
            }

            // 情報を更新
            $admin_account_obj->update();
//var_dump( $admin_account_obj );exit;
            return null;
        }

        // 認証OK
        // XXX error_num をクリア
        return $admin_account_obj;
    }
}











