<?php 
namespace Views;
?>

<section id="register-form">
<div class="container">
        <div class="row justify-content-center bg-white">
            <div class="col-8">
                <div class="card">

                    <div class="card-header mb-3 py-2">
                        <h5 class="">Validacion de Inscripcion</h5>
                        <!-- o puedo poner la clase card-header a un div tb y adentro colocar el tecto - revisar bootstrap docs-->
                    </div>

                    <div class="card-body">

                        <form class="" action="<?php echo FRONT_ROOT?>home/confirmData" method="post">

                            <div class="form-group py-1">
                                <label for="inputEmail">Email</label>
                                <input name="email" type="email" class="form-control" id="inputEmail"
                                    aria-describedby="emailHelp" placeholder="Ingrese su email para verificar si se encuentra inscripto.">
                            </div>
                           
                                <div class="row justify-content-center mt-3">
                                    <div class="col-3">
                                        <input type="submit" class="btn btn-primary btn-block my-3" value="Validar">
                                    </div>
                                </div>
                           

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
