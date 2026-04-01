<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>faculty</title>
                <?php
   //include CSS Style Sheet
        echo "<link rel='stylesheet' type='text/css' href='views/style.php' />";
        ?>
    </head>
    <?php include ('navBar.php'); ?>
    </br>
    <body>
        <table>
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Email</th>
            </tr>
            <?php foreach ($faculties as $faculty) : ?>
                <tr>
                    <td><?php echo $faculty->get_id(); ?></td>
                    <td><?php echo $faculty->get_name(); ?></td>
                    <td><?php echo $faculty->get_email(); ?></td>
                </tr>

            <?php endforeach; ?>
        </table>
        </br>
        <h2>Add or Update faculty</h2>
        <form action="faculty.php" method="post"> 
            <label>Name:</label> 
            <input type="text" name="name"/><br> 
            <label>Email:</label> 
            <input type="text" name="email"/><br> 
            <input type="hidden" name='action' value='insert_or_update'/>
            <input type="radio" name="insert_or_update" value="insert" checked>Add</br>
            <input type="radio" name="insert_or_update" value="update">Update</br>
            <label>&nbsp;</label>
            <input type="submit" value="Submit"/> 
        </form>
        </br>
        <h2>Delete Faculty</h2>
        <form action="faculty.php" method="post"> 
            <?php include("facultyDropDown.php"); ?>
            <input type="hidden" name='action' value='delete'/>
            <label>&nbsp;</label>
            <input type="submit" value="Delete faculty"/> 
        </form>
    </body>
    </br>
    <?php include ('footer.php'); ?>
</html>
