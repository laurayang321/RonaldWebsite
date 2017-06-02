<?php
/**
 * Created by PhpStorm.
 * User: rebec
 * Date: 5/17/2017
 * Time: 11:10 PM
 */?>
{menubar}
<div class="row text-right">
    <div class="col-sm-3"></div>
    <div class="col-sm-6">
        <a href="/user/addUser"><button class="btn boldtext">Add User</button> </a>
    </div>
    <div class="col-sm-3"></div>
</div>

<div class="row">
    <div class="col-sm-3"></div>
    <div class="col-sm-6">
        <table class="table text-center">
            <tr class="boldtext">
                <td>ID</td>
                <td>Username</td>
                <td>Real Name</td>
                <td></td>
            </tr>
            {records}
            <tr>
                <td>{id}</td>
                <td>{username}</td>
                <td>{realname}</td>
                <td><a href="/user/delete/{id}">{delete}</a></td>
            </tr>
            {/records}
        </table>
    </div>
    <div class="col-sm-3"></div>
</div>
{footer}