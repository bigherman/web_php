
<?php
        @ $db = new mysqli('localhost','web_user','password','carhire');

        if (mysqli_connect_errno())
        {
                echo "Error: Could not connect to database";
                exit;
        }

        $query = "select * from car left join contract on car.contract = contract.contract_id where contract.sales_person = 'Barack Obama'";

        $result = $db->query($query);

        $num_results = $result->num_rows;

        header('Content-type: text/xml');
        header('Pragma: public');
        header('Cache-control: private');
        header('Expires: -1');

        /* create a dom document with encoding utf8 */
        $domtree = new DOMDocument('1.0', 'UTF-8');

        /* create the root element of the xml tree */
        $xmlRoot = $domtree->createElement("xml");
        /* append it to the document created */
        $xmlRoot = $domtree->appendChild($xmlRoot);

        for ($i = 0; $i <$num_results; $i++)
        {
                $row = $result->fetch_assoc();

                $currentCar = $domtree->createElement("car");
                $currentCar = $xmlRoot->appendChild($currentCar);

                $currentCar->appendChild($domtree->createElement('make',$row['make']));
                $currentCar->appendChild($domtree->createElement('model',$row['model']));
                $currentCar->appendChild($domtree->createElement('class',$row['class']));
        }
        /* get the xml printed */
        echo $domtree->saveXML();
?>
