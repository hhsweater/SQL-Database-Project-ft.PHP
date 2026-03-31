<select name="id">
    <?php foreach ($courses as $course) : ?>
        <option value='<?php echo $course->get_code() ?>'><?php echo $course->get_code() ?></option>
    <?php endforeach; ?>
</select>
