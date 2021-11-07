<?php

namespace Views;
?>

<section id="register-form">
    <div class="container">
        <div class="row justify-content-center bg-white">
            <div class="col-8">
                <div class="card">

                    <div class="card-header mb-3 py-2">
                        <h5 class=""> Formulario de Registro </h5>
                        <!-- o puedo poner la clase card-header a un div tb y adentro colocar el tecto - revisar bootstrap docs-->
                    </div>

                    <div class="card-body">

                        <form class="" action="<?php echo FRONT_ROOT; ?>home/generatePassword/" method="post">

                            <div class="form-group py-0">
                                <label for="email" class="mb-1">Email</label>
                                <input type="text" name="email" readonly class="form-control is-valid" id="email" value="<?php echo $student->getEmail(); ?>" >
                            </div>

                            <div class="form-group py-0">
                                <label for="firstName" class="mb-1">Nombre</label>
                                <input type="text" name="firstName" readonly class="form-control" id="firstName" value="<?php echo $student->getFirstName(); ?>">
                            </div>

                            <div class="form-group py-0">
                                <label for="lastName" class="mb-1">Apellido</label>
                                <input type="text" name="lastName" readonly class="form-control" id="lastName" value="<?php echo $student->getLastName(); ?>">
                            </div>

                            <div class="form-group py-0">
                                <label for="birthDate" class="mb-1">Fecha de Nacimiento</label>
                                <input type="text" name="birthDate" readonly class="form-control" id="birthDate" value="<?php echo $student->getBirthDate(); ?>">
                            </div>

                            <div class="form-group py-0">
                                <label for="dni" class="mb-1">DNI</label>
                                <input type="text" name="dni" readonly class="form-control" id="dni" value="<?php echo $student->getDni(); ?>">
                            </div>

                            <div class="form-group py-0">
                                <label for="phoneNumber" class="mb-1">Telefono</label>
                                <input type="text" name="phoneNumber" readonly class="form-control" id="phoneNumber" value="<?php echo $student->getPhoneNumber(); ?>">
                            </div>

                            <div class="form-group py-0">
                                <label for="career" class="mb-1">Carrera</label>
                                <input type="text" name="careerId" readonly class="form-control" id="career" value="<?php echo $student->getCareerId(); ?>">
                            </div>

                            <div class="form-group py-0">
                                <label for="gender" class="mb-1">Genero</label>
                                <input type="text" name="gender" readonly class="form-control" id="gender" value="<?php echo $student->getGender(); ?>">
                            </div>
                            
                            <input type="hidden" name="active" class="form-control" id="active" value="<?php echo $student->getActive(); ?>">
                        
                            <div class="row justify-content-center mt-3">
                                <div class="col-3">
                                    <input type="submit" class="btn btn-primary btn-block my-3" value="Confirmar">
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</section>