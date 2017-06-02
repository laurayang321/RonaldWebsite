<?php

/**
 * Created by PhpStorm.
 * User: rebec
 * Date: 5/7/2017
 * Time: 1:24 PM
 */
class stories extends MY_Model
{
    // Constructor
    public function __construct()
    {
        parent::__construct('stories', 'id');
    }

    public function getAllStories()
    {
        return $this->all();
    }

    public function getSingleOne($id) {
        $tempArray = array();
        foreach ($this->all() as $single) {
            if($single->id == $id) {
                $tmp_publish="";
                if($single->published == 0) {
                    $tmp_publish="";
                } else {
                    $tmp_publish="checked";
                }
                $temp_agree ="";
                if($single->agreetoshare == 0) {
                    $temp_agree = "NO";
                    $tmp_publish = "disabled='disabled'";
                }else {
                    $temp_agree = "YES";
                }
                $temp_image = array();
                $temp_link = array();
                $media_result = "";
                if($single->images!="") {
                    $temp_image[] = explode(",",$single->images);
                    //var_dump($temp_image);
                    foreach ($temp_image[0] as $image) {
                        if($image != "") {
                            $temp ="<div class='col-sm-3 text-center'><a href='/pics/".$image."'>";
                            $temp.="<img src='/pics/".$image.".png' alter='".$image."' width='70px' height='70px'/></a>";
                            $temp.="<a href='/story/imagedelete/".$id."/".$image."'>delete</a>";
                            $temp.="</div>";
                        }
                        array_push($temp_link,$temp);
                    }
                    $media_result = implode(" ",$temp_link);
                }
//echo $story->video;
                if($single->video != ""){
                    $temp_link = $single->video;
                    if($media_result!=="") {
                        $media_result .= "<br/><br/>";
                    }
                    $media_result .= "<div class='col-xs-12 text-center'><iframe width='300' height='200' src='https://www.youtube.com/embed/".$temp_link."'></iframe></div>";
                }

                $tempArray = array(
                    'id' => $single->id,
                    'reason' => $single->reason,
                    'action' => $single->action,
                    'group' => $single->groupname,
                    'text' => $single->textstories,
                    'media' => $media_result,
                    'publish' => $tmp_publish,
                    'agree' => $temp_agree,
                    'time' => $single->posttime
                );
                return $tempArray;
            }
        }
        return null;
    }

    // Compare date/time descending
    public function sortDateTimeDesc($a, $b)
    {
        return strtotime($b['posttime']) - strtotime($a['posttime']);
    }

    public function sortedByDateTime($order)
    {
        // retrieve all transactions
        $transactions = $this->all();
        // convert from array of objects to array of arrays
        foreach ($transactions as $transaction){
            $converted[] = (array) $transaction;
            usort($converted, array($this,"sortDateTimeDesc"));
        }
        return $converted;
    }
}