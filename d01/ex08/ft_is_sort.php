<?php
function	ft_is_sort($tab)
{
	$new_tab = $tab;
	sort($new_tab);
	if ($new_tab == $tab)
		return (true);
	else
		return (false);
}
?>
