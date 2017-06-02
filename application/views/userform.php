<?php
/**
 * Created by PhpStorm.
 * User: rebec
 * Date: 5/9/2017
 * Time: 2:25 PM
 */?>
{menubar}

<div class="row text-center">
    {error}
</div>
<br>
<form action="/user/verify" method="post">
    <div class="row">
        <div class="col-md-5 text-right weltext">
            username:
        </div>
        <div class="col-md-3 text-left">
            <input class="form-control" type="text" name="username">
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-md-5 text-right weltext">
            real name:
        </div>
        <div class="col-md-3 text-left">
            <input class="form-control" type="text" name="realname">
        </div>
    </div>
    <br>
    <div class="row text-center">
        <div class="col-md-5 text-right weltext">
            password:
        </div>
        <div class="col-md-3 text-left">
            <input class="form-control" type="password" name="pwd">
        </div>
    </div>
    <br>
    <div class="row text-center">
        <div class="col-md-5 text-right weltext">
            confirm password:
        </div>
        <div class="col-md-3 text-left">
            <input class="form-control" type="password" name="confirm">
        </div>
    </div>
    <br>
    <div class="row text-center">
        <div class="col-md-5 text-right weltext">
            manager
        </div>
        <div class="col-md-3 text-left">
            <input type="checkbox" class="checkbox " name='role' value='manager'>
        </div>
    </div>
    <br>
    <div class="row text-center">
        <div class="col-md-5 text-right weltext">
            <input class="btn" type="submit">
        </div>
        <div class="col-md-4 text-center weltext">
            <input class="btn" type="reset">
        </div>
    </div>
</form>

{footer}
