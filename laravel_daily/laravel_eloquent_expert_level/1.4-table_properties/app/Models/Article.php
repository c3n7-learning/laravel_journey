<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
  use HasFactory;

  // protected $table = "article";

  // -- custom primary key
  // protected $primaryKey = 'article_id';

  // -- primary key is not incrementing
  // protected $incrementing = false;

  // --  Default value for pagination
  // protected $perPage = 5;

  // -- if you remove the timestamps from migrations
  // public $timestamps = false

  // -- custom timestamp columns
  // public const CREATED_AT = 'created'
  // public const UPDATED_AT = 'updated'


  // -- to specify dates, casting them to carbon objects
  // protected $dates = [];

  // -- to specify carbon date format
  // protect $dateFormat = 'Y-m-d H:i:s';
}
