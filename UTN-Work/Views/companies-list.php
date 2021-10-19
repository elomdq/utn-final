<?php
require_once('nav.php');
?>


<div class="container">
    <h2 class="mb-4">Compañias Disponibles</h2>
    <table class="table bg-light-alpha">
        <thead>
            <th>Empresa</th>
            <th>Tel.</th>
            <th>Ciudad</th>
            <th>Direccion</th>
            <th>CUIT</th>
            <th>Email</th>
            <?php if($_SESSION['userType'] == 1){ ?> <th>Delete</th> <?php } ?>
        </thead>
        <tbody>
            <?php
            if (isset($this->companiesList)) {
                foreach ($this->companiesList as $company) {
            ?>
                    <tr>
                        <td><?php echo $company->getCompanyName(); ?></td>
                        <td><?php echo $company->getTelephone(); ?></td>
                        <td><?php echo $company->getCity(); ?></td>
                        <td><?php echo $company->getDirection(); ?></td>
                        <td><?php echo $company->getCuit(); ?></td>
                        <td><?php echo $company->getEmail(); ?></td>
                        <?php if($_SESSION['userType'] == 1){ ?> <td><input type="checkbox" name="active" class="form-control" min="0"></td> <?php } ?>
                    </tr>
            <?php
                }
            }
            ?>
        </tbody>
    </table>
</div>