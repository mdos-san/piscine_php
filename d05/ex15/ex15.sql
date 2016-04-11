SELECT REVERSE(SUBSTRING(telephone, 2)) as enohpelet FROM distrib WHERE REVERSE(SUBSTRING(telephone, 2)) REGEXP '^[0-9]*5$';
