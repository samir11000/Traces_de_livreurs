<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Admin Connexion</title>
        <link rel="icon" href="../img/favicon.ico" />
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <?php
        session_start();
        if(isset($_SESSION['locale']))
        {
            header('location:main.php');
        }
    ?>
    <body class="bg-primary">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-5">
                                <form method="POST" action="auth/connexion.php">
                                    <div class="card shadow-lg border-0 rounded-lg mt-5">
                                        <img src="../img/logo.png" class="mt-3 mb-3" style="width:64px;height:64px;display:block;margin:auto;">
                                        <div class="card-header"><h3 class="text-center font-weight-light my-4">Connexion</h3></div>
                                        <div class="card-body">
                                            <form>
                                                <div class="form-group">
                                                    <label class="small mb-1" for="inputUsername">Nom d'utilisateur :</label>
                                                    <input class="form-control py-4" id="inputUsername" name="username" type="text" placeholder="exemple@test.fr" />
                                                </div>
                                                <div class="form-group">
                                                    <label class="small mb-1" for="inputPassword">Mot de passe :</label>
                                                    <input class="form-control py-4" id="inputPassword" name="pass" type="password" placeholder="Tapez un mot de passe" />
                                                </div>
                                                <div class="form-group">
                                                    <div class="custom-control custom-checkbox">
                                                        <input class="custom-control-input" id="rememberPasswordCheck" type="checkbox" />
                                                        <label class="custom-control-label" for="rememberPasswordCheck">Se souvenir de moi</label>
                                                    </div>
                                                </div>
                                                <div class="form-group d-flex align-items-center justify-content-between mt-4 mb-0">
                                                    <a class="small" href="password.html">Mot de passe oublié ?</a>
                                                    <input class="btn btn-primary" type="submit" value="Connexion">
                                                </div>
                                            </form>
                                        </div>
                                        <div class="card-footer text-center">
                                            <div class="small">Nouveau ? <a href="../inscription.php">Créer un compte</a></div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
            <div id="layoutAuthentication_footer">
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Uber Camion 2019-2020</div>
                            <!--<div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>-->
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.4.1.min.js" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
    </body>
</html>
