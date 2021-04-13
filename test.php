<?php
$packages = array(20, 70, 90, 30, 60, 110, 50, 10, 9);

function whichPackagesToLoad(int $truckSpace, array $packages){
  $truckSpace -= 30;
  $result = [];
  sort($packages);
  $length = count($packages) - 1;
  $diff = PHP_INT_MAX;

  //in case we have numbers, sum of which equals to $truckSpace
  foreach ($packages as $key=>$value) {
    $pair = $truckSpace - $value;
    unset($packages[$key]);
    if (in_array($pair, $packages)) {
        array_push($result, $value, $pair);
        break;
    }
    $packages[$key] = $value;
  }
  // in case we don't have elements, sum of which equals to $truckSpace, we find the closest
  if (count($result) == 0) {
    $start = 0;
      while ($start < $length) {
        if (($packages[$start] + $packages[$length] - $truckSpace) <  $diff){
        $res_s = $start;
        $res_l = $length;
        $diff = $packages[$start] + $packages[$length] - $truckSpace; 
        }
        if ($packages[$start] + $packages[$length] > $truckSpace)
        $length--;
          
        else 
        $start++;
        }
    array_push($result, $packages[$res_s], $packages[$res_l]);
  }
  
  return $result ;
};

print_r(whichPackagesToLoad(50, $packages));