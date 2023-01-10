<?php
// Power (Wh) = Voltage (V) * Current  (A)
// Energy (kWh) = Power * Hour * 1000 ;
// Total = Energy(kWh) * (current rate/100);

function calculate($energy)
{
    $total = 0;

    if ($energy >= 1 && $energy <= 200) {
        $current_rate = 21.8;
        $total = $energy * ($current_rate / 100);

    } else if ($energy >= 201 && $energy <= 300) {
        $current_rate = 33.4;

        $bal_energy = $energy - 200;

        $first_energy = 200 * (21.80 / 100);
        $remaining_energy = $bal_energy * ($current_rate / 100);

        $total = $first_energy + $remaining_energy;

    } else if ($energy >= 301 && $energy <= 600) {
        $current_rate = 51.6;

        $bal_energy = $energy - 200;
        $bal_energy = $bal_energy - 100;

        $first_energy = 200 * (21.80 / 100);
        $second_energy = 100 * (33.4 / 100);
        $remaining_energy = $bal_energy * ($current_rate / 100);

        $total = $first_energy + $second_energy + $remaining_energy;

    } else if ($energy >= 601 && $energy <= 900) {
        $current_rate = 54.6;

        $bal_energy = $energy - 200;
        $bal_energy = $bal_energy - 100;
        $bal_energy = $bal_energy - 300;

        $first_energy = 200 * (21.80 / 100);
        $second_energy = 100 * (33.4 / 100);
        $third_energy = 300 * (51.6 / 100);
        $remaining_energy = $bal_energy * ($current_rate / 100);

        $total = $first_energy + $second_energy + $third_energy + $remaining_energy;

    } else if ($energy >= 901) {
        $current_rate = 57.1;

        $bal_energy = $energy - 200;
        $bal_energy = $bal_energy - 100;
        $bal_energy = $bal_energy - 300;
        $bal_energy = $bal_energy - 300;

        $first_energy = 200 * (21.80 / 100);
        $second_energy = 100 * (33.4 / 100);
        $third_energy = 300 * (51.6 / 100);
        $fourth_energy = 300 * (54.60);
        $remaining_energy = $bal_energy * ($current_rate / 100);

        $total = $first_energy + $second_energy + $third_energy + $fourth_energy + $remaining_energy;
    }

    return $total;
}

// Power (Wh) = Voltage (V) * Current  (A)
// Energy (kWh) = Power * Hour * 1000 ;
// Total = Energy(kWh) * (current rate/100);

$voltage = $_POST['voltage'];
$current = $_POST['current'];
$current_rate = $_POST['current_rate'];
$hour = $_POST['hour'];

$power = $voltage * $current; // in Wh
$energy = ($power / 1000) * $hour; // kWh

$total = calculate($energy);
print("Total Amount: " . $energy);
