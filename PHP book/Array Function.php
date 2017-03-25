
<?php
// You can use the whole affin file to arrange of one library of functions,
// or look for only the functions which interest you
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
--------------------------array_contains--------------------------
------------------------------------------------------------------

# If you want to search for a value in an array you can use this function who check if a value is inside an array
# /!\ WARNING /!\ This function use "compareValue" (compareValue's function follow this one, use Ctrl + F and input : compareValue)

/**
 * array_contains Parcours un tableau en retournant vrai, faux, ou le nombre d'occurence trouvé en fonction du paramétre $search
 * @param array $array Le tableau dans lequel on souhaite faire la recherche
 * @param mixed $search La variable à rechercher dans le tableau donnée en premier paramétre
 * @param bool $withKeySearch : true=> La recherche est également étendu aux clés du tableau, 
 *                              false => On ne cherche la donnée que parmis les valeurs du tableau
 * @param bool $exactMatch : true => On souhaite savoir si la données trouvés est identique à celle cherchez,
 *                           false => on souhaite savoir si la donnés trouvé est égal à celle chercher
 * @param bool $runThrough: true => On souhaite parcourir tous le tableau et retourné le nombre d'occurence trouvé,
 *                          false => On s'arrête dés que l'on trouve la première occurence
 * @return boolean Retourne : false => La valeur n'à pas été trouvé dans le tableau ppour les paramètres donné
 *                            true => La valeur à été trouvé dans le tableau
 *                            (si runThroug est activé) => Le nombre de valeur trouvée
 */
public static function array_contains($array, $search, $withKeySearch = false, $exactMatch = false, $runThrough = false) {
    $totalFound = 0; // Utile en mode runThrough
    foreach ($array as $key => $data) {
        if (($data == $search || $key == $search)) {// Si l'une des deux valeurs correspond à la recherche
            if ($withKeySearch && ($key == $search)) {// Si l'on est en mode withKeySearch et que la valeur recherché est égal à la clé
                if (self::compareValue($key, $search, $exactMatch)) {//Si les valeurs correspondent
                    if ($runThrough)
                        $totalFound += 1;
                    else
                        return true;
                }
            }
            if (self::compareValue($data, $search, $exactMatch)) {
                if ($runThrough)
                    $totalFound += 1;
                else
                    return true;
            }
        }
    }
    return $totalFound;
}

------------------------------------------------------------------
--------------------------compareValue--------------------------
------------------------------------------------------------------

# For compare if two value are exactly the same or are equal
  
/**
* compareValue Compare deux valeurs entre elle
* @param mixed $valueOne : La première valeur
* @param mixed $valueTwo : La seconde valeur
* @param bool $exactMatch : true => On souhaite savoir si la données trouvés est identique à celle cherchez, false, on souhaite savoir si la donnés trouvé est égal à celle chercher
* @return boolean true si les valeurs correspondent, sinon retourne false
*/
public static function compareValue($valueOne, $valueTwo, $exactMatch = false) {
    if ($exactMatch && $valueOne === $valueTwo) {// Si on est en mode exactMatch et que la valeur de la clé est identique à celle recherché
        return true;
    } else if (!$exactMatch && $valueOne == $valueTwo) {// Si l'on est pas en mode exactMatch
        return true;
    }
    return false;
}
  
  
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
