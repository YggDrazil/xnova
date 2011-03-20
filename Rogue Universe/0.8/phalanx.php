<?php

/**
 * phalanx.php
 *
 * @version 1.0
 * @copyright 2008 by ??????? for XNova
 */

define('INSIDE'  , true);
define('INSTALL' , false);

$ugamela_root_path = './';
include($ugamela_root_path . 'extension.inc');
include($ugamela_root_path . 'common.' . $phpEx);


$galaktyka = $planetrow['galaxy'];
$system = $planetrow['system'];
$planeta = $planetrow['planet'];

global $planetrow;
$liczba = $poziom * 10000;
if ($planetrow['deuterium'] > $liczba);
doquery("UPDATE {{table}} SET deuterium=deuterium-10000 WHERE id='{$user['current_planet']}'", 'planets');
if ($planetrow['deuterium'] = $planetrow['deuterium'] - $liczba);
else {
	message ("<b>You did not have enough fuel!!</b>", "Error", "overview." . $phpEx, 2);
}

if ($planetrow['planet_type'] != '3') {
	message("The sensor works only on the moon", "Error", "overview." . $phpEx, 1);
}
if ($planetrow['sensor_phalax'] == '0') {
	message("You must improve your phalanx", "Error", "overview." . $phpEx, 1);
}

$poziom = $planetrow['sensor_phalax'];
$systemdol = $system - $poziom * 3;
$systemgora = $system + $poziom * 3;

if ($_SERVER["REQUEST_METHOD"] == "GET") {
	$g  = $_GET["galaxy"];
	$s  = $_GET["system"];
	$i  = $_GET["planet"];
	$id = $_GET["id"];
	$id_owner = $_GET['id_owner'];
}

$planetas = doquery("SELECT * FROM {{table}} WHERE `galaxy` = '". $g ."' AND `system` = '". $s ."' AND `planet` = '". $i ."';", 'planets');
while ($row_planetas = mysql_fetch_array($planetas)) {
	$nome = $row_planetas['name'];
}

$missiontype = array(1 => 'Attaquer',
	3 => 'Transporter',
	4 => 'Transferer',
	5 => 'Destruire',
	6 => 'Espioner',
	7 => 'Stationer',
	8 => 'Recicler',
	9 => 'Coloniser',
	);

$fq = doquery("SELECT * FROM {{table}} WHERE  (
		( fleet_start_galaxy=$g AND fleet_start_system=$s AND fleet_start_planet=$i )
		OR
		( fleet_end_galaxy=$g AND fleet_end_system=$s AND fleet_end_planet=$i )
		) ORDER BY `fleet_start_time`", 'fleets');

if (mysql_num_rows($fq) == "0") {
	$page .= "<table width=519>
	<tr>
	  <td class=c colspan=7>Last manoeuvres on the moon</td>
	</tr><th>A fleet of movement was detected;</th></table>";
} else {
	$page .= "<center><table>";
	$parse = $lang;

	while ($row = mysql_fetch_array($fq)) {
		$i++;
		$timerek    = $row['fleet_start_time'];
		$timerekend = $row['fleet_end_time'];

		if ($row['fleet_mission'] == 1) { $kolormisjido = lime;   }
		if ($row['fleet_mission'] == 2) { $kolormisjido = lime;   }
		if ($row['fleet_mission'] == 3) { $kolormisjido = lime;   }
		if ($row['fleet_mission'] == 4) { $kolormisjido = lime;   }
		if ($row['fleet_mission'] == 5) { $kolormisjido = lime;   }
		if ($row['fleet_mission'] == 6) { $kolormisjido = orange; }
		if ($row['fleet_mission'] == 7) { $kolormisjido = lime;   }
		if ($row['fleet_mission'] == 8) { $kolormisjido = lime;   }
		if ($row['fleet_mission'] == 9) { $kolormisjido = lime;   }
		if ($row['fleet_mission'] == 1) { $kolormisjiz = green;   }
		if ($row['fleet_mission'] == 2) { $kolormisjiz = green;   }
		if ($row['fleet_mission'] == 3) { $kolormisjiz = green;   }
		if ($row['fleet_mission'] == 4) { $kolormisjiz = green;   }
		if ($row['fleet_mission'] == 5) { $kolormisjiz = green;   }
		if ($row['fleet_mission'] == 6) { $kolormisjiz = B45D00;  }
		if ($row['fleet_mission'] == 7) { $kolormisjiz = green;   }
		if ($row['fleet_mission'] == 8) { $kolormisjiz = green;   }
		if ($row['fleet_mission'] == 9) { $kolormisjiz = green;   }

		// variable avec les coordoner d'origine
		$g1 = $row['fleet_start_galaxy'];
		$s1 = $row['fleet_start_system'];
		$i1 = $row['fleet_start_planet'];

		// variable avec les coordoner de destination
		$g2 = $row['fleet_end_galaxy'];
		$s2 = $row['fleet_end_system'];
		$i2 = $row['fleet_end_planet'];

		$parse['manobras'] .= "<tr><th><div id=\"bxxfs$i\" class=\"z\"></div><font color=\"lime\">" . gmdate("H:i:s", $row['fleet_start_time']-5 * 60 * 60) . "</font> </th><th colspan=\"3\">";
		$parse['manobras'] .= "<th><font color=\"$kolormisjido\">A";
		$parse['manobras'] .= '(<a title="';
		/*
		  Il faut faire une liste de flotte
		*/
		$fleet = explode(";", $row['fleet_array']);
		$e = 0;
		foreach($fleet as $a => $b) {
			if ($b != '') {
				$e++;
				$a = explode(",", $b);
				$parse['manobras'] .= "{$lang['tech']{$a[0]}}: {$a[1]}, \n";
				if ($e > 1) {
					$parse['manobras'] .= "\t";
				}
			}
		}
		$parse['manobras'] .= "\">Flotte</a>)";

		$parse['manobras'] .= " From the planet $name [$ g1: $ s1: $ i1] reaches the planet [$ g2: $ s2: $ i2]. It's mission";
		$parse['manobras'] .= " <font color=\"white\">{$missiontype[$row['fleet_mission']]}</font></th><br>";

		$parse['manobras'] .= "<tr><th><div id=\"bxxfs$i\" class=\"z\"></div><font color=\"green\">" . gmdate("H:i:s", $row['fleet_end_time']-5 * 60 * 60) . "</font></th><th colspan=\"3\">";
		$parse['manobras'] .= "<th><font color=\"$kolormisjido\">A ";
		$parse['manobras'] .= '(<a title="';
		/*
		  Il faut faire une liste de flotte
		*/
		$fleet = explode(";", $row['fleet_array']);
		$e = 0;
		foreach($fleet as $a => $b) {
			if ($b != '') {
				$e++;
				$a = explode(",", $b);
				$parse['manobras'] .= "{$lang['tech']{$a[0]}}: {$a[1]}, \n";
				if ($e > 1) {
					$parse['manobras'] .= "\t";
				}
			}
		}
		$parse['manobras'] .= "\">flotte</a>)";

		$parse['manobras'] .= " 	
from the planet [$ g2: $ s2: $ i2] back on the planet $name [$ g1: $ s1: $ i1]. Its mission:";
		$parse['manobras'] .= " <font color=\"white\">{$missiontype[$row['fleet_mission']]}</font></th></tr><br>";
	}

	$page = parsetemplate(gettemplate('phalanx_body'), $parse);
}

display($page, "phalanx");

// Cr�er par Bladegame et TMD
?>