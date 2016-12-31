/*********************************************************************
/*************************sp_drop_index_if_exists*********************/
/*********************************************************************/


!!!!!!!!!!!!!!!!!!!!!!!!!!each function have probably an exemple of how to use it!!!!!!!!!!!!!!!!!!!!!
!!!!!!Check the "name of the procedure" in the
                "generic procedure" section in 
                "Watch and Test" file in the
                "How To Use It" folder!!!!!!!!
!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!

------------------------------------------------------------------
  ------------------------------sp_index_exists-------------------------
------------------------------------------------------------------

# If you want to manage your index, you may would use the drop index if exists syntaxe...
# but this command does not exists in mysql, so you can use the folowing procedure wich
# make the same thing by passing specific parameter, see how in : how to use it/Watch and Test>generic procedure>sp_drop_index_if_exists :
DELIMITER $

DROP PROCEDURE IF EXISTS sp_index_exists$

/*
    ******* DESCRIPTION *******
    * sp_index_exists check if an index exists
    ******* PARAMETRE *******
    * name_index name of the index to search (default searching index in the current selected database)
    * name_table (optional) table where search the index
    * name_database (optional) la base de données dans laquel on doit rechercher l'index
    * and_drop (optional)
*/
CREATE PROCEDURE sp_index_exists(
IN name_index VARCHAR(255),
IN name_table VARCHAR(255),
IN name_database VARCHAR(255),
IN and_drop BOOLEAN,
OUT p_result BOOLEAN
)
BEGIN
	SET p_result = FALSE;-- if there is no parameter p_result stay false
    IF NOT ISNULL(name_index) THEN
		IF NOT ISNULL(name_table) AND NOT ISNULL(name_database) THEN
			SELECT EXISTS
				(SELECT * FROM information_schema.statistics
					WHERE TABLE_SCHEMA = name_database AND
						  TABLE_NAME = name_table AND 
						  INDEX_NAME = name_index) 
			INTO p_result;
		ELSEIF NOT ISNULL(name_table) AND ISNULL(name_database) THEN
			SELECT EXISTS
				(SELECT * FROM information_schema.statistics
					WHERE TABLE_SCHEMA = database() AND
						  TABLE_NAME = name_table AND 
						  INDEX_NAME = name_index) 
			INTO p_result;
		ELSEIF NOT ISNULL(name_database) AND ISNULL(name_table) THEN
			SELECT EXISTS
				(SELECT * FROM information_schema.statistics
					WHERE TABLE_SCHEMA = name_database AND
						  TABLE_NAME = name_table AND 
						  INDEX_NAME = name_index) 
			INTO p_result;
		ELSE
			SELECT EXISTS
				(SELECT * FROM information_schema.statistics
					WHERE TABLE_SCHEMA = database() AND 
						  INDEX_NAME = name_index)
			INTO p_result;
		END IF;
        
        IF NOT ISNULL(and_drop) AND and_drop = TRUE THEN
			IF (NOT ISNULL(name_table)) THEN
				IF p_result = 1 THEN
					CALL sp_drop_index(name_index,name_table,name_database);
                END IF;
			ELSE
				SIGNAL SQLSTATE '45001' SET MESSAGE_TEXT = 'conflicting parameters : cannot drop index if table name is not define';
			END IF;
        END IF;
        ELSE 
			SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'one required parameter is missing';
    END IF;
END$ 



/*
    ******* DESCRIPTION *******
    * sp_drop_index supprime un index
    ******* PARAMETRE *******
    * name_index name of the index to delete
    * name_table table where search the index
    * name_database (optional) la base de données dans laquel on doit rechercher l'index
    * and_drop (optional)
*/

DROP PROCEDURE IF EXISTS sp_drop_index$

CREATE PROCEDURE sp_drop_index(
IN name_index VARCHAR(255),
IN name_table VARCHAR(255),
IN name_database VARCHAR(255)
)
BEGIN
	IF NOT ISNULL(name_table) THEN
		IF ISNULL(name_database) THEN
			BEGIN
				SET @rq = CONCAT('DROP INDEX ',name_index,' ON ',database(),'.',name_table);
			END;
		ELSE
			SET @rq = CONCAT('DROP INDEX ',name_index,' ON ',name_database,'.',name_table);
		END IF;
		PREPARE drop_index FROM @rq;
		EXECUTE drop_index;
        ELSE
			SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'one required parameter is missing';
    END IF;
END$
