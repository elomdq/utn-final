<section id="register-form">
    <div class="container">
        <div class="row justify-content-center bg-white">
            <div class="col-8">
                <div class="card">

                    <div class="card-header mb-3 py-2">
                        <h5 class=""> Generar Contraseña </h5>
                        <!-- o puedo poner la clase card-header a un div tb y adentro colocar el tecto - revisar bootstrap docs-->
                    </div>

                    <div class="card-body">

                        <form class="" action="<?php echo FRONT_ROOT; ?>home/register" method="post">


                            <div class="form-group py-0">
                                <label for="inputPassword" class="mb-1">Contraseña</label>
                                <input type="password" name="password" class="form-control" id="inputPassword" placeholder="">
                            </div>

                            <div class="form-group py-0">
                                <label for="inputPassword2" class="mb-1">Confirmar Contraseña</label>
                                <input type="password" name="password2" class="form-control" id="inputPassword2" placeholder="">
                            </div>

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