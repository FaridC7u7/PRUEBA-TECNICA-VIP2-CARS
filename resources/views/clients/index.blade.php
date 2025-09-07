@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Clientes</h5>
                </div>
                <div class="card-body">
                    <form id="form_search_client">
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="document_search">Nro. de documento</label>
                                <input type="text" class="form-control" id="document_search"
                                    placeholder="Número de Documento" maxlength="20">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="name_search">Nombre</label>
                                <input type="text" class="form-control" id="name_search" placeholder="Nombre o Apellido"
                                    maxlength="100">
                            </div>
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-info mr-2">
                                <i class="fa fa-search"></i> Buscar
                            </button>
                            <button type="button" class="btn btn-success" id="btn_add_client" data-toggle="modal"
                                data-target="#client_modal">
                                <i class="fa fa-plus"></i> Agregar
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="card shadow-sm mb-4">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Listado de Clientes</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered" id="clients_table">
                            <thead>
                                <tr>
                                    <th>Tipo de documento</th>
                                    <th>Documento</th>
                                    <th>Nombre</th>
                                    <th>Apellido</th>
                                    <th>Correo</th>
                                    <th>Teléfono</th>
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

    <div class="modal fade" id="client_modal" tabindex="-1" role="dialog" aria-labelledby="client_modal_label"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="client_modal_label">Agregar/Editar Cliente</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <form id="client_form">
                        <input type="hidden" id="client_id" name="id">

                        <h6><strong>Datos Personales</strong></h6>
                        <hr>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="client_document_type" class="form-label">Tipo de Documento</label>
                                    <select id="client_document_type" name="client_document_type" class="form-control"
                                        required>
                                        @foreach ($document_types as $document_type)
                                            <option value="{{ $document_type->id }}"
                                                data-digits="{{ $document_type->digits }}"
                                                data-single-numbers="{{ $document_type->single_numbers }}">
                                                {{ $document_type->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="client_document_number">Nro. de Documento</label>
                                    <input type="text" class="form-control" id="client_document_number"
                                        name="client_document_number" required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="client_name">Nombre</label>
                                    <input type="text" class="form-control" id="client_name" name="client_name"
                                        maxlength="100" required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="client_last_name">Apellidos</label>
                                    <input type="text" class="form-control" id="client_last_name" name="client_last_name"
                                        maxlength="100" required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="client_email">Correo</label>
                                    <input type="email" class="form-control" id="client_email" name="client_email"
                                        maxlength="100" required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="client_phone">Teléfono</label>
                                    <input type="tel" class="form-control" id="client_phone" name="client_phone"
                                        maxlength="20" required>
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
                    <input type="hidden" id="client_to_delete_id">
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
        let clients_table;
        let data_client;

        $(document).ready(function() {
            initDatatable();
            listClients();

            $('#btn_add_client').on('click', function() {
                $('#client_form')[0].reset();
                $('#client_id').val('');
                $('#client_modal_label').text('Agregar Cliente');
            });

            $('#form_search_client').on('submit', function(e) {
                e.preventDefault();
                listClients();
            });

            $('#clients_table tbody').on('click', '.btn-edit-client', function() {
                const clientId = $(this).data('id');
                editClient(clientId);
            });

            $('#clients_table tbody').on('click', '.btn-delete-client', function() {
                const clientId = $(this).data('id');
                $('#client_to_delete_id').val(clientId);
                $('#delete_modal').modal('show');
            });

            $('#confirm_delete_btn').on('click', function() {
                deleteClient();
            });

            // ============ VALIDACIÓN DE INPUTS ==================

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

            // ========= FIN VALIDACIÓN DE INPUTS =================
        });

        function initDatatable() {
            clients_table = $('#clients_table').DataTable({
                language: {
                    url: "https://cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json"
                },
                data: [],
                columns: [{
                        data: 'document_type_name'
                    },
                    {
                        data: 'document_number'
                    },
                    {
                        data: 'name'
                    },
                    {
                        data: 'last_name'
                    },
                    {
                        data: 'email'
                    },
                    {
                        data: 'phone'
                    },
                    {
                        data: null,
                        orderable: false,
                        searchable: false,
                        render: function(data, type, row) {
                            return `
                                <div class="d-flex justify-content-between">
                                    <button class="btn btn-warning btn-sm btn-edit-client mr-2" data-id="${row.id}" data-toggle="modal" data-target="#client_modal">
                                        <i class="fa fa-edit"></i> Editar
                                    </button>
                                    <button class="btn btn-danger btn-sm btn-delete-client" data-id="${row.id}">
                                        <i class="fa fa-trash"></i> Eliminar
                                    </button>
                                </div>
                            `;
                        }
                    }
                ]
            });
        }

        function listClients() {
            const params = new URLSearchParams({
                document_number: $('#document_search').val(),
                name: $('#name_search').val(),
            });

            fetch(`/clients?${params.toString()}`, {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(res => {
                    if (!res.ok) throw new Error('Error al obtener los datos');
                    return res.json();
                })
                .then(data => {
                    data_client = data

                    const formatted = data.map(client => ({
                        id: client.id,
                        document_number: client.document_number,
                        name: client.name,
                        last_name: client.last_name,
                        email: client.email,
                        phone: client.phone,
                        document_type_name: client.document_type?.name || 'Sin tipo de documento'
                    }));

                    clients_table.clear().rows.add(formatted).draw();
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Error al obtener los datos de los clientes.');
                });
        }

        function editClient(clientId) {
            const item = data_client.find(f => f.id == clientId)
            $('#client_modal_label').text('Editar Cliente');

            $('#client_id').val(item.id);
            $('#client_document_type').val(item.document_type_id).change();
            $('#client_document_number').val(item.document_number);
            $('#client_name').val(item.name);
            $('#client_last_name').val(item.last_name);
            $('#client_email').val(item.email);
            $('#client_phone').val(item.phone);
            $('#client_modal').modal('show');
        }

        function saveForm() {
            const form = $('#client_form')[0];
            if (!form.checkValidity()) {
                form.reportValidity();
                return;
            }

            const clientId = $('#client_id').val();
            const item = {
                document_type_id: $('#client_document_type').val(),
                document_number: $('#client_document_number').val(),
                name: $('#client_name').val(),
                last_name: $('#client_last_name').val(),
                email: $('#client_email').val(),
                phone: $('#client_phone').val()
            };

            const url = clientId ? `/clients/${clientId}` : '/clients';
            const method = clientId ? 'PUT' : 'POST';

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
                .then(() => {
                    $('#client_modal').modal('hide');
                    $('#client_form')[0].reset();
                    alert(clientId ? 'Cliente actualizado correctamente' : 'Cliente agregado correctamente');
                    listClients();
                })
                .catch(async error => {
                    if (error.status === 422) {
                        const data = await error.json();
                        alert('Errores en los datos del cliente:\n' + Object.values(data.errors).join('\n'));
                    } else {
                        alert('Error al guardar el cliente.');
                    }
                });
        }

        function deleteClient() {
            const clientId = $('#client_to_delete_id').val();

            fetch(`/clients/${clientId}`, {
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
                            throw new Error(errData.message || 'Error al eliminar el cliente.');
                        });
                    }
                    return res.json();
                })
                .then(data => {
                    $('#delete_modal').modal('hide');
                    alert(data.message || 'Cliente eliminado exitosamente.');
                    listClients();
                })
                .catch(error => {
                    alert(error.message || 'Error inesperado al eliminar el cliente.');
                });
        }
    </script>
@endsection
