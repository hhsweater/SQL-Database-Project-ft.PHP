<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>courses</title>
    </head>
    <?php include ('navBar.php'); ?>
    </br>
    <body>
        <table>
            <tr>
                <th>Course Code</th>
                <th>Course Name</th>
                <th>Description</th>
                <th>credits</th>
            </tr>
            <?php foreach ($courses as $course) : ?>
                <tr>
                    <td><?php echo $course->get_code(); ?></td>
                    <td><?php echo $course->get_name(); ?></td>
                    <td><?php echo $course->get_description(); ?></td>
                    <td><?php echo $course->get_credits(); ?></td>
                </tr>

            <?php endforeach; ?>
        </table>
        </br>
        <h2>Add or Update course</h2>
        <form action="course.php" method="post"> 
            <label>Course Name:</label> 
            <input type="text" name="name"/><br> 
            <label>Course Code:</label> 
            <input type="text" name="code"/><br> 
            <label>credits:</label> 
            <input type="text" name="credits"/><br> 
            <label>desc:</label> 
            <input type="text" name="description"/><br> 
            <input type="hidden" name='action' value='insert_or_update'/>
            <input type="radio" name="insert_or_update" value="insert" checked>Add</br>
            <input type="radio" name="insert_or_update" value="update">Update</br>
            <label>&nbsp;</label>
            <input type="submit" value="Submit"/> 
        </form>
        </br>
        <h2>Delete course</h2>
        <form action="course.php" method="post"> 
            <?php include("courseDropDown.php"); ?>
            <input type="hidden" name='action' value='delete'/>
            <label>&nbsp;</label>
            <input type="submit" value="Delete course"/> 
        </form>
    </body>
    </br>
    <?php include ('footer.php'); ?>
</html>
