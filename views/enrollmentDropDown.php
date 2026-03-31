<select name="id">
    <?php foreach ($enrollments as $enrollment) : ?>
        <option value='<?php echo $enrollment->get_id() ?>'><?php echo $enrollment->get_id() ?></option>
    <?php endforeach; ?>
</select>
