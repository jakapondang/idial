<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Welcome to CodeIgniter</title>


</head>
<body>

<div id="container">
    <table cellpadding="0" cellspacing="0" border="1">
        <thead>
       <tr>
            <td>col1</td>
            <td>col2</td>
            <td>col3</td>
           <td>col1</td>
           <td>col2</td>
           <td>col3</td>

       </tr>
        </thead>

        <tbody>
        <?php foreach($csvData as $field){?>
        <tr>
            <td><?php echo $field['pro_id']?></td>
            <td><?php echo $field['cat_id']?></td>
            <td><?php echo $field['bra_id']?></td>
            <td><?php echo $field['name']?></td>
            <td><?php echo $field['sku']?></td>
            <td><?php echo $field['nett']?></td>
        </tr>
        <?php }?>

        </tbody>

    </table>
</div>

</body>
</html>