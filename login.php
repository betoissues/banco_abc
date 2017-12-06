<?php
include("conexion.php");
include("gestion.php");
if(isset($_POST['user']) && !empty($_POST['user']) && isset($_POST['pass']) && !empty($_POST['pass']))
{

        $user=$_POST['user'];
        $contra=$_POST['pass'];

        $sql='SELECT id_cuenta,usuario,contrasena FROM cuenta';
        $consulta=$connection->query($sql);

        while($info = $consulta->fetch_assoc())
        {
                if($info['usuario']==$user && $info['contrasena']==$contra )
                {
                        session_start();
                        $_SESSION['usuario']= new GestionUsuario($info['id_cuenta']);
                        header('Location: dashboard.php');
                }
                else
                {
                    header('Location: index.php?failed=true');
                }
        }
}

?>
