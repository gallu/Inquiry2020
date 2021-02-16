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
    public static function getList(array $find_items, string $sort, int $page) {
        // XXX あとで可変になる可能性を考慮
        $per_page = 5;

        //
        $dbh = DbHandle::get(); // PDO
//var_dump($find_items);
//var_dump($sort);

        // プリペアドステートメントの作成
        $sql = 'FROM inquiry';
        $where = [];
        $binds = [];

        // 名前(あいまい検索)
        if ('' !== $find_items['name']) {
            $where[] = 'name LIKE :name';
            $binds[':name'] = '%' . str_replace(['%', '_'], ['\\%', '\\_'], $find_items['name']) . '%'; // エスケープ処理
        }
        // 問い合わせ日時(from～to)
        // BETWEEN：bit演算使って
        $created_at_from_to = 0; // 1:from,  2:to
        if ('' !== $find_items['from']) {
            $binds[':from'] = date('Y-m-d H:i:s', strtotime("{$find_items['from']} 00:00:00")); // XXX 共通化？
            $created_at_from_to += 1;
        }
        if ('' !== $find_items['to']) {
            $binds[':to'] = date('Y-m-d H:i:s', strtotime("{$find_items['to']} 23:59:59")); // XXX 共通化？
            $created_at_from_to += 2;
        }
        if (1 === $created_at_from_to) {
            $where[] = 'created_at >= :from';
        } else if (2 === $created_at_from_to) {
            $where[] = 'created_at <= :to';
        } else if (3 === $created_at_from_to) {
            $where[] = 'created_at BETWEEN :from AND :to';
        }

        // status(未返信 / 返信済み)
        // bit演算使って
        $reply_flg = 0;
        if (true === in_array('0', $find_items['reply_flg'], true)) {
            //echo "未返信がchecked\n";
            $reply_flg += 1;
        }
        if (true === in_array('1', $find_items['reply_flg'], true)) {
            //echo "返信済みがchecked\n";
            $reply_flg += 2;
        }
//var_dump($reply_flg);
        // 0 と 3 はWHERE不要なので除外
        if (1 === $reply_flg) {
            $where[] = 'reply_at is null';
        }
        if (2 === $reply_flg) {
            $where[] = 'reply_at is not null';
        }

        // WHEREの合成
        if ([] !== $where) {
            $sql .= ' WHERE ' . implode(' AND ', $where);
        }

        /* count(*)の取得 */
        // プリペアドステートメント作成
        $sql_count = 'SELECT count(*) as cnt ' . $sql . ';';
        $pre = $dbh->prepare($sql_count);
        // 値のバインド
        foreach($binds as $k => $v) {
            $pre->bindValue($k, $v);
        }
        // SQLの実行
        $r = $pre->execute();
        $count = $pre->fetch(\PDO::FETCH_ASSOC)['cnt'];
//var_dump($count); exit;

        // sortの決定
        // (第一種)ホワイトリストを使う
        $sort_white_list = [
            'created_at' => 'created_at',
            'created_at_desc' => 'created_at DESC',
            'name' => 'name',
            'name_desc' => 'name DESC',
        ];
        //
        $sort_e = $sort_white_list[$sort] ?? 'inquiry_id DESC';
        //
        $sql_list = 'SELECT * ' . $sql . " ORDER BY {$sort_e} LIMIT :limit OFFSET :offset;";
        $pre = $dbh->prepare($sql_list);
//var_dump($sql_list);
        
        // 値のバインド
        foreach($binds as $k => $v) {
//var_dump($k, $v);
            $pre->bindValue($k, $v);
        }
        // offsetのバインド
        $pre->bindValue(':limit', $per_page, \PDO::PARAM_INT);
        $pre->bindValue(':offset', $per_page * $page, \PDO::PARAM_INT);

        // SQLの実行
        $r = $pre->execute();
        // XXX エラーチェック

        //
        $ret = [
            'data' => $pre->fetchAll(\PDO::FETCH_ASSOC),
            'count' => $count,
            'max_page' => ceil($count / $per_page)  - 1 ,
        ];
        return $ret;
    }

}
