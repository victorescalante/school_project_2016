<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class faltas extends Model
{
    protected $primaryKey = 'idal';
    protected $table = 'alumnos';
	protected $fillable = ['idf','idev','faltasev1','aprof1','faltasev2','aprof2'];
}
