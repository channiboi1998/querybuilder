<?php

require_once('databaseconnection.php');
require_once('querybuilder.php');
require_once('sites.php');
require_once('clients.php');

$site1 = new Sites();
$site1->connect('lead_gen_business');
$siteResults = $site1->select(array("client_id", $site1->count))->group_by('client_id')->having($site1->count, ">", 5)->get();

$clients = new Clients();
$clients->connect('lead_gen_business');
$clientsResults = $clients->where(array("last_name" => "Owen"))->get();  //chaining methods
?>



<table border="1">
    <tr>
        <td>Client ID</td>
        <td>Count(*)</td>
    </tr>
    <?php
    if ($siteResults) 
    {
        foreach($siteResults as $siteResult)
        {
?>
        <tr>
            <td><?=$siteResult['client_id']?></td>
            <td><?=$siteResult['COUNT(*)']?></td>
        </tr>
<?php
        }
    }

?>
</table>

<table border="1">
    <tr>
        <td>client_id</td>
        <td>first_name</td>
        <td>last_name</td>
        <td>email</td>
        <td>joined_datetime</td>
    </tr>
<?php
if ($clientsResults)
{
    foreach ($clientsResults as $clientsResult)
    {
?>
    <tr>
        <td><?=$clientsResult['client_id']?></td>
        <td><?=$clientsResult['first_name']?></td>
        <td><?=$clientsResult['last_name']?></td>
        <td><?=$clientsResult['email']?></td>
        <td><?=$clientsResult['joined_datetime']?></td>
    </tr>
<?php        
    }
}
?>
</table>