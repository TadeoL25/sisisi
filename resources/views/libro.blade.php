<x-app-layout>
    <div class="container ">
        <h1 class="py-2 text-black ">Libros</h1>
        <table class="table my-3">
            <thead>
                <tr>

                    <th scope="col">Titulo</th>
                    <th scope="col">Autor</th>
                    <th scope="col">Editorial</th>
                    <th scope="col">ISBN</th>
                    <th scope="col">Estado</th>
                    <th scope="col">Edición</th>

                </tr>
            </thead>

            <tbody>
                @foreach ($libros as $libro)
                    <tr>

                        <td>{{ $libro->titulo }}</td>
                        <td>{{ $libro->autor }}</td>
                        <td>{{ $libro->editorial }}</td>
                        <td>{{ $libro->isbn }}</td>
                        <td>{{ $libro->estado }}</td>
                        <td class="d-flex">
                            <form action="{{ route('actualizar.libro', $libro->id) }}" method="POST">
                                <button type="button" class="btn btn-primary mx-2"
                                    onclick="editar('{{ $libro->id }}', '{{ $libro->titulo }}', '{{ $libro->autor }}', '{{ $libro->editorial }}', '{{ $libro->isbn }}')">
                                    <i class="fa-solid fa-pen-to-square" style="color: #000000;"></i>
                                </button>
                            </form>
                            <button type="button" class="btn btn-danger" onclick="eliminar({{ $libro->id }})">
                                <i class="fa-solid fa-trash" style="color: #000000;"></i>
                            </button>
                        </td>
                    </tr>
                @endforeach
        </table>

        <!-- Modal trigger button -->
        <div class="d-flex justify-content-end">
            <button type="button" class="btn btn-primary text-black btn-lg" data-bs-toggle="modal"
                data-bs-target="#modalAgregarLibro">
                Agregar Libro
            </button>
        </div>



        <!-- Modal Body -->
        <!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
        <div class="modal fade" id="modalAgregarLibro" tabindex="-1" role="dialog" aria-labelledby="modalTitleId"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm" role="document">
                <div class="modal-content">
                    <div class="modal-body">Agregar nuevo libro</div>
                    <form action="{{ Route('nuevo.libro') }}" method="POST">
                        @csrf
                        <div class="container">
                            <label for="" class="mx-3 mt-2">Titulo</label>
                            <input type="text" name="titulo" id="" class="form-control my-2 rounded">
                            <label for="" class="mx-3">Autor</label>
                            <input type="text" name="autor" id="" class="form-control my-2 rounded">
                            <label for="" class="mx-3">Editorial</label>
                            <input type="text" name="editorial" id="" class="form-control my-2 rounded">
                            <label for="" class="mx-3">ISBN</label>
                            <input type="text" name="isbn" id="" class="form-control my-2 rounded">
                            <div class="container d-flex justify-content-center">
                                <button type="submit" class="btn btn-success my-3 text-black" onclick="nuevo()">Enviar</button>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>


        <!-- Modal Body -->
        <!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
        <div class="modal fade" id="editarLibro" tabindex="-1" role="dialog" aria-labelledby="modalTitleId"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalTitleId">
                            Editar libro
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form id="editarLibroForm" action="{{ route('actualizar.libro', $libro->id) }}" method="POST">
                        @csrf
                        <div class="container">
                            <input type="hidden" name="id" id="editarId" value="">
                            <label for="" class="mx-3 mt-2">Titulo</label>
                            <input type="text" name="titulo" id="editarTitulo" class="form-control my-2 rounded">
                            <label for="" class="mx-3">Autor</label>
                            <input type="text" name="autor" id="editarAutor" class="form-control my-2 rounded">
                            <label for="" class="mx-3">Editorial</label>
                            <input type="text" name="editorial" id="editarEditorial"
                                class="form-control my-2 rounded">
                            <label for="" class="mx-3">ISBN</label>
                            <input type="text" name="isbn" id="editarIsbn" class="form-control my-2 rounded">
                            <div class="container d-flex justify-content-center">
                                <button type="submit" class="btn btn-success my-3 text-black" onclick="edit()">Enviar</button>
                            </div>
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
            function nuevo() {
                Swal.fire({
                    position: "center",
                    icon: "success",
                    title: "Libro agregado",
                    showConfirmButton: false,
                    timer: 1500
                });
            }
        </script>

        <script>
            function edit(){
                Swal.fire({
                    position: "center",
                    icon: "success",
                    title: "Libro actualizado",
                    showConfirmButton: false,
                    timer: 1500
                });
            }
        </script>

        <script>
            function editar(id, titulo, autor, editorial, isbn) {
                $('#editarTitulo').val(titulo);
                $('#editarAutor').val(autor);
                $('#editarEditorial').val(editorial);
                $('#editarIsbn').val(isbn);
                $('#editarId').val(id); // Asigna el ID del libro al campo oculto

                var url = "{{ route('actualizar.libro', ':id') }}";
                url = url.replace(':id', id);

                $('#editarLibroForm').attr('action', url);
                $('#editarLibro').modal('show');
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
                        Swal.fire({
                            title: "Eliminado!",
                            text: "Libro eliminado.",
                            icon: "success"
                        });
                        url = "{{ route('eliminar.libro', ':id') }}";
                        url = url.replace(':id', id);
                        window.location.href = url;
                    }
                });
            }
        </script>

        <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
            crossorigin="anonymous"></script>

</x-app-layout>
