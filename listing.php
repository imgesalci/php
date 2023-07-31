<?php
include('inserting.php');
$query = "SELECT id, productName, purchasePrice, salePrice, vatRate, productImage, stockStatus FROM products WHERE isDeleted = 1";
$stmt = mysqli_prepare($conn, $query);
?>

<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
    <script src="./delete.js" defer></script>
    <script src="./update.js" defer></script>
</head>

<table style="width:100%" cellspacing="0" cellpadding="10">
    <tr>
        <th>#</th>
        <th>Product Name</th>
        <th>Purchase Price</th>
        <th>Sale Price</th>
        <th>VAT Rate</th>
        <th>Product Image</th>
        <th>Stock Status</th>

    </tr>
    <?php
    if (mysqli_stmt_execute($stmt)) {
        mysqli_stmt_bind_result($stmt, $id, $product_name, $purchase_price, $sale_price, $vat, $product_image, $stock);
        $sn = 1;
        while (mysqli_stmt_fetch($stmt)) {
    ?>
            <tr>
                <td><?php echo $sn; ?> </td>
                <td class="editable" data-column="pName"><?php echo $product_name; ?></td>
                <td class="editable" data-column="pPrice"><?php echo $purchase_price; ?></td>
                <td class="editable" data-column="sPrice"><?php echo $sale_price; ?></td>
                <td class="editable" data-column="vat"><?php echo $vat; ?></td>
                <td class="editable" data-column="pImage"> <?php echo $product_image; ?></td>
                <td class="editable" data-column="stock"><?php echo $stock; ?></td>
                <td align="center"><button class="edit" data-id="<?php echo $id; ?>">Update</button></td>
                <td align="center"><button class='btn' type="submit" name='delete' data-id="<?php echo $id; ?>">Delete</button></td>

            <tr>
            <?php
            $sn++;
        }
        mysqli_stmt_close($stmt);
    } else { ?>
            <tr>
                <td colspan="6">No data found</td>
            </tr>
        <?php } ?>
</table>