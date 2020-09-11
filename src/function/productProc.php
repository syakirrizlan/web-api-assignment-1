<?php
//get all products
function getAllProducts($db)
{
$sql = 'Select p.name, p.description, p.price, c.name as category from pr
oducts p ';
$sql .='Inner Join categories c on p.category_id = c.id';
$stmt = $db->prepare ($sql);
$stmt ->execute();
return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

//get product by id
function getProduct($db, $productId)
{
$sql = 'Select p.name, p.description, p.price, c.name as category from pr
oducts p ';
$sql .= 'Inner Join categories c on p.category_id = c.id ';
$sql .= 'Where p.id = :id';
$stmt = $db->prepare ($sql);
$id = (int) $productId;
$stmt->bindParam(':id', $id, PDO::PARAM_INT);
$stmt->execute();
return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

//insert new product
function createProduct($db, $form_data)
{
$sql = 'Insert into products (name, description, price, category_id, created) ';
$sql .= 'values (:name, :description, :price, :category_id, :created)';
$stmt = $db->prepare ($sql);
$stmt->bindParam(':name', $form_data['name']);
$stmt->bindParam(':description', $form_data['description']);
$stmt->bindParam(':price', floatval($form_data['price']));
$stmt->bindParam(':category_id', intval($form_data['category_id']));
$stmt->bindParam(':created', $form_data['created']);
$stmt->execute();
return $db->lastInsertID();//insert last number.. continue
}

//delete product by Id
function deleteProduct($db,$productId) {
    $sql = ' Delete from products where id = :id';
    $stmt = $db->prepare($sql);
    $id = (int)$productId;
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    }
    
    //update product by id
    function updateProduct($db,$form_dat,$productId,$date)
{
    $sql = 'UPDATE products SET name = :name , description = :description , price = :price , category_id = :category_id , modified = :modified ';
    $sql .=' WHERE id = :id';

    $stmt = $db->prepare ($sql);
    $id = (int)$productId;
    $mod = $date;

    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->bindParam(':name', $form_dat['name']);
    $stmt->bindParam(':description', $form_dat['description']);
    $stmt->bindParam(':price', ($form_dat['price']));
    $stmt->bindParam(':category_id', ($form_dat['category_id']));
    $stmt->bindParam(':modified', $mod , PDO::PARAM_STR);
    $stmt->execute();
  
    $sql1 = 'Select p.name, p.description, p.price, c.name as category from products as p ';
    $sql1 .= 'Inner Join categories c on p.category_id = c.id ';
    $sql1 .= 'Where p.id = :id'; 
    $stmt1 = $db->prepare ($sql1);
    $stmt1->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt1->execute();
    return $stmt1->fetchAll(PDO::FETCH_ASSOC);
    
}
//new coding------------------------------------------------------------------------------------------

//get product with condition by name
function getProductname($db, $productName)
{
    $sql = 'select * from products ';
    $sql .= 'Where name = :name';
    $stmt = $db->prepare ($sql);
    $name= $productName;
    $stmt->bindParam(':name', $name);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

//delete product with condition by name
function deleteProductname($db,$productName) {
    $sql = ' Delete from products where name = :name';
    $stmt = $db->prepare($sql);
    $name = (String)$productName;
    $stmt->bindParam(':name', $name, PDO::PARAM_STR);
    $stmt->execute();
    }

//update product by name
function updateProductname($db,$form_dat,$productName,$date) {
    $sql = 'UPDATE products SET name = :name , description = :description ,
   price = :price , category_id = :category_id , modified = :modified ';
    $sql .=' WHERE name = :name';
    $stmt = $db->prepare ($sql);
    $name = $productName;
    $mod = $date;
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->bindParam(':name', $form_dat['name']);
    $stmt->bindParam(':description', $form_dat['description']);
    $stmt->bindParam(':price',($form_dat['price']));
    $stmt->bindParam(':category_id',($form_dat['category_id']));
    $stmt->bindParam(':modified', $mod , PDO::PARAM_STR);
    $stmt->execute();
   }