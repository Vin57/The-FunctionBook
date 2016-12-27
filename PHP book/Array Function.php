
<?php

/*********************************************************************
/****************************ARRAY FUNCTION*************************/
/*********************************************************************/


!!!!!!!!!!!!!!!!!!!!!!!!!!each function have probably an exemple of how to use it!!!!!!!!!!!!!!!!!!!!!
!!!!!!Check the "name of the function" in the
                "ARRAY FUNCTION" section in 
                "Watch and Test" file in the
                "How To Use It" folder!!!!!!!!
!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!


------------------------------------------------------------------
  ------------------------------firstKey-------------------------
------------------------------------------------------------------

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

------------------------------------------------------------------
  ------------------------------displayExceptList-------------------------
------------------------------------------------------------------

#If you want to remove some value of an array : 

/**
     * Affiche une liste de choix à partir de $tab, en ôtant les valeurs de $tabException
     * @params string $tab : un tableau de deux colonnes
     * @params string $tabException : le tableau des valeurs à évitée
     * @params string $classe : la classe CSS à appliquer à l'élément
     * @params string $id : l'id (et nom) de la liste de choix
     * @params int $size : l'attribut size de la liste de choix
     * @params string $idSelect : l'élément à présélectionner dans la liste
     * @params string $onchange : le nom de la fonction à appeler 
     * en cas d'événement onchange()
    */
    public static function displayExceptList ($tab,$tabException, $classe, $id, $size, $idSelect, $onchange) {
        // affichage de la liste de choix
        echo '<select class="'.$classe.'" id="'.$id.'" name="'.$id.'" size="'
                .$size.'" onchange="'.$onchange . '">';
        if (count($tab) && (empty($idSelect))) {
            $idSelect = $tab[0];
        }
        for($i=0;$i<count($tab);$i++) {
            $evade = 0 ;
            for($e=0;$e<count($tabException);$e++)
            {
                if($tab[$i]==$tabException[$e])
                {
                    $evade = 1 ;
                }
                if($evade==1)
                {
                    $e = count($tabException);
                }
            }
            // l'élément en paramètre est présélectionné
            if($evade==0)// Alors l'élément doit être intégré à la liste
            {
                if ($tab[$i] != $idSelect) {
                    echo '<option value="'.$tab[$i].'">'.$tab[$i].'</option>';
                } 
                else {
                    echo '<option selected value="'.$tab[$i].'">'.$tab[$i].'</option>';
                }
            }
        }
        echo('</select>');
        return ($tab);
    }


?>
