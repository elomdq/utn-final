<?php 
namespace Views;

use Models\Offer as Offer;
//use DAO\OfferDAO as OfferDAO;

//$offerDAO = new OfferDAO;
$offer = null;

//cheque si tengo la oferta en el session y la paso a una variable para despues destruirla
if($_SESSION['offer'])
{
    $offer = $_SESSION['offer'];
    unset($_SESSION['offer']);
}

//if($offer) echo $offer->getTitle();

?>


<div class="row justify-content-center">
    <div class="col-6">
        <div class="card shadow mb-4">

            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary"><?php echo $offer->getTitle(); ?></h6>
            </div>

            <!-- Card Body -->
            <div class="row card-body justify-content-center py-2">
                <div class="col-10 m-3">
                    <div><?php echo $offer->getDescription(); ?></div>
                </div>
                <hr class="col-10 m-0">
                <div class="col-10 m-3">
                    <div>Salary: <?php echo $offer->getSalary() ?> </div>
                </div>
                
            </div>

        </div>
    </div>
</div>