
<?php


/*********************************************************************/
/****************************DATE FUNCTION*************************/
/*********************************************************************/

!!!!!!!!!!!!!!!!!!!!!!!!!!each function have probably an exemple of how to use it!!!!!!!!!!!!!!!!!!!!!
!!!!!!Check the "name of the function" in the
                "DATE FUNCTION" section in 
                "Watch and Test" file in the
                "How To Use It" folder!!!!!!!!
!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!

  
------------------------------------------------------------------
------------------------------operationDate-------------------------
------------------------------------------------------------------
  
# When you just want to operate to date and it's not work, you just become crazy,
# This function may be the solution to all your problem with date operation

/**
     * operationDate : retourne en nombre de jour le résultat d'une opération entre deux dates
     * @params string : $dateOne La plus ancienne date (au format standard php (YYYY-MM-DD))
     * @params string : $dateOne La date la plus récente (au format standard php (YYYY-MM-DD))
     * @params : $operateur l'opérateur (le signe) de l'opération à effectuer
     * @return : un nombre de jour sous forme d'entier
     */
     function operationDate($dateOne,$datetwo,$operateur)
    {
        $d1 = date('Y-m-d',strtotime($dateOne));
        $d2 = date('Y-m-d',strtotime($datetwo));
        if(
            checkdate(
                    (date('m',strtotime($d1))),
                    (date('d',strtotime($d1))),
                    (date('Y',strtotime($d1)))
                    )
                and 
            checkdate(
                    (date('m',strtotime($d2))),
                    (date('d',strtotime($d2))),
                    (date('Y',strtotime($d2)))
                    )
          )
        {
            switch($operateur)
            {
                case "-":
                {
                    $result = strtotime($d1) - strtotime($d2);
                    $result = $result/60/60/24;
                }break;
                case "+":
                {
                    $result = strtotime($d1) + strtotime($d2);
                    $result = $result/60/60/24;
                }break;
                case "*":
                {
                    $result = strtotime($d1) * strtotime($d2);
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

------------------------------------------------------------------
------------------------------isDate-------------------------
------------------------------------------------------------------
  
/**
     * Indique si une valeur est une date au format dd/mm/YYYY (format standard européen)
     * @param $date une valeur à tester
     * @return boolean vrai ou faux
     */
    public static function isDate($date)
    {
        if(substr($valeur,0,1)<3)
        {
          if(preg_match("#^[0-2][0-9]{1}/#",substr($valeur,0,3)))
          {
              if(substr($valeur,3,1)==0)
              {
                  if(preg_match("#[0-9]{1}/#",substr($valeur,4,2)))
                  {
                      if(preg_match("#[0-9]{4}$#", substr($valeur,6,4)))
                      {
                          return true;
                      }
                  }
              }
              else{
                  if(preg_match("#1[0-2]{1}/#",substr($valeur,3,3)))
                  {

                      if(preg_match("#[0-9]{4}$#", substr($valeur,6,4)))
                      {
                          return true;
                      }
                  }
              }
          }
        }
        else{
          if(preg_match("#^3[0-1]{1}/#",substr($valeur,0,3)))
          {
              if(substr($valeur,3,1)==0)
              {
                  if(preg_match("#[0-9]{1}/#",substr($valeur,4,2)))
                  {
                      if(preg_match("#[0-9]{4}$#", substr($valeur,6,4)))
                      {
                          return true;
                      }
                  }
              }
              else{
                  if(preg_match("#1[0-2]{1}/#",substr($valeur,3,3)))
                  {
                      if(preg_match("#[0-9]{4}$#", substr($valeur,6,4)))
                      {
                          return true;
                      }
                  }
              }
          }
        }
        return false;
    }
?>
