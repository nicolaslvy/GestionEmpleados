<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    use HasFactory;

    protected $fillable = ['nombres', 'apellidos', 'identificacion', 'direccion', 'telefono', 'ciudad_nacimiento', 'activo'];

    public function cargos()
    {
        return $this->belongsToMany(Cargo::class, 'empleado_cargo');
    }

    public function jefes()
    {
        return $this->belongsToMany(Empleado::class, 'jefe_empleado', 'empleado_id', 'jefe_id');
    }

    public function colaboradores()
    {
        return $this->belongsToMany(Empleado::class, 'jefe_empleado', 'jefe_id', 'empleado_id');
    }

    public function setJefesAttribute($value)
    {
        // Si el empleado tiene el cargo "Presidente", no permitir jefes
        if ($this->cargos()->where('nombre', 'Presidente')->exists()) {
            $this->attributes['jefes'] = null;
        } else {
            $this->attributes['jefes'] = $value;
        }
    }
}
