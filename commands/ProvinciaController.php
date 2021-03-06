<?php
namespace app\commands;
use Yii;
use yii\console\Controller;

/**
*   Clase que incluye las nacionalidades
*   @author Ing Leonel P. Hernandez M.
*   @date 28/06/2017
*/
class ProvinciaController extends Controller
{
    public function actionMigrate()
    {
        $sql = file_get_contents(Yii::getAlias('@app').'/commands/provincia.sql');
        Yii::$app->db->createCommand($sql)->execute();
        echo "Se migro con exito\n";
    }

    public function actionTruncate()
    {
        Yii::$app->db->createCommand("DELETE FROM provincia")->execute();
        Yii::$app->db->createCommand("ALTER TABLE provincia auto_increment = 1")->execute();
        echo "Se vacio la tabla con exito\n";
    }
}