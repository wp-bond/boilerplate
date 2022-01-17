<?php
// print out all schemas sent to View

if (view()->schemas) {
    foreach (view()->schemas as $schema) {
        echo $schema;
    }
}
