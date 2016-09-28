
<?php

*********************************************************************
/****************************ARRAY FUNCTION*************************/
*********************************************************************

# If you want to return the key on an associative array to get the first occurence 
# of this array for exemple and if you don't know the key of the element that you search,
# it's impossible to find it without create you're own fonction, you can use for example : 

/**
 * Retourne la premiére clé/valeur d'un tableau (notament utile pour les tableaux associatifs)
 * @param array $tab un tableau
 * @param int $mode 0 => renvoie la premiére valeur du tableau, 1=> renvoie la premiére clé du tableau
 * @return mixed la premiére occurence d'un tableau ou nul si le tableau est vide
 */
public static function firstKey($tab,$mode = 0)
{
    foreach($tab as $key=>$values)
    {
        if(is_array($values))
        {
            self::firstKey($values);
        }
        if($mode == 0)
        {
            return $values;
        }
        elseif($mode == 1)
        {
            return $key;            
        }
    }
    return null;
}

?>