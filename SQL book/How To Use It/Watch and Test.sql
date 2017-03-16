#Ctrl+F gonna be your friend ! ;D
/**********************************************************/
/********************How To Use It*************************/
/**********************************************************/

/**IF YOU FIND A MISTAKE OR SOMETHING WRONG, PLEASE CONTACT**/
/****ME TO THE FOLOWING ADRESS : vincphil54800@gmail.com***/
/**THANK YOU TO TELL ME IN WHICH SECTION THE PROBLEME IS **/



/**********************SECTION***************************/
/****************GENERIC PROCEDURE***********************/
/*******************************************************/


/////////////////////////////////////////////////////////
///////////////////////////////////////////////////////// 
sp_index_exists(IN name_index VARCHAR(255),
                IN name_table VARCHAR(255),
                IN name_database VARCHAR(255),
                IN and_drop BOOLEAN,
                OUT p_result BOOLEAN)
/////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////
-- This procedure has two manners to work
------------------FIRST WAY-------------------
------------------BASIC MODE------------------
-- This mode allows you to know if the index that you give in first parameter is exist :
-- (second and third parameter are optional you could set them to NULL)
-- fourth parameter has to be null or false to not delete the index when he is found
-- fifth parameter should always be a mysql variable
CALL sp_index_exists('nom_index','nom_table','nom_base',NULL,@result);
-- now execute the previous command and get back the value of the @result (fifth parameter)
SELECT @result;-- 1 => the index exist, 2 => index does not exist


------------------SECOND WAY-------------------
------------------DELETE MODE------------------
-- This mode delete the index if it has been found
-- second paramete have to be the name of the table where the index should be
-- (third parameter are optional you could set them to NULL)
-- fourth parameter has to be true to delete the index when he is found
-- fifth parameter should always be a mysql variable
CALL sp_index_exists('nom_index','nom_table','nom_base',TRUE,@result);
-- if no exception has been found, and if the index has been found in the specify table,
-- the index have been removed from the specify table if an error occur, that's may be
-- that you forgot to specify the second parameter
