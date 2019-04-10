<?php
require_once __DIR__."/includes/header.php";

//DATABASE CONNECTION
require_once "conn.php";

$sqlselectc = "SELECT * from lu_MenuCategory";
$resultc = $db->prepare($sqlselectc);
$resultc ->execute();

$errormsg = '';
$postSuccess = false;
$postError = false;
if ( isset($_POST['newMenuSubmit']) )
{

    //Data Cleansing
    $formfield['productname'] = trim($_POST['productname']);
    $formfield['productprice'] = trim($_POST['productprice']);
    $formfield['shortname'] = trim($_POST['shortname']);
    $formfield['newcategory'] = trim($_POST['newcategory']);

    //Check for empty fields
    if(empty($formfield['productname'])){$errormsg .= '<p>The product name is required</p>';}
    if(empty($formfield['productprice'])){$errormsg .= '<p>The product price is required</p>';}
    if(empty($formfield['newcategory'])){$errormsg .= '<p>The category is required</p>';}

    if($errormsg == '')
    {

        try
        {
            //enter data into database
            $sqlinsert = 'INSERT INTO menu_MenuItem (Name, Price, ShortName, id_category)
								VALUES(:productname, :productprice, :shortname, :newcategory)';
            $stmtinsert = $db->prepare($sqlinsert);
            $stmtinsert->bindvalue(':productname', $_POST['productname']);
            $stmtinsert->bindvalue(':productprice', $_POST['productprice']);
            $stmtinsert->bindvalue(':shortname', $_POST['shortname']);
            $stmtinsert->bindvalue(':newcategory', $_POST['newcategory']);

            $stmtinsert->execute();

        }//try
        catch(PDOException $e)
        {
            $errormsg .= "<p>".$e->getMessage()."</p>";
            exit();
            $postError = true;
        }
    }else{
        $postError = true;
    }
}//if isset submit


?>


<div class="row">
    <div class="col-md-3"></div>
    <div class="col-md-6">
        <h1 class="text-center">Create New Menu Item</h1>
        <br>
    </div>
    <div class="col-md-3"></div>
</div>
<div class="row">
    <div class="col-md-4"></div>
    <div class="col-md-4">
        <div class="form-group">
            <form action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
                <label for="productname">Product Name</label>
                <input class="form-control" id="productname" name="productname" type="text" value="<?php if( isset($_POST['productname'])){echo $_POST['productname'];}?>">

                <label for="productprice">Product Price</label>
                <input class="form-control" id="productprice" name="productprice" type="text" value="<?php if( isset($_POST['productprice'])){echo $_POST['productprice'];}?>">

                <label for="shortname">Short Name</label>
                <input class="form-control" id="shortname" name="shortname" type="text" value="<?php if( isset($_POST['shortname'])){echo $_POST['shortname'];}?>">

                <label for="newcategory">Category</label>
                <select class="form-control" id="newcategory" name="newcategory">
                    <option value="XX">Select a Category</option>
                    <?php while ($row = $resultc ->fetch() )
                    {
                        echo '<option value="'. $row['id_Category'] . '">'  . $row['Name'] . '</option>';
                    }
                    ?>
                </select>

                <br>
                <input class="btn btn-primary" type="submit" name="newMenuSubmit">
            </form>
        </div>
    </div>
    <div class="col-md-4"></div>
</div>
<div class="modal fade" id="newMenuSuccess" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times</span>
                </button>
            </div>
            <div class="modal-body">
                <p>New menu item was created successfully!</p>
            </div>
            <div class="modal-footer">
                <a href="index.php"><button type="button" class="btn btn-secondary">Close</button></a>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="newMenuError" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Error</h5>
            </div>
            <div class="modal-body"><?php echo $errormsg ?>
            </div>
            <div class="modal-footer">
                <a>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </a>
            </div>
        </div>
    </div>
</div>
<?php
require_once __DIR__."/includes/footer.php";
if ($postError){
    echo "<script src='js/customer/createCustomerError.js'></script>";
}
if ($postSuccess){
    echo "<script src='js/customer/createCustomerSuccess.js'></script>";
}
?>