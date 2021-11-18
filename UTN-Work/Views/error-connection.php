<div class="row justify-content-center">
    <div class="col-5">
        <div class="card shadow mb-4">

            <!-- Card Body -->
            <div class="row card-body .flex-column justify-content-center py-5 " >
                <h1 class="col-12 text-center mb-4 red">ERROR DE CONEXION</h1>
                <div class="error-connection">
                     
                    <div class="alert alert-<?php if ($alert != null) echo $alert->getType(); ?> col-8 mx-auto" role="alert"> <?php if ($alert != null) echo $alert->getMessage(); ?> </div>
                    
                </div>

            </div>

        </div>
    </div>
</div>