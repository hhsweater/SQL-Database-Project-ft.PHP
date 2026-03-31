<select name="id">
    <?php foreach ($students as $student) : ?>
        <option value='<?php echo $student->get_id() ?>'><?php echo $student->get_name() ?></option>
    <?php endforeach; ?>
</select>
