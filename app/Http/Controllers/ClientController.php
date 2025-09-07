<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\DocumentType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $validated = $request->validate([
            'name' => 'nullable|string|max:100',
            'document_number' => 'nullable|string|max:50',
            'query' => 'nullable|string|max:250',
        ]);

        $document_types = DocumentType::get();

        if ($request->ajax()) {
            $clients = Client::filter($validated)->latest()->get();
            return response()->json($clients);
        }

        return view('clients.index', compact('document_types'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'name'             => 'required|string|max:100',
                'last_name'        => 'required|string|max:100',
                'document_type_id' => 'required|exists:document_type,id',
                'document_number'  => 'required|string|max:50',
                'email'            => 'nullable|email|max:100|unique:clients,email',
                'phone'            => 'nullable|string|max:20',
            ]);

            $exists = Client::where('document_type_id', $validatedData['document_type_id'])
                ->where('document_number', $validatedData['document_number'])
                ->exists();

            if ($exists) {
                return response()->json([
                    'message' => 'Errores de validación',
                    'errors'  => [
                        'document_number' => ['a client with that document type and number already exists.'],
                    ]
                ], 422);
            }

            $validatedData['created_by'] = Auth::user()->id;

            $client = Client::create($validatedData);

            return response()->json($client, 201);
        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Errores de validación',
                'errors'  => $e->errors(),
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Ocurrió un error al crear el cliente.',
                'error'   => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Client $client)
    {
        try {
            $validatedData = $request->validate([
                'name'             => 'required|string|max:100',
                'last_name'        => 'required|string|max:100',
                'document_type_id' => 'required|exists:document_type,id',
                'document_number'  => 'required|string|max:50',
                'email'            => 'nullable|email|max:100|unique:clients,email,' . $client->id,
                'phone'            => 'nullable|string|max:20',
            ]);

            $exists = Client::where('document_type_id', $validatedData['document_type_id'])
                ->where('document_number', $validatedData['document_number'])
                ->where('id', '!=', $client->id)
                ->exists();


            if ($exists) {
                return response()->json([
                    'message' => 'Errores de validación',
                    'errors'  => [
                        'document_number' => ['a client with that document type and number already exists.'],
                    ]
                ], 422);
            }

            $validatedData['updated_by'] = Auth::user()->id;

            $client->update($validatedData);

            return response()->json([
                'message' => 'Cliente actualizado exitosamente.',
                'client'  => $client,
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Errores de validación',
                'errors'  => $e->errors(),
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Ocurrió un error al actualizar el cliente.',
                'error'   => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Client $client)
    {
        try {
            $client->update([
                'is_active' => false,
                'updated_by' => Auth::user()->id,
            ]);

            return response()->json([
                'message' => 'Cliente eliminado exitosamente.',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Ocurrió un error al eliminar el cliente.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
