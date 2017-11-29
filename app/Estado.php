<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Estado extends Model
{
    protected $table = 'estados';
    protected $fillable = ['nombre'];
    public $timestamps = false;
    
    //Crear relación con el modelo Estado
    public function servicio(){
        return $this->belongsTo('App\Servicio');
    }
}
