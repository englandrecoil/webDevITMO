<?php
require_once "others/appcont.php";
?>

<h3>Свеча</h3>
<table class = "table">
        <tr>
            <th>№</th>
            <th>Название</th>
            <th>Цена</th>
            <th>Описание</th>
            <th>Действия</th>
        </tr>
    </thead>
    <tbody>
        <?php
            $candles = $repos->getAll();
            $number = 1;
            foreach ($candles as $candle) {
                $id = $candle->id;
                echo '<tr>';
                print_r('<td>'. $number++. '</td>');
                print_r('<td>'. $candle->name . '</td>');
                print_r('<td>'. $candle->price . '</td>');
                print_r('<td>'. $candle->description . '</td>');
                print_r("<td>
                            <a href='update.php?id=$id'>
                            <img src='edit_icon.png'>
                        </td>");
                print_r("<td>
                            <a href='delete.php?id=$id'>
                            <img src='delete_icon.png'>
                        </td>");

                echo '</tr>';

            }
        ?>
    </tbody>
</table>
<button onclick="location.href='create.php'" class = "button" >Добавить</button>

