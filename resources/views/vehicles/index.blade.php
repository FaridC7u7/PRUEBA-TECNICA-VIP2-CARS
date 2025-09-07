@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Vehículos</h5>
                </div>
                <div class="card-body">
                    <form id="form_search_vehicle">
                        <div class="form-row">
                            <div class="form-group col-md-2">
                                <label for="plate_search">Placa</label>
                                <input type="text" class="form-control" id="plate_search" placeholder="Placa"
                                    maxlength="6">
                            </div>
                            <div class="form-group col-md-2">
                                <label for="brand_search">Marca</label>
                                <input type="text" class="form-control" id="brand_search" placeholder="Marca"
                                    maxlength="50">
                            </div>
                            <div class="form-group col-md-2">
                                <label for="model_search">Modelo</label>
                                <input type="text" class="form-control" id="model_search" placeholder="Modelo"
                                    maxlength="50">
                            </div>
                            <div class="form-group col-md-2">
                                <label for="year_search">Año de Fabricación</label>
                                <input type="text" class="form-control" id="year_search" placeholder="Año"
                                    maxlength="4">
                            </div>
                            <div class="form-group col-md-2">
                                <label for="client_search">Cliente</label>
                                <input type="text" class="form-control" id="client_search"
                                    placeholder="Nro. de documento o nombre" maxlength="250">
                            </div>
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-info mr-2">
                                <i class="fa fa-search"></i> Buscar
                            </button>
                            <button type="button" class="btn btn-success" id="btn_add_vehicle" data-toggle="modal"
                                data-target="#vehicle_modal">
                                <i class="fa fa-plus"></i> Agregar
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="card shadow-sm mb-4">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Listado de Vehículos</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered" id="vehicles_table">
                            <thead>
                                <tr>
                                    <th>Placa</th>
                                    <th>Marca</th>
                                    <th>Modelo</th>
                                    <th>Año</th>
                                    <th>Cliente</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="vehicle_modal" tabindex="-1" role="dialog" aria-labelledby="vehicle_modal_label"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="vehicle_modal_label">Agregar/Editar Vehículo</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="vehicle_form">
                        <input type="hidden" id="vehicle_id" name="id">
                        <input type="hidden" id="client_id" name="client_id">

                        <div class="row">
                            <div class="col-md-6">
                                <h6><strong>Datos del Vehículo</strong></h6>
                                <hr>
                                <div class="form-group">
                                    <label for="plate">Placa</label>
                                    <input type="text" class="form-control" id="plate" name="plate" maxlength="6"
                                        required>
                                </div>
                                <div class="form-group">
                                    <label for="brand">Marca</label>
                                    <input type="text" class="form-control" id="brand" name="brand" maxlength="50"
                                        required>
                                </div>
                                <div class="form-group">
                                    <label for="model">Modelo</label>
                                    <input type="text" class="form-control" id="model" name="model"
                                        maxlength="50" required>
                                </div>
                                <div class="form-group">
                                    <label for="year">Año de Fabricación</label>
                                    <input type="text" class="form-control" id="year" name="year"
                                        maxlength="4" required>
                                </div>

                            </div>

                            <div class="col-md-6">
                                <h6><strong>Datos del Cliente</strong></h6>
                                <hr>
                                <div class="form-group client-search-container">
                                    <label for="search_client">Buscar Cliente</label>
                                    <div class="input-group mb-2">
                                        <input type="text" class="form-control" id="search_client"
                                            placeholder="Buscar por Nro. de documento o nombre">
                                        <div class="input-group-append">
                                            <button class="btn btn-outline-secondary" type="button"
                                                id="search_client_btn">
                                                <i class="fa fa-search"></i>
                                            </button>
                                            <button class="btn btn-outline-success" type="button" id="btn_new_client">
                                                <i class="fa fa-plus"></i> Nuevo
                                            </button>
                                        </div>
                                    </div>
                                    <div class="client-search-results" id="client_results_list" style="display: none;">
                                    </div>
                                </div>

                                <div class="mb-2" id="client_actions" style="display: none;">
                                    <button type="button" class="btn btn-sm btn-warning" id="btn_cancel_new_client">
                                        <i class="fa fa-times"></i> Cancelar nuevo cliente
                                    </button>
                                </div>

                                <div id="client_details_container">
                                    <div class="form-group">
                                        <label for="client_document_type" class="form-label">Tipo de Documento</label>
                                        <select id="client_document_type" name="client_document_type"
                                            class="form-control" required disabled>
                                            @foreach ($document_types as $document_type)
                                                <option value="{{ $document_type->id }}"
                                                    data-digits="{{ $document_type->digits }}"
                                                    data-single-numbers="{{ $document_type->single_numbers }}">
                                                    {{ $document_type->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="client_document_number">Nro. de Documento</label>
                                        <input type="text" class="form-control" id="client_document_number"
                                            name="client_document_number" required readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="client_name">Nombre</label>
                                        <input type="text" class="form-control" id="client_name" name="client_name"
                                            maxlength="100" required readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="client_last_name">Apellidos</label>
                                        <input type="text" class="form-control" id="client_last_name" maxlength="100"
                                            name="client_last_name" required readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="client_email">Correo</label>
                                        <input type="email" class="form-control" id="client_email" name="client_email"
                                            maxlength="100" required readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="client_phone">Teléfono</label>
                                        <input type="tel" class="form-control" id="client_phone" name="client_phone"
                                            maxlength="20" required readonly>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" onclick="saveForm()">Guardar Cambios</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="delete_modal" tabindex="-1" role="dialog" aria-labelledby="delete_modal_label"
        aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="delete_modal_label">Confirmar Eliminación</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="vehicle_to_delete_id">
                    ¿Estás seguro de que deseas eliminar este registro?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-danger" id="confirm_delete_btn">Eliminar</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        let vehiculos_table;
        let data_vehicle;

        $(document).ready(function() {
            initDatatable()
            listVehicles();

            $('#btn_add_vehicle').on('click', function() {
                $('#vehicle_form')[0].reset();
                $('#vehicle_id').val('');
                $('#vehicle_modal_label').text('Agregar Vehículo');
                $('#client_id').val('');
                $('#search_client').val('');
                $("#btn_cancel_new_client").click()
                disableClientFields();
            });

            $('#search_client_btn').on('click', function() {
                searchClients()
            });

            $('#client_results_list').on('click', '.client-result', function() {
                const client = $(this).data('client');
                selectClient(client);
            });

            $('#btn_new_client').on('click', function() {
                activateNewClientMode();
            });

            $('#btn_cancel_new_client').on('click', function() {
                cancelNewClientMode();
            });

            $('#form_search_vehicle').on('submit', function(e) {
                e.preventDefault();
                listVehicles();
            });

            $('#vehicles_table tbody').on('click', '.btn-edit-vehicle', function() {
                const vehicleId = $(this).data('id');
                editVehicle(vehicleId)
            });

            $('#vehicles_table tbody').on('click', '.btn-delete-vehicle', function() {
                const vehicleId = $(this).data('id');
                $('#vehicle_to_delete_id').val(vehicleId);
                $('#delete_modal').modal('show');
            });

            $('#confirm_delete_btn').on('click', function() {
                deleteVehicle()
            })

            // ============ VALIDATION INPUTS ==================

            $('#year, #year_search').on('input', function() {
                let cleanValue = $(this).val().replace(/\D/g, '').slice(0, 4);
                $(this).val(cleanValue);
            });

            $('#client_phone').on('input', function() {
                let cleanValue = $(this).val().replace(/\D/g, '').slice(0, 20);
                $(this).val(cleanValue);
            });

            $('#client_document_type').on('change', function() {

                let selectedOption = $(this).find('option:selected');
                let digitsValue = parseInt(selectedOption.data('digits'));
                let singleNumbersValue = parseInt(selectedOption.data('single-numbers'));

                $('#client_document_number').val("")

                if (digitsValue) {
                    $('#client_document_number').attr('maxlength', digitsValue);
                } else {
                    $('#client_document_number').removeAttr('maxlength');
                }

                $('#client_document_number').off('input').on('input', function() {
                    let value = $(this).val();
                    if (singleNumbersValue === 1) {
                        value = value.replace(/\D/g, '');
                    }
                    if (digitsValue) {
                        value = value.slice(0, digitsValue);
                    }
                    $(this).val(value);
                });
            });

            $('#client_document_type').trigger('change');


            // ========= END VALIDATION INPUTS =================

        });

        function initDatatable() {
            vehicles_table = $('#vehicles_table').DataTable({
                language: {
                    url: "https://cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json"
                },
                data: [],
                columns: [{
                        data: 'plate'
                    },
                    {
                        data: 'brand'
                    },
                    {
                        data: 'model'
                    },
                    {
                        data: 'year'
                    },
                    {
                        data: 'client_name'
                    },
                    {
                        data: null,
                        orderable: false,
                        searchable: false,
                        render: function(data, type, row) {
                            return `
                                <div class="d-flex justify-content-between">
                                    <button class="btn btn-warning btn-sm btn-edit-vehicle mr-2" data-id="${row.id}" data-toggle="modal" data-target="#vehicle_modal">
                                        <i class="fa fa-edit"></i> Editar
                                    </button>
                                    <button class="btn btn-danger btn-sm btn-delete-vehicle" data-id="${row.id}" data-toggle="modal" data-target="#delete_modal">
                                        <i class="fa fa-trash"></i> Eliminar
                                    </button>
                                </div>
                            `;
                        }
                    }
                ]
            });
        }

        function listVehicles() {
            const params = new URLSearchParams({
                plate: $('#plate_search').val(),
                brand: $('#brand_search').val(),
                model: $('#model_search').val(),
                year: $('#year_search').val(),
                client: $('#client_search').val()
            });

            fetch(`/vehicles?${params.toString()}`, {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(res => {
                    if (!res.ok) throw new Error('Error al obtener los datos');
                    return res.json();
                })
                .then(data => {
                    data_vehicle = data

                    const formatted = data.map(vehicle => ({
                        id: vehicle.id,
                        plate: vehicle.plate,
                        brand: vehicle.brand,
                        model: vehicle.model,
                        year: vehicle.year,
                        client_name: `${vehicle.client?.document_number} - ${vehicle.client?.name} ${vehicle.client?.last_name}` ||
                            'Sin cliente'
                    }));

                    vehicles_table.clear().rows.add(formatted).draw();
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        }

        function editVehicle(vehicleId) {
            const item = data_vehicle.find(f => f.id == vehicleId)

            $("#btn_cancel_new_client").click()
            $('#vehicle_modal_label').text('Editar Vehículo');
            $('#vehicle_id').val(item.id);
            $('#plate').val(item.plate);
            $('#brand').val(item.brand);
            $('#model').val(item.model);
            $('#year').val(item.year);

            if (item.client) {
                $('#client_id').val(item.client.id);
                $('#search_client').val(
                    `${item.client.name} ${item.client.last_name}`);
                $('#client_document_type').val(item.client.document_type_id);
                $('#client_document_number').val(item.client.document_number);
                $('#client_name').val(item.client.name);
                $('#client_last_name').val(item.client.last_name);
                $('#client_email').val(item.client.email);
                $('#client_phone').val(item.client.phone);
                disableClientFields();
            }
        }

        function saveForm() {
            const form = $('#vehicle_form')[0];

            if (!form.checkValidity()) {
                form.reportValidity();
                return;
            }

            const vehicleId = $('#vehicle_id').val();
            const clientId = $('#client_id').val();

            if (clientId) {
                storeOrUpdateVehicle(vehicleId);
                return;
            }

            const newClientData = {
                name: $('#client_name').val(),
                last_name: $('#client_last_name').val(),
                document_type_id: $('#client_document_type').val(),
                document_number: $('#client_document_number').val(),
                email: $('#client_email').val(),
                phone: $('#client_phone').val(),
            };

            fetch('/clients', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    },
                    body: JSON.stringify(newClientData)
                })
                .then(res => {
                    if (!res.ok) throw res;
                    return res.json();
                })
                .then(client => {
                    $('#client_id').val(client.id);
                    storeOrUpdateVehicle(vehicleId);
                })
                .catch(async error => {
                    if (error.status === 422) {
                        const data = await error.json();
                        alert('Errores en los datos del cliente:\n' + Object.values(data.errors).join('\n'));
                    } else {
                        alert('Error al crear cliente.');
                    }
                });
        }

        function storeOrUpdateVehicle(vehicleId) {
            const item = {
                plate: $('#plate').val(),
                brand: $('#brand').val(),
                model: $('#model').val(),
                year: $('#year').val(),
                client_id: $('#client_id').val()
            };

            const url = vehicleId ? `/vehicles/${vehicleId}` : '/vehicles';
            const method = vehicleId ? 'PUT' : 'POST';

            fetch(url, {
                    method: method,
                    headers: {
                        'Content-Type': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    },
                    body: JSON.stringify(item)
                })
                .then(res => {
                    if (!res.ok) throw res;
                    return res.json();
                })
                .then(data => {
                    $('#vehicle_modal').modal('hide');
                    $('#vehicle_form')[0].reset();
                    $('#client_id').val('');
                    $('#vehicle_id').val('');
                    listVehicles();
                    alert(vehicleId ? 'Vehículo actualizado correctamente' : 'Vehículo creado correctamente');
                })
                .catch(async error => {
                    if (error.status === 422) {
                        const data = await error.json();
                        alert('Errores en los datos del vehículo:\n' + Object.values(data.errors).join('\n'));
                    } else {
                        alert('Error al guardar vehículo.');
                    }
                });
        }

        function deleteVehicle() {
            const vehicleId = $('#vehicle_to_delete_id').val();

            fetch(`/vehicles/${vehicleId}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json',
                    }
                })
                .then(res => {
                    if (!res.ok) {
                        return res.json().then(errData => {
                            throw new Error(errData.message || 'Error al eliminar el vehículo.');
                        });
                    }
                    return res.json();
                })
                .then(data => {
                    $('#delete_modal').modal('hide');
                    alert(data.message || 'Vehículo eliminado exitosamente.');
                    listVehicles();
                })
                .catch(error => {
                    alert(error.message || 'Error inesperado al eliminar el vehículo.');
                });
        }

        function enableClientFields() {
            $('#client_details_container input, #client_details_container select').prop('readonly', false).prop('disabled',
                false);
        }

        function disableClientFields() {
            $('#client_details_container input, #client_details_container select').prop('readonly', true).prop('disabled',
                true);
        }

        function clearClientFields() {
            $('#client_id').val('');
            $('#client_details_container input, #client_details_container select').val('');
            $('#search_client').val('');
            $('#client_results_list').empty().hide();
        }

        function activateNewClientMode() {
            clearClientFields();
            enableClientFields();

            $('#search_client').prop('disabled', true);
            $('#search_client_btn').prop('disabled', true);
            $('#btn_new_client').hide();
            $('#client_actions').show();
        }

        function cancelNewClientMode() {
            clearClientFields();
            disableClientFields();

            $('#search_client').prop('disabled', false);
            $('#search_client_btn').prop('disabled', false);
            $('#btn_new_client').show();
            $('#client_actions').hide();
        }

        function searchClients() {
            const search = $('#search_client').val().trim();
            if (!search) return;

            const params = new URLSearchParams({
                query: search,
            });

            fetch(`/clients?${params.toString()}`, {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(res => {
                    if (!res.ok) throw new Error('Error al buscar cliente');
                    return res.json();
                })
                .then(clients => {
                    if (!clients.length) {
                        $('#client_results_list').html(
                            '<div class="text-danger">No se encontraron clientes</div>').show();
                        return;
                    }

                    const html = clients.map(client => `
                            <div class="client-result border p-2 mb-1" style="cursor:pointer;" data-client='${JSON.stringify(client)}'>
                                <strong>${client.name} ${client.last_name}</strong> - ${client.document_number}
                            </div>
                        `).join('');

                    $('#client_results_list').html(html).show();
                })
                .catch(err => {
                    console.error(err);
                    alert('Error al buscar cliente');
                });
        }

        function selectClient(client) {
            $('#client_id').val(client.id);
            $('#client_document_type').val(client.document_type_id);
            $('#client_document_number').val(client.document_number);
            $('#client_name').val(client.name);
            $('#client_last_name').val(client.last_name);
            $('#client_email').val(client.email);
            $('#client_phone').val(client.phone);
            disableClientFields();
            $('#client_results_list').hide().empty();
        }
    </script>
@endsection
