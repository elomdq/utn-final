<main class="py-5">
     <section id="listado" class="mb-5">
          <div class="container">
               <h2 class="mb-4">Agregar Empresa</h2>
               <form action="<?php echo FRONT_ROOT ?>Company/createCompany" method="POST" class="bg-light-alpha p-5">
                    <div class="row">                         
                         <div class="col-lg-3">
                              <div class="form-group">
                                   <label for="companyName">Nombre</label>
                                   <input type="text" name="companyName" required class="form-control" placeholder="Nombre Company">
                              </div>
                         </div>                         
                         <div class="col-lg-2">
                              <div class="form-group">
                                   <label for="companyTel">Telefono</label>
                                   <input type="number" required name="telefono" class="form-control" placeholder="Telefono" min="0">
                              </div>
                         </div>
                         <div class="col-lg-2">
                              <div class="form-group">
                                   <label for="companyCity">Ciudad</label>
                                   <input type="text" name="companyCity" class="form-control" required placeholder="Ciudad" min="0">
                              </div>
                         </div>
                         <div class="col-lg-2">
                              <div class="form-group">
                                   <label for="companyDir">Direction</label>
                                   <input type="text" name="companyDir" class="form-control" required placeholder="Cireccion" min="0">
                              </div>
                         </div>
                         <div class="col-lg-2">
                              <div class="form-group">
                                   <label for="companyCuit">CUIT</label>
                                   <input type="number" name="companyCuit" class="form-control" required placeholder="Cuit" min="0">
                              </div>
                         </div>
                         <div class="col-lg-3">
                              <div class="form-group">
                                   <label for="companyCuit">Email</label>
                                   <input type="email" name="companyEmail" class="form-control" required placeholder="Email@Email" min="0">
                              </div>
                         </div>
                         <div class="col-lg-">
                              <div>
                                   <label for="active">Active</label>
                                   <input type="checkbox" name="active" class="form-control" required min="0">
                              </div>
                         </div>
                    </div>
                    <div class="wrapper">
                        <button  type="submit" name="button" class="btn btn-dark botonCentro">Agregar</button>
                    </div>
                    <label style="color: red;"><?php if(isset($message)) echo $message; ?> </label>
               </form>
          </div>
     </section>
</main>