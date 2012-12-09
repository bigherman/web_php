<?php
echo "entered procedure<br/>";

@ $db = new mysqli('localhost','web_user','password','carhire');

if (mysqli_connect_errno())
{
        echo "Error: Could not connect to database";
        exit;
}

echo "enter query<br/>";

$query = "select * from car left join contract on car.contract = contract.contract_id where contract.sales_person = 'Barack Obama'";

echo "run query<br/>";
$result = $db->query($query);

echo "get number of rows: ";
$num_results = $result->num_rows;
echo "$num_results<br/><br/>";

echo "<table border=1>";
echo "<tr>";
echo "<th>Car Type</th><th>Class</th>";
echo "</tr>";
for ($i = 0; $i <$num_results; $i++)
{
        $row = $result->fetch_assoc();
        echo "<tr><td>";
        echo stripslashes ($row['make']);
        echo " ";
        echo stripslashes ($row['model']);
        echo "</td><td>";
        echo stripslashes ($row['class']);
        echo "</td></tr>";
}
echo "</table>";
?>
