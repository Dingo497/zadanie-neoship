<?php

$recipient_data = new get_recipient_data($array);
//$recipient_data->get_country();
echo "<pre>";
print_r($recipient_data->result_data());
echo "<pre>";

echo "<br><br><hr>";

echo "<pre>";
print_r($recipient_data->shit());
echo "<pre>";