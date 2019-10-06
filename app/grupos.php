<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class grupos extends Model
{
    protected $primaryKey = 'idgru';
    protected $table = 'grupos';
	protected $fillable = ['idgru','idcct','grado','grupo','cicloesc'];
}
