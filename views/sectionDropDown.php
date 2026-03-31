
<select name="id">
    <?php foreach ($sections as $section) : ?>
        <option value='<?php echo $section->get_id() ?>'><?php echo $section->get_course_code() ?></option>
    <?php endforeach; ?>
</select>