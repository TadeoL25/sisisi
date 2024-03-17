<x-app-layout>
    <div class="container">
        <table class="table my-3">
            <thead>
                <tr>
                    <th scope="col">Usuario</th>
                    <th scope="col">Libro</th>
                    <th scope="col">Estado</th>
                    <th scope="col">Edición</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($prestamos as $prestamo)
                    <tr>
                        <td>{{ $prestamo->persona }}</td>
                        <td>{{ $prestamo->libro }}</td>
                        <td>{{ $prestamo->estado }}</td>
                        <td class="d-flex">
                            <form id="devolverForm{{ $prestamo->id }}"
                                action="{{ route('devolver.prestamo', $prestamo->id) }}" method="POST">
                                @csrf
                                @if($prestamo->estado == 'Prestado')
                                    <button type="submit" class="btn btn-primary devolver-btn text-black" onclick="devolver()"
                                        data-prestamo-id="{{ $prestamo->id }}">
                                        Devolver
                                    </button>
                                @endif
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Modal trigger button -->

        <div class="d-flex justify-content-end">
            <button type="button" class="btn btn-primary btn-lg text-black" data-bs-toggle="modal"
                data-bs-target="#modalNuevoPrestamo">
                Nuevo prestamo
            </button>

            <!-- Modal Body -->
            <!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
            <div class="modal fade" id="modalNuevoPrestamo" tabindex="-1" role="dialog" aria-labelledby="modalTitleId"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm" role="document">
                    <div class="modal-content">
                        <div class="modal-body">Agregar nuevo prestamo</div>

                        <form action="{{ Route('nuevo.prestamo') }}" method="POST">
                            @csrf
                            <div class="container">
                                <label for="" class="mx-3 mt-2">Usuario</label>
                                <select name="persona" id="" class="form-control my-2 rounded">
                                    @foreach ($personas as $persona)
                                        <option value="{{ $persona->nombre }}">{{ $persona->nombre }}</option>
                                    @endforeach
                                </select>
                                <label for="" class="mx-3">Libro</label>
                                <select name="libro" id="" class="form-control my-2 rounded">
                                    @foreach ($libros as $libro)
                                        <option value="{{ $libro->titulo }}">{{ $libro->titulo }}</option>
                                    @endforeach
                                </select>

                                <label for="" class="mx-3 hidden">Estado</label>
                                <select name="estado" id="" class="form-control my-2 hidden rounded">
                                    <option value="Prestado">Prestado</option>

                                </select>
                                <div class="container d-flex justify-content-center">
                                    <button type="submit" class="btn btn-success my-3 text-black" onclick="nuevo()">Enviar</button>
                                </div>
                            </div>
                        </form>
                    </div>
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
            // Espera a que se cargue el DOM
            document.addEventListener("DOMContentLoaded", function() {
                // Agrega un evento de clic a todos los botones de devolución
                var devolverButtons = document.querySelectorAll('.devolver-btn');
                devolverButtons.forEach(function(button) {
                    button.addEventListener('click', function() {
                        // Oculta el botón después de hacer clic
                        this.style.display = 'none';
                    });
                });
            });
        </script>

        <script>
            function devolver() {
                Swal.fire({
                    position: "center",
                    icon: "success",
                    title: "Libro devuelto",
                    showConfirmButton: false,
                    timer: 1500
                });
            }
        </script>

        <script>
            function nuevo() {
                Swal.fire({
                    position: "center",
                    icon: "success",
                    title: "Nuevo prestamo agregado",
                    showConfirmButton: false,
                    timer: 1500
                });
            }
        </script>


        <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
            crossorigin="anonymous"></script>

</x-app-layout>
