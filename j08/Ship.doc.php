La class Ship est un vehicule (implements IVehicle);

Un vaisseaux est defini par:

		const PP; 				| nombre par defaut de PP
		const SIZE;				| taille d'un block (carre)

		static $id;				| id qui s'incrementeras pour assigner des id au class fille

		$_name;					| nom du vaisseaux
		$_size;					| taille du viasseaux
		$_sprite;				| image correspondant au vaisseaux
		$_health;				| vie restante du vaisseaux
		$_pp;					| points de puissances du vaisseaux
		$_speed;				| vitesse du vaisseaux
		$_mobility;				| mobilite du vaisseaux
		$_shield;				| bouclier du vaisseaux
		$_weapon;				| nom de l'arme du vaisseaux

		$_dir;					| direction du vaisseaux (N, E, S, O) = (1, 2, 3, 4);
		$_moving;				| Le vaisseaux est il en mouvement ? false // true;

		$_faction;				| faction du vaisseaux
		$_id;					| id du vaisseaux

		$_x;					| position x
		$_y;					| position y

		$_selected;				| le vaisseau est selectionner ? false // true;
		$_activated;			| le vaisseau est activer ? false // true;
		$_done;					| le vaisseau a finis son mouvement ? false // true;

		$_speed_pp;				| Points pp attribue a la vitesse;
		$_shield_pp;			| Points pp attribue aux boucliers;
		$_power_pp;				| Points pp attribue a la puissances des armes;

########################################
#                                      #
#         METHODES                     #
#                                      #
########################################




Tous les getter et setter sont attribue pour les attributs.
Les methodes move et take_dmg sont initialise conformement a l'interface IVehicle.
take_dmg() enleve un point de vie soit a $_shield_pp soit a $_health;
move($x, $y) deplace le vaisseaux soit en ligne ou soit en colonne, un deplacement diagonal est impossible.

	function	display()				|	Cette fonction permet d'afficher en html un vaisseaux a sa position
										|	un lien est egalement creer pour pouvoir le selectionner.

	function	display_whithout_link()	|	Cette fonction permet d'afficher en html un vaisseaux a sa position
										|	le lien n'est pas creer dans ce cas.
