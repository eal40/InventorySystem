<?php
// Include database configuration helper
require_once __DIR__ . '/db_config.php';

// Database connection function
function dbconnection(){
    date_default_timezone_set('Asia/Manila');
    
    try {
        return create_db_connection();
    } catch (PDOException $e) {
        die("Connection failed: " . $e->getMessage());
    }
}   

// Register function
function register($fname, $lname, $username, $password, $email, $phone, $role, $branch){
    // Get the database connection
    $dbconnection = dbconnection();

    // Prepare the SQL statement
    try {
        $statement = $dbconnection->prepare("INSERT INTO users (FName, LName, Username, Password, Email, Phone, Role, Branch) 
                                             VALUES (:fname, :lname, :username, :password, :email, :phone, :role, :branch)");

        // Bind the values to the placeholders
        $statement->bindValue(':fname', $fname);
        $statement->bindValue(':lname', $lname);
        $statement->bindValue(':username', $username);
        $statement->bindValue(':password', $password);
        $statement->bindValue(':email', $email);
        $statement->bindValue(':phone', $phone);
        $statement->bindValue(':role', $role);
        $statement->bindValue(':branch', $branch);

        // Execute the statement
        $statement->execute();
        
        // If the execution is successful, return true
        return true;

    } catch (Exception $e) {
        // If there's an error, you can log it or handle it as needed
        return false;
    }
}

// Login function
function login($username, $password) {
    $dbconnection = dbconnection(); // Get database connection
    try {
        // Prepare SQL to fetch user details by username
        $statement = $dbconnection->prepare("SELECT * FROM users WHERE Username = :username");
        $statement->bindValue(':username', $username);
        $statement->execute();
        
        // Fetch user data
        $user = $statement->fetch(PDO::FETCH_ASSOC);
        
        // Check if user exists and password is correct
        if ($user && password_verify($password, $user['Password'])) {
            // Return user data (User_ID, FName, LName, Role, Branch, Email) for session storage
            return [
                'User_ID' => $user['User_ID'], 
                'FName' => $user['FName'], 
                'LName' => $user['LName'], 
                'Role' => $user['Role'], 
                'Branch' => $user['Branch'],
                'Email' => $user['Email']
            ];
        } else {
            // Return false if login fails
            return false;
        }
    } catch (Exception $e) {
        return false;
    }
}

// Inventory function
function inventoryview0() {
    $dbconnection = dbconnection(); 
    try {
        $statement = $dbconnection->prepare("SELECT 
                                                i.Item_ID AS Item_ID,
                                                c.Category_Name,
                                                i.Item_Name,
                                                i.Brand,
                                                i.Description,
                                                inv.Quantity,
                                                i.Supplier,
                                                i.Unit_Price,
                                                i.Updated_At
                                            FROM 
                                                `inventory` inv
                                            JOIN 
                                                `branch` b ON inv.Branch_ID = b.Branch_ID
                                            JOIN 
                                                `item` i ON inv.Item_ID = i.Item_ID
                                            LEFT JOIN 
                                                `category` c ON i.Category_ID = c.Category_ID
                                            WHERE 
                                                inv.Branch_ID = 1 
                                            ORDER BY 
                                                inv.Inventory_ID ASC");
        $statement->execute();
        return $statement;
    } catch (Exception $e) {
        return false;
    }
}

function inventoryview1() {
    $dbconnection = dbconnection(); 
    try {
        $statement = $dbconnection->prepare("SELECT 
                                                i.Item_ID AS Item_ID,
                                                c.Category_Name,
                                                i.Item_Name,
                                                i.Brand,
                                                i.Description,
                                                inv.Quantity,
                                                i.Supplier,
                                                i.Unit_Price,
                                                i.Updated_At
                                            FROM 
                                                `inventory` inv
                                            JOIN 
                                                `branch` b ON inv.Branch_ID = b.Branch_ID
                                            JOIN 
                                                `item` i ON inv.Item_ID = i.Item_ID
                                            LEFT JOIN 
                                                `category` c ON i.Category_ID = c.Category_ID
                                            WHERE 
                                                inv.Branch_ID = 2 
                                            ORDER BY 
                                                inv.Inventory_ID ASC");
        $statement->execute();
        return $statement;
    } catch (Exception $e) {
        return false;
    }
}

function inventoryview2() {
    $dbconnection = dbconnection(); 
    try {
        $statement = $dbconnection->prepare("SELECT 
                                                i.Item_ID AS Item_ID,
                                                c.Category_Name,
                                                i.Item_Name,
                                                i.Brand,
                                                i.Description,
                                                inv.Quantity,
                                                i.Supplier,
                                                i.Unit_Price,
                                                i.Updated_At
                                            FROM 
                                                `inventory` inv
                                            JOIN 
                                                `branch` b ON inv.Branch_ID = b.Branch_ID
                                            JOIN 
                                                `item` i ON inv.Item_ID = i.Item_ID
                                            LEFT JOIN 
                                                `category` c ON i.Category_ID = c.Category_ID
                                            WHERE 
                                                inv.Branch_ID = 3 
                                            ORDER BY 
                                                inv.Inventory_ID ASC");
        $statement->execute();
        return $statement;
    } catch (Exception $e) {
        return false;
    }
}

function userview(){
    $dbconnection = dbconnection(); // Get database connection
    try {
        // Prepare SQL to fetch users by branch
        $statement = $dbconnection->prepare("SELECT * FROM users ORDER BY User_ID ASC");
        $statement->execute();
        // Return user data
        return $statement;
    } catch (Exception $e) {
        return false;
    }
}

function distributionviewMain() {
    $dbconnection = dbconnection(); // Get database connection

    try {
        // Prepare SQL to fetch inventory by branch, including category
        $sql = "SELECT 
                    tr.Transfer_ID AS Transfer_ID,
                    i.Item_ID,
                    i.Item_Name,
                    c.Category_Name,
                    tr.Quantity,
                    tr.Transfer_From,
                    tr.Transfer_To,
                    tr.Status,
                    tr.Deliver_Date
                FROM 
                    `transfer` tr
                JOIN 
                    `item` i ON tr.Item_ID = i.Item_ID
                JOIN 
                    `category` c ON i.Category_ID = c.Category_ID -- Join with category table
                WHERE
                    tr.Transfer_From = 'Main Branch'
                ORDER BY 
                    tr.Transfer_ID ASC";

        $statement = $dbconnection->prepare($sql);
        $statement->execute();

        // Fetch and return all results
        $results = $statement->fetchAll(PDO::FETCH_ASSOC);

        // Close connection (optional, PDO usually handles this automatically)
        $statement = null;
        $dbconnection = null;

        return $results;
    } catch (Exception $e) {
        // Log the error for debugging
        error_log("Error in distributionview: " . $e->getMessage());
        return false;
    }
}

function distributionview1() {
    $dbconnection = dbconnection(); // Get database connection

    try {
        // Prepare SQL to fetch inventory by branch, including category
        $sql = "SELECT 
                    tr.Transfer_ID AS Transfer_ID,
                    i.Item_ID,
                    i.Item_Name,
                    c.Category_Name,
                    tr.Quantity,
                    tr.Transfer_From,
                    tr.Transfer_To,
                    tr.Status,
                    tr.Deliver_Date
                FROM 
                    `transfer` tr
                JOIN 
                    `item` i ON tr.Item_ID = i.Item_ID
                JOIN 
                    `category` c ON i.Category_ID = c.Category_ID -- Join with category table
                WHERE
                    tr.Transfer_From = 'Branch 1'
                ORDER BY 
                    tr.Transfer_ID ASC";

        $statement = $dbconnection->prepare($sql);
        $statement->execute();

        // Fetch and return all results
        $results = $statement->fetchAll(PDO::FETCH_ASSOC);

        // Close connection (optional, PDO usually handles this automatically)
        $statement = null;
        $dbconnection = null;

        return $results;
    } catch (Exception $e) {
        // Log the error for debugging
        error_log("Error in distributionview: " . $e->getMessage());
        return false;
    }
}

function distributionview2() {
    $dbconnection = dbconnection(); // Get database connection

    try {
        // Prepare SQL to fetch inventory by branch, including category
        $sql = "SELECT 
                    tr.Transfer_ID AS Transfer_ID,
                    i.Item_ID,
                    i.Item_Name,
                    c.Category_Name,
                    tr.Quantity,
                    tr.Transfer_From,
                    tr.Transfer_To,
                    tr.Status,
                    tr.Deliver_Date
                FROM 
                    `transfer` tr
                JOIN 
                    `item` i ON tr.Item_ID = i.Item_ID
                JOIN 
                    `category` c ON i.Category_ID = c.Category_ID -- Join with category table
                WHERE
                    tr.Transfer_From = 'Branch 2'
                ORDER BY 
                    tr.Transfer_ID ASC";

        $statement = $dbconnection->prepare($sql);
        $statement->execute();

        // Fetch and return all results
        $results = $statement->fetchAll(PDO::FETCH_ASSOC);

        // Close connection (optional, PDO usually handles this automatically)
        $statement = null;
        $dbconnection = null;

        return $results;
    } catch (Exception $e) {
        // Log the error for debugging
        error_log("Error in distributionview: " . $e->getMessage());
        return false;
    }
}


function addItemMain($itemname, $brand, $categoryName, $description, $supplier, $quantity, $unitprice) {
    $dbconnection = dbconnection(); 
    try {
        $dbconnection->beginTransaction();

        // Check if category exists
        $statement = $dbconnection->prepare("SELECT Category_ID FROM category WHERE Category_Name = :categoryName");
        $statement->execute([':categoryName' => $categoryName]);
        $category = $statement->fetch();

        // If category doesn't exist, insert it
        if (!$category) {
            $statement = $dbconnection->prepare("INSERT INTO category (Category_Name, Category_Type) VALUES (:categoryName, 'Default')");
            $statement->execute([':categoryName' => $categoryName]);
            $categoryId = $dbconnection->lastInsertId();
        } else {
            $categoryId = $category['Category_ID'];
        }

        // Insert item
        $statement = $dbconnection->prepare("INSERT INTO item (Item_Name, Brand, Category_ID, Description, Supplier, Unit_Price) 
                                              VALUES (:itemname, :brand, :categoryId, :description, :supplier, :unitprice)");
        $statement->bindValue(':itemname', $itemname);
        $statement->bindValue(':brand', $brand);
        $statement->bindValue(':categoryId', $categoryId);
        $statement->bindValue(':description', $description);
        $statement->bindValue(':supplier', $supplier);
        $statement->bindValue(':unitprice', $unitprice);
        $statement->execute();

        // Get last inserted Item_ID
        $lastItemId = $dbconnection->lastInsertId();

        // Insert inventory record
        $statement = $dbconnection->prepare("INSERT INTO inventory (Item_ID, Branch_ID, Quantity) 
                                              VALUES (:item_id, 1, :quantity)");
        $statement->bindValue(':item_id', $lastItemId);
        $statement->bindValue(':quantity', $quantity);
        $statement->execute();

        // Commit transaction
        $dbconnection->commit();

        return true;
    } catch (Exception $e) {
        $dbconnection->rollBack();
        error_log("Error adding item: " . $e->getMessage());
        return false;
    }
}

function addItemBranch1($itemname, $brand, $categoryName, $description, $supplier, $quantity, $unitprice) {
    $dbconnection = dbconnection(); 
    try {
        $dbconnection->beginTransaction();

        // Check if category exists
        $statement = $dbconnection->prepare("SELECT Category_ID FROM category WHERE Category_Name = :categoryName");
        $statement->execute([':categoryName' => $categoryName]);
        $category = $statement->fetch();

        // If category doesn't exist, insert it
        if (!$category) {
            $statement = $dbconnection->prepare("INSERT INTO category (Category_Name, Category_Type) VALUES (:categoryName, 'Default')");
            $statement->execute([':categoryName' => $categoryName]);
            $categoryId = $dbconnection->lastInsertId();
        } else {
            $categoryId = $category['Category_ID'];
        }

        // Insert item
        $statement = $dbconnection->prepare("INSERT INTO item (Item_Name, Brand, Category_ID, Description, Supplier, Unit_Price) 
                                              VALUES (:itemname, :brand, :categoryId, :description, :supplier, :unitprice)");
        $statement->bindValue(':itemname', $itemname);
        $statement->bindValue(':brand', $brand);
        $statement->bindValue(':categoryId', $categoryId);
        $statement->bindValue(':description', $description);
        $statement->bindValue(':supplier', $supplier);
        $statement->bindValue(':unitprice', $unitprice);
        $statement->execute();

        // Get last inserted Item_ID
        $lastItemId = $dbconnection->lastInsertId();

        // Insert inventory record
        $statement = $dbconnection->prepare("INSERT INTO inventory (Item_ID, Branch_ID, Quantity) 
                                              VALUES (:item_id, 2, :quantity)");
        $statement->bindValue(':item_id', $lastItemId);
        $statement->bindValue(':quantity', $quantity);
        $statement->execute();

        // Commit transaction
        $dbconnection->commit();

        return true;
    } catch (Exception $e) {
        $dbconnection->rollBack();
        error_log("Error adding item: " . $e->getMessage());
        return false;
    }
}

function addItemBranch2($itemname, $brand, $categoryName, $description, $supplier, $quantity, $unitprice) {
    $dbconnection = dbconnection(); 
    try {
        $dbconnection->beginTransaction();

        // Check if category exists
        $statement = $dbconnection->prepare("SELECT Category_ID FROM category WHERE Category_Name = :categoryName");
        $statement->execute([':categoryName' => $categoryName]);
        $category = $statement->fetch();

        // If category doesn't exist, insert it
        if (!$category) {
            $statement = $dbconnection->prepare("INSERT INTO category (Category_Name, Category_Type) VALUES (:categoryName, 'Default')");
            $statement->execute([':categoryName' => $categoryName]);
            $categoryId = $dbconnection->lastInsertId();
        } else {
            $categoryId = $category['Category_ID'];
        }

        // Insert item
        $statement = $dbconnection->prepare("INSERT INTO item (Item_Name, Brand, Category_ID, Description, Supplier, Unit_Price) 
                                              VALUES (:itemname, :brand, :categoryId, :description, :supplier, :unitprice)");
        $statement->bindValue(':itemname', $itemname);
        $statement->bindValue(':brand', $brand);
        $statement->bindValue(':categoryId', $categoryId);
        $statement->bindValue(':description', $description);
        $statement->bindValue(':supplier', $supplier);
        $statement->bindValue(':unitprice', $unitprice);
        $statement->execute();

        // Get last inserted Item_ID
        $lastItemId = $dbconnection->lastInsertId();

        // Insert inventory record
        $statement = $dbconnection->prepare("INSERT INTO inventory (Item_ID, Branch_ID, Quantity) 
                                              VALUES (:item_id, 3, :quantity)");
        $statement->bindValue(':item_id', $lastItemId);
        $statement->bindValue(':quantity', $quantity);
        $statement->execute();

        // Commit transaction
        $dbconnection->commit();

        return true;
    } catch (Exception $e) {
        $dbconnection->rollBack();
        error_log("Error adding item: " . $e->getMessage());
        return false;
    }
}



function editItem($itemid, $itemname, $brand, $categoryName, $description, $supplier, $quantity, $unitprice) {
    $dbconnection = dbconnection(); 
    try {
        $dbconnection->beginTransaction();

        // Check if category exists
        $statement = $dbconnection->prepare("SELECT Category_ID FROM category WHERE Category_Name = :categoryName");
        $statement->execute([':categoryName' => $categoryName]);
        $category = $statement->fetch();

        // If category doesn't exist, insert it
        if (!$category) {
            $statement = $dbconnection->prepare("INSERT INTO category (Category_Name, Category_Type) VALUES (:categoryName, 'Default')");
            $statement->execute([':categoryName' => $categoryName]);
            $categoryId = $dbconnection->lastInsertId();
        } else {
            $categoryId = $category['Category_ID'];
        }

        // Update item
        $statement = $dbconnection->prepare("UPDATE item 
                                              SET Item_Name = :itemname,
                                                  Brand = :brand,
                                                  Category_ID = :categoryId, 
                                                  Description = :description,
                                                  Supplier = :supplier,
                                                  Unit_Price = :unitprice, 
                                                  Updated_At = NOW()
                                              WHERE Item_ID = :itemid");
        $statement->execute([
            ':itemname' => $itemname,
            ':brand' => $brand,
            ':categoryId' => $categoryId,
            ':description' => $description,
            ':supplier' => $supplier,
            ':unitprice' => $unitprice,
            ':itemid' => $itemid
        ]);

        // Update inventory record
        $statement = $dbconnection->prepare("UPDATE inventory 
                                              SET Quantity = :quantity  
                                              WHERE Item_ID = :itemid");
        $statement->execute([
            ':quantity' => $quantity,
            ':itemid' => $itemid
        ]);

        // Commit transaction
        $dbconnection->commit();

        return true;
    } catch (Exception $e) {
        $dbconnection->rollBack();
        error_log("Error editing item: " . $e->getMessage());
        return false;
    }
}


function editAcc($accid, $fname, $lname, $username, $email, $phone, $role, $branch) {
    $dbconnection = dbconnection(); 
    try {
        
        // Update user
        $statement = $dbconnection->prepare("UPDATE users 
                                              SET 
                                                  FName = :editFName, 
                                                  LName = :editLName, 
                                                  Username = :editUsername, 
                                                  Email = :editEmail, 
                                                  Phone = :editPhone, 
                                                  Role = :editRole,
                                                  Branch = :editBranch, 
                                                  Updated_At = NOW()
                                              WHERE User_ID = :accid");
        $statement->execute([
            ':editFName' => $fname,
            ':editLName' => $lname,
            ':editUsername' => $username,
            ':editEmail' => $email,
            ':editPhone' => $phone,
            ':editRole' => $role,
            ':editBranch' => $branch,
            ':accid' => $accid
        ]);

        return true;
    
    } catch (Exception $e) {

        return false;
        // Rollback in case of error
        $dbconnection->rollBack();
        error_log("Error editing item: " . $e->getMessage());
        header("Location: ../edit_acc.php?$accid=failed");
        exit;
    }
}

function deleteAcc($accid) {
    $dbconnection = dbconnection();

    try {
        $statement = $dbconnection->prepare("DELETE FROM users WHERE User_ID = :accid");
        $statement->execute([
            ':accid' => $accid
        ]);

        return true;
    } catch (Exception $e) {
        return false;
        // Rollback in case of error
        $dbconnection->rollBack();
        error_log("Error deleting item: " . $e->getMessage());
        header("Location: ../edit_acc.php?$accid=failed");
        exit;
    }
}

function deleteItem($itemid) {
    $dbconnection = dbconnection();

    try {
        
        $statement = $dbconnection->prepare("DELETE FROM item WHERE Item_ID = :itemid");
        $statement->execute([
            ':itemid' => $itemid
        ]);

        $statement = $dbconnection->prepare("DELETE FROM inventory WHERE Item_ID = :itemid");
        $statement->execute([
            ':itemid' => $itemid
        ]);

        return true;    
    } catch (Exception $e) {
        return false;
        // Rollback in case of error
        $dbconnection->rollBack();
        error_log("Error deleting item: " . $e->getMessage());
        header("Location: ../edit_item.php?$itemid=failed");
        exit;
    }
}

function categoryView() {
    $dbconnection = dbconnection(); // Get database connection
    try {
        // Prepare SQL to fetch inventory by branch
        $statement = $dbconnection->prepare("SELECT * FROM category ORDER BY Category_ID ASC");
        $statement->execute();
        // Return inventory data
        return $statement;
    } catch (Exception $e) {
        return false;
    }
}

function addCategory($categoryName, $categoryType) {
    $dbconnection = dbconnection(); // Get database connection
    try {
        // Prepare SQL to fetch inventory by branch
        $statement = $dbconnection->prepare("INSERT INTO category (Category_Name, Category_Type) VALUES (:categoryName, :categoryType)");
        $statement->execute([
            ':categoryName' => $categoryName,
            ':categoryType' => $categoryType
        ]);
        // Return inventory data
        return true;
    } catch (Exception $e) {
        return false;
    }
}

function editCategory($categoryID, $categoryName, $categoryType) {
    $dbconnection = dbconnection(); // Get database connection
    try {
        // Prepare SQL to fetch inventory by branch
        $statement = $dbconnection->prepare("UPDATE category SET Category_Name = :categoryName, Category_Type = :categoryType WHERE Category_ID = :categoryID");
        $statement->execute([
            ':categoryName' => $categoryName,
            ':categoryType' => $categoryType,
            ':categoryID' => $categoryID
        ]);
        // Return inventory data
        return true;
    } catch (Exception $e) {
        return false;
    }
}

function deleteCategory($categoryID) {
    $dbconnection = dbconnection(); // Get database connection
    try {
        // Prepare SQL to fetch inventory by branch
        $statement = $dbconnection->prepare("DELETE FROM category WHERE Category_ID = :categoryID");
        $statement->execute([
            ':categoryID' => $categoryID
        ]);
        // Return inventory data
        return true;
    } catch (Exception $e) {
        return false;
    }
}

function fetchCategory() {
    $dbconnection = dbconnection(); // Get database connection
    try {
        // Prepare SQL to fetch inventory by branch
        $statement = $dbconnection->prepare("SELECT Category_Name, Category_Type FROM category");
        $statement->execute();
        // Return inventory data
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
        return false;
    }
}

function verifyAndUpdatePassword($userId, $enteredPassword, $newPassword) {
    // Database connection
    $dbconnection = dbconnection(); // Assumes this function provides a valid database connection
    
    try {
        // Step 1: Fetch the hashed password from the database
        $statement = $dbconnection->prepare("SELECT password FROM users WHERE User_ID = :user_id");
        $statement->bindParam(':user_id', $userId, PDO::PARAM_INT);
        $statement->execute();

        $user = $statement->fetch(PDO::FETCH_ASSOC);
        if (!$user) {
            return "User not found.";
        }

        $hashedPassword = $user['password'];

        // Step 2: Verify the entered password with the hashed password
        if (password_verify($enteredPassword, $hashedPassword)) {
            // Step 3: Hash the new password
            $newHashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

            // Step 4: Update the password in the database
            $updateStmt = $dbconnection->prepare("UPDATE users SET Password = :new_password WHERE User_ID = :user_id");
            $updateStmt->bindParam(':new_password', $newHashedPassword);
            $updateStmt->bindParam(':user_id', $userId, PDO::PARAM_INT);

            if ($updateStmt->execute()) {
                header('Location: dashboard.php?section=settings&success=Password updated successfully');
                exit;
            } else {
                header('Location: dashboard.php?section=settings&error=Failed to update the password');
                exit;
            }
        } else {
            header('Location: dashboard.php?section=settings&error=Entered password is incorrect');
            exit;
        }
    } catch (Exception $e) {
        return "Error: " . $e->getMessage();
    }
}

function addDistribution($itemId, $itemName, $category, $transferFrom, $transferTo, $quantity, $status, $deliverDate) {
    $dbconnection = dbconnection(); // Get database connection
    try {
        // Fetch the Item details along with Category_Name
        $sqlItem = "SELECT i.Item_ID, i.Item_Name, c.Category_Name 
                    FROM item i
                    JOIN category c ON i.Category_ID = c.Category_ID
                    WHERE i.Item_ID = :item_id LIMIT 1";
        $stmtItem = $dbconnection->prepare($sqlItem);
        $stmtItem->execute([':item_id' => $itemId]);
        $itemResult = $stmtItem->fetch(PDO::FETCH_ASSOC);

        // Check if the item exists and get the Category_Name
        if ($itemResult) {
            $itemName = $itemResult['Item_Name'];       // The item name
            $categoryName = $itemResult['Category_Name'];  // The category name from the category table
        } else {
            // If the item does not exist, handle it as an error
            return false;
        }

        // Insert distribution record into the transfer table
        $sql = "INSERT INTO transfer (Item_ID, Quantity, Transfer_From, Transfer_To, Status, Deliver_Date)
                VALUES (:item_id, :quantity, :transfer_from, :transfer_to, :status, :deliver_date)";
        $stmt = $dbconnection->prepare($sql);
        $stmt->execute([
            ':item_id' => $itemId,
            ':quantity' => $quantity,
            ':transfer_from' => $transferFrom,
            ':transfer_to' => $transferTo,
            ':status' => $status,
            ':deliver_date' => $deliverDate
        ]);

        return true;
    } catch (Exception $e) {
        return false;
    }
}


?>
