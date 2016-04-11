SELECT nom, prenom, DATE(date_naissance) FROM fiche_personne WHERE date_naissance REGEXP '^1989.*';
