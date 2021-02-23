<?php

namespace bydls\pages\page;
/**
 * @Desc:
 * @author: hbh
 * @Time: 2021/2/23   11:57
 */
class  page_1
{
    public $page_params_name = 'page';

    /**
     * @param int $totalPage 总页数
     * @param int $page 当前页/偏移
     * @param int $pageshow 每页显示的记录条数
     * @param int $is_show_num
     * @param string $name
     * @param string $value
     * @param string $getName
     * @return bool|string
     * @author: hbh
     * @Time: 2021/2/23   11:59
     */
    public function getPageHtml($totalPage, $page, $pageshow, $is_show_num = 10, $getName = '', $name = '', $value = '')
    {//可选参数也可以写$getName='p'，可选参数可以给定默认值
        if ($page <= 0) {
            $page = 1;
        }
        //规定总记录条数超过多少显示页码，如果没有传参的话，即没有定义，那么默认超过5条显示页码
        if (!($totalPage > $is_show_num)) {
            return false;
        }
        $and = "";
        $this->page_params_name = $getName ? $getName : $this->page_params_name;
        if ($value || $name) {
            $and = "&$name=$value";
        }

        $url = $this->get_url();

        $totalPage /= $pageshow;
        $page_number = ceil($totalPage);
        if ($page > $page_number) {
            $page = $page_number;
        }

        if ($page != 1) {
            $page_head = "<a  class='a-cn' href=$url$this->page_params_name=1$and >首页</a>";
            $page_prev = "<a  class='a-cn' href='$url$this->page_params_name=" . ($page - 1) . "$and'>上一页</a>";
        } else {
            $page_head = "<span class='text-cn'>首页</span>";
            $page_prev = "<span class='text-cn'>上一页</span>";
        }

        if ($page >= $page_number) {
            $page_next = "<span class='text-cn'>下一页</span>";
            $page_end = "<sapn class='text-cn'>尾页</sapn>";

        } else {
            $page_next = "<a class='a-cn' href='$url$this->page_params_name=" . ($page + 1) . $and . "'>下一页</a>";
            $page_end = "<a class='a-cn' href='$url$this->page_params_name=$page_number$and'>尾页</a>";

        }

        $page_for = "";
        if ($page <= 5) {
            for ($i = 1; $i <= 7; $i++) {
                if ($i == $page_number) {
                    if ($page == $page_number) {
                        $page_for .= "<span class='text-num'>$i</span>";
                        break;
                    }

                    $page_for .= "<a class='a-num' href='" . $url . "$this->page_params_name=" . $i . $and . "'>$i</a>";

                    break;
                }
                if ($page == $i) {
                    $page_for .= "<span class='text-num'>$i</span>";
                    continue;
                }

                $page_for .= "<a class='a-num' href='" . $url . "$this->page_params_name=" . $i . "$and'>$i</a>";
            }
        } else {

            for ($i = ($page - 4); $i <= ($page + 2); $i++) {
                if ($i == $page_number) {
                    if ($page == $page_number) {
                        $page_for .= "<span class='text-num'>$i</span>";
                        break;
                    }
                    $page_for .= "<a class='a-num' href='" . $url . "$this->page_params_name=" . $i . "$and'>$i</a>";
                    break;
                }
                if ($page == $i) {
                    $page_for .= "<span class='text-num'>$i</span>";
                    continue;
                }
                $page_for .= "<a class='a-num' href='" . $url . "$this->page_params_name=" . $i . "$and'>$i</a>";
            }
        }


        return "<div class='page-page'>" . $page_head . $page_prev . $page_for . $page_next . $page_end . '</div>';

        //($page-1)*$pageshow;

    }

    public function get_url()
    {
        $params = $_SERVER['QUERY_STRING']; //请求参数
        if ($params) {
            $params_arr = explode('&', $params);
            foreach ($params_arr as $k => $param) {
                if (stripos($param, 'page') > -1) unset($params_arr[$k]);
            }
            count($params_arr) ? $currentUrl = $_SERVER['PHP_SELF'] . '?' . implode('&', $params_arr) . '&' : $currentUrl = $_SERVER['PHP_SELF'] . '?';
        } else {
            $currentUrl = $_SERVER['PHP_SELF'] . '?';
        }
        return $currentUrl; //传回当前url

    }

}