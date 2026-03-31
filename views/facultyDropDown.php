<select name="id">
    <?php foreach ($faculties as $faculty) : ?>
        <option value='<?php echo $faculty->get_id() ?>'><?php echo $faculty->get_id() ?></option>
    <?php endforeach; ?>
</select>
