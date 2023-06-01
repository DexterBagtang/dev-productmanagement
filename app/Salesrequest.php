<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Salesrequest extends Model
{
  protected $fillable = [
    'mall_id',
    'sales_request_code',
    'qoutation_addressee',
    'requester',
    'date_needed',
    'on_site_survey',
    'comment',
    'project_requirements_files',
    'project_title',
    'category',
    'status'
  ];

  protected $primaryKey = 'sales_request_id';
}
