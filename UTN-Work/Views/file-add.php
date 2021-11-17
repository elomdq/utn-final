<main class="py-5">
     <section id="listado" class="mb-5">
          <div class="container">
          <div class="alert alert-<?php if($alert!=null) echo $alert->getType();?>" role="alert"> <?php if($alert!=null) echo $alert->getMessage(); ?> </div>
                <h2 class="mb-4">Agregar Curriculum</h2>
                <form action="<?php echo FRONT_ROOT ?>file/createFile/" method="POST" enctype="multipart/form-data" class="bg-light-alpha p-5">
                        <div class="row">          
                         <div class="col-lg-3">
                              <div class="form-group">
                              <label for="fileToUpload">Subir CV:</label>
                              <input type="file" id="fileToUpload" name="fileToUpload" accept="application/pdf">
                              </div>
                         </div>                         
                    </div>
                    <div class="wrapper">
                        <button  type="submit" class="btn btn-dark botonCentro">Agregar</button>
                    </div>
                    <div> <p>Recorda que solo se acepta PDF</p> </div>
                </form>
          </div>
     </section>
</main>