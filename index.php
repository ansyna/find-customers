<?php

define('BASE_PATH', realpath(dirname(__FILE__)));

function autoloader($class)
{
    include( BASE_PATH . '/' . str_replace('\\', '/', $class) . '.php' );
}

spl_autoload_register('autoloader');

use App\FindCustomers;

$finder = new FindCustomers(100,"resources/customers.txt", 53.339428, -6.257664);
$userList = $finder->getUserList();
$customers = $finder->findCustomers($userList);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Customers within 100km</title>
</head>
<body>
<table style="width:50%" border="1">
    <tr>
        <th>User id</th>
        <th>User name</th>
    </tr>
<?php foreach ($customers as $customer) { ?>
    <tr>
        <td><?php echo $customer['user_id']?></td>
        <td><?php echo $customer['name']?></td>
    </tr>
<?php } ?>
</table>
</body>
</html>


