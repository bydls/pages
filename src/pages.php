<?php
/**
 * @Desc:
 * @author: hbh
 * @Time: 2021/2/23   11:56
 */

namespace bydls\pages;

use bydls\pages\page\page_1;

class  pages
{
    protected $totalPage;
    protected $pagenow;

    public function __construct($totalPage, $pagenow, $pageshow = 10)
    {
        $this->totalPage = $totalPage;
        $this->pagenow = $pagenow;
    }

    public static function page1($totalPage, $pagenow, $pageshow = 10, $is_show_num = 10, $getName = '')
    {
        $pages = new page_1();
        return $pages->getPageHtml($totalPage, $pagenow, $pageshow, $is_show_num, $getName);
    }
}