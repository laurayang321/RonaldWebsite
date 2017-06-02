<?php

/**
 * Created by PhpStorm.
 * User: rebec
 * Date: 5/18/2017
 * Time: 6:32 PM
 */
class Api extends Application
{

    public function update()
    {
        $reason = $_POST['reasontext'];
        $action = $_POST['actiontext'];
        $groupname = $_POST['groupnametext'];
        $textstories = $_POST['storytext'];
        $totalimage = $_POST['totalimage'];
        $imagenumber = intval($totalimage);
        $images = "";
        $video = "";

        if ($_POST['agreetoshare'] == "false") {
            $agreetoshare = 0;
        } else {
            $agreetoshare = 1;
        }
        $posttime = date("Y-m-d H:i:s");

        date_default_timezone_set('UTC');
        $imagepath = "volunteer/" . date("Y-m-d H:i:s") . $groupname;

        //store image in the "pics" folder
        $target_dir = "pics";
        if (!file_exists($target_dir)) {
            mkdir($target_dir, 0777, true);
        }

        for ($x = 1; $x <= $imagenumber; $x++) {

            $imageindex = "image" . $x;
            $temp = explode(".", $_FILES["$imageindex"]["name"]);
            $newfilename = round(microtime(true)) . $x . '.' . end($temp);
            if ($x == 1) {
                $images .= pathinfo($newfilename, PATHINFO_FILENAME);
            } else {
                $images .= "," . pathinfo($newfilename, PATHINFO_FILENAME);
            }
            $file_dir = $target_dir . "/" . $newfilename;

            if (move_uploaded_file($_FILES["$imageindex"]["tmp_name"], $file_dir)) {
                echo json_encode([
                    "Message" => "The file " . basename($_FILES["$imageindex"]["name"]) . " has been uploaded.",
                    "Status" => "OK",
                ]);
            } else {
                echo json_encode([
                    "Message" => "Sorry, there was an error uploading your file.",
                    "Status" => "Error",
                ]);
            }
        }

        $temp_array = array(
            'reason' => $reason,
            'action' => $action,
            'groupname' => $groupname,
            'textstories' => $textstories,
            'images' => $images,
            'video' => $video,
            'published' => 0,
            'agreetoshare' => $agreetoshare,
            'posttime' => $posttime
        );

        $this->db->insert("stories", $temp_array);
    }

    public function json()
    {
        $this->db->from('stories');
        $this->db->order_by("id", "desc");
        $this->db->where('published', 1);

        $result = $this->db->get()->result();

        $this->data['json'] = json_encode($result);
        $this->data['pagebody'] = "json";
        $this->render();
    }


}