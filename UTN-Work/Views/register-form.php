<?php

namespace Views;
?>

<!--<section id="register-form">-->
    <div class="container">
        <div class="row justify-content-center bg-white">
            <div class="col-8">
                <div class="card">

                    <div class="card-header mb-3 py-2">
                        <h5 class=""> Formulario de Registro </h5>
                        <!-- o puedo poner la clase card-header a un div tb y adentro colocar el tecto - revisar bootstrap docs-->
                    </div>

                    <div class="card-body">

                        <form class="" action="" method="">

                            <div class="form-group py-1">
                                <label for="email">Email</label>
                                <input type="text" readonly class="form-control" id="email" value="<?php echo $student->getEmail(); ?>">
                            </div>


                            <div class="form-group py-1">
                                <label for="firstName" class="">Nombre</label>
                                <input type="text" readonly class="form-control" id="firstName" value="<?php echo $student->getFirstName(); ?>">
                            </div>

                            <div class="form-group py-1">
                                <label for="lastName" class="">Apellido</label>
                                <input type="text" readonly class="form-control" id="lastName" value="<?php echo $student->getLastName(); ?>">
                            </div>

                            <div class="form-group py-1">
                                <label for="birthDate" class="">Fecha de Nacimiento</label>
                                <input type="text" readonly class="form-control" id="birthDate" value="<?php echo $student->getBirthDate(); ?>">
                            </div>

                            <div class="form-group py-1">
                                <label for="dni" class="">DNI</label>
                                <input type="text" readonly class="form-control" id="dni" value="<?php echo $student->getDni(); ?>">
                            </div>

                            <div class="form-group py-1">
                                <label for="phoneNumber" class="">Telefono</label>
                                <input type="text" readonly class="form-control" id="phoneNumber" value="<?php echo $student->getPhoneNumber(); ?>">
                            </div>

                            <div class="form-group py-1">
                                <label for="career" class="">Carrera</label>
                                <input type="text" readonly class="form-control" id="career" value="<?php echo $student->getCareerId(); ?>">
                            </div>

                            <div class="form-group py-1">
                                <label for="gender" class="">Genero</label>
                                <input type="text" readonly class="form-control" id="gender" value="<?php echo $student->getGender(); ?>">
                            </div>

                            <div class="form-group py-1">
                                <label for="inputPassword" class="">Password</label>
                                <input type="password" class="form-control" id="inputPassword" placeholder="Password">
                            </div>

                            <div class="row justify-content-center mt-3">
                                <div class="col-3">
                                    <input type="submit" class="btn btn-primary btn-block my-3" value="Registrarse">
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
<!-- </section> -->