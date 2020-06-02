-- 1レコードが「1ユーザからの1回の問い合わせ」を意味するテーブル
CREATE TABLE inquiry
    inquiry_id SERIAL ,
    name VARCHAR(64) NOT NULL DEFAULT '' COMMENT '問い合わせ者名',
    email VARBINARY(254) NOT NULL DEFAULT '' COMMENT '問い合わせ者email',
    body TEXT COMMENT '問い合わせ本文',
    created_at DATETIME NOT NULL COMMENT '問い合わせした日時',
    reply_at DATETIME COMMENT '返信した日時(NULL許可)',
    reply_charge VARCHAR(64) COMMENT '担当者',
    reply_subject VARCHAR(256) COMMENT '返信タイトル',
    reply_body TEXT COMMENT '返信本文',
    PRIMARY KEY(inquiry_id)
)CHARACTER SET 'utf8mb4', COMMENT='1レコードが「1ユーザからの1回の問い合わせ」を意味するテーブル';


-- 1レコードが「管理画面の1アカウント」を意味するテーブル
CREATE TABLE admin_accounts
    login_id VARBINARY(128) NOT NULL COMMENT 'ログイン用のID',
    password VARBINARY(255) NOT NULL COMMENT 'パスワード(hashed)',
    -- error_num INT UNSIGNED
    -- lock_datetime DATETIME
    PRIMARY KEY(login_id)
)CHARACTER SET 'utf8mb4', COMMENT='1レコードが「管理画面の1アカウント」を意味するテーブル';


