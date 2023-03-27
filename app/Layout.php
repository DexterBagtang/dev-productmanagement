<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class layout extends Model
{
  protected $fillable = [
    'project_id',
    'layout_file'
  ];

  protected $primaryKey = 'layout_id';
}
