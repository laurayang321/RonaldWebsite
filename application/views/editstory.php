<?php
/**
 * Created by PhpStorm.
 * User: rebec
 * Date: 5/10/2017
 * Time: 1:26 AM
 */?>
{menubar}

<form  action="/story/update" method="post">
    <input type="hidden" name="id" value={id} >
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-1">
            <div class="col-xs-12 editlabeltext">Volunteer Name</div>
        </div>
        <div class="col-md-4">
            <input class="form-control" type="text" name="action" class="editwidth" value={name}>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-1">
            <div class="col-xs-12 editlabeltext">Group</div>
        </div>
        <div class="col-md-4">
            <input class="form-control" type="text" name="group" class="editwidth" value={group}>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-1">
            <div class="col-xs-12 editlabeltext">Activity Time</div>
        </div>
        <div class="col-md-4">
            <input class="form-control" type="text" name="time" class="editwidth" value={time} readonly>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-4">
            <div class="col-xs-12 editlabeltext">Reason to choose RMHCNA</div>
        </div>
        <div class="col-md-4"></div>
    </div>
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-5">
            <textarea class="form-control" type="text" rows="3" name="reason" class="editwidth">{reason}</textarea>
        </div>
        <div class="col-md-4"></div>
    </div>
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-4">
            <div class="col-xs-12 editlabeltext">Shared Experience</div>
        </div>
        <div class="col-md-4"></div>
    </div>
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-5">
            <textarea class="form-control" rows="4" type="text" name="text" class="textstyle">{text}</textarea>
        </div>
        <div class="col-md-4"></div>
    </div>
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-4">
            <div class="col-xs-12 editlabeltext">Media</div>
        </div>
        <div class="col-md-4"></div>
    </div>
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-5 text-center">
            {media}
        </div>
        <div class="col-md-4"></div>
    </div>
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-1">
            <div class="col-xs-12 editlabeltext">Publish</div>
        </div>
        <div class="col-md-4">
            <input class="checkbox" type='checkbox' name='publish' value='published' {publish} />
        </div>
    </div>
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-1">
            <div class="col-xs-12 editlabeltext">Agree to Share</div>
        </div>
        <div class="col-md-4">
            <input class="form-control" type="text" name="agree" class="editwidth" value={agree} readonly>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-xs-7 text-center">
            <input type="submit" value="update" class="btn">
        </div>
        <div class="col-xs-5 text-left editlabeltext">
            <a href="/story/get/all"><input type="button" value="cancel" class="btn"></a>
        </div>
    </div>
    <br>
    <br>
</form>

{footer}


