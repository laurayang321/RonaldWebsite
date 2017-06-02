<?php

/**
 * Created by PhpStorm.
 * User: rebec
 * Date: 5/7/2017
 * Time: 1:30 PM
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class story extends Application
{

    //homepage for the "story"
    public function index() {
        if(!$this->session->has_userdata('user')) {
            $this->goback();
        }else {
            $this->data['menubar'] = $this->parser->parse("menubar", $this->data, true);
            $this->data['user'] = $this->session->userdata('user');
            $this->data["message"] = "welcome to story management system";
            $this->data['records'] = "<div></div>";
            $this->data['footer'] = $this->parser->parse('footer', $this->data, true);
            $this->data['pagebody'] = "management";
            $this->render();
        }
    }

    //get all stories in the database and order by post time desc
    public function get($value) {
        if(!$this->session->has_userdata('user')) {
            $this->goback();
        }else{
            //var_dump($this->session->userdata('user'));
            $records = array();
            $this->db->from("stories");
            $this->db->order_by("id","desc");
            if($value == "yes") {
                $temp_value = 1;
                $this->db->where('published', $temp_value);
            } else if ($value == "no") {
                $temp_value = 0;
                $this->db->where('published', $temp_value);
            }
            $records =  $this->db->get()->result();
            $tmp_publish="";
            $tempstories = array();
            foreach ($records as $story) {
                if($story->published == 0) {
                    $tmp_publish="NO";
                } else {
                    $tmp_publish="YES";
                }
                $temp_agree ="";
                if($story->agreetoshare == 0) {
                    $temp_agree = "NO";
                }else {
                    $temp_agree = "YES";
                }
                $temp_image = array();
                $temp_link = array();
                $media_result ="";
                if($story->images!="") {
                    $temp_image[] = explode(",",$story->images);
                    //var_dump($temp_image);
                    foreach ($temp_image[0] as $image) {
                        if($image != "") {
                            $temp = "<img class='img-thumbnail' src= '/pics/".$image.".png' width='70px' height='70px'/>";
                            array_push($temp_link,$temp);
                        }
                    }
                    $media_result = implode(" ",$temp_link);
                }
//echo $story->video;
                if($story->video != ""){
                    $temp_link = $story->video;
                    if($media_result!=="") {
                        $media_result .= "<br/><br/>";
                    }
                    $media_result .= "<div class='text-center'><iframe width='300' height='200' src='https://www.youtube.com/embed/".$temp_link."'></iframe></div>";
                }

                $tempstories[] = array(
                    'id' => $story->id,
                    'reason' => $story->reason,
                    'name' => $story->action,
                    'group' => $story->groupname,
                    'story'=>$story->textstories,
                    'publish' => $tmp_publish,
                    'media' => $media_result,
                    'agreetoshare' => $temp_agree,
                    'time' => $story->posttime
                );

            }
            $this->data['menubar'] = $this->parser->parse("menubar", $this->data, true);
            $this->data['footer'] = $this->parser->parse('footer', $this->data, true);
            $this->data['records'] = $tempstories;
            $this->data['pagebody'] = "showstories";
            $this->render();
        }

    }

    //the edit page for a single story
    public function edit($id){
        if(!$this->session->has_userdata('user')) {
            $this->goback();
        } else {
            if(!isset($this->data["notice"])) {
                $this->data["notice"] = "<div></div>";
            }
            $tempArray = $this->stories->getSingleOne($id);
            $this->data['menubar'] = $this->parser->parse("menubar", $this->data, true);
            $this->data["pagebody"] = "editstory";
            $this->data['footer'] = $this->parser->parse('footer', $this->data, true);
            $this->data = array_merge($this->data, $tempArray);
            $this->render();
        }
    }


    //the function that connect to database, and update things
    public function update(){
        if(!$this->session->has_userdata('user')) {
            $this->goback();
        } else {
            $publishvalue = 0;
            if (isset($_POST['publish']) && $_POST['publish'] == 'published') {
                $publishvalue = 1;
            }
            $temp_agree = 0;
            if ($_POST['agree'] == 'YES') {
                $temp_agree = 1;
            }

            $tempstories[] = array(
                //'id' => $_POST['id'],
                'reason' => $_POST['reason'],
                'action' => $_POST['action'],
                'groupname' => $_POST['group'],
                'textstories' => $_POST['text'],
                'published' => $publishvalue
                //'agreetoshare' => $_POST['agree'],
                //'posttime' => $_POST['time']
            );
            $this->db->where('id', $_POST['id']);
            for ($i = 0; $i < sizeof($tempstories); $i++) {
                $this->db->update('stories', $tempstories[$i]);
            }
            $this->get("all");
        }
    }

    //the fuction that delete a single story
    public function delete($id) {
        if(!$this->session->has_userdata('user')) {
            $this->goback();
        } else {
            $this->db->delete('stories', array('id' => $id));
            $this->get("all");
        }
    }

    //delete single image for each story, and update the image attribute in database
    public function imagedelete($id,$image) {
        if(!$this->session->has_userdata('user')) {
            $this->goback();
        } else {
            $temp_result = $this->stories->getAllStories();
            $temp_string = "";
            foreach ($temp_result as $single) {
                if ($single->id == $id) {
                    $a = "," . $image;

                    if (!strpos($single->images, $a)) {
                        $a = $image . ",";
                        if(!strpos($single->images, $a)) {
                            $a = $image;
                        }
                    }
                    $temp_string = str_replace($a, "", $single->images);
                    break;
                }
            }
            $data = array(
                'images' => $temp_string
            );
            $this->db->where('id', $id);
            $this->db->update('stories', $data);
            $this->edit($id);
        }
    }

    public function goback() {
        $this->data['pagebody'] = 'homepage';
        $this->data['message'] = '<br>';
        $this->render();
    }
}