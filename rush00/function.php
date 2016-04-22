<?php
session_start();
function	db_add($db_name, $new_array)
{
	if (!file_exists($db_name))
	{
		$tmp = fopen($db_name, "w");
		fclose($tmp);
	}
	if (file_exists($db_name))
	{
		$str = file_get_contents($db_name);
		$tab = unserialize($str);
		$tab[$new_array[id]] = $new_array;
		file_put_contents($db_name, serialize($tab));
		return (TRUE);
	}
	return (FALSE);
}

function	db_del($db_name, $id)
{
	if (!file_exists($db_name))
	{
		$tmp = fopen($db_name, "w");
		fclose($tmp);
	}
	$str = file_get_contents($db_name);
	$tab = unserialize($str);
	unset($tab[$id]);
	file_put_contents($db_name, serialize($tab));
}

function	db_get($db_name)
{
	if (file_exists($db_name))
	{
		$str = file_get_contents($db_name);
		$tab = unserialize($str);
		return ($tab);
	}
	return (NULL);
}

function user_auth($login, $mdp)
{
	$tab = db_get("users/".$login);
	if ($tab !== NULL)
	{
		if ($tab[$login]['id'] == $login && $tab[$login]['mdp'] == hash("whirlpool", $mdp))
		{
			$_SESSION['account'] = $login;
			$_SESSION['acces'] = $tab[$login]['acces'];
			return (TRUE);
		}
	}
	return (FALSE);
}

function user_logout()
{
	$_SESSION['account'] = "";
	$_SESSION = array();
	return (TRUE);
}

?>
