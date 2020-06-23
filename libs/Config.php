<?php  // Config.php
//
class Config {
    // XXX defaultの追加
    static public function get($name, $default = null) {
        // 初めてのcallなら
        if (null === static::$data) {
            // 設定ファイルを読み込む
            static::read();
        }
        //
        return static::$data[$name] ?? $default;
    }

    static public function read() {
        // 設定ファイルを読み込む
        // XXX 「共通設定」の追加
        static::$data = require_once(BASEPATH . '/environmental_dependence.conf');
        //var_dump(static::$data);
    }

private static $data = null;
}
