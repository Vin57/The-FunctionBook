
<?php


*********************************************************************
/****************************DATE FUNCTION*************************/
*********************************************************************

/**
     * operationDate : retourne en nombre de jour le résultat d'une opération entre deux dates
     * @params : $dateOne une premiére date
     * @params : $dateTwo une seconde date
     * @params : $operateur l'opérateur (le signe) del'opération à effectuer
     * @return : un nombre de jour sous forme d'entier
     */
    public static function operationDate($dateOne,$DateTwo,$operateur)
    {
        if(
            checkdate(
                    (date('m',strtotime($dateOne))),
                    (date('d',strtotime($dateOne))),
                    (date('Y',strtotime($dateOne)))
                    )
                and 
            checkdate(
                    (date('m',strtotime($DateTwo))),
                    (date('d',strtotime($DateTwo))),
                    (date('Y',strtotime($DateTwo)))
                    )
          )
        {
            switch($operateur)
            {
                case "-":
                {
                    $result = strtotime($dateOne) - strtotime($DateTwo);
                    $result = $result/60/60/24;
                }break;
                case "+":
                {
                    $result = strtotime($dateOne) + strtotime($DateTwo);
                    $result = $result/60/60/24;
                }break;
                case "*":
                {
                    $result = strtotime($dateOne) * strtotime($DateTwo);
                    $result = $result/60/60/24;
                }break;
            }
        }
        else
        {
            $result = -1;
        }
        return $result;
    }
?>