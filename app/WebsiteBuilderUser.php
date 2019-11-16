<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WebsiteBuilderUser extends Model
{
    public $id;
    public $username;
    public $password;

    public function loadFromRow($row)
    {
        $this->id = $row->id;
        $this->username = $row->username;
        $this->password = $row->password;
    }
    public function validate($row){
        if($row){
            if($this->username == $row->username && $this->password == $row->password){
                return true;
            }
        }
        return false;
    }
}
