SELECT nom, prenom FROM	fiche_personne WHERE nom REGEXP '.*-.*' OR prenom REGEXP '.*-.*';
