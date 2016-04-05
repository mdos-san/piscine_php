#!/usr/bin/php
<?php
	$nb = 0;
	echo "Entrez un nombre: ";
	while (($nb = fgets(STDIN)) != false)
	{
		$nb = trim($nb, "\n");
		if (is_numeric($nb))
			if ($nb % 2 == 0)
				echo "Le chiffre $nb est Pair\n";
			else
				echo "Le chiffre $nb est Impair\n";
		else
			echo "'$nb' n'est pas un chiffre\n";
		echo "Entrez un nombre: ";
	}
	echo "^D\n";
?>
