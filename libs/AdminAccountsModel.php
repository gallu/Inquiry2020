<?php  // AdminAccountsModel.php

require_once(BASEPATH . '/libs/Model.php');

class AdminAccountsModel extends Model {
    /*
    // 継承先に、以下がある前提
     */
    protected static $table_name = 'admin_accounts';
    protected static $pk_name = 'login_id';
}
//insert into admin_accounts(login_id, password) values('root', 'pass');
//INSERT INTO admin_accounts(login_id, password) VALUES('root', '$2y$12$wwuNhGLF/VGUl2jk3n1dQuLf0BtWLJ4JPJVAVmfoLfFS85Yr1BXXu');
