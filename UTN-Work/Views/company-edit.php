<section id="company-edit-details" class="mb-5">

    <div class="container">

        <!-- <div class="alert alert-<?php if ($alert != null) echo $alert->getType(); ?>" role="alert"> <?php if ($alert != null) echo $alert->getMessage(); ?> </div> -->

        <div class="row justify-content-center bg-white">
            <div class="col-6 p-2">

                <div class="card">

                    <div class="card-header py-2">
                        <h5 class="mt-2">Agregar Empresa</h5>
                    </div>

                    <div class="card-body">

                        <form action="<?php echo FRONT_ROOT . "Company/modifyCompany/" ?>" method="POST" class="row bg-light-alpha p-3">

                            <div class="form-group col-12 py-3">
                                <label for="companyName">Nombre</label>
                                <input id="companyName" type="text" name="companyName" required class="form-control" placeholder="Nombre de empresa" value="<?php echo $company->getCompanyName(); ?>">
                            </div>


                            <div class="form-group col-12 py-3">
                                <label for="companyTel">Telefono</label>
                                <input id="companyTel" type="text" required name="telephone" class="form-control" placeholder="Telefono" value="<?php echo $company->getTelephone(); ?>">
                            </div>


                            <div class="form-group col-12 py-3">
                                <label for="companyCity">Ciudad</label>
                                <input id="companyCity" type="text" name="city" class="form-control" placeholder="Ciudad" value="<?php echo $company->getCity(); ?>">
                            </div>


                            <div class="form-group col-12 py-3">
                                <label for="companyDir">Direccion</label>
                                <input id="companyDir" type="text" name="address" class="form-control" placeholder="Direccion" value="<?php echo $company->getAddress(); ?>">
                            </div>

                            <div class="form-group col-12 py-3">
                                <label for="companyCuit">CUIT</label>
                                <input id="companyCuit" type="text" name="cuit" class="form-control" required placeholder="Cuit" value="<?php echo $company->getCuit(); ?>">
                            </div>

                            <div class="form-group col-12 py-3">
                                <label for="email">Email</label>
                                <input id="email" type="email" name="email" class="form-control" required placeholder="Email@Email" value="<?php echo $company->getEmail(); ?>">
                            </div>

                            <!--
                            <div class="form-group col-12 py-3">
                                <label for="fileToUpload">Imagen de Perfil: </label>
                                <input type="file" id="fileToUpload" name="fileToUpload" max-file-size="6000" accept="image/png, image/gif, image/jpeg" value="<?php //if(!empty($this->profilePictureDAO->getURLByOwnerId($company->getUserId()))) echo $this->profilePictureDAO->getURLByOwnerId($company->getUserId()); ?>">
                            </div>
                            -->

                            <div class="form-group col-12 py-3">

                                <div class="form-check">
                                    <label class="form-check-label" for="active">Active</label>
                                    <input id="active" type="checkbox" name="active" class="form-check-input" <?php if ($company->getActive()) echo "checked"; ?>>
                                </div>

                            </div>

                            <input type="hidden" name="userId" class="form-control" min="0" value="<?php echo $company->getUserId(); ?>">
                            <input type="hidden" name="companyId" class="form-control" min="0" value="<?php echo $company->getIdCompany(); ?>">

                            <hr class="col-12 my-3">

                            <div class="col-12 pt-2 d-flex justify-content-center">
                                <button type="submit" class="btn btn-dark botonCentro mx-1">Agregar</button>
                                <button type="reset" class="btn btn-dark botonCentro mx-1">Resetear</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>

    </div>
</section>