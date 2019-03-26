<?php
function BulidKeyboard($text = [], int $sort){
        $Line = 0;
        $count_aded = 0;
        $keyboard = [];
        foreach ($text as $add) {
            $keyboard[$Line][$count_aded]['text'] = $add;
            $count_aded+= 1;
            if ($count_aded == $sort) {
                $count_aded-= $sort;
                $Line+= 1;
            }
        }
        return $keyboard;
    }

   function BulidInlineKeyboard($text = [], $cb = [], int $sort) {
        $Line = 0;
        $count_aded = 0;
        $keyboard = [];
        foreach ($text as $add) {
            $keyboard[$Line][$count_aded]['text'] = $add;
            $count_aded+= 1;
            if ($count_aded == $sort) {
                $count_aded-= $sort;
                $Line+= 1;
            }
        }
        $Line = 0;
        $count_aded = 0;
        foreach ($cb as $cb_add) {
            $keyboard[$Line][$count_aded]['callback_data'] = $cb_add;
            $count_aded+= 1;
            if ($count_aded == $sort) {
                $count_aded-= $sort;
                $Line+= 1;
            }
        }
        return $keyboard;
    }
?>
