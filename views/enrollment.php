<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>enrollments</title>
    </head>
    <?php include ('navBar.php'); ?>
    </br>
    <body>
        <table>
            <tr>
                <th>Enrollment Id</th>
                <th>Student Id</th>
                <th>Section Id</th>
                <th>Grade</th>
            </tr>
            <?php foreach ($enrollments as $enrollment) : ?>
                <tr>
                    <td><?php echo $enrollment->get_id(); ?></td>
                    <td><?php echo $enrollment->get_student_id(); ?></td>
                    <td><?php echo $enrollment->get_section_id(); ?></td>
                    <td><?php echo $enrollment->get_grade(); ?></td>
                </tr>

            <?php endforeach; ?>
        </table>
        </br>
        <h2>Add or Update enrollment</h2>
        <form action="enrollment.php" method="post"> 
            <label>Student Id:</label> 
            <input type="text" name="student_id"/><br> 
            <label>Grade:</label> 
            <input type="text" name="grade"/><br> 
            <label>Section Id:</label> 
            <input type="text" name="section_id"/><br> 
            <input type="hidden" name='action' value='insert_or_update'/>
            <input type="radio" name="insert_or_update" value="insert" checked>Add</br>
            <input type="radio" name="insert_or_update" value="update">Update</br>
            <label>&nbsp;</label>
            <input type="submit" value="Submit"/> 
        </form>
        </br>
        <h2>Delete enrollment</h2>
        <form action="enrollment.php" method="post"> 
            <?php include("enrollmentDropDown.php"); ?>
            <input type="hidden" name='action' value='delete'/>
            <label>&nbsp;</label>
            <input type="submit" value="Delete enrollment"/> 
        </form>
    </body>
    </br>
    <?php include ('footer.php'); ?>
</html>