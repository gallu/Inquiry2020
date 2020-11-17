<?php  // InquiryModel.php

require_once(BASEPATH . '/libs/Model.php');

class InquiryModel extends Model {
    /*
    // 継承先に、以下がある前提
     */
    protected static $table_name = 'inquiry';
    protected static $pk_name = 'inquiry_id';

    /**
     * 一覧の取得
     */
    public static function getList() {
        //
        $dbh = DbHandle::get(); // PDO

        // プリペアドステートメントの作成
        $sql = 'SELECT * FROM inquiry ORDER BY inquiry_id DESC LIMIT 20 OFFSET 0;';
        $pre = $dbh->prepare($sql);
        
        // 値のバインド(ない)

        // SQLの実行
        $r = $pre->execute();
        // XXX エラーチェック
        
        return $pre->fetchAll(\PDO::FETCH_ASSOC);
    }
}
