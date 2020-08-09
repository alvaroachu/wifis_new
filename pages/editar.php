<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="es" xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        <title>Editor de archivo configuracion</title>
    </head>
    <body bgcolor="#5dade2">
        <p align="center">
            <img src="Joomla.png">
        </p>
        <?php
        $fn = "guardar.php";
        if (isset($_POST['content'])) {
            $content = stripslashes($_POST['content']);
            $fp = fopen($fn, "w") or die("Error al abrir el archivo");
            fputs($fp, $content);
            fclose($fp) or die("Error al cerrar el archivo");
        }
        ?>
        <div style="width:950px; text-align: center; margin: auto; background-color: #F0F0F0; border: 1px solid #B3B9D5; border-color: #B3B9D5; padding: 15px; font-family: Verdana, Arial, Helvetica, sans-serif; color: #717CB0; font-size: 14px;">
            <strong>
            </strong><br /><br />
            <form action="<?php echo $_SERVER["PHP_SELF"] ?>" method="post">
                <textarea rows="25" cols="110" name="content"><?php readfile($fn); ?></textarea>
                <br />
                <br />
                <input type="submit" value="  Guardar los cambios  ">
            </form>
            <br />
        </div>
    </body>
</html>