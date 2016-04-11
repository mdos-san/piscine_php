SELECT titre as Titre, resum as Resume, annee_prod, film.id_genre FROM film INNER JOIN genre ON film.id_genre = genre.id_genre WHERE genre.nom = 'action' ORDER BY annee_prod DESC;
