<main class="py-5">
     <section id="listado" class="mb-5">
          <div class="container">
               <h2 class="mb-4">Agregar Empresa</h2>
               <form action="<?php echo FRONT_ROOT ?>Company/createCompany/" method="POST" class="bg-light-alpha p-5">
                    <div class="row">                         
                         <div class="col-lg-3">
                              <div class="form-group">
                                   <label for="companyName">Nombre</label>
                                   <input id="companyName" type="text" name="companyName" required class="form-control" placeholder="Nombre de empresa">
                              </div>
                         </div>                         
                         <div class="col-lg-2">
                              <div class="form-group">
                                   <label for="companyTel">Telefono</label>
                                   <input id="companyTel" type="text" required name="telephone" class="form-control" placeholder="Telefono" min="0">
                              </div>
                         </div>
                         <div class="col-lg-2">
                              <div class="form-group">
                                   <label for="companyCity">Ciudad</label>
                                   <input id="companyCity" type="text" name="city" class="form-control" placeholder="Ciudad" min="0">
                              </div>
                         </div>
                         <div class="col-lg-2">
                              <div class="form-group">
                                   <label for="companyDir">Direccion</label>
                                   <input id="companyDir" type="text" name="address" class="form-control" placeholder="Direccion" min="0">
                              </div>
                         </div>
                         <div class="col-lg-2">
                              <div class="form-group">
                                   <label for="companyCuit">CUIT</label>
                                   <input id="companyCuit" type="text" name="cuit" class="form-control" required placeholder="Cuit" min="0">
                              </div>
                         </div>
                         <div class="col-lg-3">
                              <div class="form-group">
                                   <label for="email">Email</label>
                                   <input id="email" type="email" name="email" class="form-control" required placeholder="Email@Email" min="0">
                              </div>
                         </div>
                         <div class="col-lg-">
                              <div>
                                   <label for="activeCompany">Active</label>
                                   <input id="activeCompany" type="checkbox" name="active" class="form-control" >
                              </div>
                         </div>
                    </div>
                    <div class="wrapper">
                        <button  type="submit" class="btn btn-dark botonCentro">Agregar</button>
                    </div>
                    <label style="color: red;"><?php if(isset($message)) echo $message; ?> </label>
               </form>
          </div>
     </section>
</main>