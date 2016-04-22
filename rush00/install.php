<?php
	include_once("function.php");
	if(file_exists("users") || file_exists("datas"))
	{
		die("L'installation à déjà été faite, merci de supprimer le dossier \"users\" et \"data\".");
	}
	if(!file_exists("users"))
	{
		mkdir("users");
		db_add("users/admin", array("id" => "admin", "mdp" => hash("whirlpool", "admin"), "mail" => "", "acces" => "admin"));
		echo "(1/5) Users directory created<br/>";
	}
	if(!file_exists("datas"))
	{
		mkdir("datas");
		echo "Datas directory created<br/>";
		if(!file_exists("datas/categories"))
		{
			$tmp = fopen("datas/categories", "w");
			fclose($tmp);
			echo "(2/5) Articles file has been created<br/>";
		}
		if(!file_exists("datas/achats"))
		{
			$tmp = fopen("datas/achats", "w");
			fclose($tmp);
			echo "(2/5) Achats file has been created<br/>";
		}
		if(!file_exists("data/categories"))
		{
			db_add("datas/categories", array("id" => "Processeur", "url" => "http://media.ldlc.com/ld/products/00/03/17/17/LD0003171785_2.jpg"));
			db_add("datas/categories", array("id" => "Carte graphique", "url" => "http://media.ldlc.com/ld/products/00/03/07/72/LD0003077226_2.jpg"));
			db_add("datas/categories", array("id" => "Carte mère", "url" => "http://media.ldlc.com/ld/products/00/02/41/27/LD0002412758_2.jpg"));
			db_add("datas/categories", array("id" => "Boitier", "url" => "http://media.ldlc.com/ld/products/00/03/48/40/LD0003484079_2.jpg"));
			db_add("datas/categories", array("id" => "Mémoire PC", "url" => "http://media.ldlc.com/ld/products/00/01/47/39/LD0001473941_2.jpg"));
			db_add("datas/categories", array("id" => "MSI", "url" => "http://media.ldlc.com/v3/marque/bo/00/03/30/74/V30003307473_1.jpg"));
			db_add("datas/categories", array("id" => "AMD", "url" => "http://media.ldlc.com/v3/marque/bo/00/01/69/31/V30001693125_1.gif"));
			db_add("datas/categories", array("id" => "Corsair", "url" => "http://media.ldlc.com/v3/marque/bo/00/03/20/85/V30003208588_1.gif"));
			db_add("datas/categories", array("id" => "Intel", "url" => "http://media.ldlc.com/v3/marque/bo/00/02/41/24/V30002412403_1.jpg"));
			db_add("datas/categories", array("id" => "ASUS", "url" => "http://www.logospike.com/wp-content/uploads/2014/11/Asus_logo.png"));
			echo "(4/5) Categories file  created<br/>";
		}
		if(!file_exists("datas/articles"))
		{
			$tmp = fopen("datas/articles", "w");
			fclose($tmp);
			db_add("datas/articles", array("id" => "MSI GeForce GTX 960 GAMING 4G",
									"categorie" => array("MSI", "Carte graphique"),
									"prix" => 249.95,
									"description" => "La carte graphique NVIDIA GeForce GTX 960 met les performances et l'efficacité énergétique de l'architecture haut de gamme NVIDIA Maxwell à la portée de tous ! La MSI GeForce GTX 960 GAMING 4G est la carte graphique Gamer abordable par excellence grâce à son GPU innovant et son prix attractif.",
									"url" => "http://media.ldlc.com/ld/products/00/02/91/90/LD0002919055_1.jpg"));
			db_add("datas/articles", array("id" => "MSI Radeon R9 Nano R9 NANO 4G",
									"categorie" => array("MSI", "Carte graphique"),
									"prix" => 599.95,
									"description" => "Basée sur la même architecture que la Radeon Fury X, la carte graphique MSI Radeon R9 Nano R9 NANO 4G promet une immersion totale et un niveau de détails inégalé dans les jeux PC les plus récents. Elle présente le double avantage d'offrir de hautes performances pour les jeux dans un format compact.",
									"url" => "http://media.ldlc.com/ld/products/00/03/48/70/LD0003487035_1.jpg"));
			db_add("datas/articles", array("id" => "MSI B150A GAMING PRO",
									"categorie" => array("MSI", "Carte mère"),
									"prix" => 129.95,
									"description" => "Basée sur le chipset Intel B150 Express, la carte mère MSI B150A GAMING PRO est conçue pour accueillir les processeurs Intel Core de 6ème génération (Intel Skylake). Elle permettra l'assemblage d'une configuration Multimédia ou bureautique à moindre coût.",
									"url" => "http://media.ldlc.com/ld/products/00/03/23/35/LD0003233550_1.jpg"));
			db_add("datas/articles", array("id" => "MSI C236A WORKSTATION",
									"categorie" => array("MSI", "Carte mère"),
									"prix" => 194.95,
									"description" => "La carte mère MSI C236A WORKSTATION est une carte mère dernière génération haut de gamme conçue pour équiper les stations de travail devant exécuter des applications professionnelles gourmandes en ressources.",
									"url" => "http://media.ldlc.com/ld/products/00/03/51/58/LD0003515829_1.jpg"));
			db_add("datas/articles", array("id" => "MSI Z170A GAMING M9 ACK",
									"categorie" => array("MSI", "Carte mère"),
									"prix" => 449.95,
									"description" => "Basée sur le chipset Intel Z170 Express, la carte mère MSI Z170A GAMING M9 ACK est conçue pour accueillir les processeurs Intel Core de 6ème génération (Intel Skylake). Elle permettra l'assemblage d'une configuration Gaming basée sur la dernière innovation Intel.",
									"url" => "http://media.ldlc.com/ld/products/00/03/25/95/LD0003259574_1_0003456106.jpg"));
			db_add("datas/articles", array("id" => "AMD FirePro V4900 1 GB",
									"categorie" => array("AMD", "Carte graphique"),
									"prix" => 169.95,
									"description" => "La carte graphique professionnelle AMD FirePro V4900 offre de fortes et solides performances et une fiabilité hors norme pour tous les professionnels qui travaillent avec des rendus de complexité moyenne à haute.",
									"url" => "http://media.ldlc.com/ld/products/00/01/06/01/LD0001060109_1.jpg"));
			db_add("datas/articles", array("id" => "AMD FirePro V7900 2 GB",
									"categorie" => array("AMD", "Carte graphique"),
									"prix" => 699.95,
									"description" => "La carte graphique professionnelle AMD FirePro V7900 est une excellente solution simple slot pour les professionnels qui travaillent avec des visualisations avancées, des modèles complexes et de larges ensembles de données.",
									"url" => "http://media.ldlc.com/ld/products/00/00/92/10/LD0000921065_1.jpg"));
			db_add("datas/articles", array("id" => "AMD FX 9370 Unlocked et ASUS Crosshair V Formula Z",
									"categorie" => array("AMD", "Processeur", "ASUS", "Carte mère"),
									"prix" => 658.95,
									"description" => "Processeur disposant d'une fréquence de 4.7 GHz (Max Turbo avec Turbo Core 3.0), l'AMD FX 9370 à 8 coeurs offre aux Gamers une arme redoutable pour jouer aux derniers jeux les plus prisés.",
									"url" => "http://media.ldlc.com/ld/products/00/01/35/17/LD0001351706_1.jpg"));
			db_add("datas/articles", array("id" => "AMD FX 9590 Unlocked (5.0 GHz Max Turbo)",
									"categorie" => array("AMD", "Processeur"),
									"prix" => 239.95,
									"description" => "Premier processeur au monde à disposer d'une fréquence de 5 GHz (Max Turbo avec Turbo Core 3.0), l'AMD FX 9590 à 8 coeurs offre aux Gamers une arme redoutable pour jouer aux derniers jeux les plus prisés.",
									"url" => "http://media.ldlc.com/ld/products/00/01/32/57/LD0001325763_1.jpg"));
			db_add("datas/articles", array("id" => "AMD FX 8350 Black Edition (4.0 GHz)",
									"categorie" => array("AMD", "Processeur"),
									"prix" => 189.95,
									"description" => "Le seul processeur grand public à 8 coeurs proposé à un prix compétitif ! Avec plus de coeurs pour plus de puissance, le processeur AMD FX permet la conception de PC de bureau de plus en plus performants. Pour l'informatique de tous les jours, les jeux vidéo les plus récents, la modélisation 3D.",
									"url" => "http://media.ldlc.com/ld/products/00/01/16/84/LD0001168418_1.jpg"));
			db_add("datas/articles", array("id" => "Corsair Graphite 230T",
									"categorie" => array("Corsair", "Boitier"),
									"prix" => 79.95,
									"description" => "Par une esthétique percutante et dernier cri, le modèle Graphite 230T permet d'assembler des systèmes rapides dont la forme évoque, elle aussi, la vitesse. En termes d'extension et de refroidissement, l'intérieur du boîtier autorise la flexibilité qui fait la réputation de Corsair.",
									"url" => "http://media.ldlc.com/ld/products/00/01/41/63/LD0001416383_1.jpg"));
			db_add("datas/articles", array("id" => "Corsair Carbide 400R",
									"categorie" => array("Corsair", "Boitier"),
									"prix" => 119.95,
									"description" => "Abordable et fonctionnel, le boîtier Moyen Tour Corsair Carbide 400R fournit une solution d'intégration à la fois design, spacieuse et pensée pour l'utilisateur. Idéal pour un upgrade de configuration ou la conception d'un PC moderne et dans l'air du temps.",
									"url" => "http://media.ldlc.com/ld/products/00/00/92/78/LD0000927869_1.jpg"));
			db_add("datas/articles", array("id" => "Corsair Dominator 16 Go (2x 8 Go) DDR3 1600 MHz CL10",
									"categorie" => array("Corsair", "Mémoire PC"),
									"prix" => 214.95,
									"description" => "Corsair Dominator 16 Go (2x 8Go) DDR3 1600 MHz CL10 est un kit mémoire DDR3 Dual Channel conçu pour fonctionner de manière optimale avec les processeurs Intel et AMD ainsi qu'avec le système d'exploitation Microsoft Windows Seven.",
									"url" => "http://media.ldlc.com/ld/products/00/01/08/60/LD0001086054_1.jpg"));
			db_add("datas/articles", array("id" => "Corsair Dominator Platinum 128 Go (8x 16 Go) DDR4 2800 MHz CL14",
									"categorie" => array("Corsair", "Mémoire PC"),
									"prix" => 1139.65,
									"description" => "Avec la nouvelle gamme de mémoires PC haut de gamme DDR4 Dominator Platinum, Corsair propose des solutions stables et performantes pour les plateformes nouvelle génération avec en prime un fort potentiel d'overclocking.",
									"url" => "http://media.ldlc.com/ld/products/00/01/75/92/LD0001759268_1_0003089392_0003124896.jpg"));
			db_add("datas/articles", array("id" => "Intel BLK D54250WYB",
									"categorie" => array("Intel", "Carte mère"),
									"prix" => 411.95,
									"description" => "La carte mère Intel BLK D54250WYB est une carte mère NUC avec processeur Intel Core i5-4250U. Son petit format et son processeur dernière génération en font un produit idéal pour composer un PC alliant performance et format miniature.",
									"url" => "http://media.ldlc.com/ld/products/00/01/51/98/LD0001519812_1.jpg"));
			db_add("datas/articles", array("id" => "Intel Galileo 2e génération",
									"categorie" => array("Intel", "Carte mère"),
									"prix" => 89.95,
									"description" => "Intel Galileo 2e génération est la première représentante d'une famille de cartes de développement certifiées Arduino, basées sur l'architecture Intel. Elle est spécialement conçue pour les makers, les étudiants, les formateurs et les amateurs de bricolage électronique.",
									"url" => "http://media.ldlc.com/ld/products/00/01/70/70/LD0001707069_1.jpg"));
			db_add("datas/articles", array("id" => "Intel Core i3-4340 (3.6 GHz)",
									"categorie" => array("Intel", "Processeur"),
									"prix" => 173.95,
									"description" => "Adaptez votre puissance grâce au processeur Haswell Intel Core i3-4340 (3.6 GHz). Le processeur pour PC de bureau Intel Core i3-4340 délivre des performances idéales pour la bureautique et pour un multitâche fluide, en plus de posséder des graphismes intégrés de grande qualité.",
									"url" => "http://media.ldlc.com/ld/products/00/01/35/25/LD0001352569_1_0001352574.jpg"));
			db_add("datas/articles", array("id" => "Intel Core i3-4130 (3.4 GHz)",
									"categorie" => array("Intel", "Processeur"),
									"prix" => 128.99,
									"description" => "Adaptez votre puissance grâce au processeur Haswell Intel Core i3-4130 (3.4 GHz). Le processeur pour PC de bureau Intel Core i3-4130 délivre des performances idéales pour la bureautique et pour un multitâche fluide, en plus de posséder des graphismes intégrés de grande qualité.",
									"url" => "http://media.ldlc.com/ld/products/00/01/35/25/LD0001352548_1.jpg"));
			db_add("datas/articles", array("id" => "Intel Core i5-4690K (3.5 GHz) et Be Quiet ! Dark Rock 3",
									"categorie" => array("Intel", "Processeur"),
									"prix" => 313.95,
									"description" => "Profitez d'un bundle extraordinaire en associant le processeur Intel Core i5-4690K avec l'un des meilleurs ventirad du marché : le Dark Rock 3 de Be Quiet !. A l'aide du Dark Rock 3, préservez vos composants tout en optimisant les performances de votre machine.",
									"url" => "http://media.ldlc.com/ld/products/00/01/60/40/LD0001604085_1.jpg"));
			db_add("datas/articles", array("id" => "Intel Core i5-6600K (3.5 GHz) et ASUS Z170 PRO Gaming",
									"categorie" => array("Intel", "Processeur", "ASUS", "Carte mère"),
									"prix" => 445.95,
									"description" => "Profitez de ce pack hautes performances pour concevoir une machine à la pointe du Gaming ! La carte mère ASUS Z170 PRO Gaming est une carte référence, abordable et efficace, qui vous permettra de tirer parti du meilleur du processeur i5-6600K.",
									"url" => "http://media.ldlc.com/ld/products/00/03/26/91/LD0003269171_1.jpg"));
			db_add("datas/articles", array("id" => "ASUS MAXIMUS VIII HERO",
									"categorie" => array("ASUS", "Carte mère"),
									"prix" => 248.95,
									"description" => "Basée sur le chipset Intel Z170 Express, la carte mère ASUS MAXIMUS VIII HERO est conçue pour accueillir les processeurs Intel Core de 6ème génération (Intel Skylake). Elle permettra l'assemblage d'une configuration Gaming basée sur la dernière innovation Intel.",
									"url" => "http://media.ldlc.com/ld/products/00/03/18/80/LD0003188051_1.jpg"));
			db_add("datas/articles", array("id" => "ASUS ROG MAXIMUS VIII FORMULA",
									"categorie" => array("ASUS", "Carte mère"),
									"prix" => 399.95,
									"description" => "La carte mère ASUS ROG MAXIMUS VIII FORMULA est la carte de référence pour les gamers ! D'une efficacité incroyable, elle saura tirer parti du meilleur de la dernière génération de processeurs Intel.",
									"url" => "http://media.ldlc.com/ld/products/00/03/49/19/LD0003491944_1.jpg"));
			db_add("datas/articles", array("id" => "ASUS STRIX-GTX980TI-DC3-6GD5-GAMING - GTX 980 Ti 6GB",
									"categorie" => array("ASUS", "Carte mère"),
									"prix" => 825.95,
									"description" => "Boostée par l'architecture révolutionnaire NVIDIA Maxwell, à hautes performances et basse consommation, la GeForce GTX 980 Ti est la carte graphique pour gamers la plus performante du marché. Elle dispose de la puissance nécessaire pour vous faire entrer dans une autre dimension.",
									"url" => "http://media.ldlc.com/ld/products/00/03/40/39/LD0003403929_1.jpg"));
			db_add("datas/articles", array("id" => "ASUS POSEIDON-GTX980TI-P-6GD5 - GTX 980 Ti 6GB",
									"categorie" => array("ASUS", "Carte mère"),
									"prix" => 899.95,
									"description" => "Boostée par l'architecture révolutionnaire NVIDIA Maxwell, à hautes performances et basse consommation, la GeForce GTX 980 Ti est la carte graphique pour gamers la plus performante du marché. Elle dispose de la puissance nécessaire pour vous faire entrer dans une autre dimension.",
									"url" => "http://media.ldlc.com/ld/products/00/03/23/47/LD0003234747_1.jpg"));
			echo "(5/5) Articles file has been created<br/>";
		}
	}
	echo "Installation terminé! n'oublier pas de supprimer le fichier d'installation.<br />"
?>
