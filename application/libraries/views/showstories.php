<?php
/**
 * Created by PhpStorm.
 * User: rebec
 * Date: 5/7/2017
 * Time: 3:34 PM
 */
?>
{menubar}
<div class="row text-center">
    <div class="row ">
        <div class="col-md-1">SORT:</div>
        <div class="col-md-1"><a href="/story/get/all">ALL</a></div>
        <div class="col-md-1"><a href="/story/get/yes">Published</a></div>
        <div class="col-md-2 text-left"><a href="/story/get/no">Not Published</a></div>
    </div>
    <table class="table">
        <tr class="boldtext">
            <td>ID</td>
            <td>Reason to Be Volunteer</td>
            <td>Action</td>
            <td>Group</td>
            <td>Text</td>
            <td>Media</td>
            <td>Publish</td>
            <td>Agree to Share</td>
            <td colspan="2"></td>
        </tr>
        {records}
        <tr>
            <td>{id}</td>
            <td>{reason}</td>
            <td>{action}</td>
            <td>{group}</td>
            <td>{story}</td>
            <td>{media}</td>
            <td>{publish}</td>
            <td>{agreetoshare}</td>
            <td><a href="/story/edit/{id}">edit</a></td>
            <td><a href="/story/delete/{id}">delete</a></td>
        </tr>
        {/records}
    </table>
</div>
{footer}





<!--/story/edit/{id}-->
