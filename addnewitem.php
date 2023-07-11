<!DOCTYPE html>
<html>
    <head>
        <title>MDMStationery</title>
    </head>    

    <body>
        <form action="includes/addnewitem.inc.php" method="POST" enctype="multipart/form-data">
            <input type="name" name="itemName" placeholder="Item name">
            <input type="name" name="itemInStock" placeholder="Item in stock">
            <input type="file" name="file"> <!-- defines a file-select field and a "Browse" button for file uploads. -->
            <button type="submit" name="submit">Add New Item</button>
        </form> 
    </body>
</html>
