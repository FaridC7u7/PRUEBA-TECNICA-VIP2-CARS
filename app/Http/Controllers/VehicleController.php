<?php

namespace App\Http\Controllers;

use App\Models\DocumentType;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class VehicleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $validated = $request->validate([
            'plate'  => 'nullable|string|max:6',
            'brand'  => 'nullable|string|max:50',
            'model'  => 'nullable|string|max:50',
            'year'   => 'nullable|digits:4',
            'client' => 'nullable|string|max:100',
        ]);

        $document_types = DocumentType::get();

        if ($request->ajax()) {
            $vehicles = Vehicle::filter($validated)->latest()->get();
            return response()->json($vehicles);
        }

        return view('vehicles.index', compact('document_types'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'plate'     => 'required|string|max:6|unique:vehicles,plate',
                'brand'     => 'required|string|max:50',
                'model'     => 'required|string|max:50',
                'year'      => 'nullable|digits:4|integer|min:1900|max:' . (date('Y') + 1),
                'client_id' => 'required|exists:clients,id',
            ]);

            $validatedData['created_by'] = Auth::user()->id;

            $vehicle = Vehicle::create($validatedData);

            return response()->json($vehicle, 201);
        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Errores de validación',
                'errors'  => $e->errors(),
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Ocurrió un error al crear el vehículo.',
                'error'   => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Vehicle $vehicle)
    {
        try {
            $validatedData = $request->validate([
                'plate'     => 'required|string|max:6|unique:vehicles,plate,' . $vehicle->id,
                'brand'     => 'required|string|max:50',
                'model'     => 'required|string|max:50',
                'year'      => 'nullable|digits:4|integer|min:1900|max:' . (date('Y') + 1),
                'client_id' => 'required|exists:clients,id',
            ]);

            $validatedData['updated_by'] = Auth::user()->id;

            $vehicle->update($validatedData);

            return response()->json([
                'message' => 'Vehículo actualizado exitosamente.',
                'vehicle' => $vehicle,
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Errores de validación',
                'errors'  => $e->errors(),
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Ocurrió un error al actualizar el vehículo.',
                'error'   => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Vehicle $vehicle)
    {
        try {
            $vehicle->update([
                'is_active' => false,
                'updated_by' => Auth::user()->id,
            ]);

            return response()->json([
                'message' => 'Vehículo eliminado exitosamente.',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Ocurrió un error al eliminar el vehículo.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
