<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Assignment Amtis</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  </head>
  <body>
    <?php

// https: //www.blogfaiz.com/cara-kira-kos-elektrik-bagi-setiap-peralatan-elektrik-rumah/

/** Formula to calculate electricity bills */
// Power (Wh) = Voltage (V) * Current  (A)
// Energy (kWh) = Power * Hour * 1000 ;
// Total = Energy(kWh) * (current rate/100);

// calculation function
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

// to display output in the same page
if (isset($_POST['submitBtn'])) {
    // user input
    $voltage = $_POST['voltage'];
    $current = $_POST['current'];
    $current_rate = $_POST['current_rate'];
    // $hour = $_POST['hour'];

    $power = $voltage * $current; // in Wh
    // $energy = ($power / 1000) * $hour; // kWh

    $total = [];
    $energy = [];

    // loop for 24 hours
    for ($i = 0; $i < 24; $i++) {
        $energy[$i] = ($power / 1000) * ($i + 1); // kWh
        $total[$i] = calculate($energy[$i]);
    }
} else {
    // default value
    $voltage = 0;
    $current = 0;
    $current_rate = 0;
    $power = 0;

    $energy = [];
    $total = [];

    for ($i = 0; $i < 24; $i++) {
        $energy[$i] = 0; // kWh
        $total[$i] = 0;
    }

}

?>
    <div class="container mt-5 mb-5">
      <form action="" method="post">
        <h1>Calculate Electricity Rates</h1>
        <div class="mb-3">
          <label for="voltage" class="form-label">Voltage</label>
          <input type="number" class="form-control" id="voltage" name="voltage" step="any" placeholder="Example: 19">
        </div>
        <div class="mb-3">
          <label for="current" class="form-label">Current (A)</label>
          <input type="number" class="form-control" name="current" id="current" step="any" placeholder="Example: 3.24">
        </div>
        <!-- <div class="mb-3">
          <label for="hour" class="form-label">Hour</label>
          <input type="number" class="form-control" name="hour" id="hour">
        </div> -->
        <div class="mb-3">
          <label for="current_rate" class="form-label">Current Rate (sen/kWh)</label>
          <input type="number" class="form-control" name="current_rate" id="current_rate" step="any" placeholder="Example: 21.8">
        </div>

        <input type="submit" name="submitBtn" class="btn btn-primary" value="Calculate">
      </form>
    </div>

    <div class="container">
      <h2>Power (Wh): <?php echo $power; ?></h2>
      <h2>Rate (RM): <?php echo ($current_rate / 100); ?></h2>
    </div>

    <div class="container mt-5 mb-5">
      <table class="table">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Hour</th>
            <th scope="col">Energy (kWh)</th>
            <th scope="col">Total (RM)</th>
          </tr>
        </thead>
        <tbody>
          <?php
for ($i = 0; $i < 24; $i++) {
    ?>
            <tr>
              <th><?php echo ($i + 1); ?></th>
              <td><?php echo ($i + 1); ?></td>
              <td><?php echo ($energy[$i]); ?></td>
              <td><?php echo ($total[$i]); ?></td>
            </tr>
          <?php }?>
        </tbody>
      </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
  </body>
</html>
