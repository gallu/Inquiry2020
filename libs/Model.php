<?php  // Model.php

class Model {
    /*
    // 継承先に、以下がある前提
    protected static $table_name = '';
    protected static $pk_name = '';
     */

    /*
    $flight = new Flight;
    $flight->name = $request->name;
    $flight->insert();
     */
    //
    public function __set($name, $value) {
        //
        $this->data[$name] = $value;
    }

    // 識別子のエスケープ
    public static function escape($value) {
        // もし引数が配列なら、個々に分解して再帰でcallする
        if (true === is_array($value)) {
            foreach($value as $k => $v) {
                $value[$k] = static::escape($v);
            }
            return $value;
        }
        // else
        // 一端「ざっくりと」実装: 「英数アンダースコア」以外は全部NG
        $len = strlen($value);
        for($i = 0; $i < $len; ++$i) {
            //
            if (true === ctype_alnum($value[$i])) { // XXX
                continue;
            }
            if ('_' === $value[$i]) {
                continue;
            }
            // else
            throw new \Exception("識別子 {$value} には、使用不可な文字が含まれています");
        }
        //
        return $value;
    }

    //
    public function insert() {
        //
        $dbh = DbHandle::get(); // PDO

        // プリペアドステートメント(準備された文)を作成
        // ＋ 識別子のエスケープ処理
        $table_name = $this::escape($this::$table_name);
        $cols = $this::escape(array_keys($this->data));
//var_dump($table_name, $cols);
        //
        $sql_cols = implode(', ', $cols);
        $holder = [];
        foreach($cols as $s) {
            $holder[] = ":{$s}";
        }
        $sql_holder = implode(', ', $holder);

        //
        $sql = "INSERT INTO {$table_name}({$sql_cols}) VALUES({$sql_holder});";
        $pre = $dbh->prepare($sql);
//var_dump($pre);

        // プレースホルダに値をバインド
        foreach($this->data as $k => $v) {
            //
            if (true === is_null($v)) {
                $type = \PDO::PARAM_NULL;
            } else if ( (true === is_int($v))||(true === is_float($v)) ) {
                $type = \PDO::PARAM_INT;
            } else {
                $type = \PDO::PARAM_STR;
            }
            //
            $pre->bindValue(":{$k}", $v, $type);
        }

        // SQLを実行
        $r = $pre->execute();
//var_dump($r);
        return $r;
    }

    /*
     */
    public static function find($value) {
        //
        $dbh = DbHandle::get(); // PDO

        // プリペアドステートメントの作成
        $table_name = static::escape(static::$table_name);
        $pk_name = static::escape(static::$pk_name);
        $sql = "SELECT * FROM {$table_name} WHERE {$pk_name}=:{$pk_name};";
        $pre = $dbh->prepare($sql);

        // 値のバインド
        if ( (true === is_int($value))||(true === is_float($value)) ) {
            $type = \PDO::PARAM_INT;
        } else {
            $type = \PDO::PARAM_STR;
        }
        //
        $pre->bindValue(":{$pk_name}", $value, $type);

        // SQLの実行
        $r = $pre->execute();
//var_dump($r);

        // データの取得
        $data = $pre->fetch(\PDO::FETCH_ASSOC);
//var_dump($data);
        if (false === $data) {
            return null;
        }
        
        // インスタンス作ってデータ入れてreturn
        $robj = new static();
        $robj->data = $data; // XXX
/*
        foreach($data as $k => $v) {
            $robj->$k = $v;
        }
*/
        //
        return $robj;
    }

/*
UPDATE
SELECT( WHERE pk )
*/
//
private $data = [];
}