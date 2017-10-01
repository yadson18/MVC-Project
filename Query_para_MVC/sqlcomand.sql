SELECT R.RDB$FIELD_NAME AS COLUMNS,
    CASE R.RDB$NULL_FLAG
      WHEN 1 THEN 'SIM'
      ELSE 'NÃO'
    END AS IS_NULL,
   
    F.RDB$FIELD_LENGTH AS SIZE,
   
  	CASE F.RDB$FIELD_TYPE
	    WHEN 7 THEN 'SMALLINT'
	    WHEN 8 THEN 'INTEGER'
	    WHEN 9 THEN 'QUAD'
	    WHEN 10 THEN 'FLOAT'
	    WHEN 11 THEN 'D_FLOAT'
	    WHEN 12 THEN 'DATE'
	    WHEN 13 THEN 'TIME'
	    WHEN 14 THEN 'CHAR'
	    WHEN 16 THEN 'INT64'
	    WHEN 27 THEN 'DOUBLE'
	    WHEN 35 THEN 'TIMESTAMP'
	    WHEN 37 THEN 'VARCHAR'
	    WHEN 40 THEN 'CSTRING'
	    WHEN 261 THEN 'BLOB'
	    ELSE 'UNKNOWN'
  	END AS TYPE
FROM RDB$RELATION_FIELDS R
    LEFT JOIN RDB$FIELDS F ON R.RDB$FIELD_SOURCE = F.RDB$FIELD_NAME
    LEFT JOIN RDB$COLLATIONS COLL ON F.RDB$COLLATION_ID = COLL.RDB$COLLATION_ID
    LEFT JOIN RDB$CHARACTER_SETS CSET ON F.RDB$CHARACTER_SET_ID = CSET.RDB$CHARACTER_SET_ID
    WHERE R.RDB$RELATION_NAME = 'CADASTRO'
ORDER BY R.RDB$FIELD_POSITION; 