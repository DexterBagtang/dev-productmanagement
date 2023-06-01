<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class mark_up extends Model
{
  protected $fillable = [
    'sales_request_id',
    'markup_uploader',
    'mark_up_file',
      'pnl_file',
    'mark_up_remarks',
    'project_size'
  ];

  protected $primaryKey = 'mark_up_id';
}
