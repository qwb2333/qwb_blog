<?php
class QwbDatabase {
    function __destruct() {
        if(isset($this->mysqli)) {
            $this->mysqli->close();
        }
    }
    public function connect() {
        $this->mysqli = new mysqli(DATA_HOST, DATA_USER, DATA_PASS, DATA_DATABASE);
        if(mysqli_connect_errno()) {
            unset($this->mysqli);
            return false;
        }
        $this->mysqli->set_charset('utf8');
        return true;
    }

    public function delete($table, $where, $limit = '') {
        if(!isset($this->mysqli)) $this->connect();
        if(!is_array($where) || !count($where)) return false;

        $sql = "DELETE FROM `{$table}` ";
        if(count($where)) {
            $tmp = "WHERE "; $first = true;
            foreach($where as $key => $val) {
                if($first) $first = false;
                else $tmp .= "AND ";
                $val = $this->mysqli->real_escape_string($val);
                $tmp .= "`{$key}` = '{$val}' ";
            }
            $sql .= $tmp;
        }
        if(strlen($limit)) {
            $sql .= "LIMIT {$limit}";
        }

        $ret = $this->mysqli->query($sql);
        if($ret === false) return false;
        return true;
    }
    public function insert($table, $param = array()) {
        if(!isset($this->mysqli)) $this->connect();

        $key = array(); $val = array();
        foreach($param as $a => $b) {
            array_push($key, $a);
            array_push($val, $this->mysqli->real_escape_string($b));
        }
        $sql = "INSERT INTO `{$table}` ";
        if(is_array($param) && count($param)) {
            $sql .= "( "; $first = true;
            foreach($key as $v) {
                if($first) $first = false;
                else $sql .= ", ";
                $sql .= "`$v`";
            }
            $sql .= ") VALUES ( ";

            $first = true;
            foreach($val as $v) {
                if($first) $first = false;
                else $sql .= ", ";
                $sql .= "'$v'";
            }
            $sql .= ")";
        }
        $ret = $this->mysqli->query($sql);
        if($ret === false) return false;

        $id = $this->mysqli->insert_id;
        return $id;
    }
    public function query($table, $where = array(), $limit = '', $order = array()) {
        if(!isset($this->mysqli)) $this->connect();
        if(isset($where['__option__'])) $option = $where['__option__'];
        else $option = array();

        $sql = "SELECT * FROM `{$table}` ";
        if(count($where)) {
            $tmp = "WHERE "; $first = true;
            foreach($where as $key => $val) {
                if($first) $first = false;
                else $tmp .= "AND ";
                $val = $this->mysqli->real_escape_string($val);
                if(isset($option[$key])) $op = $option[$key];
                else $op = '=';
                $tmp .= "`{$key}` {$op} '{$val}' ";
            }
            $sql .= $tmp;
        }
        if(isset($order['key'])) {
            if(!isset($order['sort'])) $order['sort'] = 0;
            $tmp = "ORDER BY `{$order['key']}` ";
            if($order['sort'] == 0) $tmp .= "ASC ";
            else $tmp .= "DESC ";
            $sql .= $tmp;
        }
        if(strlen($limit)) {
            $sql .= "LIMIT {$limit}";
        }

        $retval = $this->mysqli->query($sql);
        if(!$retval) return false;

        $ret = array(); $cnt = 0;
        while($row = $retval->fetch_array(MYSQL_ASSOC)) {
            $ret[$cnt] = $row;
            $cnt++;
        }
        $retval->free_result();
        return $ret;
    }
    public function query_count($table, $where = array()) {
        if(!isset($this->mysqli)) $this->connect();
        $sql = "SELECT COUNT(*) FROM `{$table}` ";
        if(count($where)) {
            $tmp = "WHERE "; $first = true;
            foreach($where as $key => $val) {
                if($first) $first = false;
                else $tmp .= "AND ";
                $val = $this->mysqli->real_escape_string($val);
                $tmp .= "`{$key}` = '{$val}' ";
            }
            $sql .= $tmp;
        }
        $retval = $this->mysqli->query($sql);
        $tmp = $retval->fetch_array();
        return $tmp[0];
    }
    public function update($table, $param, $where) {
        if(!isset($this->mysqli)) $this->connect();
        if(!is_array($param) || !is_array($where)) return false;

        $sql = "UPDATE `{$table}` SET ";
        $first = true;
        foreach($param as $a => $b) {
            if($first) $first = false;
            else $sql .= ", ";
            $b = $this->mysqli->real_escape_string($b);
            $sql .= "`{$a}` = '{$b}' ";
        }
        if(count($where)) {
            $tmp = "WHERE "; $first = true;
            foreach($where as $key => $val) {
                if($first) $first = false;
                else $tmp .= "AND ";
                $val = $this->mysqli->real_escape_string($val);
                $tmp .= "`{$key}` = '{$val}' ";
            }
            $sql .= $tmp;
        }
        $retval = $this->mysqli->query($sql);
        if(!$retval) return false;
        return true;
    }
}
?>