<?php
// print out all schemas sent to View

if ($this->schemas) {
    foreach ($this->schemas as $schema) {
        echo $schema;
    }
}
