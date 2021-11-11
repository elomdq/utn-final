
<div class="">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class=" col-5">

                <div class="card o-hidden border-0 shadow-lg my-3">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row  justify-content-center">
                            <!-- <div class="col-lg-6 d-none d-lg-block bg-login-image"></div> -->
                            <div class="col-lg-10">
                                <div class="px-2 py-4">

                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Bienvenido!</h1>
                                    </div>                                   
                                    <form class="user" action="<?php echo FRONT_ROOT?>Home/login" method="post">
                                        
                                        <div class="form-group">
                                            <input name="email" type="email" class="form-control form-control-user"
                                                id="exampleInputEmail" aria-describedby="emailHelp"
                                                placeholder="Ingrese su email para iniciar sesión...">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user"
                                                id="password" placeholder="Contraseña" name="password">
                                        </div>                                    
                                        <input type="submit" class="btn btn-primary btn-user btn-block" value="Login">
                                       
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

    </div>

</div>