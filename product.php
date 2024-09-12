<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product</title>
    <style>
        p.search {
            text-align: center;
            margin: 20px 0;
        }
        th {
            height: 50px;
        }
        .deleteBtn {
            text-decoration: none;
        }
    </style>
</head>
<body>
   
    <a href="addproduct.php" style="text-decoration: none;">Add Product</a>
    <br> <br> 

    <?php
        
        require_once 'product.class.php';

        
        $productObj = new Product();

    
        $keyword = $category = '';
        
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            
            $keyword = htmlentities($_POST['keyword']);
            $category = htmlentities($_POST['category']);
        }

        
        $array = $productObj->showAll($keyword, $category);
    ?>

    
    <form action="" method="post">
    
        <label for="category">Category</label>
        <select name="category" id="category">
            <option value="">All</option>
            
            <?php
                $categoryList = $productObj->fetchCategory();
                foreach ($categoryList as $cat){
            ?>
                <option value="<?= $cat['id'] ?>" <?= ($category == $cat['id']) ? 'selected' : '' ?>><?= $cat['name'] ?></option>
            <?php
                }
            ?>

        </select>
        
        <label for="keyword">Search</label>
        <input type="text" name="keyword" id="keyword" value="<?= $keyword ?>">
        
        <input type="submit" value="Search" name="search" id="search">
    </form>
    <br>

    
    <table border= 2 style="border-collapse: collapse; width: 50%; border-color: black;">
        <tr>
            <th>Code</th> 
            <th>Name</th> 
            <th>Category</th> <
            <th>Price</th> 
            <th>Available Stock</th> 
            <th>Action</th> 
        </tr>
        
        <?php
        if (empty($array)) {
        ?>
            <tr>
                <td colspan="7"><p class="search">No product found.</p></td>
            </tr>
        <?php
        }
        
        foreach ($array as $arr) {
        ?>
        <tr>
         
            <td><?= $arr['code'] ?></td>
            
            <td><?= $arr['name'] ?></td>
            
            <td><?= $arr['category_name'] ?></td>
            
            <td><?= $arr['price'] ?></td>
            
            <td><?= (isset($arr['available_stock']) && ($arr['available_stock'] <= 0)) ? "No Stock" : $arr['available_stock'] ?></td>
           
            <td>
               
                <a href="editproduct.php?id=<?= $arr['id'] ?>" style="text-decoration: none;">Edit</a>
                
                <a href="#" class="deleteBtn" data-id="<?= $arr['id'] ?>" data-code="<?= $arr['code'] ?>" data-name="<?= $arr['name'] ?>">Delete</a>
            </td>
        </tr>
        <?php
        }
        ?>
    </table>
    
   
    <script src="./product.js"></script>
</body>
</html>
