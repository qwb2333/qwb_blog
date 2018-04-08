<?php
class QwbBlog {
    function __construct() {
        $this->data = new QwbDatabase();
    }
    //添加文章
    public function article_add($title, $md, $text, $tag) {
        $tag_txt = implode("|", $tag);
        $description = mb_substr($text, 0, 512);
        $time_tag = date("Y年m月");

        $pid = $this->data->insert("blog_article_list",
        array("title" => $title,
            "description" => $description,
            "tag" => $tag_txt,
            "time" => date("Y-m-d H:i:s"),
            "time_tag" => $time_tag
        ));

        $this->data->insert("blog_article_content",
        array(
            "pid" => $pid,
            "title" => $title,
            "md" => $md,
            "text" => $text,
            "tag" => $tag_txt
        ));

        $tag_edit = false;
        $tag_all = $this->tag_list_total();
        foreach($tag as $t) {
            $this->tag_add($t, $pid);
            $num = $this->tag_list_num($t); $num++;
            $this->tag_list_num_set($t, $num);
            if(!in_array($t, $tag_all)) {
                $tag_edit = true;
                array_push($tag_all, $t);
            }
        }
        if($tag_edit) {
            $this->tag_list_total_set($tag_all);
        }

        $time_all = $this->time_list_total();
        if(!in_array($time_tag, $time_all)) {
            array_push($time_all, $time_tag);
            $this->time_list_total_set($time_all);
        }

        $num = $this->time_list_num($time_tag); $num++;
        $this->time_list_num_set($time_tag, $num);

        $num = $this->article_list_num(); $num++;
        $this->article_list_num_set($num);
        return $pid;
    }

    //删除文章
    public function article_delete($pid) {
        $ret = $this->data->query("blog_article_list", array("pid" => $pid));
        if(!is_array($ret) || count($ret) == 0) return false;

        $tag = $ret[0]['tag'];
        $time_tag = $ret[0]['time_tag'];
        $this->data->delete("blog_article_list", array("pid" => $pid));
        $this->data->delete("blog_article_content", array("pid" => $pid));
        $tag_ar = explode("|", $tag);

        $tag_all = $this->tag_list_total(); $tag_edit = false;

        foreach($tag_ar as $t) {
            $this->tag_delete($t, $pid);
            $num = $this->tag_list_num($t); $num--;
            $this->tag_list_num_set($t, $num);
            if($num == 0) {
                $key = array_search($t, $tag_all);
                if($key !== false) {
                    array_splice($tag_all, $key, 1);
                    $tag_edit = true;
                }
            }
        }
        if($tag_edit) {
            $this->tag_list_total_set($tag_all);
        }

        $num = $this->time_list_num($time_tag); $num--;
        $this->time_list_num_set($time_tag, $num);
        if($num == 0) {
            $time_all = $this->time_list_total();
            $key = array_search($time_tag, $time_all);
            if($key !== false) {
                array_splice($time_all, $key, 1);
               $this->time_list_total_set($time_all);
            }
        }

        $num = $this->article_list_num(); $num--;
        $this->article_list_num_set($num);

        return true;
    }

    //文章被访问
    public function article_visit($pid) {
        $fv = new QwbFileVar("visit");
        $num = (int)$fv->get("pid_{$pid}"); $num++;
        $fv->set("pid_{$pid}", $num);
    }

    //文章访问数
    public function article_visit_get($pid) {
        $fv = new QwbFileVar("visit");
        return (int)$fv->get("pid_{$pid}");
    }

    //文章访问数 设置
    public function article_visit_set($pid, $num) {
        $fv = new QwbFileVar("visit");
        $fv->set("pid_{$pid}", $num);
    }

    //修改文章
    public function article_update($pid, $title, $md, $text, $tag) {
        $ret = $this->data->query("blog_article_list", array("pid" => $pid));
        if(!is_array($ret) || count($ret) == 0) return false;

        $tag_text = implode("|", $tag);
        $description = mb_substr($text, 0, 512);

        $this->data->update(
            "blog_article_list",
            array("title" => $title, "description" => $description, "tag" => $tag_text),
            array("pid" => $pid)
        );
        $this->data->update(
            "blog_article_content",
            array("title" => $title, "md" => $md, "text" => $text, "tag" => $tag_text),
            array("pid" => $pid)
        );

        $old_tag = $ret[0]['tag'];
        $old_tag_ar = explode("|", $old_tag);

        $tag_edit = false;
        $tag_all = $this->tag_list_total();
        foreach($old_tag_ar as $t) {
            $this->tag_delete($t, $pid);
            $num = $this->tag_list_num($t); $num--;
            $this->tag_list_num_set($t, $num);
            if($num == 0) {
                $key = array_search($t, $tag_all);
                if($key !== false) {
                    array_splice($tag_all, $key, 1);
                    $tag_edit = true;
                }
            }
        }

        foreach($tag as $t) {
            $this->tag_add($t, $pid);
            $num = $this->tag_list_num($t); $num++;
            $this->tag_list_num_set($t, $num);
            if(!in_array($t, $tag_all)) {
                array_push($tag_all, $t);
                $tag_edit = true;
            }
        }
        if($tag_edit) {
            $this->tag_list_total_set($tag_all);
        }
        return true;
    }

    //查看文章
    public function article_query($pid) {
        $tmp = $this->data->query("blog_article_content", array("pid" => $pid));
        return $tmp[0];
    }

    //查看文章简略信息
    public function article_query_list($pid) {
        $tmp = $this->data->query("blog_article_list", array("pid" => $pid));
        return $tmp[0];
    }

    //文章的评论数
    public function article_discuss_num($pid) {
        $fv = new QwbFileVar("discuss");
        return (int)$fv->get("pid_{$pid}");
    }

    //设置 文章的评论数
    public function article_discuss_num_set($pid, $num) {
        $fv = new QwbFileVar("discuss");
        $fv->set("pid_{$pid}", $num);
    }

    //文章pid是否存在
    public function article_exists($pid) {
        $ret = $this->data->query("blog_article_list", array("pid" => $pid));
        if(is_array($ret) && count($ret) > 0) return true;
        return false;
    }

    //删除tag
    public function tag_delete($tag, $pid) {
        $this->data->delete("blog_tag", array("name" => $tag, "pid" => $pid));
    }

    //增加tag
    public function tag_add($tag, $pid) {
        $this->data->insert("blog_tag", array(
            "name" => $tag,
            "pid" => $pid
        ));
    }

    //取条数
    public function article_list_num() {
        $fv = new QwbFileVar("count");
        return (int)$fv->get("article");
    }

    public function article_list_num_set($x) {
        $fv = new QwbFileVar("count");
        $fv->set("article", $x);
    }

    //列出范围的
    public function article_list_range($begin, $end) {
        $len = $end - $begin + 1;
        return $this->data->query("blog_article_list", array(), "{$begin}, {$len}", array("key" => "pid", "sort" => 1));
    }

    //一共有哪一些tag
    public function tag_list_total() {
        $fv = new QwbFileVar("list");
        return $fv->get("tag", true);
    }

    //一共有哪一些tag修改
    public function tag_list_total_set($tag) {
        $fv = new QwbFileVar("list");
        $fv->set("tag", $tag);
    }

    //列出某个tag的条数
    public function tag_list_num($tag) {
        $fv = new QwbFileVar("tag");
        return (int)$fv->get(md5($tag));
    }

    //列出某个tag的条数->设置
    public function tag_list_num_set($tag, $num) {
        $fv = new QwbFileVar("tag");
        $fv->set(md5($tag), $num);
    }

    //列出某个tag
    public function tag_list_range($tag, $begin, $end) {
        $end++;
        return $this->data->query("blog_tag", array("name" => $tag), "{$begin}, {$end}", array("key" => "pid", "sort" => 1));
    }

    //列出有哪些时间
    public function time_list_total() {
        $fv = new QwbFileVar("list");
        return $fv->get("time", true);
    }

    //修改有哪些时间
    public function time_list_total_set($tim) {
        $fv = new QwbFileVar("list");
        $fv->set("time", $tim);
    }

    //列出某个时间的个数
    public function time_list_num($tim) {
        $fv = new QwbFileVar("time");
        return (int)$fv->get(md5($tim));
    }

    //列出某个时间的个数->修改
    public function time_list_num_set($tim, $num) {
        $fv = new QwbFileVar("time");
        $fv->set(md5($tim), $num);
    }

    //列出某个时间
    public function time_list_range($tim, $begin, $end) {
        $end++;
        return $this->data->query("blog_article_list", array("time_tag" => $tim), "{$begin}, {$end}", array("key" => "pid", "sort" => 1));
    }

    //建立文章搜索索引文件,并返回数目
    public function article_search_num($content) {
        $name = md5($content);
        if(file_exists("data/search/{$name}")) {
            $fv = new QwbFileVar("search");
            $ret = $fv->get($name, true);
            return count($ret);
        }

        if(!isset($this->data->mysqli)) {
            $this->data->connect();
        }
        $mysqli = &$this->data->mysqli;
        $content = addcslashes($mysqli->real_escape_string($content), "%_");
        $sql = "SELECT `pid` FROM `blog_article_content` WHERE `text` LIKE '%{$content}%' OR `title` LIKE '%{$content}%' ORDER BY `pid` DESC";
        $retval = $mysqli->query($sql);
        if($retval == false) return 0;

        $ret = array();
        while($row = $retval->fetch_array(MYSQLI_ASSOC)) {
            array_push($ret, $row['pid']);
        }

        $fv = new QwbFileVar("search");
        $fv->set($name, implode("|", $ret));
        return count($ret);
    }

    //普通的读多少个
    public function article_search_range($content, $c_begin, $c_end) {
        $name = md5($content);
        $fv = new QwbFileVar("search");
        $ar = $fv->get($name, true);

        $ret = array();
        $text_len = 300;
        $blog = new QwbBlog();
        for($i = $c_begin; $i <= $c_end; $i++) {
            if(!isset($ar[$i])) break;
            $pid = $ar[$i];
            $c = $blog->article_query($pid);
            $title = str_replace($content, '<span class="red">'.htmlspecialchars($content).'</span>', $c['title']);
            $pos = mb_strpos($c['text'], $content);
            $len = mb_strlen($c['text']);

            if($pos === false) {
                $text = mb_substr($c['text'], 0, $text_len);
                if(mb_strlen($text) != $len) {
                    $text .= "...";
                }
            }
            else {
                $text = "";
                $begin = max($pos - (int)($text_len / 2), 0);

                if($begin != 0) {
                    $text .= "...";
                }
                $text .= mb_substr($c['text'], $begin, $text_len);
                $end = max($begin + $text_len - 1, $text_len - 1);
                if($end != $text_len - 1) {
                    $text .= "...";
                }
               $text = str_replace($content, '<span class="red">'.htmlspecialchars($content).'</span>', $text);
            }
            array_push($ret, array("pid" => $c['pid'], "title" => $title, "text" => $text));
        }
        return $ret;
    }
}
?>
