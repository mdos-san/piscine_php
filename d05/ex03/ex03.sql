INSERT INTO `db_mdos-san`.ft_table (login, groupe, date_de_creation) SELECT LEFT(nom, 8), "other",date_naissance FROM fiche_personne WHERE nom REGEXP '.*a.*';
