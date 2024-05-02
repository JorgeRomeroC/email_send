<?php session_start(); 
require_once"controllers/controllers.php"?>
<!doctype html>
<html lang="es">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700,900&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="fonts/icomoon/style.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- Style -->
    <link rel="stylesheet" href="css/style.css">

    <title>Formulario de Contacto</title>
</head>

<body>

    <div class="content">

        <div class="container">
            <div class="row mt-5 align-items-stretch no-gutters contact-wrap">
                <div class="col-md-12">
                    <div class="form h-100">
                        <h3>Formulario de Contacto</h3>
                        <?php Correo::SendMail();
                            if(isset($_SESSION['MESSAGEFORM'])){
                                echo $_SESSION['MESSAGEFORM'];
                                unset($_SESSION['MESSAGEFORM']);
                            }
                        ?>
                        <form class="mb-5 mt-5" method="post" id="contactForm" name="contactForm">
                            <div class="row">
                                <div class="col-md-6 form-group mb-3">
                                    <label for="" class="col-form-label">Nombre *</label>
                                    <input type="text" class="form-control" name="name" id="name"
                                        placeholder="Ingrese su nombre"
                                        value="<?php if(isset($_SESSION["NAME"])){echo $_SESSION["NAME"];} ?>">
                                </div>
                                <div class="col-md-6 form-group mb-3">
                                    <label for="" class="col-form-label">Email *</label>
                                    <input type="text" class="form-control" name="email" id="email"
                                        placeholder="Ingrese su email"
                                        value="<?php if(isset($_SESSION["EMAIL"])){echo $_SESSION["EMAIL"];} ?>">
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-md-6 form-group mb-3">
                                    <label for="budget" class="col-form-label">Cargo</label>
                                    <select class="custom-select" id="cargo" name="charge">
                                        <option value="" <?php if(!isset($_SESSION["CHARGE"])){echo "selected";} ?>>
                                            Seleccione Cargo</option>
                                        <option value="Desarrollador-web"
                                            <?php if(isset($_SESSION["CHARGE"]) && $_SESSION["CHARGE"] == "Desarrollador-web"){echo "selected";} ?>>
                                            Desarrollador Web</option>
                                        <option value="Desarrollador-backend"
                                            <?php if(isset($_SESSION["CHARGE"]) && $_SESSION["CHARGE"] == "Desarrollador-backend"){echo "selected";} ?>>
                                            Desarrollador BackEnd</option>
                                        <option value="Desarrollador-frontend"
                                            <?php if(isset($_SESSION["CHARGE"]) && $_SESSION["CHARGE"] == "Desarrollador-frontend"){echo "selected";} ?>>
                                            Desarrollador FrontEnd</option>
                                        <option value="devops"
                                            <?php if(isset($_SESSION["CHARGE"]) && $_SESSION["CHARGE"] == "devops"){echo "selected";} ?>>
                                            DevOPs</option>
                                        <option value="Diseñador-Grafico"
                                            <?php if(isset($_SESSION["CHARGE"]) && $_SESSION["CHARGE"] == "Diseñador-Grafico"){echo "selected";} ?>>
                                            Diseñador Grafico</option>
                                    </select>
                                </div>
                                <div class="col-md-6 form-group mb-3">
                                    <label for="" class="col-form-label">Telefono *</label>
                                    <input type="tel" class="form-control" name="tel" maxlength="9" pattern="[0-9]{9}"
                                        id="tel" placeholder="Ingrese su telefono"
                                        value="<?php if($_SESSION['TEL']){echo $_SESSION['TEL'];} ?>">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12 form-group mb-3">
                                    <label for="message" class="col-form-label">Mensaje *</label>
                                    <textarea class="form-control" name="message" id="message" cols="30" rows="4"
                                        placeholder="Cuentame en que te puedo ayudar"><?php if(isset($_SESSION["MESSAGE"])){echo $_SESSION["MESSAGE"];} ?></textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 form-group">
                                    <input type="submit" value="Enviar Mensaje"
                                        class="btn btn-primary rounded-0 py-2 px-4">
                                    <span class="Enviar"></span>

                                    <input type="hidden" name="funaction" value="contact-form">
                                </div>
                            </div>
                        </form>

                        <div id="form-message-warning mt-4"></div>
                        <div id="form-message-success">
                            ¡¡¡ Gracias por preferir mis Servicios !!!!
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
    unset($_SESSION["NAME"]);
    unset($_SESSION["EMAIL"]);
    unset($_SESSION["TEL"]);
    unset($_SESSION["CHARGE"]);
    unset($_SESSION["MESSAGE"]);
    ?>


    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script>
    $(document).ready(function() {
        $("#timeAlert").hide().fadeIn('slow');
        setTimeout(function() {
            $("#timeAlert").fadeOut('close');
        }, 4000);
    });
    $('form').on('submit', function() {
        $(this).find(':submit').attr('disabled', 'disabled');

    });
    </script>

</body>

</html>