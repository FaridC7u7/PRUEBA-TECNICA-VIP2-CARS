<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',             // NOMBRES
        'last_name',        // APELLIDOS
        'document_type_id', // TIPO DE DOCUMENTO
        'document_number',  // NRO DE DOCUEMENTO
        'email',            // CORREO ELECTRONICO
        'phone',            // TELEFONO
        'is_active',        // ESTA ACTIVO
        'created_by',       // CREADO POR
        'updated_by',       // MODIFICADO POR
    ];

    public static function filter($filters)
    {
        return self::with('documentType')
            ->where('is_active', true)
            ->when($filters['name'] ?? null, function ($q, $name) {
                $q->where(function ($query) use ($name) {
                    $query->where('name', 'like', "%$name%")
                        ->orWhere('last_name', 'like', "%$name%");
                });
            })
            ->when($filters['document_number'] ?? null, function ($q, $documentNumber) {
                $q->where('document_number', 'like', "%$documentNumber%");
            })
            ->when($filters['query'] ?? null, function ($q, $query) {
                $q->where(function ($queryBuilder) use ($query) {
                    $queryBuilder->where('name', 'like', "%$query%")
                        ->orWhere('last_name', 'like', "%$query%")
                        ->orWhere('document_number', 'like', "%$query%");
                });
            });
    }

    public function document_type()
    {
        return $this->hasMany(Vehicle::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updater()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function documentType()
    {
        return $this->belongsTo(DocumentType::class);
    }
}
