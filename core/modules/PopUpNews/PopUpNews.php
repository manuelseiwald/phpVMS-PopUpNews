<?php
//simpilotgroup addon module for phpVMS virtual airline system
//
//simpilotgroup addon modules are licenced under the following license:
//Creative Commons Attribution Non-commercial Share Alike (by-nc-sa)
//To view full icense text visit http://creativecommons.org/licenses/by-nc-sa/3.0/
//
//@author David Clark (simpilot)
//@copyright Copyright (c) 2009-2010, David Clark
//@license http://creativecommons.org/licenses/by-nc-sa/3.0/

class PopUpNews extends CodonModule
{
    public function popupnewsitem()
    {
                $id = $_GET['itemid'];

                $result = PopUpNewsData::popupnewsitem($id);

                Template::Set('item', $result);
                Template::Show('popupnews_item.tpl');
        }
    

    public function PopUpNewsList($count=5)
    {

        $sql = 'SELECT id, subject, body, postedby, UNIX_TIMESTAMP(postdate) AS postdate
					 FROM ' . TABLE_PREFIX .'news ORDER BY postdate DESC LIMIT '.$count;

        $res = DB::get_results($sql);

        if(!$res)
            return;

        foreach($res as $row)
        {
            Template::Set('id', $row->id);
            Template::Set('subject', $row->subject);
            Template::Set('postdate', date('m/d/Y', $row->postdate));

            Template::Show('popupnews_list.tpl');
        }
        echo '<center>PopUpNews &copy simpilotgroup.com</center>';
    }
}