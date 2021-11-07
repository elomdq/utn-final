
<div class="">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class=" col-5">

                <div class="card o-hidden border-0 shadow-lg my-5">
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

                                        <div class="form-group d-flex justify-content-around py-3">

                                            <div align="center">
                                                <input type="radio" id="student" name="userType" value="0" class="d-block" required>
                                                <label for="student" class="">Estudiante</label>
                                            </div>

                                            <div class="" align="center">
                                                <input type="radio" id="admin" name="userType" value="1" class="d-block">
                                                <label for="admin" class="">Administrador</label>     
                                            </div>
                                        
                                            <div align="center">
                                                <input type="radio" id="company" name="userType" value="2" class="d-block">
                                                <label for="company" class="">Empresa</label>
                                            </div>
                                        
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