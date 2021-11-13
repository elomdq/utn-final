<?php

namespace Views;

use Models\Company as Company;

$company = null;

if(isset($_SESSION['company'])) {
    $company = $_SESSION['company'];
    unset($_SESSION['company']);
}

?>


<section id="listado" class="mb-5">
    
    <div class="container">
        <form action="<?php echo FRONT_ROOT . "Company/modifyCompany/" ?>" method="POST" class="bg-light-alpha p-5">
            <div class="row">
                <div class="col-lg-3">
                    <div class="form-group">
                        <label for="companyName">Nombre</label>
                        <input id="companyName" type="text" name="companyName" required class="form-control" value="<?php echo $company->getCompanyName(); ?>">
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="form-group">
                        <label for="telephone">Telefono</label>
                        <input id="telephone" type="text" required name="telephone" class="form-control" value="<?php echo $company->getTelephone(); ?>" min="0">
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="form-group">
                        <label for="city">Ciudad</label>
                        <input id="city" type="text" name="city" class="form-control" required value="<?php echo $company->getCity(); ?>" min="0">
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="form-group">
                        <label for="address">Direccion</label>
                        <input id="address" type="text" name="address" class="form-control" required value="<?php echo $company->getAddress(); ?>" min="0">
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="form-group">
                        <label for="cuit">CUIT</label>
                        <input id="cuit" type="text" name="cuit" class="form-control" required value="<?php echo $company->getCuit(); ?>" min="0">
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input id="email" type="email" name="email" class="form-control" required value="<?php echo $company->getEmail();?>" min="0">
                    </div>
                </div>
                <div class="col-lg-">
                    <div>
                        <label for="active">Active</label>
                        <input id="active" type="checkbox" name="active" class="form-control" min="0" <?php if($company->getActive()) echo "checked";?> >
                    </div>
                </div>
                <input  type="hidden" name="userId" class="form-control" min="0" value="<?php echo $company->getUserId();?>" >
                <input type="hidden" name="companyId" class="form-control" min="0" value="<?php echo $company->getIdCompany();?>" >
            </div>
            <div class="wrapper">
                <button type="submit" class="btn btn-dark botonCentro">Aceptar</button>
                <button type="reset" class="btn btn-dark botonCentro">Resetear</button>
            </div>
            <label style="color: red;"><?php if (isset($message)) echo $message; ?> </label>
        </form>
    </div>
</section>