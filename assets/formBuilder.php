<?php

class formBuilder
{
    function startPostForm($redirect)
    {
        echo '<form action="'.$redirect.'" method="POST">';
    }

    function startGetForm($redirect)
    {
        echo '<form action="'.$redirect.'" method="GET">';
    }

    function addTextRow($name,$id,$label,$aria)
    {
        echo '<div class="form-group">
            <label for="'.$id.'">'.$label.'</label>
            <input type="text" class="form-control" name="'.$name.'" id="'.$id.'" aria-describedby="'.$aria.'">
        </div>';
    }

    function addPasswordRow($name,$id,$label,$aria)
    {
        echo '<div class="form-group">
            <label for="'.$id.'">'.$label.'</label>
            <input type="password" class="form-control" name="'.$name.'" id="'.$id.'" aria-describedby="'.$aria.'">
        </div>';
    }

    function addEmailRow($name,$id,$label,$aria)
    {
        echo '<div class="form-group">
            <label for="'.$id.'">'.$label.'</label>
            <input type="email" class="form-control" name="'.$name.'" id="'.$id.'" aria-describedby="'.$aria.'">
        </div>';
    }

    function endForm()
    {
        echo '</form>';
    }
}