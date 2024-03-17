<x-app-layout>
    <div class="container">
        <h1 class="py-2 text-black ">Personas</h1>
        <table class="table my-3">
            <thead>
                <tr>
                    <th scope="col">Foto</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Dirección</th>
                    <th scope="col">Teléfono</th>
                    <th scope="col">Edición</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($personas as $persona)
                    <tr>
                        <td>
                            <img src="{{ asset('storage/app/public/' . $persona->imagen) }}" alt="Foto de perfil"
                                class="rounded-circle" width="50px" height="50px">
                        </td>
                        <td>{{ $persona->nombre }}</td>
                        <td>{{ $persona->direccion }}</td>
                        <td>{{ $persona->telefono }}</td>

                        <td class="d-flex">
                            <form action="{{ route('actualizar.persona', $persona->id) }}" method="POST">
                                <button type="button" class="btn btn-primary mx-2"
                                    onclick="editar('{{ $persona->id }}', '{{ $persona->nombre }}', '{{ $persona->direccion }}', {{ $persona->telefono }})">
                                    <i class="fa-solid fa-pen-to-square" style="color: #000000;"></i>
                                </button>
                            </form>
                            <button type="button" class="btn btn-danger" onclick="eliminar({{ $persona->id }})">
                                <i class="fa-solid fa-trash" style="color: #000000;"></i>
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Modal trigger button -->
        <div class="d-flex justify-content-end">
            <button type="button" class="btn btn-primary text-black btn-lg" data-bs-toggle="modal"
                data-bs-target="#modalAgregarPersona">
                Agregar usuario
            </button>
        </div>





        <!-- Modal Body -->
        <!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
        <div class="modal fade" id="modalAgregarPersona" tabindex="-1" role="dialog" aria-labelledby="modalTitleId"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm" role="document">
                <div class="modal-content">
                    <div class="modal-body">Agregar nuevo usuario</div>
                    <form action="{{ Route('nueva.persona') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="container">
                            <label for="" class="mx-3 mt-2">Imágen</label>
                            <input type="file" name="imPer" id="imPer"
                                class="form-control my-2 mx-2 border-black" accept="image/jpg">
                            <label for="" class="mx-3 mt-2">Nombre</label>
                            <input type="text" name="nombre" id="" class="form-control my-2 rounded">
                            <label for="" class="mx-3">Dirección</label>
                            <input type="text" name="direccion" id="" class="form-control my-2 rounded">
                            <label for="" class="mx-3">Teléfono</label>
                            <input type="text" name="telefono" id="" class="form-control my-2 rounded">
                            <div class="container d-flex justify-content-center">
                                <button type="submit" class="btn btn-success my-3 text-black"
                                    onclick="nuevo()">Enviar</button>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal Body -->
        <!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
        <div class="modal fade" id="editarPersona" tabindex="-1" role="dialog" aria-labelledby="modalTitleId"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalTitleId">
                            Editar Persona
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form id="editarPersonaForm" action="{{ route('actualizar.persona', $persona->id) }}"
                        method="POST">
                        @csrf
                        <div class="container">
                            <label for="" class="mx-3 mt-2">Nombre</label>
                            <input type="text" name="nombre" id="editarNombre" class="form-control my-2 rounded">
                            <label for="" class="mx-3">Dirección</label>
                            <input type="text" name="direccion" id="editarDireccion"
                                class="form-control my-2 rounded">
                            <label for="" class="mx-3">Teléfono</label>
                            <input type="text" name="telefono" id="editarTelefono"
                                class="form-control my-2 rounded">
                            <div class="container d-flex justify-content-center">
                                <button type="submit" class="btn btn-success my-3 text-black"
                                    onclick="mensaje()">Enviar</button>
                            </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Optional: Place to the bottom of scripts -->
        <script>
            const myModal = new bootstrap.Modal(
                document.getElementById("modalId"),
                options,
            );
        </script>

        <script>
            function mensaje() {
                Swal.fire({
                    position: "center",
                    icon: "success",
                    title: "Persona actualizada",
                    showConfirmButton: false,
                    timer: 1500
                });
            }
        </script>


        <script>
            function editar(id, nombre, direccion, telefono) {
                $('#editarNombre').val(nombre);
                $('#editarDireccion').val(direccion);
                $('#editarTelefono').val(telefono);
                $('#personaId').val(id);

                var url = "{{ route('actualizar.persona', ':id') }}";
                url = url.replace(':id', id);

                $('#editarPersonaForm').attr('action', url);
                $('#editarPersona').modal('show');
            }
        </script>

        <script>
            function nuevo() {
                Swal.fire({
                    position: "center",
                    icon: "success",
                    title: "Usuario agregado",
                    showConfirmButton: false,
                    timer: 1500
                });
            }
        </script>

        <script>
            function eliminar(id) {
                Swal.fire({
                    title: "¿Estas seguro que quieres eliminarlo?",
                    text: "No podrás recuperarlo",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Si, eliminalo"
                }).then((result) => {
                    if (result.isConfirmed) {
                        url = "{{ route('eliminar.persona', ':id') }}";
                        url = url.replace(':id', id);
                        window.location.href = url;
                        Swal.fire({
                            title: "Eliminado!",
                            text: "Persona eliminada.",
                            icon: "success"
                        });
                    }
                });
            }
        </script>

        <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
            crossorigin="anonymous"></script>


</x-app-layout>
