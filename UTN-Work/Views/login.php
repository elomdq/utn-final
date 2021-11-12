<div class="">

<div class="container ">
    <div class="row justify-content-center">
        <div class="card col-6 border-0 shadow-lg">
            <div class="card-body">

                                    <div class="mt-3 mb-3 text-center">
                                        <h3 class="text-center">Bienvenido!</h3>
                                    </div> 

                                    <form class="" action="<?php echo FRONT_ROOT?>Home/login" method="post">
                                        
                                        <div class="input-group-md my-3">
                                            <input name="email" type="email" class="form-control form-control-user"
                                                id="inputEmail"
                                                placeholder="Ingrese su email para iniciar sesión...">
                                        </div>

                                        <div class="input-group-md my-3">
                                            <input type="password" class="form-control form-control-user"
                                                id="password" placeholder="Contraseña" name="password">
                                        </div> 
                                        
                                        <div class="input-group-lg my-3 col text-center">
                                            <button type="submit" class="btn btn-primary">Login</button>
                                        </div>
                                                                               
                                    </form>

                                    <div class="text-center mt-4 mb-0">
                                        <a class="small" href="<?php echo FRONT_ROOT . "home/checkEmail"?>" >Registrarse</a>
                                    </div> 

                                </div>
                            </div>
                        </div>
                   
                

            </div>
        </div>
    </div>
</div>