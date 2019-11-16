<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Website extends Model
{
    public $id;
    public $name;
    public $is_suspended;
    public $is_deleted;
    public $domain_id;

    public function loadWebsite($row)
    {
        $this->id = $row->id;
        $this->name = $row->name;
        $this->is_suspended = $row->name;
        $this->is_deleted = $row->is_deleted;
        $this->domain_id = $row->domain_id;
    }
}
