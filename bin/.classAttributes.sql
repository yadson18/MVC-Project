WITH VALIDATOR AS(
    SELECT DISTINCT LOWER(R.RDB$FIELD_NAME) AS TABLE_COLUMN,

        CASE R.RDB$NULL_FLAG
          WHEN 1 THEN 'notEmpty'
          ELSE 'empty'
        END AS IS_NULL,

        CASE F.RDB$FIELD_TYPE
            WHEN 7 THEN 'integer'
            WHEN 8 THEN 'integer'
            WHEN 9 THEN 'string'
            WHEN 10 THEN 'float'
            WHEN 11 THEN 'float'
            WHEN 12 THEN 'string'
            WHEN 13 THEN 'string'
            WHEN 14 THEN 'string'
            WHEN 16 THEN 'integer'
            WHEN 27 THEN 'double'
            WHEN 35 THEN 'string'
            WHEN 37 THEN 'string'
            WHEN 40 THEN 'string'
            WHEN 261 THEN 'string'
            ELSE 'unknown'
        END AS TYPE,

        F.RDB$FIELD_LENGTH AS SIZE,

        CASE
            WHEN R.RDB$DEFAULT_SOURCE IS NULL THEN '""'
            ELSE REPLACE(REPLACE(R.RDB$DEFAULT_SOURCE, 'DEFAULT', ''), '''', '"')
        END AS DEFAULT_VALUE

    FROM RDB$RELATION_FIELDS R 
        LEFT JOIN RDB$FIELDS F ON R.RDB$FIELD_SOURCE = F.RDB$FIELD_NAME
        LEFT JOIN RDB$COLLATIONS COLL ON F.RDB$COLLATION_ID = COLL.RDB$COLLATION_ID
        LEFT JOIN RDB$CHARACTER_SETS CSET ON F.RDB$CHARACTER_SET_ID = CSET.RDB$CHARACTER_SET_ID
    WHERE R.RDB$RELATION_NAME = 'CADASTRO' ORDER BY R.RDB$FIELD_POSITION
)
SELECT DISTINCT REPLACE(
    '$validator->addRule("' || TABLE_COLUMN || '")->' ||
    IS_NULL || '()->' || 
    TYPE || '()->size(' || SIZE || ')->' || 
    'defaultValue('||DEFAULT_VALUE||');', ' ', '')
FROM VALIDATOR