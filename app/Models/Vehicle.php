<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'plate',            // PLACA
        'brand',            // MARCA
        'model',            // MODELO
        'year',             // A~NO
        'client_id',        // CLIENTE
        'is_active',        // ESTA ACTIVO
        'created_by',       // CREADO POR
        'updated_by',       // MODIFICADO POR
    ];

    public static function filter($filters)
    {
        return self::with('client')
            ->where('is_active', true)
                ->when($filters['plate'] ?? null, fn($q, $plate) =>
                $q->where('plate', 'like', "%$plate%"))
                ->when($filters['brand'] ?? null, fn($q, $brand) =>
                $q->where('brand', 'like', "%$brand%"))
                ->when($filters['model'] ?? null, fn($q, $model) =>
                $q->where('model', 'like', "%$model%"))
                ->when($filters['year'] ?? null, fn($q, $year) =>
                $q->where('year', $year))
                ->when($filters['client'] ?? null, function ($q, $client) {
                    $q->whereHas('client', function ($q) use ($client) {
                        $q->where(function ($query) use ($client) {
                            $query->where('name', 'like', "%$client%")
                                ->orWhere('last_name', 'like', "%$client%")
                                ->orWhere('document_number', 'like', "%$client%");
                        });
                    });
                });
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updater()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
